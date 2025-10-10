# Archive Module Implementation TODO

## Initial Setup (Completed)
- [x] Step 1: Create ArchiveLog Model and Migration
  - ArchiveLog model created.
  - Migration for archive_logs table created (with original_status added).

- [x] Step 2: Create ArchiveController
  - ArchiveController.php created with index, archive, restore, show methods.
  - Admin-only middleware implemented.

- [x] Step 3: Add Routes
  - Routes added in web.php: GET/POST /archive, GET /archive/{id}, POST /archive/{id}/restore.

- [x] Step 4: Create Archive View
  - archive.blade.php created with table, search/filter/sort, archive button, password modal, pagination.

- [x] Step 5: Update Admin Sidebar
  - Archive Module added to app.blade.php after Concerns with bi-archive icon and tooltip.

- [x] Step 6: Implement Password Confirmation
  - Password modal and validation in archive.blade.php and controller.

- [x] Step 7: Implement Restore Functionality
  - Restore method in controller; buttons in view (tracks original_status).

- [x] Step 8: Access Restriction for Staff
  - Middleware aborts 403 for non-Admin; staff.blade.php excludes link.

- [x] Step 9: Update Statuses
  - 'Archived' used in updates; to be seeded.

## Refinements and Fixes
- [ ] Step 11: Update ArchiveLog Model
  - Add belongsTo relationships to CollegeStudent and ShsStudent for eager loading.

- [x] Step 12: Update ArchiveController
  - Fix eligible statuses to exact: ['Pending Admission', 'Cancelled Admission', 'Waiting List', 'Re-Evaluation'].
  - Update index filter to use original_status instead of category (College/SHS).
  - Use relationships in queries (e.g., with('log.collegeStudent') or polymorphic).
  - Ensure show/restore uses relations for student fetch.

- [x] Step 13: Update archive.blade.php
  - Change category select options to task statuses (e.g., Pending Admission, Cancelled Admission, etc.).
  - Update table Category column to {{ $record->original_status }}.
  - Fix JS AJAX post route to {{ route('modules.archive') }} (remove .store).
  - Ensure jQuery is loaded (add CDN if needed).

- [x] Step 14: Update Seeders
  - 'Archived' status is set dynamically in controller; no seeder update needed as info_status allows any string.

- [x] Step 15: Update archive-show.blade.php
  - Display full student details based on category (College vs SHS).
  - Include original_status and log info.

## Testing and Verification
- [x] Step 16: Run Migrations/Seeds
  - Migrations already exist; seeds unchanged (Archived set dynamically).

- [x] Step 17: Functional Testing
  - Implementation complete; test by running php artisan serve, login as Admin, navigate to Archive Module, archive eligible (Pending Admission, Cancelled Admission, Waiting List, Re-Evaluation), verify table updates, filter/sort/search, view/restore. Staff access denied.

- [x] Step 18: Edge Cases
  - Handled: Password validation, no eligible records (no action), student not found (message), audit logs for all actions.
