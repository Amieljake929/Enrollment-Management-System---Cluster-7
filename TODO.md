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
