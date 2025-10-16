# TODO: Separate Date and Time Fields in Kegiatan Table

## Pending Tasks
- [x] Create migration to alter 'kegiatans' table: add 'jam' time column, extract time from existing 'tanggal' to 'jam', change 'tanggal' to date type
- [x] Update Kegiatan model: add 'jam' to fillable array
- [x] Update KegiatanController: remove date/time combining logic in add() and update() methods, save 'tanggal' and 'jam' separately
- [x] Update view (resources/views/admin/kegiatan/index.blade.php): remove special splitting logic in edit JavaScript for 'tanggal', change table Jam column to render from 'jam' field
- [ ] Run migration: php artisan migrate (Note: Migration command failed due to PHP version < 8.2.0 requirement. Please upgrade PHP or run manually when environment is ready)
- [ ] Test form functionality for add/edit kegiatan
- [ ] Verify table displays date and time correctly
