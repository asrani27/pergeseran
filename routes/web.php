<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\LoginController;
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
use App\Http\Controllers\BidangKegiatanController;
use App\Http\Controllers\SuperadminSkpdController;
use App\Http\Controllers\AdminBatasInputController;
use App\Http\Controllers\AdminPermohonanController;
use App\Http\Controllers\BidangPerubahanController;
use App\Http\Controllers\BidangRealisasiController;
use App\Http\Controllers\BidangLaporanRFKController;
use App\Http\Controllers\BidangPergeseranController;
use App\Http\Controllers\BidangSubkegiatanController;
use App\Http\Controllers\GantiPasswordController;
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
        Route::get('pengajuan', [PengajuanController::class, 'index']);
        Route::get('gantipass', [GantiPasswordController::class, 'admin']);
    });
});

Route::group(['middleware' => ['auth', 'role:bidang']], function () {
    Route::prefix('bidang')->group(function () {

        Route::get('kirim_angkas/{id}', [BidangKirimController::class, 'kirimAngkas']);

        Route::get('beranda', [BidangBerandaController::class, 'index']);
        Route::get('beranda/uraian', [BidangBerandaController::class, 'uraian']);
        Route::get('beranda/sortir', [BidangBerandaController::class, 'sortir']);
        Route::get('beranda/uraian/angkas/{id}', [BidangBerandaController::class, 'angkas']);
        Route::get('beranda/realisasi/{id}', [BidangBerandaController::class, 'realisasi']);
        Route::get('beranda/tahun', [PencarianController::class, 'bTahun']);

        Route::get('detail/subkegiatan/{id}', [BidangSubkegiatanController::class, 'detailSubKegiatan']);

        //-------------------route pergeseran--------------------------//

        Route::get('murni/subkegiatan', [BidangMurniController::class, 'subkegiatan']);
        //-------------------------------------------------------------//
        //-------------------route pergeseran--------------------------//
        Route::get('pergeseran/program', [BidangPergeseranController::class, 'program']);
        Route::get('pergeseran/program/kegiatan/{program_id}', [BidangPergeseranController::class, 'kegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}', [BidangPergeseranController::class, 'subkegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangPergeseranController::class, 'createsubkegiatan']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangPergeseranController::class, 'storesubkegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangPergeseranController::class, 'editsubkegiatan']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangPergeseranController::class, 'updatesubkegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/delete/{sub_id}', [BidangPergeseranController::class, 'deletesubkegiatan']);

        Route::get('pergeseran/kirim_angkas/{id}', [BidangKirimController::class, 'kirimAngkas']);

        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}', [BidangPergeseranController::class, 'uraian']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPergeseranController::class, 'createuraian']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPergeseranController::class, 'storeuraian']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPergeseranController::class, 'edituraian']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPergeseranController::class, 'updateuraian']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/delete/{uraian_id}', [BidangPergeseranController::class, 'deleteuraian']);

        Route::get('pergeseran/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPergeseranController::class, 'createangkas']);
        Route::post('pergeseran/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPergeseranController::class, 'storeangkas']);
        //------------------------------------------------------------//

        //-------------------route perubahan--------------------------//
        Route::get('perubahan/program', [BidangPerubahanController::class, 'program']);
        Route::get('perubahan/program/kegiatan/{program_id}', [BidangPerubahanController::class, 'kegiatan']);
        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}', [BidangPerubahanController::class, 'subKegiatan']);
        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}', [BidangPerubahanController::class, 'uraian']);
        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPerubahanController::class, 'editUraian']);
        Route::post('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPerubahanController::class, 'updateUraian']);
        Route::get('perubahan/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPerubahanController::class, 'editDPA']);
        Route::post('perubahan/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPerubahanController::class, 'updateDPA']);

        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPerubahanController::class, 'addUraian']);
        Route::post('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPerubahanController::class, 'storeUraian']);
        //------------------------------------------------------------//

        Route::get('program', [BidangProgramController::class, 'index']);
        Route::get('program/add', [BidangProgramController::class, 'create']);
        Route::post('program/add', [BidangProgramController::class, 'store']);
        Route::get('program/edit/{id}', [BidangProgramController::class, 'edit']);
        Route::post('program/edit/{id}', [BidangProgramController::class, 'update']);
        Route::get('program/delete/{id}', [BidangProgramController::class, 'delete']);

        Route::get('realisasi', [BidangRealisasiController::class, 'index']);
        Route::post('realisasi', [BidangRealisasiController::class, 'store']);
        Route::post('realisasifisik', [BidangRealisasiController::class, 'storeFisik']);
        Route::get('realisasi/{tahun}', [BidangRealisasiController::class, 'tahun']);
        Route::get('realisasi/{tahun}/{program_id}', [BidangRealisasiController::class, 'program']);
        Route::get('realisasi/{tahun}/{program_id}/{kegiatan_id}', [BidangRealisasiController::class, 'kegiatan']);
        Route::get('realisasi/{tahun}/{program_id}/{kegiatan_id}/{subkegiatan_id}', [BidangRealisasiController::class, 'subkegiatan']);

        Route::get('laporanrfk', [BidangLaporanRFKController::class, 'index']);
        Route::get('laporanrfk/kirimdata/{bulan}/{subkegiatan_id}', [BidangLaporanRFKController::class, 'kirimData']);
        Route::get('laporanrfk/{tahun}', [BidangLaporanRFKController::class, 'tahun']);
        Route::get('laporanrfk/{tahun}/{bulan}', [BidangLaporanRFKController::class, 'bulan']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}', [BidangLaporanRFKController::class, 'program']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}', [BidangLaporanRFKController::class, 'kegiatan']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}', [BidangLaporanRFKController::class, 'subkegiatan']);

        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/srp', [BidangLaporanRFKController::class, 'srp']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/rfk', [BidangLaporanRFKController::class, 'rfk']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/pbj', [BidangLaporanRFKController::class, 'pbj']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/st', [BidangLaporanRFKController::class, 'st']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/m', [BidangLaporanRFKController::class, 'm']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/v', [BidangLaporanRFKController::class, 'v']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/fiskeu', [BidangLaporanRFKController::class, 'fiskeu']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/input', [BidangLaporanRFKController::class, 'input']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/export', [BidangLaporanRFKController::class, 'excel']);

        Route::post('laporanrfk/rfk_input', [BidangLaporanRFKController::class, 'storeInput']);
        //Route::post('laporanrfk/rfk_st', [BidangLaporanRFKController::class, 'storeSt']);
        Route::get('laporanrfk-rfk_st/delete/{id}', [BidangLaporanRFKController::class, 'deleteSt']);
        Route::get('laporanrfk-rfk_st/edit/{id}', [BidangLaporanRFKController::class, 'editSt']);
        Route::post('laporanrfk-rfk_st/edit/{id}', [BidangLaporanRFKController::class, 'updateSt']);
        Route::get('laporanrfk-rfk_st/tambah-st/{id}/{bulan}', [BidangLaporanRFKController::class, 'tambahSt']);
        Route::post('laporanrfk-rfk_st/tambah-st/{id}/{bulan}', [BidangLaporanRFKController::class, 'storeSt']);

        Route::get('laporanrfk-rfk_m/delete/{id}', [BidangLaporanRFKController::class, 'deleteM']);
        Route::get('laporanrfk-rfk_m/edit/{id}', [BidangLaporanRFKController::class, 'editM']);
        Route::post('laporanrfk-rfk_m/edit/{id}', [BidangLaporanRFKController::class, 'updateM']);
        Route::get('laporanrfk-rfk_m/tambah-m/{id}/{bulan}', [BidangLaporanRFKController::class, 'tambahM']);
        Route::post('laporanrfk-rfk_m/tambah-m/{id}/{bulan}', [BidangLaporanRFKController::class, 'storeM']);

        Route::get('laporanrfk-rfk_pbj/tambah-pbj/{id}/{bulan}', [BidangLaporanRFKController::class, 'tambahPbj']);
        Route::post('laporanrfk-rfk_pbj/tambah-pbj/{id}/{bulan}', [BidangLaporanRFKController::class, 'storePbj']);
        Route::get('laporanrfk-rfk_pbj/delete/{id}', [BidangLaporanRFKController::class, 'deletePbj']);
        Route::get('laporanrfk-rfk_pbj/edit/{id}', [BidangLaporanRFKController::class, 'editPbj']);
        Route::post('laporanrfk-rfk_pbj/edit/{id}', [BidangLaporanRFKController::class, 'updatePbj']);

        Route::get('laporanrfk-rfk_v/delete/{id}', [BidangLaporanRFKController::class, 'deleteV']);
        Route::post('laporanrfk-rfk_v/tambah-v/{id}/{bulan}', [BidangLaporanRFKController::class, 'storeV']);

        Route::get('program/kegiatan/{id}', [BidangKegiatanController::class, 'index']);
        Route::get('program/kegiatan/{id}/add', [BidangKegiatanController::class, 'create']);
        Route::post('program/kegiatan/{id}/add', [BidangKegiatanController::class, 'store']);
        Route::get('program/kegiatan/{program_id}/edit/{kegiatan_id}', [BidangKegiatanController::class, 'edit']);
        Route::post('program/kegiatan/{program_id}/edit/{kegiatan_id}', [BidangKegiatanController::class, 'update']);
        Route::get('program/kegiatan/{program_id}/delete/{kegiatan_id}', [BidangKegiatanController::class, 'delete']);

        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}', [BidangSubkegiatanController::class, 'index']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangSubkegiatanController::class, 'create']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangSubkegiatanController::class, 'store']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangSubkegiatanController::class, 'edit']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangSubkegiatanController::class, 'update']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/delete/{sub_id}', [BidangSubkegiatanController::class, 'delete']);

        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}', [BidangUraianController::class, 'index']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangUraianController::class, 'create']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangUraianController::class, 'store']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangUraianController::class, 'edit']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangUraianController::class, 'update']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/delete/{uraian_id}', [BidangUraianController::class, 'delete']);

        Route::get('program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangAngkasController::class, 'create']);
        Route::post('program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangAngkasController::class, 'store']);

        Route::get('skpd/bidang/pptk', [PPTKController::class, 'index']);
        Route::get('skpd/bidang/pptk/add', [PPTKController::class, 'create']);
        Route::post('skpd/bidang/pptk/add', [PPTKController::class, 'store']);
        Route::get('skpd/bidang/pptk/edit/{id}', [PPTKController::class, 'edit']);
        Route::post('skpd/bidang/pptk/edit/{id}', [PPTKController::class, 'update']);
        Route::get('skpd/bidang/pptk/delete/{id}', [PPTKController::class, 'delete']);
        Route::get('skpd/bidang/pptk/createuser/{id}', [PPTKController::class, 'createuser']);
        Route::post('skpd/bidang/pptk/createuser/{id}', [PPTKController::class, 'storeuser']);
        Route::get('skpd/bidang/pptk/resetpass/{id}', [PPTKController::class, 'resetpass']);

        Route::get('kirimdata', [BidangKirimController::class, 'index']);

        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}', [ExcelController::class, 'index']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}', [ExcelController::class, 'bulan']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/suratpengantar', [ExcelController::class, 'sp']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/rfk', [ExcelController::class, 'rfk']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/v', [ExcelController::class, 'v']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/fiskeu', [ExcelController::class, 'fiskeu']);

        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/kppbj', [ExcelController::class, 'kppbj']);
        // Route::post('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/kppbj', [ExcelController::class, 'storeKppbj']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/kppbj/delete/{m_id}', [ExcelController::class, 'deleteKppbj']);

        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/m', [ExcelController::class, 'm']);
        // Route::post('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/m', [ExcelController::class, 'storeM']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/m/delete/{m_id}', [ExcelController::class, 'deleteM']);

        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/pbj', [ExcelController::class, 'pbj']);
        // Route::post('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/pbj', [ExcelController::class, 'storePbj']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/pbj/delete/{pbj_id}', [ExcelController::class, 'deletePbj']);

        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/st', [ExcelController::class, 'st']);
        // Route::post('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/st', [ExcelController::class, 'storeSt']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/st/delete/{st_id}', [ExcelController::class, 'deleteSt']);


        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/input', [ExcelController::class, 'input']);
        // Route::post('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/input', [ExcelController::class, 'storeInput']);
        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/input/delete/{input_id}', [ExcelController::class, 'deleteInput']);
        // Route::post('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/updatepptk', [ExcelController::class, 'updatepptk']);


        // Route::get('skpd/bidang/program/kegiatan/{program_id}/sub/{kegiatan_id}/excel/{subkegiatan_id}/{bulan}/input/exportexcel/{t_pptk_id}', [ExportController::class, 'exportInput']);

        Route::get('murni/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [MurniController::class, 'create']);
        Route::post('murni/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [MurniController::class, 'store']);

        Route::get('pergeseran/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [PergeseranController::class, 'create']);
        Route::post('pergeseran/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [PergeseranController::class, 'store']);

        Route::get('realisasi/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [RealisasiController::class, 'create']);
        Route::post('realisasi/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [RealisasiController::class, 'store']);

        Route::get('excel/sp/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'suratpengantar']);
        Route::get('excel/rfk/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'rfk']);
        Route::get('excel/fiskeu/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'fiskeu']);
        Route::get('excel/input/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'input']);

        Route::get('skpd/bidang/riwayat/kegiatan', [RiwayatKegiatanController::class, 'index']);
        Route::get('skpd/bidang/riwayat/kegiatan/search', [RiwayatKegiatanController::class, 'tampilkan']);
    });
});

Route::group(['middleware' => ['auth', 'role:bidang|pptk']], function () {
    Route::get('pptk/beranda', [BerandaController::class, 'pptk']);

    Route::get('pptk/murni', [PPTKMurniController::class, 'subkegiatan']);
    Route::get('pptk/murni/subkegiatan/add', [PPTKMurniController::class, 'addsubkegiatan']);
    Route::post('pptk/murni/subkegiatan/add', [PPTKMurniController::class, 'storesubkegiatan']);

    // Route::get('skpd/bidang/program', [ProgramController::class, 'index']);
    // Route::get('skpd/bidang/program/add', [ProgramController::class, 'create']);
    // Route::post('skpd/bidang/program/add', [ProgramController::class, 'store']);
    // Route::get('skpd/bidang/program/edit/{id}', [ProgramController::class, 'edit']);
    // Route::post('skpd/bidang/program/edit/{id}', [ProgramController::class, 'update']);
    // Route::get('skpd/bidang/program/delete/{id}', [ProgramController::class, 'delete']);
});

Route::group(['middleware' => ['auth', 'role:superadmin|admin|bidang|pptk']], function () {
    Route::get('/logout', [LogoutController::class, 'logout']);

    Route::get('gantipass', [GantiPassController::class, 'index']);
    Route::post('gantipass', [GantiPassController::class, 'update']);
});
