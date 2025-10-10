# TODO: Fix Missing Educational Background Data in College Enrollment

## Current Work
Fix the issue where educational background year fields (primaryYearGraduated, secondaryYearGraduated, lastSchoolYearGraduated) are not being validated server-side, leading to missing data in the database.

## Key Technical Concepts
- Laravel Validation: Using Validator::make to enforce required integer years (1900-2099).
- Form Submission: AJAX FormData handles all fields; validation ensures completeness.
- Models: CollegeEducationalBackground stores the data; no changes needed.

## Relevant Files and Code
- app/Http/Controllers/EnrollmentController.php
  - Current validation array misses year fields.
  - Will add: 'primaryYearGraduated' => 'required|integer|min:1900|max:2099', etc.

## Problem Solving
- Issue: Frontend marks fields required, but backend skips validation, allowing null saves.
- Solution: Add server-side rules to match frontend requirements.

## Pending Tasks and Next Steps
- [x] Step 1: Edit EnrollmentController.php to add validation rules for primaryYearGraduated, secondaryYearGraduated, and lastSchoolYearGraduated in the $validator array.
  - Locate the Validator::make($request->all(), [ ... ]) section.
  - Insert the new rules after the existing educational fields.
- [x] Step 2: After edit, update TODO.md to mark Step 1 as completed.
- [ ] Step 3: Test submission (user to verify in database or admin panel that years are saved).
- [ ] Step 4: If issues persist, investigate further (e.g., request logs).
