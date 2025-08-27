<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\CollegeParentInfo;
use App\Models\CollegeGuardian;
use App\Models\CollegeEnrollmentPreference;
use App\Models\CollegeEducationalBackground;
use App\Models\CollegeUploadedDocument;
use App\Models\CollegeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function showForm()
    {
        return view('website.CollegeEnrollment'); // ✅ Match your actual Blade path
    }

    public function submit(Request $request)
    {
        // Validate basic student info
        $validator = Validator::make($request->all(), [
            'studentType' => 'required|exists:college_student_types,type_name',
            'firstName' => 'required|string|max:100',
            'middleName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'civilStatus' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'placeOfBirth' => 'required',
            'nationality' => 'required',
            'currentAddress' => 'required',
            'cityMunicipality' => 'required',
            'region' => 'required|exists:college_regions,region_id', // ✅ Fixed: was region_id
            'zipCode' => 'required',
            'province' => 'required',
            'religion' => 'required',
            'email' => 'required|email|unique:college_students,email',
            'contactNumber' => 'required',
            'socialMedia' => 'required',
            'motherFirstName' => 'required',
            'motherLastName' => 'required',
            'fatherFirstName' => 'required',
            'fatherLastName' => 'required',
            'preferredBranch' => 'required|exists:college_branches,branch_id',
            'preferredCourse' => 'required|exists:college_courses,course_id',
            'yearLevelStep4' => 'required|exists:college_year_levels,level_id',
            'primarySchool' => 'required',
            'secondarySchool' => 'required',
            'lastSchoolAttended' => 'required',
            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Start transaction
        DB::beginTransaction();
        try {
            // Get type_id
            $typeId = DB::table('college_student_types')
                ->where('type_name', $request->studentType)
                ->value('type_id');

            if (!$typeId) {
                return $this->jsonOrRedirect($request, false, 'Invalid student type.');
            }

            // 1. Save Student
            $student = CollegeStudent::create([
                'type_id' => $typeId,
                'first_name' => $request->firstName,
                'middle_name' => $request->middleName,
                'last_name' => $request->lastName,
                'extension_name' => $request->extensionName,
                'civil_status' => $request->civilStatus,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'place_of_birth' => $request->placeOfBirth,
                'nationality' => $request->nationality,
                'previous_student_id' => $request->previousStudentId,
                'contact_number' => $request->contactNumber,
                'email' => $request->email,
                'social_media' => $request->socialMedia,
                'religion' => $request->religion,
                'current_address' => $request->currentAddress,
                'city_municipality' => $request->cityMunicipality,
                'province' => $request->province,
                'zip_code' => $request->zipCode,
                'region_id' => $request->region,
            ]);

            // 2. Save Parents
            foreach (['Mother', 'Father'] as $parentType) {
                $prefix = $parentType === 'Mother' ? 'mother' : 'father';
                CollegeParentInfo::create([
                    'student_id' => $student->student_id,
                    'parent_type' => $parentType,
                    'first_name' => $request->{$prefix . 'FirstName'},
                    'middle_name' => $request->{$prefix . 'MiddleName'},
                    'last_name' => $request->{$prefix . 'LastName'},
                    'occupation' => $request->{$prefix . 'Occupation'},
                    'contact_number' => $request->{$prefix . 'Contact'},
                    'email' => $request->{$prefix . 'Email'},
                ]);
            }

            // 3. Save Guardian (optional)
            if ($request->filled('guardianFirstName')) {
                CollegeGuardian::create([
                    'student_id' => $student->student_id,
                    'first_name' => $request->guardianFirstName,
                    'middle_name' => $request->guardianMiddleName,
                    'last_name' => $request->guardianLastName,
                    'dob' => $request->guardianDob,
                    'contact_number' => $request->guardianContact,
                    'email' => $request->guardianEmail,
                ]);
            }

            // 4. Save Preference
            CollegeEnrollmentPreference::create([
                'student_id' => $student->student_id,
                'branch_id' => $request->preferredBranch,
                'course_id' => $request->preferredCourse,
                'level_id' => $request->yearLevelStep4,
            ]);

            // 5. Save Educational Background
            CollegeEducationalBackground::create([
                'student_id' => $student->student_id,
                'primary_school' => $request->primarySchool,
                'primary_year_graduated' => $request->primaryYearGraduated,
                'secondary_school' => $request->secondarySchool,
                'secondary_year_graduated' => $request->secondaryYearGraduated,
                'last_school_attended' => $request->lastSchoolAttended,
                'last_school_year_graduated' => $request->lastSchoolYearGraduated,
            ]);

            // 6. Save Documents
            if ($request->hasFile('documents')) {
            $docIds = $request->input('document_doc_id'); // Array of correct doc_ids

               foreach ($request->file('documents') as $index => $file) {
                    $path = $file->store('enrollment_documents', 'public');
                    $extension = $file->getClientOriginalExtension();

                  CollegeUploadedDocument::create([
                     'student_id' => $student->student_id,
                     'doc_id' => $docIds[$index], // ✅ Correct doc_id from hidden input
                     'file_path' => $path,
                     'file_type' => $extension,
                ]);
             }
           }

           
            DB::commit();

            // ✅ Return JSON for AJAX, redirect for regular form
            return $this->jsonOrRedirect($request, true, null, route('enrollment.success'));

        } catch (\Exception $e) {
            DB::rollback();
            return $this->jsonOrRedirect($request, false, 'Save failed: ' . $e->getMessage());
        }
    }

    /**
     * Helper: Return JSON or Redirect based on request type
     */
    private function jsonOrRedirect($request, $success, $message = null, $redirect = null)
    {
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => $success,
                'message' => $message,
                'redirect' => $redirect
            ], $success ? 200 : 500);
        }

        if ($success) {
            return redirect($redirect)->with('success', $message ?? 'Enrollment submitted successfully!');
        }

        return redirect()->back()->with('error', $message);
    }

    public function success()
    {
        return view('website.enrollment_success'); // ✅ Create this view
    }
}