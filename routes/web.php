<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\KepalaBadanController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\BidangAnggaranController;
use App\Http\Controllers\BidangPerbendaharaanController;
use App\Http\Controllers\BidangAkuntansiController;
use App\Http\Controllers\BidangAsetController;
use App\Http\Controllers\SubbagPerencanaanController;
use App\Http\Controllers\SubbagKeuanganController;
use App\Http\Controllers\SubbagUmumController;
use App\Http\Controllers\SubbidAnggaranPendapatanController;
use App\Http\Controllers\SubbidAnggaranBelanjaController;
use App\Http\Controllers\SubbidPengelolaanController;
use App\Http\Controllers\SubbidAdministrasiController;
use App\Http\Controllers\SubbidPembukuanController;
use App\Http\Controllers\SubbidVerifikasiController;
use App\Http\Controllers\SubbidPerencanaanController;
use App\Http\Controllers\SubbidPenggunaanController;
use App\Http\Controllers\AdminSekretarisController;
use App\Http\Controllers\AdminAnggaranController;
use App\Http\Controllers\AdminPerbendaharaanController;
use App\Http\Controllers\AdminAkuntansiController;
use App\Http\Controllers\AdminAsetController;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Hak Akses Super Admin
Route::middleware(['auth', 'superAdmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboardSuperAdmin');

    // User
    Route::get('/superadmin/user', [SuperAdminController::class, 'indexUser'])->name('userSuperAdmin');
    Route::get('/superadmin/user/status/{id}', [SuperAdminController::class, 'status'])->name('statusUser');
    Route::get('/superadmin/user/create', [SuperAdminController::class, 'createUser'])->name('createUserSuperAdmin');
    Route::post('/superadmin/user/store', [SuperAdminController::class, 'storeUser'])->name('storeUserSuperAdmin');
    Route::get('/superadmin/user/{id}/edit', [SuperAdminController::class, 'editUser'])->name('editUserSuperAdmin');
    Route::put('/superadmin/user/{id}', [SuperAdminController::class, 'updateUser'])->name('updateUserSuperAdmin');

    // Agenda
    Route::get('/superadmin/agenda', [SuperAdminController::class, 'indexAgenda'])->name('agendaSuperAdmin');
    Route::get('/superadmin/agenda/create', [SuperAdminController::class, 'createAgenda'])->name('createAgendaSuperAdmin');
    Route::post('/superadmin/agenda/store', [SuperAdminController::class, 'storeAgenda'])->name('storeAgendaSuperAdmin');
    Route::get('/superadmin/agenda/{id}/edit', [SuperAdminController::class, 'editAgenda'])->name('editAgendaSuperAdmin');
    Route::put('/superadmin/agenda/{id}', [SuperAdminController::class, 'updateAgenda'])->name('updateAgendaSuperAdmin');
    Route::delete('/superadmin/agenda/{id}', [SuperAdminController::class, 'destroyAgenda'])->name('deleteAgendaSuperAdmin');

    // Arsip
    Route::get('/superadmin/arsip', [SuperAdminController::class, 'indexArsip'])->name('arsipSuperAdmin');
    Route::get('/superadmin/arsip/create', [SuperAdminController::class, 'createArsip'])->name('createArsipSuperAdmin');
    Route::post('/superadmin/arsip/store', [SuperAdminController::class, 'storeArsip'])->name('storeArsipSuperAdmin');
    Route::get('/superadmin/arsip/{id}/edit', [SuperAdminController::class, 'editArsip'])->name('editArsipSuperAdmin');
    Route::put('/superadmin/arsip/{id}', [SuperAdminController::class, 'updateArsip'])->name('updateArsipSuperAdmin');
    
    // Dokumentasi
    Route::get('/superadmin/dokumentasi', [SuperAdminController::class, 'indexDokumentasi'])->name('dokumentasiSuperAdmin');
    Route::get('/superadmin/dokumentasi/create', [SuperAdminController::class, 'createDokumentasi'])->name('createDokumentasiSuperAdmin');
    Route::post('/superadmin/dokumentasi/store', [SuperAdminController::class, 'storeDokumentasi'])->name('storeDokumentasiSuperAdmin');
    Route::get('superadmin/dokumentasi/{id}', [SuperAdminController::class, 'showDokumentasi'])->name('showDokumentasiSuperAdmin');
    Route::get('/superadmin/dokumentasi/{id}/edit', [SuperAdminController::class, 'editDokumentasi'])->name('editDokumentasiSuperAdmin');
    Route::put('/superadmin/dokumentasi/{id}', [SuperAdminController::class, 'updateDokumentasi'])->name('updateDokumentasiSuperAdmin');
    Route::delete('/superadmin/dokumentasi/{id}', [SuperAdminController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSuperAdmin');

    // Berkas
    Route::get('/superadmin/peraturan', [SuperAdminController::class, 'peraturanIndex'])->name('peraturanSuperAdmin');
    Route::get('/superadmin/apbd', [SuperAdminController::class, 'apbdIndex'])->name('apbdSuperAdmin');
    Route::get('/superadmin/keuangan', [SuperAdminController::class, 'keuanganIndex'])->name('keuanganSuperAdmin');
    Route::get('/superadmin/slide', [SuperAdminController::class, 'slideIndex'])->name('slideSuperAdmin');
    Route::get('/superadmin/lainnya', [SuperAdminController::class, 'lainnyaIndex'])->name('lainnyaSuperAdmin');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Kepala Badan
Route::middleware(['auth', 'kepalaBadan'])->group(function () {
    Route::get('/kepalabadan/dashboard', [KepalaBadanController::class, 'dashboard'])->name('dashboardKepalaBadan');

    // Agenda
    Route::get('/kepalabadan/agenda', [KepalaBadanController::class, 'indexAgenda'])->name('agendaKepalaBadan');
    Route::get('/kepalabadan/agenda/{id}/disposisi', [KepalaBadanController::class, 'disposisiAgenda'])->name('disposisiAgendaKepalaBadan');
    Route::put('/kepalabadan/agenda/{id}', [KepalaBadanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaKepalaBadan');

    // User
    Route::get('/kepalabadan/user', [KepalaBadanController::class, 'indexUser'])->name('userKepalaBadan');
    Route::get('/kepalabadan/user/status/{id}', [KepalaBadanController::class, 'status'])->name('statusUserKepalaBadan');

    // Disposisi
    Route::get('/kepalabadan/disposisi', [KepalaBadanController::class, 'indexDisposisi'])->name('disposisiKepalaBadan');

    // Laporan
    Route::get('kepalabadan/laporan', [KepalaBadanController::class, 'indexLaporan'])->name('laporanKepalaBadan');
    Route::get('kepalabadan/laporan/{id}', [KepalaBadanController::class, 'showLaporan'])->name('showLaporanKepalaBadan');

    // Arsip
    Route::get('/kepalabadan/arsip', [KepalaBadanController::class, 'indexArsip'])->name('arsipKepalaBadan');
    Route::get('/kepalabadan/arsip/create', [KepalaBadanController::class, 'createArsip'])->name('createArsipKepalaBadan');
    Route::post('/kepalabadan/arsip/store', [KepalaBadanController::class, 'storeArsip'])->name('storeArsipKepalaBadan');
    Route::get('/kepalabadan/arsip/{id}/edit', [KepalaBadanController::class, 'editArsip'])->name('editArsipKepalaBadan');
    Route::put('/kepalabadan/arsip/{id}', [KepalaBadanController::class, 'updateArsip'])->name('updateArsipKepalaBadan');

    // Berkas
    Route::get('/kepalabadan/peraturan', [KepalaBadanController::class, 'peraturanIndex'])->name('peraturanKepalaBadan');
    Route::get('/kepalabadan/apbd', [KepalaBadanController::class, 'apbdIndex'])->name('apbdKepalaBadan');
    Route::get('/kepalabadan/keuangan', [KepalaBadanController::class, 'keuanganIndex'])->name('keuanganKepalaBadan');
    Route::get('/kepalabadan/slide', [KepalaBadanController::class, 'slideIndex'])->name('slideKepalaBadan');
    Route::get('/kepalabadan/lainnya', [KepalaBadanController::class, 'lainnyaIndex'])->name('lainnyaKepalaBadan');

    // Dokumentasi
    Route::get('/kepalabadan/dokumentasi', [KepalaBadanController::class, 'indexDokumentasi'])->name('dokumentasiKepalaBadan');
    Route::get('/kepalabadan/dokumentasi/create', [KepalaBadanController::class, 'createDokumentasi'])->name('createDokumentasiKepalaBadan');
    Route::post('/kepalabadan/dokumentasi/store', [KepalaBadanController::class, 'storeDokumentasi'])->name('storeDokumentasiKepalaBadan');
    Route::get('kepalabadan/dokumentasi/{id}', [KepalaBadanController::class, 'showDokumentasi'])->name('showDokumentasiKepalaBadan');
    Route::get('/kepalabadan/dokumentasi/{id}/edit', [KepalaBadanController::class, 'editDokumentasi'])->name('editDokumentasiKepalaBadan');
    Route::put('/kepalabadan/dokumentasi/{id}', [KepalaBadanController::class, 'updateDokumentasi'])->name('updateDokumentasiKepalaBadan');
    Route::delete('/kepalabadan/dokumentasi/{id}', [KepalaBadanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiKepalaBadan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Sekretaris
Route::middleware(['auth', 'sekretaris'])->group(function () {
    Route::get('/sekretaris/dashboard', [SekretarisController::class, 'dashboard'])->name('dashboardSekretaris');

    // Agenda
    Route::get('/sekretaris/agenda', [SekretarisController::class, 'indexAgenda'])->name('agendaSekretaris');
    Route::get('/sekretaris/agenda/{id}/disposisi', [SekretarisController::class, 'disposisiAgenda'])->name('disposisiAgendaSekretaris');
    Route::put('/sekretaris/agenda/{id}', [SekretarisController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSekretaris');

    // Laporan
    Route::get('/sekretaris/laporan/{id}/upload', [SekretarisController::class, 'uploadLaporan'])->name('uploadLaporanSekretaris');
    Route::put('/sekretaris/laporan/{id}', [SekretarisController::class, 'storeLaporan'])->name('storeLaporanSekretaris');

    // Disposisi
    Route::get('/sekretaris/disposisi', [SekretarisController::class, 'indexDisposisi'])->name('disposisiSekretaris');

    // Arsip
    Route::get('/sekretaris/arsip', [SekretarisController::class, 'indexArsip'])->name('arsipSekretaris');
    Route::get('/sekretaris/arsip/create', [SekretarisController::class, 'createArsip'])->name('createArsipSekretaris');
    Route::post('/sekretaris/arsip/store', [SekretarisController::class, 'storeArsip'])->name('storeArsipSekretaris');
    Route::get('/sekretaris/arsip/{id}/edit', [SekretarisController::class, 'editArsip'])->name('editArsipSekretaris');
    Route::put('/sekretaris/arsip/{id}', [SekretarisController::class, 'updateArsip'])->name('updateArsipSekretaris');

    // Berkas
    Route::get('/sekretaris/peraturan', [SekretarisController::class, 'peraturanIndex'])->name('peraturanSekretaris');
    Route::get('/sekretaris/apbd', [SekretarisController::class, 'apbdIndex'])->name('apbdSekretaris');
    Route::get('/sekretaris/keuangan', [SekretarisController::class, 'keuanganIndex'])->name('keuanganSekretaris');
    Route::get('/sekretaris/slide', [SekretarisController::class, 'slideIndex'])->name('slideSekretaris');
    Route::get('/sekretaris/lainnya', [SekretarisController::class, 'lainnyaIndex'])->name('lainnyaSekretaris');

    // Dokumentasi
    Route::get('/sekretaris/dokumentasi', [SekretarisController::class, 'indexDokumentasi'])->name('dokumentasiSekretaris');
    Route::get('/sekretaris/dokumentasi/create', [SekretarisController::class, 'createDokumentasi'])->name('createDokumentasiSekretaris');
    Route::post('/sekretaris/dokumentasi/store', [SekretarisController::class, 'storeDokumentasi'])->name('storeDokumentasiSekretaris');
    Route::get('/sekretaris/dokumentasi/{id}', [SekretarisController::class, 'showDokumentasi'])->name('showDokumentasiSekretaris');
    Route::get('/sekretaris/dokumentasi/{id}/edit', [SekretarisController::class, 'editDokumentasi'])->name('editDokumentasiSekretaris');
    Route::put('/sekretaris/dokumentasi/{id}', [SekretarisController::class, 'updateDokumentasi'])->name('updateDokumentasiSekretaris');
    Route::delete('/sekretaris/dokumentasi/{id}', [SekretarisController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSekretaris');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Bidang Anggaran
Route::middleware(['auth', 'bidangAnggaran'])->group(function () {
    Route::get('/b_anggaran/dashboard', [BidangAnggaranController::class, 'dashboard'])->name('dashboardBidangAnggaran');

    // Agenda
    Route::get('/b_anggaran/agenda', [BidangAnggaranController::class, 'indexAgenda'])->name('agendaBidangAnggaran');
    Route::get('/b_anggaran/agenda/{id}/disposisi', [BidangAnggaranController::class, 'disposisiAgenda'])->name('disposisiAgendaBidangAnggaran');
    Route::put('/b_anggaran/agenda/{id}', [BidangAnggaranController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaBidangAnggaran');

    // Laporan
    Route::get('/b_anggaran/laporan/{id}/upload', [BidangAnggaranController::class, 'uploadLaporan'])->name('uploadLaporanBidangAnggaran');
    Route::put('/b_anggaran/laporan/{id}', [BidangAnggaranController::class, 'storeLaporan'])->name('storeLaporanBidangAnggaran');

    // Disposisi
    Route::get('/b_anggaran/disposisi', [BidangAnggaranController::class, 'indexDisposisi'])->name('disposisiBidangAnggaran');

    // Arsip
    Route::get('/b_anggaran/arsip', [BidangAnggaranController::class, 'indexArsip'])->name('arsipBidangAnggaran');
    Route::get('/b_anggaran/arsip/create', [BidangAnggaranController::class, 'createArsip'])->name('createArsipBidangAnggaran');
    Route::post('/b_anggaran/arsip/store', [BidangAnggaranController::class, 'storeArsip'])->name('storeArsipBidangAnggaran');
    Route::get('/b_anggaran/arsip/{id}/edit', [BidangAnggaranController::class, 'editArsip'])->name('editArsipBidangAnggaran');
    Route::put('/b_anggaran/arsip/{id}', [BidangAnggaranController::class, 'updateArsip'])->name('updateArsipBidangAnggaran');

    // Berkas
    Route::get('/b_anggaran/peraturan', [BidangAnggaranController::class, 'peraturanIndex'])->name('peraturanBidangAnggaran');
    Route::get('/b_anggaran/apbd', [BidangAnggaranController::class, 'apbdIndex'])->name('apbdBidangAnggaran');
    Route::get('/b_anggaran/keuangan', [BidangAnggaranController::class, 'keuanganIndex'])->name('keuanganBidangAnggaran');
    Route::get('/b_anggaran/slide', [BidangAnggaranController::class, 'slideIndex'])->name('slideBidangAnggaran');
    Route::get('/b_anggaran/lainnya', [BidangAnggaranController::class, 'lainnyaIndex'])->name('lainnyaBidangAnggaran');

    // Dokumentasi
    Route::get('/b_anggaran/dokumentasi', [BidangAnggaranController::class, 'indexDokumentasi'])->name('dokumentasiBidangAnggaran');
    Route::get('/b_anggaran/dokumentasi/create', [BidangAnggaranController::class, 'createDokumentasi'])->name('createDokumentasiBidangAnggaran');
    Route::post('/b_anggaran/dokumentasi/store', [BidangAnggaranController::class, 'storeDokumentasi'])->name('storeDokumentasiBidangAnggaran');
    Route::get('/b_anggaran/dokumentasi/{id}', [BidangAnggaranController::class, 'showDokumentasi'])->name('showDokumentasiBidangAnggaran');
    Route::get('/b_anggaran/dokumentasi/{id}/edit', [BidangAnggaranController::class, 'editDokumentasi'])->name('editDokumentasiBidangAnggaran');
    Route::put('/b_anggaran/dokumentasi/{id}', [BidangAnggaranController::class, 'updateDokumentasi'])->name('updateDokumentasiBidangAnggaran');
    Route::delete('/b_anggaran/dokumentasi/{id}', [BidangAnggaranController::class, 'destroyDokumentasi'])->name('deleteDokumentasiBidangAnggaran');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Bidang Perbendaharaan
Route::middleware(['auth', 'bidangPerbendaharaan'])->group(function () {
    Route::get('/b_perbendaharaan/dashboard', [BidangPerbendaharaanController::class, 'dashboard'])->name('dashboardBidangPerbendaharaan');

    // Agenda
    Route::get('/b_perbendaharaan/agenda', [BidangPerbendaharaanController::class, 'indexAgenda'])->name('agendaBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/agenda/{id}/disposisi', [BidangPerbendaharaanController::class, 'disposisiAgenda'])->name('disposisiAgendaBidangPerbendaharaan');
    Route::put('/b_perbendaharaan/agenda/{id}', [BidangPerbendaharaanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaBidangPerbendaharaan');

    // Laporan
    Route::get('/b_perbendaharaan/laporan/{id}/upload', [BidangPerbendaharaanController::class, 'uploadLaporan'])->name('uploadLaporanBidangPerbendaharaan');
    Route::put('/b_perbendaharaan/laporan/{id}', [BidangPerbendaharaanController::class, 'storeLaporan'])->name('storeLaporanBidangPerbendaharaan');

    // Disposisi
    Route::get('/b_perbendaharaan/disposisi', [BidangPerbendaharaanController::class, 'indexDisposisi'])->name('disposisiBidangPerbendaharaan');

    // Arsip
    Route::get('/b_perbendaharaan/arsip', [BidangPerbendaharaanController::class, 'indexArsip'])->name('arsipBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/arsip/create', [BidangPerbendaharaanController::class, 'createArsip'])->name('createArsipBidangPerbendaharaan');
    Route::post('/b_perbendaharaan/arsip/store', [BidangPerbendaharaanController::class, 'storeArsip'])->name('storeArsipBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/arsip/{id}/edit', [BidangPerbendaharaanController::class, 'editArsip'])->name('editArsipBidangPerbendaharaan');
    Route::put('/b_perbendaharaan/arsip/{id}', [BidangPerbendaharaanController::class, 'updateArsip'])->name('updateArsipBidangPerbendaharaan');

    // Berkas
    Route::get('/b_perbendaharaan/peraturan', [BidangPerbendaharaanController::class, 'peraturanIndex'])->name('peraturanBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/apbd', [BidangPerbendaharaanController::class, 'apbdIndex'])->name('apbdBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/keuangan', [BidangPerbendaharaanController::class, 'keuanganIndex'])->name('keuanganBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/slide', [BidangPerbendaharaanController::class, 'slideIndex'])->name('slideBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/lainnya', [BidangPerbendaharaanController::class, 'lainnyaIndex'])->name('lainnyaBidangPerbendaharaan');

    // Dokumentasi
    Route::get('/b_perbendaharaan/dokumentasi', [BidangPerbendaharaanController::class, 'indexDokumentasi'])->name('dokumentasiBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/dokumentasi/create', [BidangPerbendaharaanController::class, 'createDokumentasi'])->name('createDokumentasiBidangPerbendaharaan');
    Route::post('/b_perbendaharaan/dokumentasi/store', [BidangPerbendaharaanController::class, 'storeDokumentasi'])->name('storeDokumentasiBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/dokumentasi/{id}', [BidangPerbendaharaanController::class, 'showDokumentasi'])->name('showDokumentasiBidangPerbendaharaan');
    Route::get('/b_perbendaharaan/dokumentasi/{id}/edit', [BidangPerbendaharaanController::class, 'editDokumentasi'])->name('editDokumentasiBidangPerbendaharaan');
    Route::put('/b_perbendaharaan/dokumentasi/{id}', [BidangPerbendaharaanController::class, 'updateDokumentasi'])->name('updateDokumentasiBidangPerbendaharaan');
    Route::delete('/b_perbendaharaan/dokumentasi/{id}', [BidangPerbendaharaanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiBidangPerbendaharaan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Bidang Akuntansi
Route::middleware(['auth', 'bidangAkuntansi'])->group(function () {
    Route::get('/b_akuntansi/dashboard', [BidangAkuntansiController::class, 'dashboard'])->name('dashboardBidangAkuntansi');

    // Agenda
    Route::get('/b_akuntansi/agenda', [BidangAkuntansiController::class, 'indexAgenda'])->name('agendaBidangAkuntansi');
    Route::get('/b_akuntansi/agenda/{id}/disposisi', [BidangAkuntansiController::class, 'disposisiAgenda'])->name('disposisiAgendaBidangAkuntansi');
    Route::put('/b_akuntansi/agenda/{id}', [BidangAkuntansiController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaBidangAkuntansi');

    // Laporan
    Route::get('/b_akuntansi/laporan/{id}/upload', [BidangAkuntansiController::class, 'uploadLaporan'])->name('uploadLaporanBidangAkuntansi');
    Route::put('/b_akuntansi/laporan/{id}', [BidangAkuntansiController::class, 'storeLaporan'])->name('storeLaporanBidangAkuntansi');

    // Disposisi
    Route::get('/b_akuntansi/disposisi', [BidangAkuntansiController::class, 'indexDisposisi'])->name('disposisiBidangAkuntansi');

    // Arsip
    Route::get('/b_akuntansi/arsip', [BidangAkuntansiController::class, 'indexArsip'])->name('arsipBidangAkuntansi');
    Route::get('/b_akuntansi/arsip/create', [BidangAkuntansiController::class, 'createArsip'])->name('createArsipBidangAkuntansi');
    Route::post('/b_akuntansi/arsip/store', [BidangAkuntansiController::class, 'storeArsip'])->name('storeArsipBidangAkuntansi');
    Route::get('/b_akuntansi/arsip/{id}/edit', [BidangAkuntansiController::class, 'editArsip'])->name('editArsipBidangAkuntansi');
    Route::put('/b_akuntansi/arsip/{id}', [BidangAkuntansiController::class, 'updateArsip'])->name('updateArsipBidangAkuntansi');

    // Berkas
    Route::get('/b_akuntansi/peraturan', [BidangAkuntansiController::class, 'peraturanIndex'])->name('peraturanBidangAkuntansi');
    Route::get('/b_akuntansi/apbd', [BidangAkuntansiController::class, 'apbdIndex'])->name('apbdBidangAkuntansi');
    Route::get('/b_akuntansi/keuangan', [BidangAkuntansiController::class, 'keuanganIndex'])->name('keuanganBidangAkuntansi');
    Route::get('/b_akuntansi/slide', [BidangAkuntansiController::class, 'slideIndex'])->name('slideBidangAkuntansi');
    Route::get('/b_akuntansi/lainnya', [BidangAkuntansiController::class, 'lainnyaIndex'])->name('lainnyaBidangAkuntansi');

    // Dokumentasi
    Route::get('/b_akuntansi/dokumentasi', [BidangAkuntansiController::class, 'indexDokumentasi'])->name('dokumentasiBidangAkuntansi');
    Route::get('/b_akuntansi/dokumentasi/create', [BidangAkuntansiController::class, 'createDokumentasi'])->name('createDokumentasiBidangAkuntansi');
    Route::post('/b_akuntansi/dokumentasi/store', [BidangAkuntansiController::class, 'storeDokumentasi'])->name('storeDokumentasiBidangAkuntansi');
    Route::get('/b_akuntansi/dokumentasi/{id}', [BidangAkuntansiController::class, 'showDokumentasi'])->name('showDokumentasiBidangAkuntansi');
    Route::get('/b_akuntansi/dokumentasi/{id}/edit', [BidangAkuntansiController::class, 'editDokumentasi'])->name('editDokumentasiBidangAkuntansi');
    Route::put('/b_akuntansi/dokumentasi/{id}', [BidangAkuntansiController::class, 'updateDokumentasi'])->name('updateDokumentasiBidangAkuntansi');
    Route::delete('/b_akuntansi/dokumentasi/{id}', [BidangAkuntansiController::class, 'destroyDokumentasi'])->name('deleteDokumentasiBidangAkuntansi');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Bidang Aset
Route::middleware(['auth', 'bidangAset'])->group(function () {
    Route::get('/b_aset/dashboard', [BidangAsetController::class, 'dashboard'])->name('dashboardBidangAset');

    // Agenda
    Route::get('/b_aset/agenda', [BidangAsetController::class, 'indexAgenda'])->name('agendaBidangAset');
    Route::get('/b_aset/agenda/{id}/disposisi', [BidangAsetController::class, 'disposisiAgenda'])->name('disposisiAgendaBidangAset');
    Route::put('/b_aset/agenda/{id}', [BidangAsetController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaBidangAset');

    // Laporan
    Route::get('/b_aset/laporan/{id}/upload', [BidangAsetController::class, 'uploadLaporan'])->name('uploadLaporanBidangAset');
    Route::put('/b_aset/laporan/{id}', [BidangAsetController::class, 'storeLaporan'])->name('storeLaporanBidangAset');

    // Disposisi
    Route::get('/b_aset/disposisi', [BidangAsetController::class, 'indexDisposisi'])->name('disposisiBidangAset');

    // Arsip
    Route::get('/b_aset/arsip', [BidangAsetController::class, 'indexArsip'])->name('arsipBidangAset');
    Route::get('/b_aset/arsip/create', [BidangAsetController::class, 'createArsip'])->name('createArsipBidangAset');
    Route::post('/b_aset/arsip/store', [BidangAsetController::class, 'storeArsip'])->name('storeArsipBidangAset');
    Route::get('/b_aset/arsip/{id}/edit', [BidangAsetController::class, 'editArsip'])->name('editArsipBidangAset');
    Route::put('/b_aset/arsip/{id}', [BidangAsetController::class, 'updateArsip'])->name('updateArsipBidangAset');

    // Berkas
    Route::get('/b_aset/peraturan', [BidangAsetController::class, 'peraturanIndex'])->name('peraturanBidangAset');
    Route::get('/b_aset/apbd', [BidangAsetController::class, 'apbdIndex'])->name('apbdBidangAset');
    Route::get('/b_aset/keuangan', [BidangAsetController::class, 'keuanganIndex'])->name('keuanganBidangAset');
    Route::get('/b_aset/slide', [BidangAsetController::class, 'slideIndex'])->name('slideBidangAset');
    Route::get('/b_aset/lainnya', [BidangAsetController::class, 'lainnyaIndex'])->name('lainnyaBidangAset');

    // Dokumentasi
    Route::get('/b_aset/dokumentasi', [BidangAsetController::class, 'indexDokumentasi'])->name('dokumentasiBidangAset');
    Route::get('/b_aset/dokumentasi/create', [BidangAsetController::class, 'createDokumentasi'])->name('createDokumentasiBidangAset');
    Route::post('/b_aset/dokumentasi/store', [BidangAsetController::class, 'storeDokumentasi'])->name('storeDokumentasiBidangAset');
    Route::get('/b_aset/dokumentasi/{id}', [BidangAsetController::class, 'showDokumentasi'])->name('showDokumentasiBidangAset');
    Route::get('/b_aset/dokumentasi/{id}/edit', [BidangAsetController::class, 'editDokumentasi'])->name('editDokumentasiBidangAset');
    Route::put('/b_aset/dokumentasi/{id}', [BidangAsetController::class, 'updateDokumentasi'])->name('updateDokumentasiBidangAset');
    Route::delete('/b_aset/dokumentasi/{id}', [BidangAsetController::class, 'destroyDokumentasi'])->name('deleteDokumentasiBidangAset');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbag Perencanaan dan Evaluasi
Route::middleware(['auth', 'subbagPerencanaan'])->group(function () {
    Route::get('/subbag_perencanaan/dashboard', [SubbagPerencanaanController::class, 'dashboard'])->name('dashboardSubbagPerencanaan');

    // Agenda
    Route::get('/subbag_perencanaan/agenda', [SubbagPerencanaanController::class, 'indexAgenda'])->name('agendaSubbagPerencanaan');
    Route::get('/subbag_perencanaan/agenda/{id}/disposisi', [SubbagPerencanaanController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbagPerencanaan');
    Route::put('/subbag_perencanaan/agenda/{id}', [SubbagPerencanaanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbagPerencanaan');

    // Laporan
    Route::get('/subbag_perencanaan/laporan/{id}/upload', [SubbagPerencanaanController::class, 'uploadLaporan'])->name('uploadLaporanSubbagPerencanaan');
    Route::put('/subbag_perencanaan/laporan/{id}', [SubbagPerencanaanController::class, 'storeLaporan'])->name('storeLaporanSubbagPerencanaan');

    // Disposisi
    Route::get('/subbag_perencanaan/disposisi', [SubbagPerencanaanController::class, 'indexDisposisi'])->name('disposisiSubbagPerencanaan');

    // Arsip
    Route::get('/subbag_perencanaan/arsip', [SubbagPerencanaanController::class, 'indexArsip'])->name('arsipSubbagPerencanaan');
    Route::get('/subbag_perencanaan/arsip/create', [SubbagPerencanaanController::class, 'createArsip'])->name('createArsipSubbagPerencanaan');
    Route::post('/subbag_perencanaan/arsip/store', [SubbagPerencanaanController::class, 'storeArsip'])->name('storeArsipSubbagPerencanaan');
    Route::get('/subbag_perencanaan/arsip/{id}/edit', [SubbagPerencanaanController::class, 'editArsip'])->name('editArsipSubbagPerencanaan');
    Route::put('/subbag_perencanaan/arsip/{id}', [SubbagPerencanaanController::class, 'updateArsip'])->name('updateArsipSubbagPerencanaan');

    // Berkas
    Route::get('/subbag_perencanaan/peraturan', [SubbagPerencanaanController::class, 'peraturanIndex'])->name('peraturanSubbagPerencanaan');
    Route::get('/subbag_perencanaan/apbd', [SubbagPerencanaanController::class, 'apbdIndex'])->name('apbdSubbagPerencanaan');
    Route::get('/subbag_perencanaan/keuangan', [SubbagPerencanaanController::class, 'keuanganIndex'])->name('keuanganSubbagPerencanaan');
    Route::get('/subbag_perencanaan/slide', [SubbagPerencanaanController::class, 'slideIndex'])->name('slideSubbagPerencanaan');
    Route::get('/subbag_perencanaan/lainnya', [SubbagPerencanaanController::class, 'lainnyaIndex'])->name('lainnyaSubbagPerencanaan');

    // Dokumentasi
    Route::get('/subbag_perencanaan/dokumentasi', [SubbagPerencanaanController::class, 'indexDokumentasi'])->name('dokumentasiSubbagPerencanaan');
    Route::get('/subbag_perencanaan/dokumentasi/create', [SubbagPerencanaanController::class, 'createDokumentasi'])->name('createDokumentasiSubbagPerencanaan');
    Route::post('/subbag_perencanaan/dokumentasi/store', [SubbagPerencanaanController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbagPerencanaan');
    Route::get('/subbag_perencanaan/dokumentasi/{id}', [SubbagPerencanaanController::class, 'showDokumentasi'])->name('showDokumentasiSubbagPerencanaan');
    Route::get('/subbag_perencanaan/dokumentasi/{id}/edit', [SubbagPerencanaanController::class, 'editDokumentasi'])->name('editDokumentasiSubbagPerencanaan');
    Route::put('/subbag_perencanaan/dokumentasi/{id}', [SubbagPerencanaanController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbagPerencanaan');
    Route::delete('/subbag_perencanaan/dokumentasi/{id}', [SubbagPerencanaanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbagPerencanaan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbag Keuangan
Route::middleware(['auth', 'subbagKeuangan'])->group(function () {
    Route::get('/subbag_keuangan/dashboard', [SubbagKeuanganController::class, 'dashboard'])->name('dashboardSubbagKeuangan');

    // Agenda
    Route::get('/subbag_keuangan/agenda', [SubbagKeuanganController::class, 'indexAgenda'])->name('agendaSubbagKeuangan');
    Route::get('/subbag_keuangan/agenda/{id}/disposisi', [SubbagKeuanganController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbagKeuangan');
    Route::put('/subbag_keuangan/agenda/{id}', [SubbagKeuanganController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbagKeuangan');

    // Laporan
    Route::get('/subbag_keuangan/laporan/{id}/upload', [SubbagKeuanganController::class, 'uploadLaporan'])->name('uploadLaporanSubbagKeuangan');
    Route::put('/subbag_keuangan/laporan/{id}', [SubbagKeuanganController::class, 'storeLaporan'])->name('storeLaporanSubbagKeuangan');

    // Disposisi
    Route::get('/subbag_keuangan/disposisi', [SubbagKeuanganController::class, 'indexDisposisi'])->name('disposisiSubbagKeuangan');

    // Arsip
    Route::get('/subbag_keuangan/arsip', [SubbagKeuanganController::class, 'indexArsip'])->name('arsipSubbagKeuangan');
    Route::get('/subbag_keuangan/arsip/create', [SubbagKeuanganController::class, 'createArsip'])->name('createArsipSubbagKeuangan');
    Route::post('/subbag_keuangan/arsip/store', [SubbagKeuanganController::class, 'storeArsip'])->name('storeArsipSubbagKeuangan');
    Route::get('/subbag_keuangan/arsip/{id}/edit', [SubbagKeuanganController::class, 'editArsip'])->name('editArsipSubbagKeuangan');
    Route::put('/subbag_keuangan/arsip/{id}', [SubbagKeuanganController::class, 'updateArsip'])->name('updateArsipSubbagKeuangan');

    // Berkas
    Route::get('/subbag_keuangan/peraturan', [SubbagKeuanganController::class, 'peraturanIndex'])->name('peraturanSubbagKeuangan');
    Route::get('/subbag_keuangan/apbd', [SubbagKeuanganController::class, 'apbdIndex'])->name('apbdSubbagKeuangan');
    Route::get('/subbag_keuangan/keuangan', [SubbagKeuanganController::class, 'keuanganIndex'])->name('keuanganSubbagKeuangan');
    Route::get('/subbag_keuangan/slide', [SubbagKeuanganController::class, 'slideIndex'])->name('slideSubbagKeuangan');
    Route::get('/subbag_keuangan/lainnya', [SubbagKeuanganController::class, 'lainnyaIndex'])->name('lainnyaSubbagKeuangan');

    // Dokumentasi
    Route::get('/subbag_keuangan/dokumentasi', [SubbagKeuanganController::class, 'indexDokumentasi'])->name('dokumentasiSubbagKeuangan');
    Route::get('/subbag_keuangan/dokumentasi/create', [SubbagKeuanganController::class, 'createDokumentasi'])->name('createDokumentasiSubbagKeuangan');
    Route::post('/subbag_keuangan/dokumentasi/store', [SubbagKeuanganController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbagKeuangan');
    Route::get('/subbag_keuangan/dokumentasi/{id}', [SubbagKeuanganController::class, 'showDokumentasi'])->name('showDokumentasiSubbagKeuangan');
    Route::get('/subbag_keuangan/dokumentasi/{id}/edit', [SubbagKeuanganController::class, 'editDokumentasi'])->name('editDokumentasiSubbagKeuangan');
    Route::put('/subbag_keuangan/dokumentasi/{id}', [SubbagKeuanganController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbagKeuangan');
    Route::delete('/subbag_keuangan/dokumentasi/{id}', [SubbagKeuanganController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbagKeuangan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbag Umum dan Kepegawaian
Route::middleware(['auth', 'subbagUmum'])->group(function () {
    Route::get('/subbag_umum/dashboard', [SubbagUmumController::class, 'dashboard'])->name('dashboardSubbagUmum');

    // Agenda
    Route::get('/subbag_umum/agenda', [SubbagUmumController::class, 'indexAgenda'])->name('agendaSubbagUmum');
    Route::get('/subbag_umum/agenda/{id}/disposisi', [SubbagUmumController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbagUmum');
    Route::put('/subbag_umum/agenda/{id}', [SubbagUmumController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbagUmum');

    // Laporan
    Route::get('/subbag_umum/laporan/{id}/upload', [SubbagUmumController::class, 'uploadLaporan'])->name('uploadLaporanSubbagUmum');
    Route::put('/subbag_umum/laporan/{id}', [SubbagUmumController::class, 'storeLaporan'])->name('storeLaporanSubbagUmum');

    // Disposisi
    Route::get('/subbag_umum/disposisi', [SubbagUmumController::class, 'indexDisposisi'])->name('disposisiSubbagUmum');

    // Arsip
    Route::get('/subbag_umum/arsip', [SubbagUmumController::class, 'indexArsip'])->name('arsipSubbagUmum');
    Route::get('/subbag_umum/arsip/create', [SubbagUmumController::class, 'createArsip'])->name('createArsipSubbagUmum');
    Route::post('/subbag_umum/arsip/store', [SubbagUmumController::class, 'storeArsip'])->name('storeArsipSubbagUmum');
    Route::get('/subbag_umum/arsip/{id}/edit', [SubbagUmumController::class, 'editArsip'])->name('editArsipSubbagUmum');
    Route::put('/subbag_umum/arsip/{id}', [SubbagUmumController::class, 'updateArsip'])->name('updateArsipSubbagUmum');

    // Berkas
    Route::get('/subbag_umum/peraturan', [SubbagUmumController::class, 'peraturanIndex'])->name('peraturanSubbagUmum');
    Route::get('/subbag_umum/apbd', [SubbagUmumController::class, 'apbdIndex'])->name('apbdSubbagUmum');
    Route::get('/subbag_umum/keuangan', [SubbagUmumController::class, 'keuanganIndex'])->name('keuanganSubbagUmum');
    Route::get('/subbag_umum/slide', [SubbagUmumController::class, 'slideIndex'])->name('slideSubbagUmum');
    Route::get('/subbag_umum/lainnya', [SubbagUmumController::class, 'lainnyaIndex'])->name('lainnyaSubbagUmum');

    // Dokumentasi
    Route::get('/subbag_umum/dokumentasi', [SubbagUmumController::class, 'indexDokumentasi'])->name('dokumentasiSubbagUmum');
    Route::get('/subbag_umum/dokumentasi/create', [SubbagUmumController::class, 'createDokumentasi'])->name('createDokumentasiSubbagUmum');
    Route::post('/subbag_umum/dokumentasi/store', [SubbagUmumController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbagUmum');
    Route::get('/subbag_umum/dokumentasi/{id}', [SubbagUmumController::class, 'showDokumentasi'])->name('showDokumentasiSubbagUmum');
    Route::get('/subbag_umum/dokumentasi/{id}/edit', [SubbagUmumController::class, 'editDokumentasi'])->name('editDokumentasiSubbagUmum');
    Route::put('/subbag_umum/dokumentasi/{id}', [SubbagUmumController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbagUmum');
    Route::delete('/subbag_umum/dokumentasi/{id}', [SubbagUmumController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbagUmum');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Anggaran Pendapatan dan Pembiayaan
Route::middleware(['auth', 'subbidAnggaranPendapatan'])->group(function () {
    Route::get('/subbid_anggaran_pendapatan/dashboard', [SubbidAnggaranPendapatanController::class, 'dashboard'])->name('dashboardSubbidAnggaranPendapatan');

    // Agenda
    Route::get('/subbid_anggaran_pendapatan/agenda', [SubbidAnggaranPendapatanController::class, 'indexAgenda'])->name('agendaSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/agenda/{id}/disposisi', [SubbidAnggaranPendapatanController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidAnggaranPendapatan');
    Route::put('/subbid_anggaran_pendapatan/agenda/{id}', [SubbidAnggaranPendapatanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidAnggaranPendapatan');

    // Laporan
    Route::get('/subbid_anggaran_pendapatan/laporan/{id}/upload', [SubbidAnggaranPendapatanController::class, 'uploadLaporan'])->name('uploadLaporanSubbidAnggaranPendapatan');
    Route::put('/subbid_anggaran_pendapatan/laporan/{id}', [SubbidAnggaranPendapatanController::class, 'storeLaporan'])->name('storeLaporanSubbidAnggaranPendapatan');

    // Disposisi
    Route::get('/subbid_anggaran_pendapatan/disposisi', [SubbidAnggaranPendapatanController::class, 'indexDisposisi'])->name('disposisiSubbidAnggaranPendapatan');

    // Arsip
    Route::get('/subbid_anggaran_pendapatan/arsip', [SubbidAnggaranPendapatanController::class, 'indexArsip'])->name('arsipSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/arsip/create', [SubbidAnggaranPendapatanController::class, 'createArsip'])->name('createArsipSubbidAnggaranPendapatan');
    Route::post('/subbid_anggaran_pendapatan/arsip/store', [SubbidAnggaranPendapatanController::class, 'storeArsip'])->name('storeArsipSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/arsip/{id}/edit', [SubbidAnggaranPendapatanController::class, 'editArsip'])->name('editArsipSubbidAnggaranPendapatan');
    Route::put('/subbid_anggaran_pendapatan/arsip/{id}', [SubbidAnggaranPendapatanController::class, 'updateArsip'])->name('updateArsipSubbidAnggaranPendapatan');

    // Berkas
    Route::get('/subbid_anggaran_pendapatan/peraturan', [SubbidAnggaranPendapatanController::class, 'peraturanIndex'])->name('peraturanSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/apbd', [SubbidAnggaranPendapatanController::class, 'apbdIndex'])->name('apbdSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/keuangan', [SubbidAnggaranPendapatanController::class, 'keuanganIndex'])->name('keuanganSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/slide', [SubbidAnggaranPendapatanController::class, 'slideIndex'])->name('slideSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/lainnya', [SubbidAnggaranPendapatanController::class, 'lainnyaIndex'])->name('lainnyaSubbidAnggaranPendapatan');

    // Dokumentasi
    Route::get('/subbid_anggaran_pendapatan/dokumentasi', [SubbidAnggaranPendapatanController::class, 'indexDokumentasi'])->name('dokumentasiSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/dokumentasi/create', [SubbidAnggaranPendapatanController::class, 'createDokumentasi'])->name('createDokumentasiSubbidAnggaranPendapatan');
    Route::post('/subbid_anggaran_pendapatan/dokumentasi/store', [SubbidAnggaranPendapatanController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/dokumentasi/{id}', [SubbidAnggaranPendapatanController::class, 'showDokumentasi'])->name('showDokumentasiSubbidAnggaranPendapatan');
    Route::get('/subbid_anggaran_pendapatan/dokumentasi/{id}/edit', [SubbidAnggaranPendapatanController::class, 'editDokumentasi'])->name('editDokumentasiSubbidAnggaranPendapatan');
    Route::put('/subbid_anggaran_pendapatan/dokumentasi/{id}', [SubbidAnggaranPendapatanController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidAnggaranPendapatan');
    Route::delete('/subbid_anggaran_pendapatan/dokumentasi/{id}', [SubbidAnggaranPendapatanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidAnggaranPendapatan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Anggaran Belanja
Route::middleware(['auth', 'subbidAnggaranBelanja'])->group(function () {
    Route::get('/subbid_anggaran_belanja/dashboard', [SubbidAnggaranBelanjaController::class, 'dashboard'])->name('dashboardSubbidAnggaranBelanja');

    // Agenda
    Route::get('/subbid_anggaran_belanja/agenda', [SubbidAnggaranBelanjaController::class, 'indexAgenda'])->name('agendaSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/agenda/{id}/disposisi', [SubbidAnggaranBelanjaController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidAnggaranBelanja');
    Route::put('/subbid_anggaran_belanja/agenda/{id}', [SubbidAnggaranBelanjaController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidAnggaranBelanja');

    // Laporan
    Route::get('/subbid_anggaran_belanja/laporan/{id}/upload', [SubbidAnggaranBelanjaController::class, 'uploadLaporan'])->name('uploadLaporanSubbidAnggaranBelanja');
    Route::put('/subbid_anggaran_belanja/laporan/{id}', [SubbidAnggaranBelanjaController::class, 'storeLaporan'])->name('storeLaporanSubbidAnggaranBelanja');

    // Disposisi
    Route::get('/subbid_anggaran_belanja/disposisi', [SubbidAnggaranBelanjaController::class, 'indexDisposisi'])->name('disposisiSubbidAnggaranBelanja');

    // Arsip
    Route::get('/subbid_anggaran_belanja/arsip', [SubbidAnggaranBelanjaController::class, 'indexArsip'])->name('arsipSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/arsip/create', [SubbidAnggaranBelanjaController::class, 'createArsip'])->name('createArsipSubbidAnggaranBelanja');
    Route::post('/subbid_anggaran_belanja/arsip/store', [SubbidAnggaranBelanjaController::class, 'storeArsip'])->name('storeArsipSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/arsip/{id}/edit', [SubbidAnggaranBelanjaController::class, 'editArsip'])->name('editArsipSubbidAnggaranBelanja');
    Route::put('/subbid_anggaran_belanja/arsip/{id}', [SubbidAnggaranBelanjaController::class, 'updateArsip'])->name('updateArsipSubbidAnggaranBelanja');

    // Berkas
    Route::get('/subbid_anggaran_belanja/peraturan', [SubbidAnggaranBelanjaController::class, 'peraturanIndex'])->name('peraturanSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/apbd', [SubbidAnggaranBelanjaController::class, 'apbdIndex'])->name('apbdSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/keuangan', [SubbidAnggaranBelanjaController::class, 'keuanganIndex'])->name('keuanganSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/slide', [SubbidAnggaranBelanjaController::class, 'slideIndex'])->name('slideSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/lainnya', [SubbidAnggaranBelanjaController::class, 'lainnyaIndex'])->name('lainnyaSubbidAnggaranBelanja');

    // Dokumentasi
    Route::get('/subbid_anggaran_belanja/dokumentasi', [SubbidAnggaranBelanjaController::class, 'indexDokumentasi'])->name('dokumentasiSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/dokumentasi/create', [SubbidAnggaranBelanjaController::class, 'createDokumentasi'])->name('createDokumentasiSubbidAnggaranBelanja');
    Route::post('/subbid_anggaran_belanja/dokumentasi/store', [SubbidAnggaranBelanjaController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/dokumentasi/{id}', [SubbidAnggaranBelanjaController::class, 'showDokumentasi'])->name('showDokumentasiSubbidAnggaranBelanja');
    Route::get('/subbid_anggaran_belanja/dokumentasi/{id}/edit', [SubbidAnggaranBelanjaController::class, 'editDokumentasi'])->name('editDokumentasiSubbidAnggaranBelanja');
    Route::put('/subbid_anggaran_belanja/dokumentasi/{id}', [SubbidAnggaranBelanjaController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidAnggaranBelanja');
    Route::delete('/subbid_anggaran_belanja/dokumentasi/{id}', [SubbidAnggaranBelanjaController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidAnggaranBelanja');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Pengelolaan Kas
Route::middleware(['auth', 'subbidPengelolaan'])->group(function () {
    Route::get('/subbid_pengelolaan/dashboard', [SubbidPengelolaanController::class, 'dashboard'])->name('dashboardSubbidPengelolaan');

    // Agenda
    Route::get('/subbid_pengelolaan/agenda', [SubbidPengelolaanController::class, 'indexAgenda'])->name('agendaSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/agenda/{id}/disposisi', [SubbidPengelolaanController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidPengelolaan');
    Route::put('/subbid_pengelolaan/agenda/{id}', [SubbidPengelolaanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidPengelolaan');

    // Laporan
    Route::get('/subbid_pengelolaan/laporan/{id}/upload', [SubbidPengelolaanController::class, 'uploadLaporan'])->name('uploadLaporanSubbidPengelolaan');
    Route::put('/subbid_pengelolaan/laporan/{id}', [SubbidPengelolaanController::class, 'storeLaporan'])->name('storeLaporanSubbidPengelolaan');

    // Disposisi
    Route::get('/subbid_pengelolaan/disposisi', [SubbidPengelolaanController::class, 'indexDisposisi'])->name('disposisiSubbidPengelolaan');

    // Arsip
    Route::get('/subbid_pengelolaan/arsip', [SubbidPengelolaanController::class, 'indexArsip'])->name('arsipSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/arsip/create', [SubbidPengelolaanController::class, 'createArsip'])->name('createArsipSubbidPengelolaan');
    Route::post('/subbid_pengelolaan/arsip/store', [SubbidPengelolaanController::class, 'storeArsip'])->name('storeArsipSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/arsip/{id}/edit', [SubbidPengelolaanController::class, 'editArsip'])->name('editArsipSubbidPengelolaan');
    Route::put('/subbid_pengelolaan/arsip/{id}', [SubbidPengelolaanController::class, 'updateArsip'])->name('updateArsipSubbidPengelolaan');

    // Berkas
    Route::get('/subbid_pengelolaan/peraturan', [SubbidPengelolaanController::class, 'peraturanIndex'])->name('peraturanSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/apbd', [SubbidPengelolaanController::class, 'apbdIndex'])->name('apbdSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/keuangan', [SubbidPengelolaanController::class, 'keuanganIndex'])->name('keuanganSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/slide', [SubbidPengelolaanController::class, 'slideIndex'])->name('slideSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/lainnya', [SubbidPengelolaanController::class, 'lainnyaIndex'])->name('lainnyaSubbidPengelolaan');

    // Dokumentasi
    Route::get('/subbid_pengelolaan/dokumentasi', [SubbidPengelolaanController::class, 'indexDokumentasi'])->name('dokumentasiSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/dokumentasi/create', [SubbidPengelolaanController::class, 'createDokumentasi'])->name('createDokumentasiSubbidPengelolaan');
    Route::post('/subbid_pengelolaan/dokumentasi/store', [SubbidPengelolaanController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/dokumentasi/{id}', [SubbidPengelolaanController::class, 'showDokumentasi'])->name('showDokumentasiSubbidPengelolaan');
    Route::get('/subbid_pengelolaan/dokumentasi/{id}/edit', [SubbidPengelolaanController::class, 'editDokumentasi'])->name('editDokumentasiSubbidPengelolaan');
    Route::put('/subbid_pengelolaan/dokumentasi/{id}', [SubbidPengelolaanController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidPengelolaan');
    Route::delete('/subbid_pengelolaan/dokumentasi/{id}', [SubbidPengelolaanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidPengelolaan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Administrasi Perbendaharaan
Route::middleware(['auth', 'subbidAdministrasi'])->group(function () {
    Route::get('/subbid_administrasi/dashboard', [SubbidAdministrasiController::class, 'dashboard'])->name('dashboardSubbidAdministrasi');

    // Agenda
    Route::get('/subbid_administrasi/agenda', [SubbidAdministrasiController::class, 'indexAgenda'])->name('agendaSubbidAdministrasi');
    Route::get('/subbid_administrasi/agenda/{id}/disposisi', [SubbidAdministrasiController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidAdministrasi');
    Route::put('/subbid_administrasi/agenda/{id}', [SubbidAdministrasiController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidAdministrasi');

    // Laporan
    Route::get('/subbid_administrasi/laporan/{id}/upload', [SubbidAdministrasiController::class, 'uploadLaporan'])->name('uploadLaporanSubbidAdministrasi');
    Route::put('/subbid_administrasi/laporan/{id}', [SubbidAdministrasiController::class, 'storeLaporan'])->name('storeLaporanSubbidAdministrasi');

    // Disposisi
    Route::get('/subbid_administrasi/disposisi', [SubbidAdministrasiController::class, 'indexDisposisi'])->name('disposisiSubbidAdministrasi');

    // Arsip
    Route::get('/subbid_administrasi/arsip', [SubbidAdministrasiController::class, 'indexArsip'])->name('arsipSubbidAdministrasi');
    Route::get('/subbid_administrasi/arsip/create', [SubbidAdministrasiController::class, 'createArsip'])->name('createArsipSubbidAdministrasi');
    Route::post('/subbid_administrasi/arsip/store', [SubbidAdministrasiController::class, 'storeArsip'])->name('storeArsipSubbidAdministrasi');
    Route::get('/subbid_administrasi/arsip/{id}/edit', [SubbidAdministrasiController::class, 'editArsip'])->name('editArsipSubbidAdministrasi');
    Route::put('/subbid_administrasi/arsip/{id}', [SubbidAdministrasiController::class, 'updateArsip'])->name('updateArsipSubbidAdministrasi');

    // Berkas
    Route::get('/subbid_administrasi/peraturan', [SubbidAdministrasiController::class, 'peraturanIndex'])->name('peraturanSubbidAdministrasi');
    Route::get('/subbid_administrasi/apbd', [SubbidAdministrasiController::class, 'apbdIndex'])->name('apbdSubbidAdministrasi');
    Route::get('/subbid_administrasi/keuangan', [SubbidAdministrasiController::class, 'keuanganIndex'])->name('keuanganSubbidAdministrasi');
    Route::get('/subbid_administrasi/slide', [SubbidAdministrasiController::class, 'slideIndex'])->name('slideSubbidAdministrasi');
    Route::get('/subbid_administrasi/lainnya', [SubbidAdministrasiController::class, 'lainnyaIndex'])->name('lainnyaSubbidAdministrasi');

    // Dokumentasi
    Route::get('/subbid_administrasi/dokumentasi', [SubbidAdministrasiController::class, 'indexDokumentasi'])->name('dokumentasiSubbidAdministrasi');
    Route::get('/subbid_administrasi/dokumentasi/create', [SubbidAdministrasiController::class, 'createDokumentasi'])->name('createDokumentasiSubbidAdministrasi');
    Route::post('/subbid_administrasi/dokumentasi/store', [SubbidAdministrasiController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidAdministrasi');
    Route::get('/subbid_administrasi/dokumentasi/{id}', [SubbidAdministrasiController::class, 'showDokumentasi'])->name('showDokumentasiSubbidAdministrasi');
    Route::get('/subbid_administrasi/dokumentasi/{id}/edit', [SubbidAdministrasiController::class, 'editDokumentasi'])->name('editDokumentasiSubbidAdministrasi');
    Route::put('/subbid_administrasi/dokumentasi/{id}', [SubbidAdministrasiController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidAdministrasi');
    Route::delete('/subbid_administrasi/dokumentasi/{id}', [SubbidAdministrasiController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidAdministrasi');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Pembukuan dan Pelaporan
Route::middleware(['auth', 'subbidPembukuan'])->group(function () {
    Route::get('/subbid_pembukuan/dashboard', [SubbidPembukuanController::class, 'dashboard'])->name('dashboardSubbidPembukuan');

    // Agenda
    Route::get('/subbid_pembukuan/agenda', [SubbidPembukuanController::class, 'indexAgenda'])->name('agendaSubbidPembukuan');
    Route::get('/subbid_pembukuan/agenda/{id}/disposisi', [SubbidPembukuanController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidPembukuan');
    Route::put('/subbid_pembukuan/agenda/{id}', [SubbidPembukuanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidPembukuan');

    // Laporan
    Route::get('/subbid_pembukuan/laporan/{id}/upload', [SubbidPembukuanController::class, 'uploadLaporan'])->name('uploadLaporanSubbidPembukuan');
    Route::put('/subbid_pembukuan/laporan/{id}', [SubbidPembukuanController::class, 'storeLaporan'])->name('storeLaporanSubbidPembukuan');

    // Disposisi
    Route::get('/subbid_pembukuan/disposisi', [SubbidPembukuanController::class, 'indexDisposisi'])->name('disposisiSubbidPembukuan');

    // Arsip
    Route::get('/subbid_pembukuan/arsip', [SubbidPembukuanController::class, 'indexArsip'])->name('arsipSubbidPembukuan');
    Route::get('/subbid_pembukuan/arsip/create', [SubbidPembukuanController::class, 'createArsip'])->name('createArsipSubbidPembukuan');
    Route::post('/subbid_pembukuan/arsip/store', [SubbidPembukuanController::class, 'storeArsip'])->name('storeArsipSubbidPembukuan');
    Route::get('/subbid_pembukuan/arsip/{id}/edit', [SubbidPembukuanController::class, 'editArsip'])->name('editArsipSubbidPembukuan');
    Route::put('/subbid_pembukuan/arsip/{id}', [SubbidPembukuanController::class, 'updateArsip'])->name('updateArsipSubbidPembukuan');

    // Berkas
    Route::get('/subbid_pembukuan/peraturan', [SubbidPembukuanController::class, 'peraturanIndex'])->name('peraturanSubbidPembukuan');
    Route::get('/subbid_pembukuan/apbd', [SubbidPembukuanController::class, 'apbdIndex'])->name('apbdSubbidPembukuan');
    Route::get('/subbid_pembukuan/keuangan', [SubbidPembukuanController::class, 'keuanganIndex'])->name('keuanganSubbidPembukuan');
    Route::get('/subbid_pembukuan/slide', [SubbidPembukuanController::class, 'slideIndex'])->name('slideSubbidPembukuan');
    Route::get('/subbid_pembukuan/lainnya', [SubbidPembukuanController::class, 'lainnyaIndex'])->name('lainnyaSubbidPembukuan');

    // Dokumentasi
    Route::get('/subbid_pembukuan/dokumentasi', [SubbidPembukuanController::class, 'indexDokumentasi'])->name('dokumentasiSubbidPembukuan');
    Route::get('/subbid_pembukuan/dokumentasi/create', [SubbidPembukuanController::class, 'createDokumentasi'])->name('createDokumentasiSubbidPembukuan');
    Route::post('/subbid_pembukuan/dokumentasi/store', [SubbidPembukuanController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidPembukuan');
    Route::get('/subbid_pembukuan/dokumentasi/{id}', [SubbidPembukuanController::class, 'showDokumentasi'])->name('showDokumentasiSubbidPembukuan');
    Route::get('/subbid_pembukuan/dokumentasi/{id}/edit', [SubbidPembukuanController::class, 'editDokumentasi'])->name('editDokumentasiSubbidPembukuan');
    Route::put('/subbid_pembukuan/dokumentasi/{id}', [SubbidPembukuanController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidPembukuan');
    Route::delete('/subbid_pembukuan/dokumentasi/{id}', [SubbidPembukuanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidPembukuan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Verifikasi
Route::middleware(['auth', 'subbidVerifikasi'])->group(function () {
    Route::get('/subbid_verifikasi/dashboard', [SubbidVerifikasiController::class, 'dashboard'])->name('dashboardSubbidVerifikasi');

    // Agenda
    Route::get('/subbid_verifikasi/agenda', [SubbidVerifikasiController::class, 'indexAgenda'])->name('agendaSubbidVerifikasi');
    Route::get('/subbid_verifikasi/agenda/{id}/disposisi', [SubbidVerifikasiController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidVerifikasi');
    Route::put('/subbid_verifikasi/agenda/{id}', [SubbidVerifikasiController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidVerifikasi');

    // Laporan
    Route::get('/subbid_verifikasi/laporan/{id}/upload', [SubbidVerifikasiController::class, 'uploadLaporan'])->name('uploadLaporanSubbidVerifikasi');
    Route::put('/subbid_verifikasi/laporan/{id}', [SubbidVerifikasiController::class, 'storeLaporan'])->name('storeLaporanSubbidVerifikasi');

    // Disposisi
    Route::get('/subbid_verifikasi/disposisi', [SubbidVerifikasiController::class, 'indexDisposisi'])->name('disposisiSubbidVerifikasi');

    // Arsip
    Route::get('/subbid_verifikasi/arsip', [SubbidVerifikasiController::class, 'indexArsip'])->name('arsipSubbidVerifikasi');
    Route::get('/subbid_verifikasi/arsip/create', [SubbidVerifikasiController::class, 'createArsip'])->name('createArsipSubbidVerifikasi');
    Route::post('/subbid_verifikasi/arsip/store', [SubbidVerifikasiController::class, 'storeArsip'])->name('storeArsipSubbidVerifikasi');
    Route::get('/subbid_verifikasi/arsip/{id}/edit', [SubbidVerifikasiController::class, 'editArsip'])->name('editArsipSubbidVerifikasi');
    Route::put('/subbid_verifikasi/arsip/{id}', [SubbidVerifikasiController::class, 'updateArsip'])->name('updateArsipSubbidVerifikasi');

    // Berkas
    Route::get('/subbid_verifikasi/peraturan', [SubbidVerifikasiController::class, 'peraturanIndex'])->name('peraturanSubbidVerifikasi');
    Route::get('/subbid_verifikasi/apbd', [SubbidVerifikasiController::class, 'apbdIndex'])->name('apbdSubbidVerifikasi');
    Route::get('/subbid_verifikasi/keuangan', [SubbidVerifikasiController::class, 'keuanganIndex'])->name('keuanganSubbidVerifikasi');
    Route::get('/subbid_verifikasi/slide', [SubbidVerifikasiController::class, 'slideIndex'])->name('slideSubbidVerifikasi');
    Route::get('/subbid_verifikasi/lainnya', [SubbidVerifikasiController::class, 'lainnyaIndex'])->name('lainnyaSubbidVerifikasi');

    // Dokumentasi
    Route::get('/subbid_verifikasi/dokumentasi', [SubbidVerifikasiController::class, 'indexDokumentasi'])->name('dokumentasiSubbidVerifikasi');
    Route::get('/subbid_verifikasi/dokumentasi/create', [SubbidVerifikasiController::class, 'createDokumentasi'])->name('createDokumentasiSubbidVerifikasi');
    Route::post('/subbid_verifikasi/dokumentasi/store', [SubbidVerifikasiController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidVerifikasi');
    Route::get('/subbid_verifikasi/dokumentasi/{id}', [SubbidVerifikasiController::class, 'showDokumentasi'])->name('showDokumentasiSubbidVerifikasi');
    Route::get('/subbid_verifikasi/dokumentasi/{id}/edit', [SubbidVerifikasiController::class, 'editDokumentasi'])->name('editDokumentasiSubbidVerifikasi');
    Route::put('/subbid_verifikasi/dokumentasi/{id}', [SubbidVerifikasiController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidVerifikasi');
    Route::delete('/subbid_verifikasi/dokumentasi/{id}', [SubbidVerifikasiController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidVerifikasi');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Perencanaan dan Penatausahaan
Route::middleware(['auth', 'subbidPerencanaan'])->group(function () {
    Route::get('/subbid_perencanaan/dashboard', [SubbidPerencanaanController::class, 'dashboard'])->name('dashboardSubbidPerencanaan');

    // Agenda
    Route::get('/subbid_perencanaan/agenda', [SubbidPerencanaanController::class, 'indexAgenda'])->name('agendaSubbidPerencanaan');
    Route::get('/subbid_perencanaan/agenda/{id}/disposisi', [SubbidPerencanaanController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidPerencanaan');
    Route::put('/subbid_perencanaan/agenda/{id}', [SubbidPerencanaanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidPerencanaan');

    // Laporan
    Route::get('/subbid_perencanaan/laporan/{id}/upload', [SubbidPerencanaanController::class, 'uploadLaporan'])->name('uploadLaporanSubbidPerencanaan');
    Route::put('/subbid_perencanaan/laporan/{id}', [SubbidPerencanaanController::class, 'storeLaporan'])->name('storeLaporanSubbidPerencanaan');

    // Disposisi
    Route::get('/subbid_perencanaan/disposisi', [SubbidPerencanaanController::class, 'indexDisposisi'])->name('disposisiSubbidPerencanaan');

    // Arsip
    Route::get('/subbid_perencanaan/arsip', [SubbidPerencanaanController::class, 'indexArsip'])->name('arsipSubbidPerencanaan');
    Route::get('/subbid_perencanaan/arsip/create', [SubbidPerencanaanController::class, 'createArsip'])->name('createArsipSubbidPerencanaan');
    Route::post('/subbid_perencanaan/arsip/store', [SubbidPerencanaanController::class, 'storeArsip'])->name('storeArsipSubbidPerencanaan');
    Route::get('/subbid_perencanaan/arsip/{id}/edit', [SubbidPerencanaanController::class, 'editArsip'])->name('editArsipSubbidPerencanaan');
    Route::put('/subbid_perencanaan/arsip/{id}', [SubbidPerencanaanController::class, 'updateArsip'])->name('updateArsipSubbidPerencanaan');

    // Berkas
    Route::get('/subbid_perencanaan/peraturan', [SubbidPerencanaanController::class, 'peraturanIndex'])->name('peraturanSubbidPerencanaan');
    Route::get('/subbid_perencanaan/apbd', [SubbidPerencanaanController::class, 'apbdIndex'])->name('apbdSubbidPerencanaan');
    Route::get('/subbid_perencanaan/keuangan', [SubbidPerencanaanController::class, 'keuanganIndex'])->name('keuanganSubbidPerencanaan');
    Route::get('/subbid_perencanaan/slide', [SubbidPerencanaanController::class, 'slideIndex'])->name('slideSubbidPerencanaan');
    Route::get('/subbid_perencanaan/lainnya', [SubbidPerencanaanController::class, 'lainnyaIndex'])->name('lainnyaSubbidPerencanaan');

    // Dokumentasi
    Route::get('/subbid_perencanaan/dokumentasi', [SubbidPerencanaanController::class, 'indexDokumentasi'])->name('dokumentasiSubbidPerencanaan');
    Route::get('/subbid_perencanaan/dokumentasi/create', [SubbidPerencanaanController::class, 'createDokumentasi'])->name('createDokumentasiSubbidPerencanaan');
    Route::post('/subbid_perencanaan/dokumentasi/store', [SubbidPerencanaanController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidPerencanaan');
    Route::get('/subbid_perencanaan/dokumentasi/{id}', [SubbidPerencanaanController::class, 'showDokumentasi'])->name('showDokumentasiSubbidPerencanaan');
    Route::get('/subbid_perencanaan/dokumentasi/{id}/edit', [SubbidPerencanaanController::class, 'editDokumentasi'])->name('editDokumentasiSubbidPerencanaan');
    Route::put('/subbid_perencanaan/dokumentasi/{id}', [SubbidPerencanaanController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidPerencanaan');
    Route::delete('/subbid_perencanaan/dokumentasi/{id}', [SubbidPerencanaanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidPerencanaan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid Penggunaan dan Pemanfaatan
Route::middleware(['auth', 'subbidPenggunaan'])->group(function () {
    Route::get('/subbid_penggunaan/dashboard', [SubbidPenggunaanController::class, 'dashboard'])->name('dashboardSubbidPenggunaan');

    // Agenda
    Route::get('/subbid_penggunaan/agenda', [SubbidPenggunaanController::class, 'indexAgenda'])->name('agendaSubbidPenggunaan');
    Route::get('/subbid_penggunaan/agenda/{id}/disposisi', [SubbidPenggunaanController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbidPenggunaan');
    Route::put('/subbid_penggunaan/agenda/{id}', [SubbidPenggunaanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbidPenggunaan');

    // Laporan
    Route::get('/subbid_penggunaan/laporan/{id}/upload', [SubbidPenggunaanController::class, 'uploadLaporan'])->name('uploadLaporanSubbidPenggunaan');
    Route::put('/subbid_penggunaan/laporan/{id}', [SubbidPenggunaanController::class, 'storeLaporan'])->name('storeLaporanSubbidPenggunaan');

    // Disposisi
    Route::get('/subbid_penggunaan/disposisi', [SubbidPenggunaanController::class, 'indexDisposisi'])->name('disposisiSubbidPenggunaan');

    // Arsip
    Route::get('/subbid_penggunaan/arsip', [SubbidPenggunaanController::class, 'indexArsip'])->name('arsipSubbidPenggunaan');
    Route::get('/subbid_penggunaan/arsip/create', [SubbidPenggunaanController::class, 'createArsip'])->name('createArsipSubbidPenggunaan');
    Route::post('/subbid_penggunaan/arsip/store', [SubbidPenggunaanController::class, 'storeArsip'])->name('storeArsipSubbidPenggunaan');
    Route::get('/subbid_penggunaan/arsip/{id}/edit', [SubbidPenggunaanController::class, 'editArsip'])->name('editArsipSubbidPenggunaan');
    Route::put('/subbid_penggunaan/arsip/{id}', [SubbidPenggunaanController::class, 'updateArsip'])->name('updateArsipSubbidPenggunaan');

    // Berkas
    Route::get('/subbid_penggunaan/peraturan', [SubbidPenggunaanController::class, 'peraturanIndex'])->name('peraturanSubbidPenggunaan');
    Route::get('/subbid_penggunaan/apbd', [SubbidPenggunaanController::class, 'apbdIndex'])->name('apbdSubbidPenggunaan');
    Route::get('/subbid_penggunaan/keuangan', [SubbidPenggunaanController::class, 'keuanganIndex'])->name('keuanganSubbidPenggunaan');
    Route::get('/subbid_penggunaan/slide', [SubbidPenggunaanController::class, 'slideIndex'])->name('slideSubbidPenggunaan');
    Route::get('/subbid_penggunaan/lainnya', [SubbidPenggunaanController::class, 'lainnyaIndex'])->name('lainnyaSubbidPenggunaan');

    // Dokumentasi
    Route::get('/subbid_penggunaan/dokumentasi', [SubbidPenggunaanController::class, 'indexDokumentasi'])->name('dokumentasiSubbidPenggunaan');
    Route::get('/subbid_penggunaan/dokumentasi/create', [SubbidPenggunaanController::class, 'createDokumentasi'])->name('createDokumentasiSubbidPenggunaan');
    Route::post('/subbid_penggunaan/dokumentasi/store', [SubbidPenggunaanController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbidPenggunaan');
    Route::get('/subbid_penggunaan/dokumentasi/{id}', [SubbidPenggunaanController::class, 'showDokumentasi'])->name('showDokumentasiSubbidPenggunaan');
    Route::get('/subbid_penggunaan/dokumentasi/{id}/edit', [SubbidPenggunaanController::class, 'editDokumentasi'])->name('editDokumentasiSubbidPenggunaan');
    Route::put('/subbid_penggunaan/dokumentasi/{id}', [SubbidPenggunaanController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbidPenggunaan');
    Route::delete('/subbid_penggunaan/dokumentasi/{id}', [SubbidPenggunaanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbidPenggunaan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Admin Sekretaris
Route::middleware(['auth', 'adminSekretaris'])->group(function () {
    Route::get('/admin_sekretaris/dashboard', [AdminSekretarisController::class, 'dashboard'])->name('dashboardAdminSekretaris');

    // User
    Route::get('/admin_sekretaris/staff', [AdminSekretarisController::class, 'indexStaff'])->name('staffAdminSekretaris');
    Route::get('/admin_sekretaris/staff/status/{id}', [AdminSekretarisController::class, 'status'])->name('statusStaff');
    Route::get('/admin_sekretaris/staff/create', [AdminSekretarisController::class, 'createStaff'])->name('createStaffAdminSekretaris');
    Route::post('/admin_sekretaris/staff/store', [AdminSekretarisController::class, 'storeStaff'])->name('storeStaffAdminSekretaris');
    Route::get('/admin_sekretaris/staff/{id}/edit', [AdminSekretarisController::class, 'editStaff'])->name('editStaffAdminSekretaris');
    Route::put('/admin_sekretaris/staff/{id}', [AdminSekretarisController::class, 'updateStaff'])->name('updateStaffAdminSekretaris');

    // Agenda
    Route::get('/admin_sekretaris/agenda', [AdminSekretarisController::class, 'indexAgenda'])->name('agendaAdminSekretaris');
    Route::get('/admin_sekretaris/agenda/create', [AdminSekretarisController::class, 'createAgenda'])->name('createAgendaAdminSekretaris');
    Route::post('/admin_sekretaris/agenda/store', [AdminSekretarisController::class, 'storeAgenda'])->name('storeAgendaAdminSekretaris');
    Route::get('/admin_sekretaris/agenda/{id}/edit', [AdminSekretarisController::class, 'editAgenda'])->name('editAgendaAdminSekretaris');
    Route::put('/admin_sekretaris/agenda/{id}', [AdminSekretarisController::class, 'updateAgenda'])->name('updateAgendaAdminSekretaris');
    Route::delete('/admin_sekretaris/agenda/{id}', [AdminSekretarisController::class, 'destroyAgenda'])->name('deleteAgendaAdminSekretaris');

    // Arsip
    Route::get('/admin_sekretaris/arsip', [AdminSekretarisController::class, 'indexArsip'])->name('arsipAdminSekretaris');
    Route::get('/admin_sekretaris/arsip/create', [AdminSekretarisController::class, 'createArsip'])->name('createArsipAdminSekretaris');
    Route::post('/admin_sekretaris/arsip/store', [AdminSekretarisController::class, 'storeArsip'])->name('storeArsipAdminSekretaris');
    Route::get('/admin_sekretaris/arsip/{id}/edit', [AdminSekretarisController::class, 'editArsip'])->name('editArsipAdminSekretaris');
    Route::put('/admin_sekretaris/arsip/{id}', [AdminSekretarisController::class, 'updateArsip'])->name('updateArsipAdminSekretaris');
    
    // Dokumentasi
    Route::get('/admin_sekretaris/dokumentasi', [AdminSekretarisController::class, 'indexDokumentasi'])->name('dokumentasiAdminSekretaris');
    Route::get('/admin_sekretaris/dokumentasi/create', [AdminSekretarisController::class, 'createDokumentasi'])->name('createDokumentasiAdminSekretaris');
    Route::post('/admin_sekretaris/dokumentasi/store', [AdminSekretarisController::class, 'storeDokumentasi'])->name('storeDokumentasiAdminSekretaris');
    Route::get('admin_sekretaris/dokumentasi/{id}', [AdminSekretarisController::class, 'showDokumentasi'])->name('showDokumentasiAdminSekretaris');
    Route::get('/admin_sekretaris/dokumentasi/{id}/edit', [AdminSekretarisController::class, 'editDokumentasi'])->name('editDokumentasiAdminSekretaris');
    Route::put('/admin_sekretaris/dokumentasi/{id}', [AdminSekretarisController::class, 'updateDokumentasi'])->name('updateDokumentasiAdminSekretaris');
    Route::delete('/admin_sekretaris/dokumentasi/{id}', [AdminSekretarisController::class, 'destroyDokumentasi'])->name('deleteDokumentasiAdminSekretaris');

    // Berkas
    Route::get('/admin_sekretaris/peraturan', [AdminSekretarisController::class, 'peraturanIndex'])->name('peraturanAdminSekretaris');
    Route::get('/admin_sekretaris/apbd', [AdminSekretarisController::class, 'apbdIndex'])->name('apbdAdminSekretaris');
    Route::get('/admin_sekretaris/keuangan', [AdminSekretarisController::class, 'keuanganIndex'])->name('keuanganAdminSekretaris');
    Route::get('/admin_sekretaris/slide', [AdminSekretarisController::class, 'slideIndex'])->name('slideAdminSekretaris');
    Route::get('/admin_sekretaris/lainnya', [AdminSekretarisController::class, 'lainnyaIndex'])->name('lainnyaAdminSekretaris');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Admin Bidang Anggaran
Route::middleware(['auth', 'adminAnggaran'])->group(function () {
    Route::get('/admin_anggaran/dashboard', [AdminAnggaranController::class, 'dashboard'])->name('dashboardAdminAnggaran');

    // User
    Route::get('/admin_anggaran/staff', [AdminAnggaranController::class, 'indexStaff'])->name('staffAdminAnggaran');
    Route::get('/admin_anggaran/staff/status/{id}', [AdminAnggaranController::class, 'status'])->name('statusStaff');
    Route::get('/admin_anggaran/staff/create', [AdminAnggaranController::class, 'createStaff'])->name('createStaffAdminAnggaran');
    Route::post('/admin_anggaran/staff/store', [AdminAnggaranController::class, 'storeStaff'])->name('storeStaffAdminAnggaran');
    Route::get('/admin_anggaran/staff/{id}/edit', [AdminAnggaranController::class, 'editStaff'])->name('editStaffAdminAnggaran');
    Route::put('/admin_anggaran/staff/{id}', [AdminAnggaranController::class, 'updateStaff'])->name('updateStaffAdminAnggaran');

    // Agenda
    Route::get('/admin_anggaran/agenda', [AdminAnggaranController::class, 'indexAgenda'])->name('agendaAdminAnggaran');
    Route::get('/admin_anggaran/agenda/create', [AdminAnggaranController::class, 'createAgenda'])->name('createAgendaAdminAnggaran');
    Route::post('/admin_anggaran/agenda/store', [AdminAnggaranController::class, 'storeAgenda'])->name('storeAgendaAdminAnggaran');
    Route::get('/admin_anggaran/agenda/{id}/edit', [AdminAnggaranController::class, 'editAgenda'])->name('editAgendaAdminAnggaran');
    Route::put('/admin_anggaran/agenda/{id}', [AdminAnggaranController::class, 'updateAgenda'])->name('updateAgendaAdminAnggaran');
    Route::delete('/admin_anggaran/agenda/{id}', [AdminAnggaranController::class, 'destroyAgenda'])->name('deleteAgendaAdminAnggaran');

    // Arsip
    Route::get('/admin_anggaran/arsip', [AdminAnggaranController::class, 'indexArsip'])->name('arsipAdminAnggaran');
    Route::get('/admin_anggaran/arsip/create', [AdminAnggaranController::class, 'createArsip'])->name('createArsipAdminAnggaran');
    Route::post('/admin_anggaran/arsip/store', [AdminAnggaranController::class, 'storeArsip'])->name('storeArsipAdminAnggaran');
    Route::get('/admin_anggaran/arsip/{id}/edit', [AdminAnggaranController::class, 'editArsip'])->name('editArsipAdminAnggaran');
    Route::put('/admin_anggaran/arsip/{id}', [AdminAnggaranController::class, 'updateArsip'])->name('updateArsipAdminAnggaran');
    
    // Dokumentasi
    Route::get('/admin_anggaran/dokumentasi', [AdminAnggaranController::class, 'indexDokumentasi'])->name('dokumentasiAdminAnggaran');
    Route::get('/admin_anggaran/dokumentasi/create', [AdminAnggaranController::class, 'createDokumentasi'])->name('createDokumentasiAdminAnggaran');
    Route::post('/admin_anggaran/dokumentasi/store', [AdminAnggaranController::class, 'storeDokumentasi'])->name('storeDokumentasiAdminAnggaran');
    Route::get('admin_anggaran/dokumentasi/{id}', [AdminAnggaranController::class, 'showDokumentasi'])->name('showDokumentasiAdminAnggaran');
    Route::get('/admin_anggaran/dokumentasi/{id}/edit', [AdminAnggaranController::class, 'editDokumentasi'])->name('editDokumentasiAdminAnggaran');
    Route::put('/admin_anggaran/dokumentasi/{id}', [AdminAnggaranController::class, 'updateDokumentasi'])->name('updateDokumentasiAdminAnggaran');
    Route::delete('/admin_anggaran/dokumentasi/{id}', [AdminAnggaranController::class, 'destroyDokumentasi'])->name('deleteDokumentasiAdminAnggaran');

    // Berkas
    Route::get('/admin_anggaran/peraturan', [AdminAnggaranController::class, 'peraturanIndex'])->name('peraturanAdminAnggaran');
    Route::get('/admin_anggaran/apbd', [AdminAnggaranController::class, 'apbdIndex'])->name('apbdAdminAnggaran');
    Route::get('/admin_anggaran/keuangan', [AdminAnggaranController::class, 'keuanganIndex'])->name('keuanganAdminAnggaran');
    Route::get('/admin_anggaran/slide', [AdminAnggaranController::class, 'slideIndex'])->name('slideAdminAnggaran');
    Route::get('/admin_anggaran/lainnya', [AdminAnggaranController::class, 'lainnyaIndex'])->name('lainnyaAdminAnggaran');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Admin Bidang Perbendaharaan
Route::middleware(['auth', 'adminPerbendaharaan'])->group(function () {
    Route::get('/admin_perbendaharaan/dashboard', [AdminPerbendaharaanController::class, 'dashboard'])->name('dashboardAdminPerbendaharaan');

    // User
    Route::get('/admin_perbendaharaan/staff', [AdminPerbendaharaanController::class, 'indexStaff'])->name('staffAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/staff/status/{id}', [AdminPerbendaharaanController::class, 'status'])->name('statusStaff');
    Route::get('/admin_perbendaharaan/staff/create', [AdminPerbendaharaanController::class, 'createStaff'])->name('createStaffAdminPerbendaharaan');
    Route::post('/admin_perbendaharaan/staff/store', [AdminPerbendaharaanController::class, 'storeStaff'])->name('storeStaffAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/staff/{id}/edit', [AdminPerbendaharaanController::class, 'editStaff'])->name('editStaffAdminPerbendaharaan');
    Route::put('/admin_perbendaharaan/staff/{id}', [AdminPerbendaharaanController::class, 'updateStaff'])->name('updateStaffAdminPerbendaharaan');

    // Agenda
    Route::get('/admin_perbendaharaan/agenda', [AdminPerbendaharaanController::class, 'indexAgenda'])->name('agendaAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/agenda/create', [AdminPerbendaharaanController::class, 'createAgenda'])->name('createAgendaAdminPerbendaharaan');
    Route::post('/admin_perbendaharaan/agenda/store', [AdminPerbendaharaanController::class, 'storeAgenda'])->name('storeAgendaAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/agenda/{id}/edit', [AdminPerbendaharaanController::class, 'editAgenda'])->name('editAgendaAdminPerbendaharaan');
    Route::put('/admin_perbendaharaan/agenda/{id}', [AdminPerbendaharaanController::class, 'updateAgenda'])->name('updateAgendaAdminPerbendaharaan');
    Route::delete('/admin_perbendaharaan/agenda/{id}', [AdminPerbendaharaanController::class, 'destroyAgenda'])->name('deleteAgendaAdminPerbendaharaan');

    // Arsip
    Route::get('/admin_perbendaharaan/arsip', [AdminPerbendaharaanController::class, 'indexArsip'])->name('arsipAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/arsip/create', [AdminPerbendaharaanController::class, 'createArsip'])->name('createArsipAdminPerbendaharaan');
    Route::post('/admin_perbendaharaan/arsip/store', [AdminPerbendaharaanController::class, 'storeArsip'])->name('storeArsipAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/arsip/{id}/edit', [AdminPerbendaharaanController::class, 'editArsip'])->name('editArsipAdminPerbendaharaan');
    Route::put('/admin_perbendaharaan/arsip/{id}', [AdminPerbendaharaanController::class, 'updateArsip'])->name('updateArsipAdminPerbendaharaan');
    
    // Dokumentasi
    Route::get('/admin_perbendaharaan/dokumentasi', [AdminPerbendaharaanController::class, 'indexDokumentasi'])->name('dokumentasiAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/dokumentasi/create', [AdminPerbendaharaanController::class, 'createDokumentasi'])->name('createDokumentasiAdminPerbendaharaan');
    Route::post('/admin_perbendaharaan/dokumentasi/store', [AdminPerbendaharaanController::class, 'storeDokumentasi'])->name('storeDokumentasiAdminPerbendaharaan');
    Route::get('admin_perbendaharaan/dokumentasi/{id}', [AdminPerbendaharaanController::class, 'showDokumentasi'])->name('showDokumentasiAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/dokumentasi/{id}/edit', [AdminPerbendaharaanController::class, 'editDokumentasi'])->name('editDokumentasiAdminPerbendaharaan');
    Route::put('/admin_perbendaharaan/dokumentasi/{id}', [AdminPerbendaharaanController::class, 'updateDokumentasi'])->name('updateDokumentasiAdminPerbendaharaan');
    Route::delete('/admin_perbendaharaan/dokumentasi/{id}', [AdminPerbendaharaanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiAdminPerbendaharaan');

    // Berkas
    Route::get('/admin_perbendaharaan/peraturan', [AdminPerbendaharaanController::class, 'peraturanIndex'])->name('peraturanAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/apbd', [AdminPerbendaharaanController::class, 'apbdIndex'])->name('apbdAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/keuangan', [AdminPerbendaharaanController::class, 'keuanganIndex'])->name('keuanganAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/slide', [AdminPerbendaharaanController::class, 'slideIndex'])->name('slideAdminPerbendaharaan');
    Route::get('/admin_perbendaharaan/lainnya', [AdminPerbendaharaanController::class, 'lainnyaIndex'])->name('lainnyaAdminPerbendaharaan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Admin Bidang Akuntansi
Route::middleware(['auth', 'adminAkuntansi'])->group(function () {
    Route::get('/admin_akuntansi/dashboard', [AdminAkuntansiController::class, 'dashboard'])->name('dashboardAdminAkuntansi');

    // User
    Route::get('/admin_akuntansi/staff', [AdminAkuntansiController::class, 'indexStaff'])->name('staffAdminAkuntansi');
    Route::get('/admin_akuntansi/staff/status/{id}', [AdminAkuntansiController::class, 'status'])->name('statusStaff');
    Route::get('/admin_akuntansi/staff/create', [AdminAkuntansiController::class, 'createStaff'])->name('createStaffAdminAkuntansi');
    Route::post('/admin_akuntansi/staff/store', [AdminAkuntansiController::class, 'storeStaff'])->name('storeStaffAdminAkuntansi');
    Route::get('/admin_akuntansi/staff/{id}/edit', [AdminAkuntansiController::class, 'editStaff'])->name('editStaffAdminAkuntansi');
    Route::put('/admin_akuntansi/staff/{id}', [AdminAkuntansiController::class, 'updateStaff'])->name('updateStaffAdminAkuntansi');

    // Agenda
    Route::get('/admin_akuntansi/agenda', [AdminAkuntansiController::class, 'indexAgenda'])->name('agendaAdminAkuntansi');
    Route::get('/admin_akuntansi/agenda/create', [AdminAkuntansiController::class, 'createAgenda'])->name('createAgendaAdminAkuntansi');
    Route::post('/admin_akuntansi/agenda/store', [AdminAkuntansiController::class, 'storeAgenda'])->name('storeAgendaAdminAkuntansi');
    Route::get('/admin_akuntansi/agenda/{id}/edit', [AdminAkuntansiController::class, 'editAgenda'])->name('editAgendaAdminAkuntansi');
    Route::put('/admin_akuntansi/agenda/{id}', [AdminAkuntansiController::class, 'updateAgenda'])->name('updateAgendaAdminAkuntansi');
    Route::delete('/admin_akuntansi/agenda/{id}', [AdminAkuntansiController::class, 'destroyAgenda'])->name('deleteAgendaAdminAkuntansi');

    // Arsip
    Route::get('/admin_akuntansi/arsip', [AdminAkuntansiController::class, 'indexArsip'])->name('arsipAdminAkuntansi');
    Route::get('/admin_akuntansi/arsip/create', [AdminAkuntansiController::class, 'createArsip'])->name('createArsipAdminAkuntansi');
    Route::post('/admin_akuntansi/arsip/store', [AdminAkuntansiController::class, 'storeArsip'])->name('storeArsipAdminAkuntansi');
    Route::get('/admin_akuntansi/arsip/{id}/edit', [AdminAkuntansiController::class, 'editArsip'])->name('editArsipAdminAkuntansi');
    Route::put('/admin_akuntansi/arsip/{id}', [AdminAkuntansiController::class, 'updateArsip'])->name('updateArsipAdminAkuntansi');
    
    // Dokumentasi
    Route::get('/admin_akuntansi/dokumentasi', [AdminAkuntansiController::class, 'indexDokumentasi'])->name('dokumentasiAdminAkuntansi');
    Route::get('/admin_akuntansi/dokumentasi/create', [AdminAkuntansiController::class, 'createDokumentasi'])->name('createDokumentasiAdminAkuntansi');
    Route::post('/admin_akuntansi/dokumentasi/store', [AdminAkuntansiController::class, 'storeDokumentasi'])->name('storeDokumentasiAdminAkuntansi');
    Route::get('admin_akuntansi/dokumentasi/{id}', [AdminAkuntansiController::class, 'showDokumentasi'])->name('showDokumentasiAdminAkuntansi');
    Route::get('/admin_akuntansi/dokumentasi/{id}/edit', [AdminAkuntansiController::class, 'editDokumentasi'])->name('editDokumentasiAdminAkuntansi');
    Route::put('/admin_akuntansi/dokumentasi/{id}', [AdminAkuntansiController::class, 'updateDokumentasi'])->name('updateDokumentasiAdminAkuntansi');
    Route::delete('/admin_akuntansi/dokumentasi/{id}', [AdminAkuntansiController::class, 'destroyDokumentasi'])->name('deleteDokumentasiAdminAkuntansi');

    // Berkas
    Route::get('/admin_akuntansi/peraturan', [AdminAkuntansiController::class, 'peraturanIndex'])->name('peraturanAdminAkuntansi');
    Route::get('/admin_akuntansi/apbd', [AdminAkuntansiController::class, 'apbdIndex'])->name('apbdAdminAkuntansi');
    Route::get('/admin_akuntansi/keuangan', [AdminAkuntansiController::class, 'keuanganIndex'])->name('keuanganAdminAkuntansi');
    Route::get('/admin_akuntansi/slide', [AdminAkuntansiController::class, 'slideIndex'])->name('slideAdminAkuntansi');
    Route::get('/admin_akuntansi/lainnya', [AdminAkuntansiController::class, 'lainnyaIndex'])->name('lainnyaAdminAkuntansi');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Admin Bidang Aset
Route::middleware(['auth', 'adminAset'])->group(function () {
    Route::get('/admin_aset/dashboard', [AdminAsetController::class, 'dashboard'])->name('dashboardAdminAset');

    // User
    Route::get('/admin_aset/staff', [AdminAsetController::class, 'indexStaff'])->name('staffAdminAset');
    Route::get('/admin_aset/staff/status/{id}', [AdminAsetController::class, 'status'])->name('statusStaff');
    Route::get('/admin_aset/staff/create', [AdminAsetController::class, 'createStaff'])->name('createStaffAdminAset');
    Route::post('/admin_aset/staff/store', [AdminAsetController::class, 'storeStaff'])->name('storeStaffAdminAset');
    Route::get('/admin_aset/staff/{id}/edit', [AdminAsetController::class, 'editStaff'])->name('editStaffAdminAset');
    Route::put('/admin_aset/staff/{id}', [AdminAsetController::class, 'updateStaff'])->name('updateStaffAdminAset');

    // Agenda
    Route::get('/admin_aset/agenda', [AdminAsetController::class, 'indexAgenda'])->name('agendaAdminAset');
    Route::get('/admin_aset/agenda/create', [AdminAsetController::class, 'createAgenda'])->name('createAgendaAdminAset');
    Route::post('/admin_aset/agenda/store', [AdminAsetController::class, 'storeAgenda'])->name('storeAgendaAdminAset');
    Route::get('/admin_aset/agenda/{id}/edit', [AdminAsetController::class, 'editAgenda'])->name('editAgendaAdminAset');
    Route::put('/admin_aset/agenda/{id}', [AdminAsetController::class, 'updateAgenda'])->name('updateAgendaAdminAset');
    Route::delete('/admin_aset/agenda/{id}', [AdminAsetController::class, 'destroyAgenda'])->name('deleteAgendaAdminAset');

    // Arsip
    Route::get('/admin_aset/arsip', [AdminAsetController::class, 'indexArsip'])->name('arsipAdminAset');
    Route::get('/admin_aset/arsip/create', [AdminAsetController::class, 'createArsip'])->name('createArsipAdminAset');
    Route::post('/admin_aset/arsip/store', [AdminAsetController::class, 'storeArsip'])->name('storeArsipAdminAset');
    Route::get('/admin_aset/arsip/{id}/edit', [AdminAsetController::class, 'editArsip'])->name('editArsipAdminAset');
    Route::put('/admin_aset/arsip/{id}', [AdminAsetController::class, 'updateArsip'])->name('updateArsipAdminAset');
    
    // Dokumentasi
    Route::get('/admin_aset/dokumentasi', [AdminAsetController::class, 'indexDokumentasi'])->name('dokumentasiAdminAset');
    Route::get('/admin_aset/dokumentasi/create', [AdminAsetController::class, 'createDokumentasi'])->name('createDokumentasiAdminAset');
    Route::post('/admin_aset/dokumentasi/store', [AdminAsetController::class, 'storeDokumentasi'])->name('storeDokumentasiAdminAset');
    Route::get('admin_aset/dokumentasi/{id}', [AdminAsetController::class, 'showDokumentasi'])->name('showDokumentasiAdminAset');
    Route::get('/admin_aset/dokumentasi/{id}/edit', [AdminAsetController::class, 'editDokumentasi'])->name('editDokumentasiAdminAset');
    Route::put('/admin_aset/dokumentasi/{id}', [AdminAsetController::class, 'updateDokumentasi'])->name('updateDokumentasiAdminAset');
    Route::delete('/admin_aset/dokumentasi/{id}', [AdminAsetController::class, 'destroyDokumentasi'])->name('deleteDokumentasiAdminAset');

    // Berkas
    Route::get('/admin_aset/peraturan', [AdminAsetController::class, 'peraturanIndex'])->name('peraturanAdminAset');
    Route::get('/admin_aset/apbd', [AdminAsetController::class, 'apbdIndex'])->name('apbdAdminAset');
    Route::get('/admin_aset/keuangan', [AdminAsetController::class, 'keuanganIndex'])->name('keuanganAdminAset');
    Route::get('/admin_aset/slide', [AdminAsetController::class, 'slideIndex'])->name('slideAdminAset');
    Route::get('/admin_aset/lainnya', [AdminAsetController::class, 'lainnyaIndex'])->name('lainnyaAdminAset');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('dashboardStaff');

    // Agenda
    Route::get('/staff/agenda', [StaffController::class, 'indexAgenda'])->name('agendaStaff');
    Route::put('/staff/agenda/{id}', [StaffController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaStaff');

    // Laporan
    Route::get('/staff/laporan/{id}/upload', [StaffController::class, 'uploadLaporan'])->name('uploadLaporanStaff');
    Route::put('/staff/laporan/{id}', [StaffController::class, 'storeLaporan'])->name('storeLaporanStaff');

    // Arsip
    Route::get('/staff/arsip', [StaffController::class, 'indexArsip'])->name('arsipStaff');
    Route::get('/staff/arsip/create', [StaffController::class, 'createArsip'])->name('createArsipStaff');
    Route::post('/staff/arsip/store', [StaffController::class, 'storeArsip'])->name('storeArsipStaff');
    Route::get('/staff/arsip/{id}/edit', [StaffController::class, 'editArsip'])->name('editArsipStaff');
    Route::put('/staff/arsip/{id}', [StaffController::class, 'updateArsip'])->name('updateArsipStaff');

    // Berkas
    Route::get('/staff/peraturan', [StaffController::class, 'peraturanIndex'])->name('peraturanStaff');
    Route::get('/staff/apbd', [StaffController::class, 'apbdIndex'])->name('apbdStaff');
    Route::get('/staff/keuangan', [StaffController::class, 'keuanganIndex'])->name('keuanganStaff');
    Route::get('/staff/slide', [StaffController::class, 'slideIndex'])->name('slideStaff');
    Route::get('/staff/lainnya', [StaffController::class, 'lainnyaIndex'])->name('lainnyaStaff');

    // Dokumentasi
    Route::get('/staff/dokumentasi', [StaffController::class, 'indexDokumentasi'])->name('dokumentasiStaff');
    Route::get('/staff/dokumentasi/create', [StaffController::class, 'createDokumentasi'])->name('createDokumentasiStaff');
    Route::post('/staff/dokumentasi/store', [StaffController::class, 'storeDokumentasi'])->name('storeDokumentasiStaff');
    Route::get('/staff/dokumentasi/{id}', [StaffController::class, 'showDokumentasi'])->name('showDokumentasiStaff');
    Route::get('/staff/dokumentasi/{id}/edit', [StaffController::class, 'editDokumentasi'])->name('editDokumentasiStaff');
    Route::put('/staff/dokumentasi/{id}', [StaffController::class, 'updateDokumentasi'])->name('updateDokumentasiStaff');
    Route::delete('/staff/dokumentasi/{id}', [StaffController::class, 'destroyDokumentasi'])->name('deleteDokumentasiStaff');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});