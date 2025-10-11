# TODO: Artikel CRUD Implementation

## Overview
Create tabel artikels with fields: id, kategori_id, judul, slug, isi_artikel, status, photo. Create CRUD operations and landing page display related to kategori_artikel table.

## Tasks
- [ ] Create migration for kategori_artikel table
- [ ] Create migration for artikels table
- [ ] Create KategoriArtikel model
- [ ] Create Artikel model
- [ ] Create StoreArtikelRequest validation
- [ ] Create UpdateArtikelRequest validation
- [ ] Create ArtikelController with CRUD methods
- [ ] Create admin artikel index view
- [ ] Create user artikel index view (landing page)
- [ ] Add routes for artikels in web.php
- [ ] Run migrations
- [ ] Test CRUD functionality
- [ ] Test user landing page display

## Files to Create
- database/migrations/YYYY_MM_DD_HHMMSS_create_kategori_artikels_table.php
- database/migrations/YYYY_MM_DD_HHMMSS_create_artikels_table.php
- app/Models/KategoriArtikel.php
- app/Models/Artikel.php
- app/Http/Requests/StoreArtikelRequest.php
- app/Http/Requests/UpdateArtikelRequest.php
- app/Http/Controllers/ArtikelController.php
- resources/views/admin/artikel/index.blade.php
- resources/views/user/artikel/index.blade.php

## Files to Edit
- routes/web.php: Add artikel routes
