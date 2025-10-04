<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\CollegeParentInfo;
use App\Models\CollegeGuardian;
use App\Models\CollegeEnrollmentPreference;
use App\Models\CollegeEducationalBackground;
use App\Models\CollegeUploadedDocument;
use App\Models\CollegeDocument;
use App\Models\CollegeShsIndigenous;
use App\Models\CollegeShsDisability;
use App\Models\CollegeEnrolleeNumber;
use App\Models\CollegeHealth;
use App\Models\CollegeReferral;
use App\Models\CollegeFourPs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Show the enrollment form
     */
    public function showForm()
    {
        $indigenousGroups = CollegeShsIndigenous::orderBy('indigenous_name')->get();
        $disabilityTypes = CollegeShsDisability::orderBy('disability_name')->get();

        return view('website.CollegeEnrollment', compact('indigenousGroups', 'disabilityTypes'));
    }

    /**
     * Handle form submission
     */
    public function submit(Request $request)
    {
        // Validate basic student info
        $validator = Validator::make($request->all(), [
            'studentType' => 'required|exists:college_student_types,type_name',
            'previousStudentId' => 'nullable|required_if:studentType,Returnee|regex:/^\d{8}$/',
            'firstName' => 'required|string|max:100',
            'middleName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'extensionName' => 'nullable|string|max:10',
            'civilStatus' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'placeOfBirth' => 'required',
            'nationality' => 'required',
            'currentAddress' => 'required',
            'cityMunicipality' => 'required',
            'region' => 'required|exists:college_regions,region_id',
            'zipCode' => 'required',
            'province' => 'required',
            'religion' => 'required',
            'email' => 'required|email|unique:college_students,email',
            'contactNumber' => 'required',
            'socialMedia' => 'required',
            'motherFirstName' => 'required|string|max:100',
            'motherMiddleName' => 'required|string|max:100',
            'motherLastName' => 'required|string|max:100',
            'motherOccupation' => 'required|string|max:100',
            'motherContact' => 'required|regex:/^\+?\d{7,15}$/',
            'motherEmail' => 'required|email',
            'fatherFirstName' => 'required|string|max:100',
            'fatherMiddleName' => 'required|string|max:100',
            'fatherLastName' => 'required|string|max:100',
            'fatherOccupation' => 'required|string|max:100',
            'fatherContact' => 'required|regex:/^\+?\d{7,15}$/',
            'fatherEmail' => 'required|email',
            'notLivingWithParents' => 'nullable|in:0,1',
            'guardianFirstName' => 'nullable|required_if:notLivingWithParents,1|string|max:100',
            'guardianMiddleName' => 'nullable|required_if:notLivingWithParents,1|string|max:100',
            'guardianLastName' => 'nullable|required_if:notLivingWithParents,1|string|max:100',
            'guardianDob' => 'nullable|required_if:notLivingWithParents,1|date',
            'guardianContact' => 'nullable|required_if:notLivingWithParents,1|regex:/^\+?\d{7,15}$/',
            'guardianEmail' => 'nullable|required_if:notLivingWithParents,1|email',
            'preferredBranch' => 'required|exists:college_branches,branch_id',
            'preferredCourse' => 'required|exists:college_courses,course_id',
            'yearLevelStep4' => 'required|exists:college_year_levels,level_id',
            'primarySchool' => 'required',
            'secondarySchool' => 'required',
            'lastSchoolAttended' => 'required',
            'indigenous' => 'required|exists:college_shs_indigenous,indigenous_id',
            'disability' => 'required|exists:college_shs_disability,disability_id',
            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB max per file
             'healthCondition' => 'required|in:Asthma,Allergies,Heart Disease,Hypertension,Diabeties Type 2,Kidney Disease,Pneumonia,Tuberculosis,Bleeding Disorders,Psychiatric Disorder,Cancer,Others',
             'weightKg' => 'required|numeric|min:0|max:300',
             'heightCm' => 'required|numeric|min:0|max:300',
             'referralSource' => 'required|in:Social Media Account,Adviser/Referral/Others,Walk-in/No Referral',
             'healthConditionOthers' => 'nullable|required_if:healthCondition,Others|string|max:255',
'referralName' => 'nullable|required_if:referralSource,Adviser/Referral/Others|string|max:100',
'referralRelation' => 'nullable|required_if:referralSource,Adviser/Referral/Others|string|max:100',
        ], [
            'indigenous.required' => 'Please select an Indigenous group.',
            'disability.required' => 'Please select a Disability type.',
        ]);
        
        // Add custom after validation hook for duplicate name check
        $validator->after(function ($validator) use ($request) {
            $existsCollege = CollegeStudent::whereRaw('LOWER(TRIM(first_name)) = ?', [strtolower(trim($request->firstName))])
                ->whereRaw('LOWER(TRIM(middle_name)) = ?', [strtolower(trim($request->middleName))])
                ->whereRaw('LOWER(TRIM(last_name)) = ?', [strtolower(trim($request->lastName))])
                ->where(function ($query) use ($request) {
                    if ($request->extensionName) {
                        $query->where('extension_name', $request->extensionName);
                    } else {
                        $query->whereNull('extension_name');
                    }
                })
                ->exists();

            $existsShs = \App\Models\ShsStudent::whereRaw('LOWER(TRIM(first_name)) = ?', [strtolower(trim($request->firstName))])
                ->whereRaw('LOWER(TRIM(middle_name)) = ?', [strtolower(trim($request->middleName))])
                ->whereRaw('LOWER(TRIM(last_name)) = ?', [strtolower(trim($request->lastName))])
                ->where(function ($query) use ($request) {
                    if ($request->extensionName) {
                        $query->where('extension_name', $request->extensionName);
                    } else {
                        $query->whereNull('extension_name');
                    }
                })
                ->exists();

            if ($existsCollege || $existsShs) {
                $validator->errors()->add('firstName', 'A student with this name already exists. Please verify your information.');
            }
        });
        

        // Removed duplicate name check here because it is now handled in the validator after() hook

        // Add custom document validation after basic validation
if ($validator->passes()) {
    $docIds = $request->input('document_doc_id', []);
    $toFollow = $request->input('to_follow', []); // e.g., [3 => "1", 5 => "1"]
    $files = $request->file('documents') ?: [];

    // Required doc_ids that CANNOT be "to follow"
    $strictlyRequiredDocIds = [1, 2, 7, 8, 13, 14]; // Form 138, PSA, Barangay Clearance, etc.

    // Validate count
    if (count($files) !== count($docIds)) {
        $validator->errors()->add('documents', 'Document count mismatch.');
    } else {
        foreach ($docIds as $index => $docId) {
            $isToFollow = isset($toFollow[$docId]) && $toFollow[$docId] == '1';
            $file = $files[$index] ?? null;

            // If NOT "to follow", file must exist
            if (!$isToFollow) {
                if (!$file) {
                    $validator->errors()->add("documents.{$index}", "Document {$docId} is required.");
                } elseif (!in_array($file->getClientOriginalExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {
                    $validator->errors()->add("documents.{$index}", "Invalid file type for document {$docId}.");
                } elseif ($file->getSize() > 5 * 1024 * 1024) {
                    $validator->errors()->add("documents.{$index}", "File too large for document {$docId}.");
                }
            }

            // If it's a strictly required doc, "to follow" is NOT allowed
            if (in_array($docId, $strictlyRequiredDocIds) && $isToFollow) {
                $validator->errors()->add("to_follow.{$docId}", "Document {$docId} cannot be marked as 'To follow'.");
            }
        }
    }
}


        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            \Log::debug('Validation errors:', $errors); // Log errors for debugging
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $errors
                ], 422);
            }
            $errorMessage = implode(', ', $errors);
            return redirect()->back()->with('error', $errorMessage)->withInput();
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
                'indigenous_id' => $request->indigenous,
                'disability_id' => $request->disability,
            ]);

            // Save 4Ps info if checked
if ($request->has('isFourPs') && $request->isFourPs == '1') {
    CollegeFourPs::create([
        'student_id' => $student->student_id,
    ]);
}
            // 2.5 Save Health Info
CollegeHealth::create([
    'student_id' => $student->student_id,
    'condition_type' => $request->healthCondition,
    'condition' => $request->healthCondition === 'Others' ? $request->healthConditionOthers : null,
    'weight_kg' => $request->weightKg,
    'height_cm' => $request->heightCm,
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

            // 3. Save Guardian (if not living with parents)
            if ($request->notLivingWithParents == '1') {
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

            // 5.5 Save Referral
CollegeReferral::create([
    'student_id' => $student->student_id,
    'referral_source' => $request->referralSource,
    'referral_name' => $request->referralSource === 'Adviser/Referral/Others' ? $request->referralName : null,
    'referral_relation' => $request->referralSource === 'Adviser/Referral/Others' ? $request->referralRelation : null,
]);

            // 6. Save Documents
            // 6. Save Documents (Only those NOT marked as "To follow")
if ($request->hasFile('documents')) {
    $files = $request->file('documents');
    $docIds = $request->input('document_doc_id');
    $toFollow = $request->input('to_follow', []);

    // Validate: must be arrays
    if (!is_array($docIds) || !is_array($files)) {
        throw new \Exception("Invalid document data.");
    }

    // Create a filtered list: only save docs that are NOT "to follow"
    $filteredFiles = [];
    $filteredDocIds = [];

    foreach ($docIds as $index => $docId) {
        $isToFollow = isset($toFollow[$docId]) && $toFollow[$docId] == '1';
        if (!$isToFollow) { // Only save if NOT marked as "To follow"
            $file = $files[$index] ?? null;
            if ($file) {
                $filteredFiles[] = $file;
                $filteredDocIds[] = $docId;
            }
        }
    }

    // Now validate: filtered files and doc_ids must match
    if (count($filteredFiles) !== count($filteredDocIds)) {
        throw new \Exception("Filtered document ID mismatch: expected " . count($filteredFiles) . " IDs.");
    }

    // Save each filtered file
    foreach ($filteredFiles as $index => $file) {
        $path = $file->store('enrollment_documents', 'public');
        $extension = $file->getClientOriginalExtension();

        CollegeUploadedDocument::create([
            'student_id' => $student->student_id,
            'doc_id' => $filteredDocIds[$index],
            'file_path' => $path,
            'file_type' => $extension,
        ]);
    }
}

            // ✅ REMOVED: CollegeSelf::create(...) — no longer needed

            // 7. Generate and Save Enrollee Number (ONLY ONCE PER STUDENT)
            $enrolleeNo = CollegeEnrolleeNumber::generateUniqueEnrolleeNo();

            CollegeEnrolleeNumber::create([
                'enrollee_no' => $enrolleeNo,
                'student_id' => $student->student_id,
            ]);

            // ✅ Commit transaction
            DB::commit();

            // ✅ Return JSON or Redirect
            return $this->jsonOrRedirect($request, true, null, route('enrollment.success'));

        } catch (\Exception $e) {
            // 🔙 Undo all changes
            DB::rollback();

            // Log error for debugging
            \Log::error('Enrollment failed: ' . $e->getMessage());

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

    /**
     * Show success page
     */
    public function success()
    {
        return view('website.enrollment_success');
    }
}