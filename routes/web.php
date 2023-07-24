<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\KadisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BpkpadController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminKrkController;
use App\Http\Controllers\AdminPptkController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PPTKMurniController;
use App\Http\Controllers\AdminBidangController;
use App\Http\Controllers\BidangKirimController;
use App\Http\Controllers\BidangMurniController;
use App\Http\Controllers\TpermohonanController;
use App\Http\Controllers\AdminBerandaController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminPeriodeController;
use App\Http\Controllers\AdminProgramController;
use App\Http\Controllers\BidangAngkasController;
use App\Http\Controllers\BidangUraianController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\AdminKegiatanController;
use App\Http\Controllers\AdminValidasiController;
use App\Http\Controllers\BidangBerandaController;
use App\Http\Controllers\BidangProgramController;
use App\Http\Controllers\DaftarLayananController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\BidangKegiatanController;
use App\Http\Controllers\SuperadminSkpdController;
use App\Http\Controllers\AdminBatasInputController;
use App\Http\Controllers\AdminPermohonanController;
use App\Http\Controllers\BidangPerubahanController;
use App\Http\Controllers\BidangRealisasiController;
use App\Http\Controllers\BidangLaporanRFKController;
use App\Http\Controllers\BidangPergeseranController;
use App\Http\Controllers\BidangSubkegiatanController;
use App\Http\Controllers\SuperadminBerandaController;
use App\Http\Controllers\SuperadminJenisrfkController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::prefix('superadmin')->group(function () {
        Route::get('beranda', [SuperadminBerandaController::class, 'index']);
        Route::get('skpd', [SuperadminSkpdController::class, 'index']);
        Route::get('skpd/createakun/{id}', [SuperadminSkpdController::class, 'createakun']);
        Route::get('skpd/resetakun/{id}', [SuperadminSkpdController::class, 'resetakun']);
        Route::get('skpd/kepala/createakun/{id}', [SuperadminSkpdController::class, 'createakunkepala']);
        Route::get('skpd/kepala/resetakun/{id}', [SuperadminSkpdController::class, 'resetakunkepala']);
    });
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('beranda', [AdminBerandaController::class, 'index']);
        Route::get('beranda/detail/{id}', [AdminBerandaController::class, 'detail']);
        Route::get('pengajuan', [PengajuanController::class, 'index']);
        Route::post('pengajuan/create', [PengajuanController::class, 'store']);
        Route::get('gantipass', [GantiPasswordController::class, 'admin']);
    });
});

Route::group(['middleware' => ['auth', 'role:kadis']], function () {
    Route::prefix('pimpinan')->group(function () {
        Route::get('beranda', [KadisController::class, 'index']);
        Route::get('pengajuan/{id}', [KadisController::class, 'pengajuan']);
        Route::get('pengajuan/{id}/terima', [KadisController::class, 'terima']);
        Route::get('pengajuan/{id}/tolak', [KadisController::class, 'tolak']);
    });
});

Route::group(['middleware' => ['auth', 'role:bpkpad']], function () {
    Route::prefix('bpkpad')->group(function () {
        Route::get('beranda', [BpkpadController::class, 'index']);
        Route::get('pengajuan/{id}', [BpkpadController::class, 'pengajuan']);
    });
});

Route::group(['middleware' => ['auth', 'role:superadmin|admin|kadis|bpkpad']], function () {
    Route::get('/logout', [LogoutController::class, 'logout']);

    Route::get('gantipass', [GantiPasswordController::class, 'index']);
    Route::post('gantipass', [GantiPasswordController::class, 'update']);
});
