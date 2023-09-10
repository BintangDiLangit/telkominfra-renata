<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriLowonganController;
use App\Http\Controllers\Admin\LamaranController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\ElearningController;
use App\Http\Controllers\Admin\KategoriElearningController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\User\DataDiriController;
use App\Http\Controllers\User\DokumenController;
use App\Http\Controllers\User\KeluargaController;
use App\Http\Controllers\User\KontakDaruratController;
use App\Http\Controllers\User\PendidikanController;
use App\Http\Controllers\User\RiwayatPekerjaanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/search-lowongan', [MainController::class, 'searchLowongan'])->name('search.lowongan');
Route::get('/get-lowongan/{id}', [MainController::class, 'getLowonganDetail'])->name('get.lowongan.detail');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/check-user-data', [MainController::class, 'checkData']);
    Route::post('/lamaran-user', [MainController::class, 'lamaranStore'])->name('user.lamaran.store');
    Route::get('/lowongan-favorit-status/{lowongan_id}', [MainController::class, 'lowonganFavoritStatus'])->name('user.lowongan.favorit.status');

    Route::get('/lamaran-saya', [MainController::class, 'lamaranSaya'])->name('lamaran.saya');
    Route::get('/elearning', [MainController::class, 'elearning'])->name('elearning');
    Route::get('/lamaran-saya', [MainController::class, 'lamaranSaya'])->name('lamaran.saya');
    Route::get('/lowongan-favorit', [MainController::class, 'lamaranFavorit'])->name('lamaran.favorit');
    Route::group(['prefix' => 'pengaturan', 'as' => 'pengaturan.',], function () {
        Route::get('/data-diri', [DataDiriController::class, 'dataDiri'])->name('data.diri');
        Route::post('/data-diri', [DataDiriController::class, 'dataDiriUpdate'])->name('data.diri.update');

        Route::get('/keluarga', [KeluargaController::class, 'keluarga'])->name('keluarga');
        Route::post('/keluarga', [KeluargaController::class, 'keluargaStore'])->name('keluarga.store');
        Route::post('/keluarga/{id}', [KeluargaController::class, 'keluargaUpdate'])->name('keluarga.update');
        Route::delete('/keluarga/{id}', [KeluargaController::class, 'keluargaDelete'])->name('keluarga.delete');

        Route::get('/kontak-darurat', [KontakDaruratController::class, 'kontakDarurat'])->name('kontak.darurat');
        Route::post('/kontak-darurat', [KontakDaruratController::class, 'kontakDaruratStore'])->name('kontak.darurat.store');
        Route::post('/kontak-darurat/{id}', [KontakDaruratController::class, 'kontakDaruratUpdate'])->name('kontak.darurat.update');
        Route::delete('/kontak-darurat/{id}', [KontakDaruratController::class, 'kontakDaruratDelete'])->name('kontak.darurat.delete');

        Route::get('/pendidikan', [PendidikanController::class, 'pendidikan'])->name('pendidikan');
        Route::post('/pendidikan', [PendidikanController::class, 'pendidikanStore'])->name('pendidikan.store');
        Route::post('/pendidikan/{id}', [PendidikanController::class, 'pendidikanUpdate'])->name('pendidikan.update');
        Route::delete('/pendidikan/{id}', [PendidikanController::class, 'pendidikanDelete'])->name('pendidikan.delete');

        Route::get('/riwayat-pekerjaan', [RiwayatPekerjaanController::class, 'riwayatPekerjaan'])->name('riwayat.pekerjaan');
        Route::post('/riwayat-pekerjaan', [RiwayatPekerjaanController::class, 'riwayatPekerjaanStore'])->name('riwayat.pekerjaan.store');
        Route::post('/riwayat-pekerjaan/{id}', [RiwayatPekerjaanController::class, 'riwayatPekerjaanUpdate'])->name('riwayat.pekerjaan.update');
        Route::delete('/riwayat-pekerjaan/{id}', [RiwayatPekerjaanController::class, 'riwayatPekerjaanDelete'])->name('riwayat.pekerjaan.delete');

        Route::get('/dokumen', [DokumenController::class, 'dokumen'])->name('dokumen');
        Route::post('/dokumen', [DokumenController::class, 'dokumenStore'])->name('dokumen.store');
        Route::post('/dokumen/{id}', [DokumenController::class, 'dokumenUpdate'])->name('dokumen.update');
        Route::delete('/dokumen/{id}', [DokumenController::class, 'dokumenDelete'])->name('dokumen.delete');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::post('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::post('/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'company', 'as' => 'company.'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::post('/', [CompanyController::class, 'store'])->name('store');
        Route::post('/{id}', [CompanyController::class, 'update'])->name('update');
        Route::delete('/{id}', [CompanyController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'kategori_lowongan', 'as' => 'kategori_lowongan.'], function () {
        Route::get('/', [KategoriLowonganController::class, 'index'])->name('index');
        Route::post('/', [KategoriLowonganController::class, 'store'])->name('store');
        Route::post('/{id}', [KategoriLowonganController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriLowonganController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'lowongan', 'as' => 'lowongan.'], function () {
        Route::get('/', [LowonganController::class, 'index'])->name('index');
        Route::post('/', [LowonganController::class, 'store'])->name('store');
        Route::post('/{id}', [LowonganController::class, 'update'])->name('update');
        Route::delete('/{id}', [LowonganController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'lamaran', 'as' => 'lamaran.'], function () {
        Route::get('/search-lowongan', [LamaranController::class, 'searchLowongan'])->name('search.lowongan');
        Route::get('/milestone-lamaran/{lowongan_id}', [LamaranController::class, 'milestoneLamaran'])->name('milestone.lamaran');
        Route::get('/milestone-lamaran/{lowongan_id}/detail/{milestone_id}', [LamaranController::class, 'milestoneLamaranDetail'])->name('milestone.lamaran.detail');
        Route::get('/detail_lamaran/{lamaran_id}', [LamaranController::class, 'milestoneLamaranDetailPelamar'])->name('milestone.lamaran.detail.pelamar');

        Route::post('/approve/{lamaran_id}', [LamaranController::class, 'approve'])->name('approve');
        Route::post('/reject/{lamaran_id}', [LamaranController::class, 'reject'])->name('reject');

        Route::get('/', [LamaranController::class, 'index'])->name('index');
        Route::post('/', [LamaranController::class, 'store'])->name('store');
        Route::post('/{id}', [LamaranController::class, 'update'])->name('update');
        Route::delete('/{id}', [LamaranController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'kategori_elearning', 'as' => 'kategori_elearning.'], function () {
        Route::get('/', [KategoriElearningController::class, 'index'])->name('index');
        Route::post('/', [KategoriElearningController::class, 'store'])->name('store');
        Route::post('/{id}', [KategoriElearningController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriElearningController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'elearning', 'as' => 'elearning.'], function () {
        Route::get('/', [ElearningController::class, 'index'])->name('index');
        Route::post('/', [ElearningController::class, 'store'])->name('store');
        Route::post('/{id}', [ElearningController::class, 'update'])->name('update');
        Route::delete('/{id}', [ElearningController::class, 'destroy'])->name('destroy');
    });

    Route::post('logout', [AuthController::class, 'logoutOl'])->name('logout-ol');
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginOl'])->name('login-ol');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerOl'])->name('register-ol');