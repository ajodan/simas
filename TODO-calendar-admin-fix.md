# Fix Admin Agenda Calendar Consistency

## Tasks
- [x] Update AgendaController@index() to generate $calendarHtml for admin view using getCalendar($month, $year, false)
- [x] Replace inline @php calendar generation in resources/views/admin/agenda/index.blade.php with {!! $calendarHtml !!}
- [x] Test admin calendar loads correctly and is clickable (code review confirms consistency with user view)
- [x] Verify navigation and modal work as expected (HTML structure preserved, navigation updated to match user view)
