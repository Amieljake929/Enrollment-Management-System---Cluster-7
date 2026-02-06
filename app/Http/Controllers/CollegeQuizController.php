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

    // Updated with your provided YouTube links (Converted to Embed format)
    private $courseDetails = [
        'BSIT' => [
            'info' => 'This program focuses on the study of computer systems and software. It prepares students to design, develop, and manage IT solutions.',
            'video' => 'https://www.youtube.com/embed/vyDsSJu-spc'
        ],
        'BSCPE' => [
            'info' => 'A blend of computer science and electrical engineering. Students learn to develop hardware and integrate it with advanced software systems.',
            'video' => 'https://www.youtube.com/embed/MfOtVvg1r2U'
        ],
        'BSP' => [
            'info' => 'A scientific study of behavior and mental processes. It offers pathways to clinical work, research, human resources, and counseling.',
            'video' => 'https://www.youtube.com/embed/MvZRiAVrqzY'
        ],
        'BSCRIM' => [
            'info' => 'Focuses on the study of crimes, criminals, and the justice system. It prepares students for law enforcement and public safety careers.',
            'video' => 'https://www.youtube.com/embed/sPP5_6aTPC4'
        ],
        'BSBA MM' => [
            'info' => 'Concentrates on market research, consumer behavior, and strategic planning to promote and sell products effectively.',
            'video' => 'https://www.youtube.com/embed/65MQnEMf-uI'
        ],
        'BSHM' => [
            'info' => 'Training for hospitality, focusing on hotel management, food service, and ensuring a high-quality guest experience.',
            'video' => 'https://www.youtube.com/embed/5yjaj5UZRlY'
        ],
        'BSTM' => [
            'info' => 'Covers travel industry management, destination marketing, and tour operations for the global tourism sector.',
            'video' => 'https://www.youtube.com/embed/dUp0ml6Sm3s'
        ],
        'BEED' => [
            'info' => 'Designed for those who want to teach in elementary schools, focusing on child development and instructional methods.',
            'video' => 'https://www.youtube.com/embed/MicHI942vjk'
        ],
        'BSENTREP' => [
            'info' => 'Focuses on developing the mindset and skills to start, manage, and grow your own business or innovative projects.',
            'video' => 'https://www.youtube.com/embed/pC5l5j2u9SQ'
        ],
        'default' => [
            'info' => 'This course aligns with your indicated skills and interests. It offers a comprehensive curriculum designed to prepare you for industry challenges.',
            'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'
        ]
    ];

    public function submitInterests(Request $request)
    {
        $request->validate([
            'interests' => 'required|array|min:2',
            'interests.*' => 'string|in:science & technology,business & management,education & teaching,arts_communication_library,social & public services,hospitality_tourism_service'
        ]);

        session(['selected_interests' => $request->input('interests')]);
        return response()->json(['success' => true]);
    }

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
        $filteredQuestions = array_filter($allQuestions, function($q) use ($selectedInterests) {
            return in_array($q['category'], $selectedInterests);
        });

        $groupedQuestions = [];
        foreach ($filteredQuestions as $q) {
            $groupedQuestions[$q['course']][] = $q;
        }

        return view('website.CollegeQuiz', [
            'questions' => $filteredQuestions,
            'groupedQuestions' => $groupedQuestions,
            'selectedInterests' => $selectedInterests,
            'allCourses' => $this->allCourses,
        ]);
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers');
        if (!$answers || !is_array($answers)) {
            return back()->with('error', 'Please answer all questions.');
        }

        $questionsPath = public_path('data/college_quiz_questions.json');
        if (!file_exists($questionsPath)) {
            return back()->with('error', 'Quiz configuration is missing.');
        }

        $questions = json_decode(file_get_contents($questionsPath), true);
        $courseTally = array_fill_keys(array_keys($this->allCourses), 0);

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
                if (isset($courseTally[$interestLevel])) {
                    $courseTally[$interestLevel] += 5;
                }
            } else {
                $course = $question['course'];
                $points = $interestMap[$interestLevel] ?? 2;
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

        $finalRecommendations = [];
        foreach ($topCourses as $idx => $course) {
            $localScore = round($courseTally[$course], 2);
            $dominance = $localScore / ($total ?: 1);

            $baseConfidence = match($idx) {
                0 => 85,
                1 => 75,
                2 => 65,
                default => 60
            };

            $bonus = min(10, ($dominance * 20));
            $confidence = round(max(60, min(98, $baseConfidence + $bonus + mt_rand(0, 3))), 2);

            $detail = $this->courseDetails[$course] ?? $this->courseDetails['default'];

            $finalRecommendations[] = [
                'course' => $course,
                'description' => $this->allCourses[$course],
                'info' => $detail['info'],
                'video' => $detail['video'],
                'local_score' => $localScore,
                'confidence' => $confidence,
                'is_top' => $idx === 0,
            ];
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
            $pct = round(($score / ($total ?: 1)) * 100, 1);
            $parts[] = "$course ($pct%)";
        }

        $topCourse = key($top3);
        $baseNarratives = [
            'BSIT' => 'is highly interested in technology, coding, and solving technical problems',
            'BSCPE' => 'enjoys working with hardware, circuits, and engineering systems',
            'BSBA MM' => 'is entrepreneurial, creative, and enjoys marketing',
            'BSHM' => 'is service-oriented and enjoys hospitality management',
            'BSP' => 'is empathetic and curious about human behavior',
            'BSCRIM' => 'is disciplined and values justice and law enforcement',
        ];

        $interestDesc = $baseNarratives[$topCourse] ?? 'shows strong interest in academic and professional fields';

        return "The student scored highest in " . implode(', ', $parts) . ". They $interestDesc. Their strongest alignment is with $topCourse.";
    }
}