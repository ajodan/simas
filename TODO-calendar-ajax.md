# TODO: Implement AJAX Calendar for Landing Page Agenda

## Steps to Complete:
- [x] Add getCalendar method in AgendaController to generate calendar HTML for a given month/year
- [x] Modify index_user method in AgendaController to detect AJAX requests and return calendar HTML instead of full view
- [x] Update resources/views/user/agenda/index.blade.php to use AJAX for navigation buttons, add loading indicator, and wrap calendar in a container with ID
- [x] Add AJAX handling code in public/assets-landing/js/custom-scripts.js for calendar navigation
- [x] Test the AJAX functionality to ensure smooth navigation without page reloads
- [x] Add error handling for AJAX requests in case of failures
