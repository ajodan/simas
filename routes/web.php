<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::get('/', 'Dashboard@index')->name('home.index');

    Route::get('/', 'Dashboard@dashboard_user')->name('dashboard-user');

    Route::get('/donasi-campaign-user', 'CampaignDonasiController@donasi_campaign_user')->name('donasi-campaign-user');
    Route::get('/detail-donasi-campaign/{params}', 'CampaignDonasiController@detail_donasi_campaign')->name('detail-donasi-campaign');
    Route::post('/donasi-campaign', 'CampaignDonasiController@donasi_campaign')->name('donasi-campaign');

    Route::get('/kegiatan', 'KegiatanController@index_kegiatan_user')->name('kegiatan');
    Route::get('/detail-kegiatan/{params}', 'KegiatanController@detail_kegiatan_user')->name('detail-kegiatan');

    Route::get('/artikel', 'ArtikelController@index_artikel_user')->name('artikel');
    Route::get('/detail-artikel/{params}', 'ArtikelController@detail_artikel_user')->name('detail-artikel');

    Route::get('/donatur-tetap/{params}', 'DonaturTetapController@donatur_tetap_jamaah')->name('donatur-tetap');
    Route::post('/donatur-tetap-donasi', 'DonaturTetapController@donasi_donatur_tetap')->name('donatur-tetap-donasi');

    Route::get('/about', 'Dashboard@about')->name('about');
    Route::get('/struktur-organisasi', 'Dashboard@struktur_organisasi')->name('struktur-organisasi');

    Route::post('/pengajuan', 'PengajuanBarangController@store')->name('pengajuan');

    Route::get('dokumentasi', 'DokumentasiController@dokumentasi')->name('dokumentasi');
    Route::get('/landing-artikel', 'ArtikelController@landingPage')->name('landing-artikel');
    Route::get('/artikel/{slug}', 'ArtikelController@showUser')->name('artikel.detail');
    Route::get('/inventaris', 'InventarisController@index_inventaris_user')->name('inventaris-user');
    Route::get('/detail-inventaris/{params}', 'InventarisController@detail_inventaris_user')->name('detail-inventaris');

    Route::get('/monitoring', 'Dashboard@monitorin')->name('monitoring');

    Route::get('/waktu-azan', 'Dashboard@getWaktuAzan')->name('waktu-azan');
    Route::get('/agenda', 'AgendaController@index_user')->name('agenda');
    Route::get('/agenda/get-by-date', 'AgendaController@getByDate')->name('agenda.get-by-date');
    // Route::get('/agenda-mini', 'AgendaController@getMiniCalendar')->name('agenda-mini');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/login-akun', 'Auth@show')->name('login-akun');
        Route::post('/login-proses', 'Auth@login_proses')->name('login-proses');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
        Route::get('/dashboard-admin', 'Dashboard@dashboard_admin')->name('dashboard-admin');
        Route::get('/dashboard-pengurus', 'Dashboard@dashboard_pengurus')->name('dashboard-pengurus');

        Route::get('/data-jamaah', 'DataJamaahController@index')->name('data-jamaah');
        Route::get('/data-jamaah-get', 'DataJamaahController@get')->name('data-jamaah-get');
        Route::post('/data-jamaah-add', 'DataJamaahController@add')->name('data-jamaah-add');
        Route::get('/data-jamaah-show/{params}', 'DataJamaahController@show')->name('data-jamaah-show');
        Route::post('/data-jamaah-update/{params}', 'DataJamaahController@update')->name('data-jamaah-update');
        Route::delete('/data-jamaah-delete/{params}', 'DataJamaahController@delete')->name('data-jamaah-delete');

        Route::get('/data-ustadz', 'UstadzController@index')->name('data-ustadz');
        Route::get('/data-ustadz-get', 'UstadzController@get')->name('data-ustadz-get');
        Route::post('/data-ustadz-add', 'UstadzController@add')->name('data-ustadz-add');
        Route::get('/data-ustadz-show/{params}', 'UstadzController@show')->name('data-ustadz-show');
        Route::post('/data-ustadz-update/{params}', 'UstadzController@update')->name('data-ustadz-update');
        Route::delete('/data-ustadz-delete/{params}', 'UstadzController@delete')->name('data-ustadz-delete');

        Route::get('/laporan-keuangan', 'LaporanKeuanganController@index')->name('laporan-keuangan');
        Route::get('/laporan-keuangan-get', 'LaporanKeuanganController@get')->name('laporan-keuangan-get');
        Route::post('/laporan-keuangan-add', 'LaporanKeuanganController@add')->name('laporan-keuangan-add');
        Route::get('/laporan-keuangan-show/{params}', 'LaporanKeuanganController@show')->name('laporan-keuangan-show');
        Route::post('/laporan-keuangan-update/{params}', 'LaporanKeuanganController@update')->name('laporan-keuangan-update');
        Route::delete('/laporan-keuangan-delete/{params}', 'LaporanKeuanganController@delete')->name('laporan-keuangan-delete');

        Route::get('/users', 'UserController@index')->name('users');
        Route::get('/users-get', 'UserController@get')->name('users-get');
        Route::post('/users-add', 'UserController@add')->name('users-add');
        Route::get('/users-show/{params}', 'UserController@show')->name('users-show');
        Route::post('/users-update/{params}', 'UserController@update')->name('users-update');
        Route::delete('/users-delete/{params}', 'UserController@delete')->name('users-delete');

        Route::get('/jenisinventaris', 'JenisInventarisController@index')->name('jenisinventaris');
        Route::get('/jenisinventaris-get', 'JenisInventarisController@get')->name('jenisinventaris-get');
        Route::post('/jenisinventaris-add', 'JenisInventarisController@add')->name('jenisinventaris-add');
        Route::get('/jenisinventaris-show/{params}', 'JenisInventarisController@show')->name('jenisinventaris-show');
        Route::post('/jenisinventaris-update/{params}', 'JenisInventarisController@update')->name('jenisinventaris-update');
        Route::delete('/jenisinventaris-delete/{params}', 'JenisInventarisController@delete')->name('jenisinventaris-delete');

        Route::get('/inventaris', 'InventarisController@index')->name('inventaris');
        Route::get('/inventaris-get', 'InventarisController@get')->name('inventaris-get');
        Route::post('/inventaris-add', 'InventarisController@add')->name('inventaris-add');
        Route::get('/inventaris-show/{params}', 'InventarisController@show')->name('inventaris-show');
        Route::post('/inventaris-update/{params}', 'InventarisController@update')->name('inventaris-update');
        Route::delete('/inventaris-delete/{params}', 'InventarisController@delete')->name('inventaris-delete');

        Route::prefix('data-donasi')->group(function () {
            Route::get('/donasi-manual', 'DonasiManualController@index')->name('donasi-manual');
            Route::get('/donasi-manual-get', 'DonasiManualController@get')->name('donasi-manual-get');
            Route::post('/donasi-manual-add', 'DonasiManualController@add')->name('donasi-manual-add');
            Route::get('/donasi-manual-show/{params}', 'DonasiManualController@show')->name('donasi-manual-show');
            Route::post('/donasi-manual-update/{params}', 'DonasiManualController@update')->name('donasi-manual-update');
            Route::delete('/donasi-manual-delete/{params}', 'DonasiManualController@delete')->name('donasi-manual-delete');

            Route::get('donatur-tetap', 'DonaturTetapController@index')->name('donatur-tetap');
            Route::get('donatur-tetap-get', 'DonaturTetapController@get')->name('donatur-tetap-get');
            Route::post('donatur-tetap-add', 'DonaturTetapController@add')->name('donatur-tetap-add');
            Route::get('donatur-tetap-show/{params}', 'DonaturTetapController@show')->name('donatur-tetap-show');
            Route::post('donatur-tetap-update/{params}', 'DonaturTetapController@update')->name('donatur-tetap-update');
            Route::delete('donatur-tetap-delete/{params}', 'DonaturTetapController@delete')->name('donatur-tetap-delete');
            Route::get('donatur-tetap-list-donasi/{params}', 'DonaturTetapController@list_donasi')->name('donatur-tetap-list-donasi');
            Route::get('donatur-tetap-get-list-donasi/{params}', 'DonaturTetapController@get_list_donasi')->name('donatur-tetap-get-list-donasi');
            Route::get('donatur-tetap-aprove-donasi/{params}', 'DonaturTetapController@aprove_donasi_tetap')->name('donatur-tetap-aprove-donasi');

            Route::get('campaign-donasi', 'CampaignDonasiController@index')->name('campaign-donasi');
            Route::get('campaign-donasi-get', 'CampaignDonasiController@get')->name('campaign-donasi-get');
            Route::post('campaign-donasi-add', 'CampaignDonasiController@add')->name('campaign-donasi-add');
            Route::get('campaign-donasi-show/{params}', 'CampaignDonasiController@show')->name('campaign-donasi-show');
            Route::post('campaign-donasi-update/{params}', 'CampaignDonasiController@update')->name('campaign-donasi-update');
            Route::delete('campaign-donasi-delete/{params}', 'CampaignDonasiController@delete')->name('campaign-donasi-delete');
            Route::get('update-tombol-campaign/{params}', 'CampaignDonasiController@update_tombol')->name('update-tombol-campaign');
            Route::get('list-donasi-campaign/{params}', 'CampaignDonasiController@list_donasi_campaign')->name('list-donasi-campaign');
            Route::get('donasi-campaign-get/{params}', 'CampaignDonasiController@get_list_donasi_campaign')->name('donasi-campaign-get');
            Route::get('donasi-campaign-approve/{params}', 'CampaignDonasiController@aprove_donasi_campaign')->name('donasi-campaign-approve');
            Route::delete('donasi-campaign-delete/{params}', 'CampaignDonasiController@delete_donasi_campaign')->name('donasi-campaign-delete');

            Route::get('/realisasi-dana', 'RealisasiController@index')->name('realisasi-dana');
            Route::get('/realisasi-dana-get', 'RealisasiController@get')->name('realisasi-dana-get');
            Route::post('/realisasi-dana-add', 'RealisasiController@add')->name('realisasi-dana-add');
            Route::get('/realisasi-dana-show/{params}', 'RealisasiController@show')->name('realisasi-dana-show');
            Route::post('/realisasi-dana-update/{params}', 'RealisasiController@update')->name('realisasi-dana-update');
            Route::delete('/realisasi-dana-delete/{params}', 'RealisasiController@delete')->name('realisasi-dana-delete');

            Route::get('/laporan', 'Laporan@index')->name('laporan');
            Route::get('/laporan-get/{params}', 'Laporan@get')->name('laporan-get');
            Route::get('/laporan-export/{params}', 'Laporan@export_to_excel')->name('laporan-export');
        });

        Route::prefix('kegiatan')->group(function () {
            Route::get('/jadwal-jumat', 'JadwalJumatController@index')->name('jadwal-jumat');
            Route::get('/jadwal-jumat-get', 'JadwalJumatController@get')->name('jadwal-jumat-get');
            Route::post('/jadwal-jumat-add', 'JadwalJumatController@add')->name('jadwal-jumat-add');
            Route::get('/jadwal-jumat-show/{params}', 'JadwalJumatController@show')->name('jadwal-jumat-show');
            Route::post('/jadwal-jumat-update/{params}', 'JadwalJumatController@update')->name('jadwal-jumat-update');
            Route::delete('/jadwal-jumat-delete/{params}', 'JadwalJumatController@delete')->name('jadwal-jumat-delete');

            Route::get('/kegiatan', 'KegiatanController@index')->name('kegiatan');
            Route::get('/kegiatan-get', 'KegiatanController@get')->name('kegiatan-get');
            Route::post('/kegiatan-add', 'KegiatanController@add')->name('kegiatan-add');
            Route::get('/kegiatan-show/{params}', 'KegiatanController@show')->name('kegiatan-show');
            Route::post('/kegiatan-update/{params}', 'KegiatanController@update')->name('kegiatan-update');
            Route::delete('/kegiatan-delete/{params}', 'KegiatanController@delete')->name('kegiatan-delete');

            Route::get('/jeniskegiatan', 'JeniskegiatanController@index')->name('jeniskegiatan');
            Route::get('/jeniskegiatan-get', 'JeniskegiatanController@get')->name('jeniskegiatan-get');
            Route::post('/jeniskegiatan-add', 'JeniskegiatanController@add')->name('jeniskegiatan-add');
            Route::get('/jeniskegiatan-show/{params}', 'JeniskegiatanController@show')->name('jeniskegiatan-show');
            Route::post('/jeniskegiatan-update/{params}', 'JeniskegiatanController@update')->name('jeniskegiatan-update');
            Route::delete('/jeniskegiatan-delete/{params}', 'JeniskegiatanController@delete')->name('jeniskegiatan-delete');

            Route::get('/jenislaporan', 'JenislaporanController@index')->name('jenislaporan');
            Route::get('/jenislaporan-get', 'JenislaporanController@get')->name('jenislaporan-get');
            Route::post('/jenislaporan-add', 'JenislaporanController@add')->name('jenislaporan-add');
            Route::get('/jenislaporan-show/{params}', 'JenislaporanController@show')->name('jenislaporan-show');
            Route::post('/jenislaporan-update/{params}', 'JenislaporanController@update')->name('jenislaporan-update');
            Route::delete('/jenislaporan-delete/{params}', 'JenislaporanController@delete')->name('jenislaporan-delete');

            Route::get('/agenda', 'AgendaController@index')->name('agenda');
            Route::get('/agenda-get', 'AgendaController@get')->name('agenda-get');
            Route::post('/agenda-add', 'AgendaController@add')->name('agenda-add');
            Route::get('/agenda-show/{params}', 'AgendaController@show')->name('agenda-show');
            Route::post('/agenda-update/{params}', 'AgendaController@update')->name('agenda-update');
            Route::delete('/agenda-delete/{params}', 'AgendaController@delete')->name('agenda-delete');
            Route::get('/agenda-by-date', 'AgendaController@getByDate')->name('agenda-by-date');

        });

        Route::prefix('tentang')->group(function () {
            Route::get('/visimisi', 'VisiMisiController@index')->name('visimisi');
            Route::get('/visimisi-get', 'VisiMisiController@get')->name('visimisi-get');
            Route::post('/visimisi-add', 'VisiMisiController@add')->name('visimisi-add');
            Route::get('/visimisi-show/{params}', 'VisiMisiController@show')->name('visimisi-show');
            Route::post('/visimisi-update/{params}', 'VisiMisiController@update')->name('visimisi-update');
            Route::delete('/visimisi-delete/{params}', 'VisiMisiController@delete')->name('visimisi-delete');

            Route::get('/sejarah', 'SejarahController@index')->name('sejarah');
            Route::get('/sejarah-get', 'SejarahController@get')->name('sejarah-get');
            Route::post('/sejarah-add', 'SejarahController@add')->name('sejarah-add');
            Route::get('/sejarah-show/{params}', 'SejarahController@show')->name('sejarah-show');
            Route::post('/sejarah-update/{params}', 'SejarahController@update')->name('sejarah-update');
            Route::delete('/sejarah-delete/{params}', 'SejarahController@delete')->name('sejarah-delete');

            Route::get('/struktur-organisasi', 'StrukturOrganisasiController@index')->name('struktur-organisasi');
            Route::get('/struktur-organisasi-get', 'StrukturOrganisasiController@get')->name('struktur-organisasi-get');
            Route::post('/struktur-organisasi-add', 'StrukturOrganisasiController@add')->name('struktur-organisasi-add');
            Route::get('/struktur-organisasi-show/{params}', 'StrukturOrganisasiController@show')->name('struktur-organisasi-show');
            Route::post('/struktur-organisasi-update/{params}', 'StrukturOrganisasiController@update')->name('struktur-organisasi-update');
            Route::delete('/struktur-organisasi-delete/{params}', 'StrukturOrganisasiController@delete')->name('struktur-organisasi-delete');
        });

        Route::get('/chart', 'Dashboard@areaChart')->name('chart');

        Route::get('/dokumentasi', 'DokumentasiController@index')->name('dokumentasi');
        Route::get('/dokumentasi-get', 'DokumentasiController@get')->name('dokumentasi-get');
        Route::post('/dokumentasi-add', 'DokumentasiController@add')->name('dokumentasi-add');
        Route::get('/dokumentasi-show/{params}', 'DokumentasiController@show')->name('dokumentasi-show');
        Route::post('/dokumentasi-update/{params}', 'DokumentasiController@update')->name('dokumentasi-update');
        Route::delete('/dokumentasi-delete/{params}', 'DokumentasiController@delete')->name('dokumentasi-delete');

        Route::get('/kategori-artikel', 'KategoriArtikelController@index')->name('kategori-artikel');
        Route::get('/kategori-artikel-get', 'KategoriArtikelController@get')->name('kategori-artikel-get');
        Route::post('/kategori-artikel-add', 'KategoriArtikelController@add')->name('kategori-artikel-add');
        Route::get('/kategori-artikel-show/{params}', 'KategoriArtikelController@show')->name('kategori-artikel-show');
        Route::post('/kategori-artikel-update/{params}', 'KategoriArtikelController@update')->name('kategori-artikel-update');
        Route::delete('/kategori-artikel-delete/{params}', 'KategoriArtikelController@delete')->name('kategori-artikel-delete');

        Route::get('/artikel', 'ArtikelController@index')->name('artikel');
        Route::get('/artikel-get', 'ArtikelController@get')->name('artikel-get');
        Route::post('/artikel-add', 'ArtikelController@add')->name('artikel-add');
        Route::get('/artikel-show/{params}', 'ArtikelController@show')->name('artikel-show');
        Route::post('/artikel-update/{params}', 'ArtikelController@update')->name('artikel-update');
        Route::delete('/artikel-delete/{params}', 'ArtikelController@delete')->name('artikel-delete');

        Route::get('/dokumentasi-sub/{uuid}', 'SubDokumentasiController@index')->name('dokumentasi-sub');

        Route::get('/sub-dokumentasi', 'SubDokumentasiController@index')->name('sub-dokumentasi');
        Route::get('/sub-dokumentasi-get', 'SubDokumentasiController@get')->name('sub-dokumentasi-get');
        Route::post('/sub-dokumentasi-add', 'SubDokumentasiController@add')->name('sub-dokumentasi-add');
        Route::get('/sub-dokumentasi-show/{params}', 'SubDokumentasiController@show')->name('sub-dokumentasi-show');
        Route::post('/sub-dokumentasi-update/{params}', 'SubDokumentasiController@update')->name('sub-dokumentasi-update');
        Route::delete('/sub-dokumentasi-delete/{params}', 'SubDokumentasiController@delete')->name('sub-dokumentasi-delete');

        Route::get('pengajuan', 'PengajuanBarangController@index')->name('pengajuan');
        Route::get('pengajuan-get', 'PengajuanBarangController@get')->name('pengajuan-get');
        Route::get('/pengajuan-show/{params}', 'PengajuanBarangController@show')->name('pengajuan-show');
        Route::post('/pengajuan-update/{params}', 'PengajuanBarangController@update')->name('pengajuan-update');
        Route::delete('/pengajuan-delete/{params}', 'PengajuanBarangController@delete')->name('pengajuan-delete');
    });

    Route::group(['prefix' => 'pengurus', 'middleware' => ['auth'], 'as' => 'pengurus.'], function () {
        Route::get('/dashboard-pengurus', 'Dashboard@dashboard_pengurus')->name('dashboard-pengurus');
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::post('/profile-update/{params}', 'ProfileController@update')->name('profile-update');
    });

    Route::get('/logout', 'Auth@logout')->name('logout');
    Route::get('/user/change-password', 'UserController@changePassword')->middleware('auth')->name('user.change-password');
    Route::post('/user/change-password', 'UserController@changePassword')->middleware('auth')->name('user.change-password.post');
    Route::get('/user/profile', 'UserController@profile')->middleware('auth')->name('user.profile');
    Route::post('/user/profile', 'UserController@updateProfile')->middleware('auth')->name('user.profile.update');
    
});
