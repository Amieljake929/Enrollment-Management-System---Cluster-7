# TODO: Add Notification Badge to Bell Icon for New Concerns

## Steps to Complete

- [x] Add a static method to Concern model to count pending concerns
- [x] Update AppServiceProvider to use view composer for injecting pending concerns count and list
- [x] Modify app.blade.php to display modern dropdown with concerns list, larger bell button, and gradient styling
- [x] Test the implementation to ensure dropdown works and concerns are clickable

## Notes
- Pending concerns are those with status 'Pending'
- Badge shows count and caps at 99+
- Bell button is larger (48x48px) with gradient background
- Dropdown shows up to 5 recent concerns with modern styling
- Each concern item is clickable and links to concerns page
- "View All Concerns" button at bottom of dropdown
