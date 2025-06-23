<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSHController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\KadisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\BpkpadController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminKrkController;
use App\Http\Controllers\AdminPptkController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PPTKMurniController;
use App\Http\Controllers\ImportDataController;
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
use App\Http\Controllers\KunciRekeningController;
use App\Http\Controllers\BidangKegiatanController;
use App\Http\Controllers\SuperadminSkpdController;
use App\Http\Controllers\AdminBatasInputController;
use App\Http\Controllers\AdminPermohonanController;
use App\Http\Controllers\BidangPerubahanController;
use App\Http\Controllers\BidangRealisasiController;
use App\Http\Controllers\BidangLaporanRFKController;
use App\Http\Controllers\BidangPergeseranController;
use App\Http\Controllers\BidangSubkegiatanController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SuperadminBerandaController;
use App\Http\Controllers\SuperadminJenisrfkController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('kegiatan/{id}', [SuperadminBerandaController::class, 'kegiatanJson']);
Route::get('subkegiatan/{id}', [SuperadminBerandaController::class, 'subkegiatanJson']);
Route::get('rekeningawal/{id}', [SuperadminBerandaController::class, 'rekeningawalJson']);
Route::get('timer', [TimerController::class, 'timer']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::prefix('superadmin')->group(function () {

        Route::get('importdata', [ImportDataController::class, 'index']);
        Route::post('importdata/satuan', [ImportDataController::class, 'satuan']);
        Route::post('importdata/subkegiatan', [ImportDataController::class, 'subkegiatan']);
        Route::post('importdata/kegiatan', [ImportDataController::class, 'kegiatan']);
        Route::post('importdata/program', [ImportDataController::class, 'program']);
        Route::get('beranda', [SuperadminBerandaController::class, 'index']);
        Route::get('kunci_rekening', [KunciRekeningController::class, 'index']);
        Route::get('kunci_rekening/add', [KunciRekeningController::class, 'add']);
        Route::post('kunci_rekening/add', [KunciRekeningController::class, 'store']);
        Route::get('kunci_rekening/edit/{id}', [KunciRekeningController::class, 'edit']);
        Route::post('kunci_rekening/edit/{id}', [KunciRekeningController::class, 'update']);
        Route::get('kunci_rekening/delete/{id}', [KunciRekeningController::class, 'delete']);
        Route::get('ssh', [SSHController::class, 'index']);
        Route::get('satuan', [SatuanController::class, 'index']);
        Route::get('satuan/search', [SatuanController::class, 'search']);
        Route::get('ssh/upload', [SSHController::class, 'upload']);
        Route::post('ssh/upload', [SSHController::class, 'storeUpload']);
        Route::get('ssh/search', [SSHController::class, 'search']);
        Route::post('updatetimer', [SuperadminBerandaController::class, 'updateTimer']);
        Route::post('updaterunningtext', [SuperadminBerandaController::class, 'updateRunningText']);
        Route::get('tarikssh', [SuperadminBerandaController::class, 'tarikSSH']);
        Route::get('skpd', [SuperadminSkpdController::class, 'index']);
        Route::get('skpd/upload', [SuperadminSkpdController::class, 'upload']);
        Route::post('skpd/upload', [SuperadminSkpdController::class, 'storeUpload']);
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
        Route::get('beranda/detail/{id}/update', [AdminBerandaController::class, 'update']);
        Route::get('beranda/rekawal/{id}', [AdminBerandaController::class, 'deleteRekawal']);
        Route::get('beranda/menjadi/{id}', [AdminBerandaController::class, 'deleteMenjadi']);
        Route::post('beranda/detail/{id}/sebelum', [AdminBerandaController::class, 'storeSebelum']);
        Route::post('beranda/detail/{id}/sesudah', [AdminBerandaController::class, 'storeSesudah']);
        Route::get('pengajuan', [PengajuanController::class, 'index']);
        Route::post('pengajuan/create', [PengajuanController::class, 'store']);
        Route::get('gantipass', [GantiPasswordController::class, 'admin']);

        Route::get('surat', [SuratController::class, 'index']);
        Route::get('surat/add', [SuratController::class, 'add']);
        Route::post('surat/add', [SuratController::class, 'store']);
        Route::get('surat/edit/{id}', [SuratController::class, 'edit']);
        Route::post('surat/edit/{id}', [SuratController::class, 'update']);
        Route::get('surat/delete/{id}', [SuratController::class, 'delete']);
        Route::get('surat1/print/{id}', [SuratController::class, 'surat1']);
        Route::get('surat2/print/{id}', [SuratController::class, 'surat2']);
        Route::get('surat3/print/{id}', [SuratController::class, 'surat3']);
    });
});

Route::group(['middleware' => ['auth', 'role:kadis']], function () {
    Route::prefix('pimpinan')->group(function () {
        Route::get('beranda', [KadisController::class, 'index']);
        Route::get('pengajuan/{id}', [KadisController::class, 'pengajuan']);
        Route::get('pengajuan/{id}/detail', [KadisController::class, 'detail']);
        Route::get('pengajuan/{id}/terima', [KadisController::class, 'terima']);
        Route::get('pengajuan/{id}/tolak', [KadisController::class, 'tolak']);
        Route::post('pengajuan/terima', [KadisController::class, 'simpanTerima']);
        Route::post('pengajuan/tolak', [KadisController::class, 'simpanTolak']);
    });
});

Route::group(['middleware' => ['auth', 'role:bpkpad']], function () {
    Route::prefix('bpkpad')->group(function () {
        Route::get('beranda', [BpkpadController::class, 'index']);
        Route::get('beranda/filter', [BpkpadController::class, 'search']);
        Route::get('pengajuan/{id}', [BpkpadController::class, 'pengajuan']);
        Route::get('pengajuan/{id}/detail', [BpkpadController::class, 'detail']);
        Route::get('pengajuan/{id}/terima', [BpkpadController::class, 'terima']);
        Route::get('pengajuan/{id}/tolak', [BpkpadController::class, 'tolak']);
        Route::post('pengajuan/terima', [BpkpadController::class, 'simpanTerima']);
        Route::post('pengajuan/tolak', [BpkpadController::class, 'simpanTolak']);
    });
});

Route::group(['middleware' => ['auth', 'role:superadmin|admin|kadis|bpkpad']], function () {
    Route::get('/logout', [LogoutController::class, 'logout']);

    Route::get('gantipass', [GantiPasswordController::class, 'index']);
    Route::post('gantipass', [GantiPasswordController::class, 'update']);
});
