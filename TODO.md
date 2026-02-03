<<<<<<< HEAD
# TODO: Merge Step 2 and Step 3 in CollegeEnrollment.blade.php

## Tasks
- [x] Update the stepper div to have 7 steps, renaming Step 2 to "Parents & Health Info" and renumbering subsequent steps.
- [x] Merge the HTML content of Step 2 (Parents Info) and Step 3 (Health Info) into a single section with data-step="2" and header "Step 2: Parents & Health Info".
- [x] Update data-step attributes of subsequent form sections (Preferences to 3, Educational Background to 4, Documents to 5, Referral to 6, Summary to 7).
- [x] Update JavaScript references: change document upload validation from index === 6 to index === 4, update error step mapping for merged steps, remove redundant populateSummary call.
- [x] Test the form navigation and validation to ensure 7 steps work correctly.
=======
# Dashboard Update Tasks

## Completed Tasks
- [x] Updated DashboardController.php to calculate counts instead of percentages for Pending Admission, Waiting List, Cancelled Admissions
- [x] Added import for ShsEnrollmentPreference model
- [x] Updated branch calculations to count enrollees in Main Branch and Bulacan Branch from both College and SHS
- [x] Renamed variables: pendingPercentage -> pendingCount, validatedPercentage -> waitingListCount, cancelledPercentage -> cancelledCount, reEvaluatePercentage -> mainBranchCount, mainCampusPercentage + bulacanPercentage -> bulacanBranchCount
- [x] Updated dashboard.blade.php to display counts instead of percentages for the specified cards
- [x] Renamed "Re-evaluation" card to "Main Branch"
- [x] Renamed "Total Campus" card to "Bulacan Branch"
- [x] Updated JavaScript chart data to use new count variables for trend charts
- [x] Kept pie chart using percentages for campus distribution

## Status Mappings
- Pending Admission -> Pending status count
- Waiting List -> Validated status count
- Cancelled Admissions -> Cancelled status count
- Main Branch -> Count of enrollees in Main Campus branch
- Bulacan Branch -> Count of enrollees in Bulacan Campus branch

## Files Modified
- app/Http/Controllers/DashboardController.php
- resources/views/dashboard.blade.php
>>>>>>> main
