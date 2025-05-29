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
    Route::get('/', 'Dashboard@index')->name('home.index');

    Route::get('/', 'Dashboard@dashboard_user')->name('dashboard-user');

    Route::get('/donasi-campaign-user', 'CampaignDonasiController@donasi_campaign_user')->name('donasi-campaign-user');
    Route::get('/detail-donasi-capaign/{params}', 'CampaignDonasiController@detail_donasi_campaign')->name('detail-donasi-campaign');
    Route::post('/donasi-campaign', 'CampaignDonasiController@donasi_campaign')->name('donasi-campaign');

    Route::get('/kegiatan', 'KegiatanController@index_kegiatan_user')->name('kegiatan');
    Route::get('/detail-kegiatan/{params}', 'KegiatanController@detail_kegiatan_user')->name('detail-kegiatan');

    Route::get('/donatur-tetap/{params}', 'DonaturTetapController@donatur_tetap_jamaah')->name('donatur-tetap');
    Route::post('/donatur-tetap-donasi', 'DonaturTetapController@donasi_donatur_tetap')->name('donatur-tetap-donasi');

    Route::get('/about', 'Dashboard@about')->name('about');

    Route::get('/monitoring', 'Dashboard@monitorin')->name('monitoring');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/login-akun', 'Auth@show')->name('login-akun');
        Route::post('/login-proses', 'Auth@login_proses')->name('login-proses');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
        Route::get('/dashboard-admin', 'Dashboard@dashboard_admin')->name('dashboard-admin');

        Route::get('/data-jamaah', 'DataJamaahController@index')->name('data-jamaah');
        Route::get('/data-jamaah-get', 'DataJamaahController@get')->name('data-jamaah-get');
        Route::post('/data-jamaah-add', 'DataJamaahController@add')->name('data-jamaah-add');
        Route::get('/data-jamaah-show/{params}', 'DataJamaahController@show')->name('data-jamaah-show');
        Route::post('/data-jamaah-update/{params}', 'DataJamaahController@update')->name('data-jamaah-update');
        Route::delete('/data-jamaah-delete/{params}', 'DataJamaahController@delete')->name('data-jamaah-delete');

        Route::prefix('data-donasi')->group(function () {
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
            Route::get('donasi-camaign-approve/{params}', 'CampaignDonasiController@aprove_donasi_campaign')->name('donasi-campaign-approve');
            Route::delete('donasi-campaign-delete/{params}', 'CampaignDonasiController@delete_donasi_campaign')->name('donasi-campaign-delete');
        });

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

        Route::get('/realisasi-dana', 'RealisasiController@index')->name('realisasi-dana');
        Route::get('/realisasi-dana-get', 'RealisasiController@get')->name('realisasi-dana-get');
        Route::post('/realisasi-dana-add', 'RealisasiController@add')->name('realisasi-dana-add');
        Route::get('/realisasi-dana-show/{params}', 'RealisasiController@show')->name('realisasi-dana-show');
        Route::post('/realisasi-dana-update/{params}', 'RealisasiController@update')->name('realisasi-dana-update');
        Route::delete('/realisasi-dana-delete/{params}', 'RealisasiController@delete')->name('realisasi-dana-delete');

        Route::get('/laporan', 'Laporan@index')->name('laporan');
        Route::get('/laporan-get/{params}', 'Laporan@get')->name('laporan-get');
        Route::get('/laporan-export/{params}', 'Laporan@export_to_excel')->name('laporan-export');

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

        Route::get('/chart', 'Dashboard@areaChart')->name('chart');
    });

    Route::get('/logout', 'Auth@logout')->name('logout');
});
