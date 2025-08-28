<?php

namespace App\Http\Controllers;

use App\Models\ShsStudent;
use App\Models\ShsParentInfo;
use App\Models\ShsGuardian;
use App\Models\ShsEnrollmentPreference;
use App\Models\ShsEducationalBackground;
use App\Models\ShsUploadedDocument;
use App\Models\ShsDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ShsEnrollmentController extends Controller
{
    public function showForm()
    {
        return view('website.ShsEnrollment');
    }

    public function submit(Request $request)
    {
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
            'secondarySchool' => 'required|string|max:255',
            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'document_doc_id' => 'required|array',
            'document_doc_id.*' => 'exists:shs_documents,doc_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.',
                'errors' => $validator->errors()
            ], 422);
        }

        $success = false;
        $message = '';
        $redirect = '';

        DB::beginTransaction();
        try {
            // Create Student
            $studentType = \App\Models\ShsStudentType::where('type_name', $request->studentType)->first();
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
            ]);

            // Parent Info
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

            // Guardian (optional)
            if ($request->guardianFirstName) {
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

            // Educational Background
            ShsEducationalBackground::create([
                'student_id' => $student->student_id,
                'primary_school' => $request->primarySchool,
                'primary_year_graduated' => $request->primaryYearGraduated,
                'secondary_school' => $request->secondarySchool,
                'secondary_year_graduated' => $request->secondaryYearGraduated,
                'last_school_attended' => $request->lastSchoolAttended,
                'last_school_year_graduated' => $request->lastSchoolYearGraduated,
            ]);

            // Enrollment Preference
            ShsEnrollmentPreference::create([
                'student_id' => $student->student_id,
                'branch_id' => $request->preferredBranch,
                'course_id' => $request->preferredCourse,
                'level_id' => $request->yearLevelStep4,
            ]);

            // Upload Documents
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

            DB::commit();
            $success = true;
            $message = 'SHS Enrollment submitted successfully!';
            $redirect = route('shs.enrollment.success');
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'An error occurred: ' . $e->getMessage();
        }

        return response()->json([
    'success' => $success,
    'message' => $message,
    'redirect' => $redirect,
], $success ? 200 : 500);
        

        if ($success) {
            return redirect($redirect)->with('success', $message);
        }

        return redirect()->back()->with('error', $message);
    }

    public function success()
    {
        return view('website.enrollment_success');
    }
}