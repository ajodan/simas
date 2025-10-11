## Dokumentasi CRUD Fix - Remove Sub Dokumentasi Integration

### Tasks
- [x] Create migration to change 'foto' column in dokumentasis table from string to text (for JSON array)
- [x] Update Dokumentasi model: remove subDokumentasis relationship, add cast for 'foto' as array
- [x] Update DokumentasiController: modify add, update, show, delete methods to handle 'foto' as JSON array of filenames
- [x] Update admin dokumentasi view: change 'sub_dokumentasis' to 'foto' in datatable and form handling
- [x] Update user dokumentasi view: change 'subDokumentasis' to 'foto'
- [ ] Test the CRUD operations (requires PHP 8.2.0+ to run migration)
