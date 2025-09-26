<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CollegeQuizController extends Controller
{
    private $allCourses = [
        'BLIS' => 'Bachelor in Library Information Science',
        'BPED' => 'Bachelor in Physical Education',
        'BEED' => 'Bachelor of Elementary Education',
        'BSAIS' => 'BS in Accounting Information System',
        'BSBA FM' => 'BSBA major in Financial Management',
        'BSBA HRM' => 'BSBA major in Human Resource Management',
        'BSBA MM' => 'BSBA major in Marketing Management',
        'BSCPE' => 'BS in Computer Engineering',
        'BSCRIM' => 'BS in Criminology',
        'BSENTREP' => 'BS in Entrepreneurship',
        'BSHM' => 'BS in Hospitality Management',
        'BSIT' => 'BS in Information Technology',
        'BSOA' => 'BS in Office Administration',
        'BSP' => 'BS in Psychology',
        'BSTM' => 'BS in Tourism Management',
        'BSED english' => 'BSEd major in English',
        'BSED filipino' => 'BSEd major in Filipino',
        'BSED math' => 'BSEd major in Mathematics',
        'BSED science' => 'BSEd major in Science',
        'BSED social studies' => 'BSEd major in Social Studies',
        'BSED values' => 'BSEd major in Values',
        'BTLED' => 'Bachelor of Technology and Livelihood Education',
        'CPE' => 'Certificate of Professional Education',
        'BTVTED' => 'BTVTED major in Food Service Management',
        'BPE' => 'Bachelor of Physical Education major in School PE',
        'BSIS' => 'Bachelor of Science in Information System',
    ];

    private $courseRIASEC = [
        'BLIS' => ['A', 'C', 'S'],
        'BPED' => ['S', 'E', 'R'],
        'BEED' => ['S', 'A', 'E'],
        'BSAIS' => ['C', 'I'],
        'BSBA FM' => ['C', 'E'],
        'BSBA HRM' => ['S', 'E'],
        'BSBA MM' => ['E', 'S'],
        'BSCPE' => ['R', 'I'],
        'BSCRIM' => ['R', 'S', 'I'],
        'BSENTREP' => ['E', 'I'],
        'BSHM' => ['S', 'E', 'C'],
        'BSIT' => ['I', 'R'],
        'BSOA' => ['C', 'S'],
        'BSP' => ['S', 'I'],
        'BSTM' => ['S', 'E'],
        'BSED english' => ['S', 'A'],
        'BSED filipino' => ['S', 'A'],
        'BSED math' => ['I', 'C'],
        'BSED science' => ['I', 'S'],
        'BSED social studies' => ['S', 'I'],
        'BSED values' => ['S', 'A'],
        'BTLED' => ['R', 'S'],
        'CPE' => ['S', 'I'],
        'BTVTED' => ['S', 'C'],
        'BPE' => ['S', 'R'],
        'BSIS' => ['I', 'C'],
    ];

    // ✅ NEW: Submit Interests (from CollegeWelcome.blade.php)
    public function submitInterests(Request $request)
    {
        $request->validate([
            'interests' => 'required|array|min:2',
            'interests.*' => 'string|in:science & technology,business & management,education & teaching,arts_communication_library,social & public services,hospitality_tourism_service'
        ]);

        session(['selected_interests' => $request->input('interests')]);

        return response()->json(['success' => true]);
    }

    // ✅ UPDATED: Show Quiz — now requires selected interests
    public function showQuiz()
{
    if (!session()->has('selected_interests')) {
        return redirect()->route('college.welcome')->with('error', 'Please select your interests first.');
    }

    $selectedInterests = session('selected_interests');

    $questionsPath = public_path('data/college_quiz_questions.json');
    if (!file_exists($questionsPath)) {
        Log::error('College quiz questions JSON not found at: ' . $questionsPath);
        return back()->with('error', 'Quiz configuration is missing.');
    }

    $allQuestions = json_decode(file_get_contents($questionsPath), true);

    // Filter questions by selected categories
    $filteredQuestions = array_filter($allQuestions, function($q) use ($selectedInterests) {
        return in_array($q['category'], $selectedInterests);
    });

    // Group by course for better display in Blade
    $groupedQuestions = [];
    foreach ($filteredQuestions as $q) {
        $groupedQuestions[$q['course']][] = $q;
    }

    // ✅ PASS $allCourses TO VIEW
    return view('website.CollegeQuiz', [
        'questions' => $filteredQuestions,
        'groupedQuestions' => $groupedQuestions,
        'selectedInterests' => $selectedInterests,
        'allCourses' => $this->allCourses, // ← ADD this!
    ]);
}

    // ✅ UPDATED: Submit Quiz — new scoring logic (5,4,3,2) + tie breaker handling
   public function submit(Request $request)
{
    $answers = $request->input('answers');
    if (!$answers || !is_array($answers)) {
        return back()->with('error', 'Please answer all questions.');
    }

    $questionsPath = public_path('data/college_quiz_questions.json');
    if (!file_exists($questionsPath)) {
        Log::error('College quiz questions JSON not found at: ' . $questionsPath);
        return back()->with('error', 'Quiz configuration is missing.');
    }

    $questions = json_decode(file_get_contents($questionsPath), true);

    $courseTally = array_fill_keys(array_keys($this->allCourses), 0);

    // ✅ UPDATED SCORING: Very Interested = 5, Slightly = 4, Interested = 3, Not = 2
    $interestMap = [
        'very_interested' => 5,
        'slightly_interested' => 4,
        'interested' => 3,
        'not_interested' => 2,
    ];

    foreach ($answers as $qId => $interestLevel) {
        $question = collect($questions)->firstWhere('id', (int)$qId);
        if (!$question) continue;

        // ✅ Handle Tie Breaker: answer is the course code (e.g., "BSIT")
        if ($question['type'] === 'tie_breaker') {
            $selectedCourse = $interestLevel; // e.g., "BSIT"
            if (isset($courseTally[$selectedCourse])) {
                $courseTally[$selectedCourse] += 5; // Full 5 points for tie breaker choice
            }
        } else {
            // ✅ Regular question: assign points to the course
            $course = $question['course'];
            $points = $interestMap[$interestLevel] ?? 2; // default to 2
            if (isset($courseTally[$course])) {
                $courseTally[$course] += $points;
            }
        }
    }

    $courseTally = array_filter($courseTally, fn($score) => $score > 0);

    if (empty($courseTally)) {
        return back()->with('error', 'No valid answers recorded.');
    }

    arsort($courseTally);
    $topCourses = array_keys(array_slice($courseTally, 0, 3));
    $total = array_sum($courseTally);

    $narrative = $this->generateRichNarrative($courseTally, $total);

    $profile = "Student Profile: $narrative The student's top aligned courses are: " . implode(', ', $topCourses) . ". Based on their interests and strengths, which of these is the best fit for their future?";

    $apiResults = [];
    $rawScores = [];

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.huggingface.api_key'),
        ])->timeout(30)->post('https://api-inference.huggingface.co/models/facebook/bart-large-mnli', [
            'inputs' => $profile,
            'parameters' => [
                'candidate_labels' => $topCourses,
                'hypothesis_template' => 'The student\'s interests, skills, and responses strongly indicate they are best suited for the {} program.',
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

    foreach ($topCourses as $idx => $course) {
        $localScore = round($courseTally[$course], 2);
        $dominance = $localScore / $total;

        if (isset($rawScores[$course])) {
            $confidence = 50 + ($rawScores[$course] * 50);
        } else {
            // ✅ UPDATED: Confidence based on RANK and SCORE
            // Higher rank (0=1st) = higher base confidence
            $baseConfidence = match($idx) {
                0 => 85,
                1 => 75,
                2 => 65,
                default => 60
            };

            // Bonus if score is high relative to total
            $bonus = min(10, ($dominance * 20));
            $confidence = $baseConfidence + $bonus + mt_rand(0, 3);

            $confidence = round(min(98, $confidence), 2);
        }

        $confidence = round(max(60, min(98, $confidence)), 2);

        $finalRecommendations[] = [
            'course' => $course,
            'description' => $this->allCourses[$course],
            'local_score' => $localScore,
            'confidence' => $confidence,
            'is_top' => $idx === 0,
        ];

        // ✅ NO usort() — preserve order by interest score!
    }

    // ❌ REMOVE THIS LINE:
    // usort($finalRecommendations, fn($a, $b) => $b['confidence'] <=> $a['confidence']);

    // Save to DB if assessment data exists
    if (session()->has('college_assessment_data')) {
        $assessmentData = session('college_assessment_data');
        $assessmentId = $assessmentData['assessment_id'];

        $topRecommendation = $finalRecommendations[0] ?? null;

        if ($topRecommendation) {
            \App\Models\CollegeAssessmentResult::where('assessment_id', $assessmentId)
                ->update([
                    'recommended_course' => $topRecommendation['course'],
                    'recommended_course_description' => $topRecommendation['description'],
                    'confidence_score' => $topRecommendation['confidence'],
                    'narrative' => $narrative ?? null,
                ]);
        }
    }

    return view('website.CollegeQuizResult', [
        'recommendations' => $finalRecommendations,
        'localScores' => $courseTally,
        'totalScore' => $total,
        'narrative' => $narrative,
        'allCourses' => $this->allCourses,
    ]);
}

    private function generateRichNarrative($tally, $total)
    {
        arsort($tally);
        $top3 = array_slice($tally, 0, 3, true);

        $parts = [];
        foreach ($top3 as $course => $score) {
            $pct = round(($score / $total) * 100, 1);
            $parts[] = "$course ($pct%)";
        }

        $topCourse = key($top3);
        $baseNarratives = [
            'BSIT' => 'is highly interested in technology, coding, and solving technical problems',
            'BSCPE' => 'enjoys working with hardware, circuits, and engineering systems',
            'BSED english' => 'loves language, teaching, and communicating ideas effectively',
            'BSED math' => 'excels in logical thinking, problem-solving, and mathematical reasoning',
            'BSBA MM' => 'is entrepreneurial, creative, and enjoys marketing and sales',
            'BSHM' => 'is service-oriented, enjoys hospitality, and has strong interpersonal skills',
            'BSP' => 'is empathetic, curious about human behavior, and enjoys helping others',
            'BSCRIM' => 'is disciplined, values justice, and is interested in law and public safety',
            'BEED' => 'is nurturing, patient, and passionate about teaching young learners',
            'BSENTREP' => 'is innovative, independent, and driven to start their own business',
            'BPED' => 'is active, health-conscious, and enjoys sports and physical activities',
            'BSIS' => 'is organized, tech-savvy, and interested in information systems',
            'BSTM' => 'is outgoing, enjoys travel, and is passionate about tourism and events',
        ];

        $interestDesc = $baseNarratives[$topCourse] ?? 'shows strong interest in academic, technical, or creative fields';

        return "The student scored highest in " . implode(', ', $parts) . ". "
            . "They $interestDesc. "
            . "Their strongest alignment is with $topCourse, which received the most points from their answers. "
            . "They demonstrate clear preferences for hands-on, analytical, creative, or service-oriented tasks based on their responses.";
    }
}