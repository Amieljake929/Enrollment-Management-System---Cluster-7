<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    private $allStrands = [
        'ABM' => 'Accountancy, Business and Management',
        'GAS' => 'General Academic Strand',
        'HECF' => 'Home Economics - Culinary Arts and Food Services',
        'HEHRS' => 'Home Economics - Hotel and Restaurant Services',
        'HEHO' => 'Home Economics - Hotel Operation',
        'HETEM' => 'Home Economics - Tourism and Event Management',
        'HUMSS' => 'Humanities and Social Sciences',
        'ICT-HW' => 'ICT - Hardware',
        'ICT-CP' => 'ICT - Programming',
        'ICT-Animation' => 'ICT - Animation',
        'ICT-CCS' => 'ICT - Contact Center Services',
        'ICT-VisualGraphics' => 'ICT - Visual Graphics',
        'STEM' => 'Science, Technology, Engineering and Mathematics',
        'STEM-PBM' => 'STEM - Pre-Baccalaureate Maritime',
        'SMAW' => 'Shielded Metal Arc Welding',
        'SPORTS' => 'Sports Track',
        'AUTO' => 'Automotive',
        'ICT' => 'Information and Communications Technology',
        'HE' => 'Home Economics',
    ];

    public function showQuiz()
    {
        return view('website.ShsQuiz');
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers');
        if (!$answers || !is_array($answers)) {
            return back()->with('error', 'Please answer all questions.');
        }

        $questionsPath = public_path('data/quiz_questions.json');
        if (!file_exists($questionsPath)) {
            Log::error('Quiz questions JSON not found at: ' . $questionsPath);
            return back()->with('error', 'Quiz configuration is missing.');
        }

        $questions = json_decode(file_get_contents($questionsPath), true);

        // Tally with weighted scoring
        $strandTally = array_fill_keys(array_keys($this->allStrands), 0);

        $interestMap = [
            'very_interested' => 3,
            'interested' => 2,
            'slightly_interested' => 1,
            'not_interested' => 0,
        ];

        foreach ($answers as $qId => $interestLevel) {
            $question = collect($questions)->firstWhere('id', (int)$qId);
            if (!$question) continue;

            $strand = $question['strand'];
            $points = $interestMap[$interestLevel] ?? 0;
            $strandTally[$strand] += $points;
        }

        // Remove zero-score strands
        $strandTally = array_filter($strandTally, fn($score) => $score > 0);

        if (empty($strandTally)) {
            return back()->with('error', 'No valid answers recorded.');
        }

        arsort($strandTally);
        $topStrands = array_keys(array_slice($strandTally, 0, 3)); // Top 3 only
        $localBest = $topStrands[0];
        $localBestScore = $strandTally[$localBest];
        $total = array_sum($strandTally);

        // === Generate Rich Narrative for AI ===
        $narrative = $this->generateRichNarrative($strandTally, $total);

        // === Input for Hugging Face API ===
        $profile = "Student Profile: $narrative The student's top aligned tracks are: " . implode(', ', $topStrands) . ". Based on their interests, which of these is the best fit?";

        $apiResults = [];
        $rawScores = [];

        $hfApiKey = env('HUGGINGFACE_API_KEY'); // ✅ secure best practice
        if ($hfApiKey) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $hfApiKey,
                ])->timeout(30)->post('https://api-inference.huggingface.co/models/facebook/bart-large-mnli', [
                    'inputs' => $profile,
                    'parameters' => [
                        'candidate_labels' => $topStrands,
                        'hypothesis_template' => 'The student\'s interests, strengths, and responses strongly indicate they are best suited for the {} strand.',
                        'multi_label' => false,
                    ],
                ]);

                $result = $response->json();
                if (isset($result['labels']) && isset($result['scores'])) {
                    $apiResults = array_combine($result['labels'], $result['scores']);
                    arsort($apiResults);
                    $rawScores = $apiResults;
                }
            } catch (\Exception $e) {
                Log::warning('Hugging Face API failed: ' . $e->getMessage());
            }
        } else {
            Log::warning('Hugging Face API Key not set in .env');
        }

        // === FINAL TOP 3 WITH CONFIDENCE ===
        $finalRecommendations = [];

        foreach ($topStrands as $idx => $strand) {
            $localScore = $strandTally[$strand];
            $dominance = $localScore / $total;

            // Base confidence: from AI if available, else from local dominance + score gap
            if (isset($rawScores[$strand])) {
                $confidence = 50 + ($rawScores[$strand] * 50); // 50–100%
            } else {
                // Fallback: use local dominance and gap from next
                $nextScore = $idx + 1 < count($topStrands) ? $strandTally[$topStrands[$idx + 1]] : 0;
                $gap = $localScore - $nextScore;

                if ($dominance > 0.5 && $gap >= 5) {
                    $confidence = 85 + mt_rand(0, 10);
                } elseif ($dominance > 0.4 && $gap >= 3) {
                    $confidence = 75 + mt_rand(0, 8);
                } else {
                    $confidence = 65 + mt_rand(0, 7);
                }
            }

            $confidence = round(max(60, min(98, $confidence)), 2);

            $finalRecommendations[] = [
                'strand' => $strand,
                'description' => $this->allStrands[$strand],
                'local_score' => $localScore,
                'confidence' => $confidence,
                'is_top' => $idx === 0,
            ];
        }

        // Sort by confidence (in case AI reordered)
        usort($finalRecommendations, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        return view('website.ShsQuizResult', [
            'recommendations' => $finalRecommendations,
            'localScores'       => $strandTally,
            'totalScore'        => $total,
            'narrative'         => $narrative,
        ]);
    }

    private function generateRichNarrative($tally, $total)
    {
        arsort($tally);
        $top3 = array_slice($tally, 0, 3);

        $parts = [];
        foreach ($top3 as $strand => $score) {
            $pct = round(($score / $total) * 100, 1);
            $parts[] = "$strand ($pct%)";
        }

        $topStrand = key($top3);
        $dominance = $top3[$topStrand] / $total;

        $baseNarratives = [
            'HUMSS' => "enjoys writing, debating, understanding people, and exploring social issues",
            'GAS' => "has broad academic interests and enjoys learning across subjects",
            'ABM' => "is interested in business, money, entrepreneurship, and managing projects",
            'STEM' => "excels in math and science, enjoys problem-solving and logical thinking",
            'ICT' => "is tech-savvy, enjoys coding, building apps, or fixing computers",
            'HE' => "likes cooking, serving, organizing events, or helping others",
            'SPORTS' => "prefers physical activity, teamwork, and athletic challenges",
            'AUTO' => "is curious about vehicles, mechanics, and hands-on repair work",
            'SMAW' => "is drawn to welding, metalwork, and industrial skills",
        ];

        $interestDesc = $baseNarratives[$topStrand] ?? $baseNarratives['GAS'];

        return "The student scored highest in " . implode(', ', $parts) . ". "
            . "They $interestDesc. "
            . "Their strongest alignment is with $topStrand, which received the most points from their answers. "
            . "They show clear interest in practical, creative, or technical tasks depending on the strand.";
    }
}
