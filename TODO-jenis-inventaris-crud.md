# TODO: Jenis Inventaris CRUD Implementation

## Migration
- [ ] Create migration file: database/migrations/[timestamp]_create_jenis_inventaris_table.php
  - id (auto increment)
  - uuid (string, unique)
  - jenis_inventaris (string)
  - timestamps

## Model
- [ ] Create app/Models/JenisInventaris.php
  - Use HasFactory
  - Fillable: uuid, jenis_inventaris
  - Boot method for UUID generation

## Controller
- [ ] Create app/Http/Controllers/JenisInventarisController.php
  - Extend BaseController
  - Methods: index, get, add, show, update, delete

## Form Requests
- [ ] Create app/Http/Requests/StoreJenisInventarisRequest.php
  - Validate jenis_inventaris as required
- [ ] Create app/Http/Requests/UpdateJenisInventarisRequest.php
  - Validate jenis_inventaris as required

## View
- [ ] Create resources/views/admin/jenisinventaris/index.blade.php
  - DataTable with No, Jenis Inventaris, Aksi columns
  - Side drawer form for add/edit

## Routes
- [ ] Add routes to routes/web.php under admin/kegiatan prefix
  - jenisinventaris (GET) -> index
  - jenisinventaris-get (GET) -> get
  - jenisinventaris-add (POST) -> add
  - jenisinventaris-show/{uuid} (GET) -> show
  - jenisinventaris-update/{uuid} (POST) -> update
  - jenisinventaris-delete/{uuid} (DELETE) -> delete

## Testing
- [ ] Run migration: php artisan migrate
- [ ] Test CRUD functionality in browser
