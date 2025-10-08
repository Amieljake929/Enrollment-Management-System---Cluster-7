<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Env;

class CollegeStudentController extends Controller
{
    public function index(Request $request)
    {
        // ✅ I-check ang API token
        $token = $request->header('X-Registrar-Token');
        $expectedToken = Env::get('REGISTRAR_API_TOKEN', 'registrar-secret-2025');

        if ($token !== $expectedToken) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Registrar access only.'
            ], 403);
        }

        // ✅ Optional filter
        $studentId = $request->query('student_id');

        // ✅ BUILD QUERY with joins
        $query = DB::table('college_students')
            ->leftJoin('college_student_types', 'college_students.type_id', '=', 'college_student_types.type_id')
            ->leftJoin('college_regions', 'college_students.region_id', '=', 'college_regions.region_id')
            ->leftJoin('college_shs_disability', 'college_students.disability_id', '=', 'college_shs_disability.disability_id')
            ->leftJoin('college_shs_indigenous', 'college_students.indigenous_id', '=', 'college_shs_indigenous.indigenous_id')
            ->leftJoin('college_enrollment_preferences', 'college_students.student_id', '=', 'college_enrollment_preferences.student_id')
            ->leftJoin('college_branches', 'college_enrollment_preferences.branch_id', '=', 'college_branches.branch_id')
            ->leftJoin('college_courses', 'college_enrollment_preferences.course_id', '=', 'college_courses.course_id')
            ->leftJoin('college_year_levels', 'college_enrollment_preferences.level_id', '=', 'college_year_levels.level_id')
            ->leftJoin('college_uploaded_documents', 'college_students.student_id', '=', 'college_uploaded_documents.student_id')
            ->leftJoin('college_documents', 'college_uploaded_documents.doc_id', '=', 'college_documents.doc_id')
            ->leftJoin('college_status', 'college_students.student_id', '=', 'college_status.student_id') // 🆕 JOIN the status table
            ->select(
                'college_students.*',
                'college_student_types.type_name as student_type',
                'college_regions.region_name as region',
                'college_shs_disability.disability_name as disability',
                'college_shs_indigenous.indigenous_name as indigenous_group',

                // Enrollment Preferences
                'college_enrollment_preferences.*',
                'college_branches.branch_name as preferred_branch',
                'college_courses.course_name as preferred_course',
                'college_year_levels.level_name as preferred_level',

                // Documents
                'college_uploaded_documents.file_path',
                'college_uploaded_documents.file_type',
                'college_uploaded_documents.uploaded_at',
                'college_documents.document_name',

                // Status
                'college_status.info_status'
            )
            ->where('college_status.info_status', 'Validated'); // 🧠 Only show validated students

        // ✅ Optional: Filter specific student
        if ($studentId) {
            $query->where('college_students.student_id', $studentId);
        }

        $rawData = $query->get();

        // ✅ WALANG DATA? I-return agad
        if ($rawData->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => $studentId ? 'Student not found or not validated' : 'No validated students found'
            ], $studentId ? 404 : 200);
        }

        // ✅ I-GROUP DOCUMENTS PER STUDENT
        $result = [];
        foreach ($rawData as $student) {
            $key = $student->student_id;
            if (!isset($result[$key])) {
                $result[$key] = $student;
                $result[$key]->documents = [];
            }
            $result[$key]->documents[] = [
                'file_path' => $student->file_path,
                'file_type' => $student->file_type,
                'uploaded_at' => $student->uploaded_at,
                'document_name' => $student->document_name
            ];
        }

        // ✅ Final formatted data
        $finalData = array_values($result);

        if ($studentId && count($finalData) === 1) {
            return response()->json([
                'success' => true,
                'data' => $finalData[0]
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $finalData
        ]);
    }
}
