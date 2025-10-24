# TODO: Merge Step 2 and Step 3 in CollegeEnrollment.blade.php

## Tasks
- [x] Update the stepper div to have 7 steps, renaming Step 2 to "Parents & Health Info" and renumbering subsequent steps.
- [x] Merge the HTML content of Step 2 (Parents Info) and Step 3 (Health Info) into a single section with data-step="2" and header "Step 2: Parents & Health Info".
- [x] Update data-step attributes of subsequent form sections (Preferences to 3, Educational Background to 4, Documents to 5, Referral to 6, Summary to 7).
- [x] Update JavaScript references: change document upload validation from index === 6 to index === 4, update error step mapping for merged steps, remove redundant populateSummary call.
- [x] Test the form navigation and validation to ensure 7 steps work correctly.
