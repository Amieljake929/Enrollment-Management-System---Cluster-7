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
use App\Models\ShsHealth;
use App\Models\ShsReferral;
use App\Models\ShsFourPs;
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
    'healthCondition' => 'required|in:Asthma,Allergies,Heart Disease,Hypertension,Diabeties Type 2,Kidney Disease,Pneumonia,Tuberculosis,Bleeding Disorders,Psychiatric Disorder,Cancer,Others',
    'healthConditionOthers' => 'nullable|required_if:healthCondition,Others|string|max:255',
    'weightKg' => 'required|numeric|min:0|max:300',
    'heightCm' => 'required|numeric|min:0|max:300',
    'referralSource' => 'required|in:Social Media Account,Adviser/Referral/Others,Walk-in/No Referral',
    'referralName' => 'nullable|required_if:referralSource,Adviser/Referral/Others|string|max:100',
    'referralRelation' => 'nullable|required_if:referralSource,Adviser/Referral/Others|string|max:100',
], [
    'lrn.unique' => 'The LRN is already taken.',
    'indigenous.required' => 'Please select an Indigenous group.',
    'disability.required' => 'Please select a Disability type.',
]);

// Custom document validation
if ($validator->passes()) {
    $docIds = $request->input('document_doc_id', []);
    $toFollow = $request->input('to_follow', []); // e.g., [2 => "1", 3 => "1"]
    $files = $request->file('documents') ?: [];

    // Strictly required doc_ids (CANNOT be "to follow")
    $strictlyRequiredDocIds = [1, 4]; // Form 138, ID Picture

    if (count($files) !== count($docIds)) {
        $validator->errors()->add('documents', 'Document count mismatch.');
    } else {
        foreach ($docIds as $index => $docId) {
            $isToFollow = isset($toFollow[$docId]) && $toFollow[$docId] == '1';
            $file = $files[$index] ?? null;

            // If NOT "to follow", file must exist and be valid
            if (!$isToFollow) {
                if (!$file) {
                    $validator->errors()->add("documents.{$index}", "Document {$docId} is required.");
                } elseif (!in_array($file->getClientOriginalExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {
                    $validator->errors()->add("documents.{$index}", "Invalid file type for document {$docId}.");
                } elseif ($file->getSize() > 5 * 1024 * 1024) {
                    $validator->errors()->add("documents.{$index}", "File too large for document {$docId}.");
                }
            }

            // Block "to follow" on strictly required docs
            if (in_array($docId, $strictlyRequiredDocIds) && $isToFollow) {
                $validator->errors()->add("to_follow.{$docId}", "Document {$docId} cannot be marked as 'To follow'.");
            }
        }
    }
}

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

            // Save 4Ps info if checked
if ($request->has('isFourPs') && $request->isFourPs == '1') {
    ShsFourPs::create([
        'student_id' => $student->student_id,
    ]);
}

            // Save Health Info
ShsHealth::create([
    'student_id' => $student->student_id,
    'condition_type' => $request->healthCondition,
    'condition' => $request->healthCondition === 'Others' ? $request->healthConditionOthers : null,
    'weight_kg' => $request->weightKg,
    'height_cm' => $request->heightCm,
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
            // After saving educational background, add:
ShsReferral::create([
    'student_id' => $student->student_id,
    'referral_source' => $request->referralSource,
    'referral_name' => $request->referralSource === 'Adviser/Referral/Others' ? $request->referralName : null,
    'referral_relation' => $request->referralSource === 'Adviser/Referral/Others' ? $request->referralRelation : null,
]);

            // 5. Save Enrollment Preference
            ShsEnrollmentPreference::create([
                'student_id' => $student->student_id,
                'branch_id' => $request->preferredBranch,
                'course_id' => $request->preferredCourse,
                'level_id' => $request->yearLevelStep4,
            ]);

            // 6. Upload Documents
            // Save Documents (only those NOT marked as "To follow")
if ($request->hasFile('documents')) {
    $files = $request->file('documents');
    $docIds = $request->input('document_doc_id');
    $toFollow = $request->input('to_follow', []);

    foreach ($docIds as $index => $docId) {
        $isToFollow = isset($toFollow[$docId]) && $toFollow[$docId] == '1';
        $file = $files[$index] ?? null;

        if (!$isToFollow && $file) {
            $path = $file->store('shs_documents', 'public');
            ShsUploadedDocument::create([
                'student_id' => $student->student_id,
                'doc_id' => $docId,
                'file_path' => $path,
            ]);
        }
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