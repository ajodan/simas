# TODO: Add Photo and Tahun Perolehan to Inventaris

## Completed Steps
- [x] Create migration to add 'photo' string nullable and 'tahun_perolehan' integer nullable columns to inventaris table.
- [x] Update Inventaris model to include 'photo' and 'tahun_perolehan' in fillable.
- [x] Update StoreInventarisRequest to add validation for 'photo' as nullable image file and 'tahun_perolehan' as nullable integer min 1900 max current year.
- [x] Update UpdateInventarisRequest similarly, fixing the unique rule for kode_inventaris.
- [x] Update InventarisController add method to handle photo upload (store in public/inventaris, generate unique name).
- [x] Update update method to handle photo upload and delete old photo if new one uploaded.
- [x] Update delete method to delete the photo file.
- [x] Update the view: add file input and tahun_perolehan input in the form, add 'Photo' and 'Tahun Perolehan' columns in the table with image display.

## Followup Steps
- [ ] Run the migration: `php artisan migrate`
- [ ] Test the CRUD functionality, especially file upload and display.
- [ ] Ensure the public/storage link is created if not already: `php artisan storage:link`
- [ ] Verify that the inventaris directory exists in storage/app/public/inventaris
