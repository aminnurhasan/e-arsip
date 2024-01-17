<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\KepalaBadanController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\BidangAnggaranController;
use App\Http\Controllers\BidangPerbendaharaanController;
use App\Http\Controllers\BidangAkuntansiController;
use App\Http\Controllers\BidangAsetController;

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
Route::middleware(['auth', 'hak_akses:8'])->group(function () {
    
});

// Hak Akses Subbag Keuangan
Route::middleware(['auth', 'hak_akses:9'])->group(function () {
    
});

// Hak Akses Subbag Umum dan Kepegawaian
Route::middleware(['auth', 'hak_akses:10'])->group(function () {
    
});

// Hak Akses Subbid Anggaran Pendapatan dan Pembiayaan
Route::middleware(['auth', 'hak_akses:11'])->group(function () {
    
});

// Hak Akses Subbid Anggaran Belanja
Route::middleware(['auth', 'hak_akses:12'])->group(function () {
    
});

// Hak Akses Subbid Pengelolaan Kas
Route::middleware(['auth', 'hak_akses:13'])->group(function () {
    
});

// Hak Akses Subbid Administrasi Perbendaharaan
Route::middleware(['auth', 'hak_akses:14'])->group(function () {
    
});

// Hak Akses Subbid Pembukuan dan Pelaporan
Route::middleware(['auth', 'hak_akses:15'])->group(function () {
    
});

// Hak Akses Subbid Verifikasi
Route::middleware(['auth', 'hak_akses:16'])->group(function () {
    
});

// Hak Akses Subbid Perencanaan dan Penatausahaan
Route::middleware(['auth', 'hak_akses:17'])->group(function () {
    
});

// Hak Akses Subbid Penggunaan dan Pemanfaatan
Route::middleware(['auth', 'hak_akses:18'])->group(function () {
    
});

// Hak Akses Admin Sekretaris
Route::middleware(['auth', 'hak_akses:19'])->group(function () {
    
});

// Hak Akses Admin Bidang Anggaran
Route::middleware(['auth', 'hak_akses:20'])->group(function () {
    
});

// Hak Akses Admin Bidang Perbendaharaan
Route::middleware(['auth', 'hak_akses:21'])->group(function () {
    
});

// Hak Akses Admin Bidang Akuntansi
Route::middleware(['auth', 'hak_akses:22'])->group(function () {
    
});

// Hak Akses Admin Bidang Aset
Route::middleware(['auth', 'hak_akses:23'])->group(function () {
    
});







