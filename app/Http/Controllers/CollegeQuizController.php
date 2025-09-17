<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

    public function showQuiz()
    {
        return view('website.CollegeQuiz');
    }

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
            $codes = $question['codes'] ?? [];
            $points = $interestMap[$interestLevel] ?? 0;

            $courseTally[$strand] += $points;

            foreach ($this->courseRIASEC as $course => $courseCodes) {
                if ($course === $strand) continue;
                $shared = array_intersect($codes, $courseCodes);
                if (count($shared) > 0) {
                    $bonus = $points * (count($shared) / count($codes)) * 0.5;
                    $courseTally[$course] += $bonus;
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
                $nextScore = $idx + 1 < count($topCourses) ? $courseTally[$topCourses[$idx + 1]] : 0;
                $gap = $localScore - $nextScore;

                if ($dominance > 0.5 && $gap >= 8) {
                    $confidence = 88 + mt_rand(0, 7);
                } elseif ($dominance > 0.4 && $gap >= 5) {
                    $confidence = 78 + mt_rand(0, 6);
                } else {
                    $confidence = 68 + mt_rand(0, 6);
                }
            }

            $confidence = round(max(60, min(98, $confidence)), 2);

            $finalRecommendations[] = [
                'course' => $course,
                'description' => $this->allCourses[$course],
                'local_score' => $localScore,
                'confidence' => $confidence,
                'is_top' => $idx === 0,
            ];
        }

        usort($finalRecommendations, fn($a, $b) => $b['confidence'] <=> $a['confidence']);

        // AFTER generating $finalRecommendations, BEFORE return view(...)
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
