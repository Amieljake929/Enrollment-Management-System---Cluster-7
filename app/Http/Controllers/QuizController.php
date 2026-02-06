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

    // Updated: Detailed Info with YouTube Embed Links
    private $strandDetails = [
        'STEM' => [
            'info' => 'Focuses on advanced mathematics and science. Best for those aiming for careers in Engineering, Medicine, and Pure Sciences.',
            'video' => 'https://www.youtube.com/embed/fH5iLx_jCUk'
        ],
        'ABM' => [
            'info' => 'Focuses on financial management, business operation, and accounting. Perfect for future entrepreneurs and corporate leaders.',
            'video' => 'https://www.youtube.com/embed/NbtnP5Wbwp8'
        ],
        'HUMSS' => [
            'info' => 'Designed for those interested in sociology, politics, and the arts. Ideal for future lawyers, journalists, or teachers.',
            'video' => 'https://www.youtube.com/embed/5-6EQnGGe0Q'
        ],
        'GAS' => [
            'info' => 'A versatile strand for students who want to explore various college courses before specializing.',
            'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ' // Default placeholder
        ],
        'ICT' => [
            'info' => 'Equips students with skills in programming, hardware, and digital arts. Key for the modern tech industry.',
            'video' => 'https://www.youtube.com/embed/tPZ8M9en-Ow'
        ],
        'HE' => [
            'info' => 'Practical training in hospitality, culinary arts, and tourism management.',
            'video' => 'https://www.youtube.com/embed/j7XlkEx2IHA'
        ],
        'SPORTS' => [
            'info' => 'Covers sports science, coaching, and fitness leadership for aspiring athletes and trainers.',
            'video' => 'https://www.youtube.com/embed/Rnjk2YkSSDw'
        ],
        // Sa loob ng QuizController.php, i-update ang GAS entry:

        'GAS' => [
        'info' => 'A versatile strand for students who want to explore various college courses before specializing. It offers a balanced mix of subjects from different tracks.',
        'video' => 'https://www.youtube.com/embed/EZwJs0qUYFQ'
        ],
        'default' => [
            'info' => 'This strand provides specialized knowledge and skills to prepare you for your chosen career path or college degree.',
            'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'
        ]
    ];

    public function submitInterests(Request $request)
    {
        $request->validate([
            'interests' => 'required|array|size:2',
            'interests.*' => 'string|in:flexible_exploratory_learning,business_leadership,society_people_communication,science_math_innovation,creativity_design,hospitality_food_tourism'
        ]);

        session(['shs_selected_interests' => $request->input('interests')]);
        return response()->json(['success' => true]);
    }

    public function showQuiz()
    {
        if (!session()->has('shs_selected_interests')) {
            return redirect()->route('shs.welcome')->with('error', 'Please select your interests first.');
        }

        $selectedInterests = session('shs_selected_interests');
        $questionsPath = public_path('data/quiz_questions.json');
        
        if (!file_exists($questionsPath)) {
            Log::error('Quiz questions JSON not found at: ' . $questionsPath);
            return back()->with('error', 'Quiz configuration is missing.');
        }

        $allQuestions = json_decode(file_get_contents($questionsPath), true);
        $filteredQuestions = array_filter($allQuestions, function ($q) use ($selectedInterests) {
            return in_array($q['category'], $selectedInterests);
        });

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

    public function submit(Request $request)
    {
        $answers = $request->input('answers');
        if (!$answers || !is_array($answers)) {
            return back()->with('error', 'Please answer all questions.');
        }

        $questionsPath = public_path('data/quiz_questions.json');
        if (!file_exists($questionsPath)) {
            return back()->with('error', 'Quiz configuration is missing.');
        }

        $questions = json_decode(file_get_contents($questionsPath), true);
        $strandTally = array_fill_keys(array_keys($this->allStrands), 0);

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
                if (isset($strandTally[$interestLevel])) {
                    $strandTally[$interestLevel] += 5;
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

        $finalRecommendations = [];
        foreach ($topStrands as $idx => $strand) {
            $localScore = round($strandTally[$strand], 2);
            $dominance = $localScore / ($total ?: 1);

            $baseConfidence = match($idx) {
                0 => 85,
                1 => 75,
                2 => 65,
                default => 60
            };

            $bonus = min(10, ($dominance * 20));
            $confidence = round(max(60, min(98, $baseConfidence + $bonus + mt_rand(0, 3))), 2);

            // Get detail with video
            $detail = $this->strandDetails[$strand] ?? 
                      ($this->strandDetails[explode('-', $strand)[0]] ?? $this->strandDetails['default']);

            $finalRecommendations[] = [
                'strand' => $strand,
                'description' => $this->allStrands[$strand],
                'info' => $detail['info'],
                'video' => $detail['video'],
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
            $pct = round(($score / ($total ?: 1)) * 100, 1);
            $parts[] = "$strand ($pct%)";
        }

        $topStrand = key($top3);
        $baseNarratives = [
            'HUMSS' => "enjoys writing, debating, and exploring social issues",
            'ABM' => "is interested in business and managing projects",
            'STEM' => "excels in math and science and logical thinking",
            'ICT' => "is tech-savvy and enjoys digital innovation",
            'HE' => "likes hospitality and service-oriented tasks",
        ];

        $interestDesc = $baseNarratives[$topStrand] ?? 'shows a balanced interest in academic and technical fields';

        return "The student scored highest in " . implode(', ', $parts) . ". They $interestDesc. Their strongest alignment is with $topStrand.";
    }
}