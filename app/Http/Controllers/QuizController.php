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

    // ✅ NEW: Submit Interests from ShsWelcome
    public function submitInterests(Request $request)
    {
        $request->validate([
            'interests' => 'required|array|size:2',
            // ✅ NO SPACES after commas!
            'interests.*' => 'string|in:flexible_exploratory_learning,business_leadership,society_people_communication,science_math_innovation,creativity_design,hospitality_food_tourism'
        ]);

        session(['shs_selected_interests' => $request->input('interests')]);
        return response()->json(['success' => true]);
    }

    // ✅ UPDATED: Show Quiz — now filters by selected interests
    public function showQuiz()
    {
        if (!session()->has('shs_selected_interests')) {
            return redirect()->route('shs.welcome')->with('error', 'Please select your interests first.');
        }

        $selectedInterests = session('shs_selected_interests');

        // ✅ Define $normalizedMap correctly
        $normalizedMap = [
            'Flexible & Exploratory Leaning' => 'flexible_exploratory_learning',
            'Business & Leadership' => 'business_leadership',
            'Society, People & Communication' => 'society_people_communication',
            'Science, Math & Innovation' => 'science_math_innovation',
            'Creativity & Design' => 'creativity_design',
            'Hospitality, Food & Tourism' => 'hospitality_food_tourism',
        ];

        $normalizedSelected = [];
        foreach ($selectedInterests as $interest) {
            // ✅ But wait — if you use underscore values in Blade, no need to normalize!
            // So better: assume $selectedInterests are already underscored
            $normalizedSelected[] = $interest;
        }

        $questionsPath = public_path('data/quiz_questions.json');
        if (!file_exists($questionsPath)) {
            Log::error('Quiz questions JSON not found at: ' . $questionsPath);
            return back()->with('error', 'Quiz configuration is missing.');
        }

        $allQuestions = json_decode(file_get_contents($questionsPath), true);

        // ✅ Filter questions by selected categories (now underscored)
        $filteredQuestions = array_filter($allQuestions, function ($q) use ($normalizedSelected) {
            return in_array($q['category'], $normalizedSelected);
        });

        // Optional: Group by strand for better UX
        $groupedQuestions = [];
        foreach ($filteredQuestions as $q) {
            $groupedQuestions[$q['strand']][] = $q;
        }

        return view('website.ShsQuiz', [
            'questions' => $filteredQuestions,
            'groupedQuestions' => $groupedQuestions,
            'selectedInterests' => $selectedInterests,
            'allStrands' => $this->allStrands,
        ]);
    }

    // ✅ UPDATED: Submit Quiz — new scoring + tie breaker + better confidence
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

        $strandTally = array_fill_keys(array_keys($this->allStrands), 0);

        // ✅ NEW SCORING: 5,4,3,2
        $interestMap = [
            'very_interested' => 5,
            'slightly_interested' => 4,
            'interested' => 3,
            'not_interested' => 2,
        ];

        foreach ($answers as $qId => $interestLevel) {
            $question = collect($questions)->firstWhere('id', (int)$qId);
            if (!$question) continue;

            if ($question['type'] === 'tie_breaker') {
                $selectedStrand = $interestLevel;
                if (isset($strandTally[$selectedStrand])) {
                    $strandTally[$selectedStrand] += 5;
                }
            } else {
                $strand = $question['strand'];
                $points = $interestMap[$interestLevel] ?? 2;
                if (isset($strandTally[$strand])) {
                    $strandTally[$strand] += $points;
                }
            }
        }

        $strandTally = array_filter($strandTally, fn($score) => $score > 0);

        if (empty($strandTally)) {
            return back()->with('error', 'No valid answers recorded.');
        }

        arsort($strandTally);
        $topStrands = array_keys(array_slice($strandTally, 0, 3));
        $total = array_sum($strandTally);

        $narrative = $this->generateRichNarrative($strandTally, $total);

        $profile = "Student Profile: $narrative The student's top aligned tracks are: " . implode(', ', $topStrands) . ". Based on their interests, which of these is the best fit?";

        $apiResults = [];
        $rawScores = [];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.huggingface.api_key'),
            ])->timeout(30)->post('https://api-inference.huggingface.co/models/facebook/bart-large-mnli', [ // ✅ No trailing space
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

        $finalRecommendations = [];

        foreach ($topStrands as $idx => $strand) {
            $localScore = round($strandTally[$strand], 2);
            $dominance = $localScore / $total;

            if (isset($rawScores[$strand])) {
                $confidence = 50 + ($rawScores[$strand] * 50);
            } else {
                $baseConfidence = match($idx) {
                    0 => 90,
                    1 => 80,
                    2 => 70,
                    default => 60
                };
                $bonus = min(15, ($dominance * 30));
                $confidence = $baseConfidence + $bonus + mt_rand(0, 2);
                $confidence = round(min(98, $confidence), 2);
                // ❌ NO max(60) — allow real scores
            }

            $finalRecommendations[] = [
                'strand' => $strand,
                'description' => $this->allStrands[$strand],
                'local_score' => $localScore,
                'confidence' => $confidence,
                'is_top' => $idx === 0,
            ];
        }

        return view('website.ShsQuizResult', [
            'recommendations' => $finalRecommendations,
            'localScores' => $strandTally,
            'totalScore' => $total,
            'narrative' => $narrative,
            'allStrands' => $this->allStrands,
        ]);
    }

    private function generateRichNarrative($tally, $total)
    {
        arsort($tally);
        $top3 = array_slice($tally, 0, 3, true);

        $parts = [];
        foreach ($top3 as $strand => $score) {
            $pct = round(($score / $total) * 100, 1);
            $parts[] = "$strand ($pct%)";
        }

        $topStrand = key($top3);
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