<?php

namespace App\Http\Controllers;

use App\Models\ShsStudent;
use App\Models\ShsParentInfo;
use App\Models\ShsGuardian;
use App\Models\ShsEnrollmentPreference;
use App\Models\ShsEducationalBackground;
use App\Models\ShsUploadedDocument;
use App\Models\ShsDocument;
use App\Models\ShsEnrolleeNumber;
use App\Models\CollegeShsIndigenous;
use App\Models\CollegeShsDisability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ShsEnrollmentController extends Controller
{
    /**
     * Show the enrollment form
     */
    public function showForm()
    {
        // Get data from shared lookup tables (used by both College and SHS)
        $indigenousGroups = CollegeShsIndigenous::orderBy('indigenous_name')->get();
        $disabilityTypes = CollegeShsDisability::orderBy('disability_name')->get();

        return view('website.ShsEnrollment', compact('indigenousGroups', 'disabilityTypes'));
    }

    /**
     * Handle form submission
     */
    public function submit(Request $request)
    {
        // Enhanced Validation
        $validator = Validator::make($request->all(), [
            'studentType' => 'required|exists:shs_student_types,type_name',
            'firstName' => 'required|string|max:100',
            'middleName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'lrn' => 'required|string|size:12|unique:shs_students,lrn',
            'dob' => 'required|date',
            'email' => 'required|email|unique:shs_students,email',
            'contactNumber' => 'required|string|max:20',
            'currentAddress' => 'required|string|max:255',
            'cityMunicipality' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'region' => 'required|exists:college_regions,region_id',
            'zipCode' => 'required|string|max:10',
            'preferredBranch' => 'required|exists:shs_branches,branch_id',
            'preferredCourse' => 'required|exists:shs_courses,course_id',
            'yearLevelStep4' => 'required|exists:shs_year_levels,level_id',
            'primarySchool' => 'required|string|max:255',
            'primaryYearGraduated' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'secondarySchool' => 'required|string|max:255',
            'secondaryYearGraduated' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'lastSchoolAttended' => 'required|string|max:255',
            'lastSchoolYearGraduated' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'indigenous' => 'required|exists:college_shs_indigenous,indigenous_id',
            'disability' => 'required|exists:college_shs_disability,disability_id',
            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'document_doc_id' => 'required|array',
            'document_doc_id.*' => 'exists:shs_documents,doc_id',
        ], [
            'lrn.unique' => 'The LRN is already taken.',
            'primaryYearGraduated.integer' => 'Primary graduation year must be a valid number.',
            'secondaryYearGraduated.integer' => 'Secondary graduation year must be a valid number.',
            'lastSchoolYearGraduated.integer' => 'Last school year must be a valid number.',
            'primaryYearGraduated.between' => 'Primary year must be between 1900 and ' . (date('Y') + 5) . '.',
            'secondaryYearGraduated.between' => 'Secondary year must be between 1900 and ' . (date('Y') + 5) . '.',
            'lastSchoolYearGraduated.between' => 'Last school year must be between 1900 and ' . (date('Y') + 5) . '.',
            'indigenous.required' => 'Please select an Indigenous group.',
            'disability.required' => 'Please select a Disability type.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check Chronological Order of Years
        $primaryYear = $request->primaryYearGraduated;
        $secondaryYear = $request->secondaryYearGraduated;
        $lastSchoolYear = $request->lastSchoolYearGraduated;

        if ($primaryYear >= $secondaryYear) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid year order: Secondary graduation year must be after primary.',
                'errors' => ['secondaryYearGraduated' => ['Secondary year must be after primary year.']]
            ], 422);
        }

        if ($secondaryYear >= $lastSchoolYear) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid year order: Last school year must be after secondary.',
                'errors' => ['lastSchoolYearGraduated' => ['Last school year must be after secondary.']]
            ], 422);
        }

        $success = false;
        $message = '';
        $redirect = '';

        DB::beginTransaction();
        try {
            // Get type_id from shs_student_types
            $studentType = \App\Models\ShsStudentType::where('type_name', $request->studentType)->first();
            if (!$studentType) {
                throw new \Exception("Invalid student type.");
            }

            // 1. Save Student
            $student = ShsStudent::create([
                'type_id' => $studentType->type_id,
                'first_name' => $request->firstName,
                'middle_name' => $request->middleName,
                'last_name' => $request->lastName,
                'extension_name' => $request->extensionName,
                'civil_status' => $request->civilStatus,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'place_of_birth' => $request->placeOfBirth,
                'nationality' => $request->nationality,
                'lrn' => $request->lrn,
                'previous_student_id' => $request->studentType === 'Returnee' ? $request->previousStudentId : null,
                'current_address' => $request->currentAddress,
                'city_municipality' => $request->cityMunicipality,
                'province' => $request->province,
                'region_id' => $request->region,
                'zip_code' => $request->zipCode,
                'religion' => $request->religion,
                'email' => $request->email,
                'contact_number' => $request->contactNumber,
                'social_media' => $request->socialMedia,
                'indigenous_id' => $request->indigenous,
                'disability_id' => $request->disability,
            ]);

            // 2. Save Parent Info
            ShsParentInfo::create([
                'student_id' => $student->student_id,
                'mother_first_name' => $request->motherFirstName,
                'mother_middle_name' => $request->motherMiddleName,
                'mother_last_name' => $request->motherLastName,
                'mother_occupation' => $request->motherOccupation,
                'mother_contact' => $request->motherContact,
                'mother_email' => $request->motherEmail,
                'father_first_name' => $request->fatherFirstName,
                'father_middle_name' => $request->fatherMiddleName,
                'father_last_name' => $request->fatherLastName,
                'father_occupation' => $request->fatherOccupation,
                'father_contact' => $request->fatherContact,
                'father_email' => $request->fatherEmail,
            ]);

            // 3. Save Guardian (optional)
            if ($request->filled('guardianFirstName')) {
                ShsGuardian::create([
                    'student_id' => $student->student_id,
                    'first_name' => $request->guardianFirstName,
                    'middle_name' => $request->guardianMiddleName,
                    'last_name' => $request->guardianLastName,
                    'dob' => $request->guardianDob,
                    'contact_number' => $request->guardianContact,
                    'email' => $request->guardianEmail,
                ]);
            }

            // 4. Save Educational Background
            ShsEducationalBackground::create([
                'student_id' => $student->student_id,
                'primary_school' => $request->primarySchool,
                'primary_year_graduated' => $primaryYear,
                'secondary_school' => $request->secondarySchool,
                'secondary_year_graduated' => $secondaryYear,
                'last_school_attended' => $request->lastSchoolAttended,
                'last_school_year_graduated' => $lastSchoolYear,
            ]);

            // 5. Save Enrollment Preference
            ShsEnrollmentPreference::create([
                'student_id' => $student->student_id,
                'branch_id' => $request->preferredBranch,
                'course_id' => $request->preferredCourse,
                'level_id' => $request->yearLevelStep4,
            ]);

            // 6. Upload Documents
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $index => $file) {
                    $docId = $request->document_doc_id[$index];
                    $path = $file->store('shs_documents', 'public');
                    ShsUploadedDocument::create([
                        'student_id' => $student->student_id,
                        'doc_id' => $docId,
                        'file_path' => $path,
                    ]);
                }
            }

            // 7. Generate Enrollee Number
            $enrolleeNo = ShsEnrolleeNumber::generateUniqueEnrolleeNo();

            ShsEnrolleeNumber::create([
                'enrollee_no' => $enrolleeNo,
                'student_id' => $student->student_id,
            ]);

            DB::commit();
            $success = true;
            $message = 'SHS Enrollment submitted successfully!';
            $redirect = route('shs.enrollment.success');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('SHS Enrollment Error: ' . $e->getMessage());
            $message = 'An error occurred during submission. Please try again.';
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'redirect' => $redirect,
        ], $success ? 200 : 500);
    }

    /**
     * Show success page
     */
    public function success()
    {
        return view('website.enrollment_success');
    }
}