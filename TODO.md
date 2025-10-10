# TODO: Set Up Dedicated Modules for Staff

## Information Gathered
- Admin uses `layouts.app.blade.php` with sidebar containing modules: Dashboard, Pending Admissions (College/SHS), Waiting List (College/SHS), Student Records (College/SHS), Cancelled Admissions (College/SHS), Re-Evaluation (College/SHS), Concerns.
- Staff uses `layouts.staff.blade.php` with sidebar containing: Staff Dashboard, Pending Admissions (placeholders), Waiting List (placeholders), Student Records (placeholders), Uploaded Documents (placeholders), Parents Notification (placeholders).
- Current modules routes are under `/modules` prefix, accessible by both roles.
- User wants staff to have the same modules as admin, but dedicated so editing admin modules doesn't affect staff.

## Plan
- [x] Create dedicated routes for staff modules under `/staff/modules` prefix in `routes/web.php`.
- [x] Update `layouts.staff.blade.php` to have the same module structure as `layouts.app.blade.php`, but with links to staff-specific routes.
- [x] Ensure staff dashboard link points to `dashboard.staff`.
- [x] Create separate controllers for staff modules (StaffPendingAdmissionController, StaffWaitingController, StaffCancelledController, StaffReEvaluationController, StaffConcernController) to ensure editing admin controllers doesn't affect staff.
- [ ] Update `DashboardStaff.blade.php` if additional content is needed (currently basic).
- [ ] Create separate views for staff modules if needed for full separation (currently using same views as admin for Student Records and Parents Notification).

## Dependent Files to be Edited
- `routes/web.php`: Add new route group for staff modules and update to use Staff*Controllers. [DONE]
- `resources/views/layouts/staff.blade.php`: Update sidebar modules to match admin's, with staff routes. [DONE]
- `resources/views/DashboardStaff.blade.php`: Optionally add content.
- `app/Http/Controllers/`: Created Staff*Controllers. [DONE]

## Followup Steps
- Test staff login and module access.
- Implement any staff-specific logic in controllers if required.
- Ensure no conflicts with admin modules.
- If full view separation is needed, create modules/staff* views.
