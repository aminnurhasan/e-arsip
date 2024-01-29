<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\KepalaBadanController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SubbagController;
use App\Http\Controllers\KabidController;
use App\Http\Controllers\SubbidController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Hak Akses Super Admin
Route::middleware(['auth', 'superAdmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboardSuperAdmin');

    // User
    Route::get('/superadmin/user', [SuperAdminController::class, 'indexUser'])->name('userSuperAdmin');
    Route::get('/superadmin/user/status/{id}', [SuperAdminController::class, 'status'])->name('statusUserSuperAdmin');
    Route::get('/superadmin/user/create', [SuperAdminController::class, 'createUser'])->name('createUserSuperAdmin');
    Route::post('/superadmin/user/store', [SuperAdminController::class, 'storeUser'])->name('storeUserSuperAdmin');
    Route::get('/superadmin/user/{id}/edit', [SuperAdminController::class, 'editUser'])->name('editUserSuperAdmin');
    Route::put('/superadmin/user/{id}', [SuperAdminController::class, 'updateUser'])->name('updateUserSuperAdmin');

    // Agenda
    Route::get('/superadmin/agenda', [SuperAdminController::class, 'indexAgenda'])->name('agendaSuperAdmin');
    Route::get('/superadmin/agenda/disposisi', [SuperAdminController::class, 'disposisiAgenda'])->name('disposisiAgendaSuperAdmin');
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
    Route::get('/superadmin/suratmasuk', [SuperAdminController::class, 'suratMasukIndex'])->name('suratMasukSuperAdmin');

    // Ganti Password
    Route::get('/superadmin/gantipassword', [SuperAdminController::class, 'gantiPassword'])->name('gantiPasswordSuperAdmin');
    Route::put('/superadmin/gantipassword/{id}', [SuperAdminController::class, 'updatePassword'])->name('updatePasswordSuperAdmin');

    // Filter Arsip
    Route::get('/superadmin/filterperaturan', [SuperAdminController::class, 'peraturanFilter'])->name('filterPeraturanSuperAdmin');
    Route::get('/superadmin/filterapbd', [SuperAdminController::class, 'apbdFilter'])->name('filterApbdSuperAdmin');
    Route::get('/superadmin/filterkeuangan', [SuperAdminController::class, 'keuanganFilter'])->name('filterKeuanganSuperAdmin');
    Route::get('/superadmin/filterslide', [SuperAdminController::class, 'slideFilter'])->name('filterSlideSuperAdmin');
    Route::get('/superadmin/filterlainnya', [SuperAdminController::class, 'lainnyaFilter'])->name('filterLainnyaSuperAdmin');
    Route::get('/superadmin/filtersuratmasuk', [SuperAdminController::class, 'suratMasukFilter'])->name('filterSuratMasukSuperAdmin');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Kepala Badan
Route::middleware(['auth', 'kepalaBadan'])->group(function () {
    Route::get('/kepalabadan/dashboard', [KepalaBadanController::class, 'dashboard'])->name('dashboardKepalaBadan');

    // Agenda
    Route::get('/kepalabadan/agenda', [KepalaBadanController::class, 'indexAgenda'])->name('agendaKepalaBadan');
    Route::get('/kepalabadan/agenda/{id}/disposisi', [KepalaBadanController::class, 'disposisiAgenda'])->name('disposisiAgendaKepalaBadan');
    Route::put('/kepalabadan/agenda/{id}', [KepalaBadanController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaKepalaBadan');
    Route::get('/kepalabadan/agenda/tindaklanjut/{id}', [KepalaBadanController::class, 'tindakLanjut'])->name('tindakLanjutKepalaBadan');
    Route::put('/kepalabadan/agenda/tindaklanjut/{id}', [KepalaBadanController::class, 'storeTindakLanjut'])->name('storeTindakLanjutKepalaBadan');
    Route::get('/kepalabadan/agenda/saya', [KepalaBadanController::class, 'indexAgendaSaya'])->name('agendaSayaKepalaBadan');

    // Laporan
    Route::get('/kepalabadan/laporan/{id}/upload', [KepalaBadanController::class, 'uploadLaporan'])->name('uploadLaporanKepalaBadan');
    Route::put('/kepalabadan/laporan/{id}', [KepalaBadanController::class, 'storeLaporan'])->name('storeLaporanKepalaBadan');

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
    Route::get('/kepalabadan/suratmasuk', [KepalaBadanController::class, 'suratMasukIndex'])->name('suratMasukKepalaBadan');

    // Dokumentasi
    Route::get('/kepalabadan/dokumentasi', [KepalaBadanController::class, 'indexDokumentasi'])->name('dokumentasiKepalaBadan');
    Route::get('/kepalabadan/dokumentasi/create', [KepalaBadanController::class, 'createDokumentasi'])->name('createDokumentasiKepalaBadan');
    Route::post('/kepalabadan/dokumentasi/store', [KepalaBadanController::class, 'storeDokumentasi'])->name('storeDokumentasiKepalaBadan');
    Route::get('kepalabadan/dokumentasi/{id}', [KepalaBadanController::class, 'showDokumentasi'])->name('showDokumentasiKepalaBadan');
    Route::get('/kepalabadan/dokumentasi/{id}/edit', [KepalaBadanController::class, 'editDokumentasi'])->name('editDokumentasiKepalaBadan');
    Route::put('/kepalabadan/dokumentasi/{id}', [KepalaBadanController::class, 'updateDokumentasi'])->name('updateDokumentasiKepalaBadan');
    Route::delete('/kepalabadan/dokumentasi/{id}', [KepalaBadanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiKepalaBadan');

    // Ganti Password
    Route::get('/kepalabadan/gantipassword', [KepalaBadanController::class, 'gantiPassword'])->name('gantiPasswordKepalaBadan');
    Route::put('/kepalabadan/gantipassword/{id}', [KepalaBadanController::class, 'updatePassword'])->name('updatePasswordKepalaBadan');

    // Filter Arsip
    Route::get('/kepalabadan/filterperaturan', [KepalaBadanController::class, 'peraturanFilter'])->name('filterPeraturanKepalaBadan');
    Route::get('/kepalabadan/filterapbd', [KepalaBadanController::class, 'apbdFilter'])->name('filterApbdKepalaBadan');
    Route::get('/kepalabadan/filterkeuangan', [KepalaBadanController::class, 'keuanganFilter'])->name('filterKeuanganKepalaBadan');
    Route::get('/kepalabadan/filterslide', [KepalaBadanController::class, 'slideFilter'])->name('filterSlideKepalaBadan');
    Route::get('/kepalabadan/filterlainnya', [KepalaBadanController::class, 'lainnyaFilter'])->name('filterLainnyaKepalaBadan');
    Route::get('/kepalabadan/filtersuratmasuk', [KepalaBadanController::class, 'suratMasukFilter'])->name('filterSuratMasukKepalaBadan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Sekretaris
Route::middleware(['auth', 'sekretaris'])->group(function () {
    Route::get('/sekretaris/dashboard', [SekretarisController::class, 'dashboard'])->name('dashboardSekretaris');

    // Agenda
    Route::get('/sekretaris/agenda', [SekretarisController::class, 'indexAgenda'])->name('agendaSekretaris');
    Route::get('/sekretaris/agenda/{id}/disposisi', [SekretarisController::class, 'disposisiAgenda'])->name('disposisiAgendaSekretaris');
    Route::put('/sekretaris/agenda/{id}', [SekretarisController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSekretaris');
    Route::get('/sekretaris/agenda/tindaklanjut/{id}', [SekretarisController::class, 'tindakLanjut'])->name('tindakLanjutSekretaris');
    Route::put('/sekretaris/agenda/tindaklanjut/{id}', [SekretarisController::class, 'tindakLanjutStore'])->name('storeTindakLanjutSekretaris');
    Route::get('/sekretaris/agenda/saya', [SekretarisController::class, 'indexAgendaSaya'])->name('agendaSayaSekretaris');
    Route::get('/sekretaris/agenda/selesaikan/{id}', [SekretarisController::class, 'selesaikan'])->name('selesaikanAgendaSekretaris');

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
    Route::get('/sekretaris/suratmasuk', [SekretarisController::class, 'suratMasukIndex'])->name('suratMasukSekretaris');

    // Dokumentasi
    Route::get('/sekretaris/dokumentasi', [SekretarisController::class, 'indexDokumentasi'])->name('dokumentasiSekretaris');
    Route::get('/sekretaris/dokumentasi/create', [SekretarisController::class, 'createDokumentasi'])->name('createDokumentasiSekretaris');
    Route::post('/sekretaris/dokumentasi/store', [SekretarisController::class, 'storeDokumentasi'])->name('storeDokumentasiSekretaris');
    Route::get('/sekretaris/dokumentasi/{id}', [SekretarisController::class, 'showDokumentasi'])->name('showDokumentasiSekretaris');
    Route::get('/sekretaris/dokumentasi/{id}/edit', [SekretarisController::class, 'editDokumentasi'])->name('editDokumentasiSekretaris');
    Route::put('/sekretaris/dokumentasi/{id}', [SekretarisController::class, 'updateDokumentasi'])->name('updateDokumentasiSekretaris');
    Route::delete('/sekretaris/dokumentasi/{id}', [SekretarisController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSekretaris');

    // Ganti Password
    Route::get('/sekretaris/gantipassword', [SekretarisController::class, 'gantiPassword'])->name('gantiPasswordSekretaris');
    Route::put('/sekretaris/gantipassword/{id}', [SekretarisController::class, 'updatePassword'])->name('updatePasswordSekretaris');

    // Filter Arsip
    Route::get('/sekretaris/filterperaturan', [SekretarisController::class, 'peraturanFilter'])->name('filterPeraturanSekretaris');
    Route::get('/sekretaris/filterapbd', [SekretarisController::class, 'apbdFilter'])->name('filterApbdSekretaris');
    Route::get('/sekretaris/filterkeuangan', [SekretarisController::class, 'keuanganFilter'])->name('filterKeuanganSekretaris');
    Route::get('/sekretaris/filterslide', [SekretarisController::class, 'slideFilter'])->name('filterSlideSekretaris');
    Route::get('/sekretaris/filterlainnya', [SekretarisController::class, 'lainnyaFilter'])->name('filterLainnyaSekretaris');
    Route::get('/sekretaris/filtersuratmasuk', [SekretarisController::class, 'suratMasukFilter'])->name('filterSuratMasukSekretaris');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Kabid
Route::middleware(['auth', 'kabid'])->group(function () {
    Route::get('/kabid/dashboard', [KabidController::class, 'dashboard'])->name('dashboardKabid');

    // Agenda
    Route::get('/kabid/agenda', [KabidController::class, 'indexAgenda'])->name('agendaKabid');
    Route::get('/kabid/agenda/{id}/disposisi', [KabidController::class, 'disposisiAgenda'])->name('disposisiAgendaKabid');
    Route::put('/kabid/agenda/{id}', [KabidController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaKabid');
    Route::get('/kabid/agenda/tindaklanjut/{id}', [KabidController::class, 'tindakLanjut'])->name('tindakLanjutKabid');
    Route::put('/kabid/agenda/tindaklanjut/{id}', [KabidController::class, 'storeTindakLanjut'])->name('storeTindakLanjutKabid');
    Route::get('/kabid/agenda/saya', [KabidController::class, 'indexAgendaSaya'])->name('agendaSayaKabid');
    Route::get('/kabid/agenda/selesaikan/{id}', [KabidController::class, 'selesaikan'])->name('selesaikanAgendaKabid');

    // Laporan
    Route::get('/kabid/laporan/{id}/upload', [KabidController::class, 'uploadLaporan'])->name('uploadLaporanKabid');
    Route::put('/kabid/laporan/{id}', [KabidController::class, 'storeLaporan'])->name('storeLaporanKabid');

    // Disposisi
    Route::get('/kabid/disposisi', [KabidController::class, 'indexDisposisi'])->name('disposisiKabid');

    // Arsip
    Route::get('/kabid/arsip', [KabidController::class, 'indexArsip'])->name('arsipKabid');
    Route::get('/kabid/arsip/create', [KabidController::class, 'createArsip'])->name('createArsipKabid');
    Route::post('/kabid/arsip/store', [KabidController::class, 'storeArsip'])->name('storeArsipKabid');
    Route::get('/kabid/arsip/{id}/edit', [KabidController::class, 'editArsip'])->name('editArsipKabid');
    Route::put('/kabid/arsip/{id}', [KabidController::class, 'updateArsip'])->name('updateArsipKabid');

    // Berkas
    Route::get('/kabid/peraturan', [KabidController::class, 'peraturanIndex'])->name('peraturanKabid');
    Route::get('/kabid/apbd', [KabidController::class, 'apbdIndex'])->name('apbdKabid');
    Route::get('/kabid/keuangan', [KabidController::class, 'keuanganIndex'])->name('keuanganKabid');
    Route::get('/kabid/slide', [KabidController::class, 'slideIndex'])->name('slideKabid');
    Route::get('/kabid/lainnya', [KabidController::class, 'lainnyaIndex'])->name('lainnyaKabid');
    Route::get('/kabid/suratmasuk', [KabidController::class, 'suratMasukIndex'])->name('suratMasukKabid');

    // Dokumentasi
    Route::get('/kabid/dokumentasi', [KabidController::class, 'indexDokumentasi'])->name('dokumentasiKabid');
    Route::get('/kabid/dokumentasi/create', [KabidController::class, 'createDokumentasi'])->name('createDokumentasiKabid');
    Route::post('/kabid/dokumentasi/store', [KabidController::class, 'storeDokumentasi'])->name('storeDokumentasiKabid');
    Route::get('/kabid/dokumentasi/{id}', [KabidController::class, 'showDokumentasi'])->name('showDokumentasiKabid');
    Route::get('/kabid/dokumentasi/{id}/edit', [KabidController::class, 'editDokumentasi'])->name('editDokumentasiKabid');
    Route::put('/kabid/dokumentasi/{id}', [KabidController::class, 'updateDokumentasi'])->name('updateDokumentasiKabid');
    Route::delete('/kabid/dokumentasi/{id}', [KabidController::class, 'destroyDokumentasi'])->name('deleteDokumentasiKabid');

    // Ganti Password
    Route::get('/kabid/gantipassword', [KabidController::class, 'gantiPassword'])->name('gantiPasswordKabid');
    Route::put('/kabid/gantipassword/{id}', [KabidController::class, 'updatePassword'])->name('updatePasswordKabid');

    // Filter Arsip
    Route::get('/kabid/filterperaturan', [KabidController::class, 'peraturanFilter'])->name('filterPeraturanKabid');
    Route::get('/kabid/filterapbd', [KabidController::class, 'apbdFilter'])->name('filterApbdKabid');
    Route::get('/kabid/filterkeuangan', [KabidController::class, 'keuanganFilter'])->name('filterKeuanganKabid');
    Route::get('/kabid/filterslide', [KabidController::class, 'slideFilter'])->name('filterSlideKabid');
    Route::get('/kabid/filterlainnya', [KabidController::class, 'lainnyaFilter'])->name('filterLainnyaKabid');
    Route::get('/kabid/filtersuratmasuk', [KabidController::class, 'suratMasukFilter'])->name('filterSuratMasukKabid');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbag
Route::middleware(['auth', 'subbag'])->group(function () {
    Route::get('/subbag/dashboard', [SubbagController::class, 'dashboard'])->name('dashboardSubbag');

    // Agenda
    Route::get('/subbag/agenda', [SubbagController::class, 'indexAgenda'])->name('agendaSubbag');
    Route::get('/subbag/agenda/{id}/disposisi', [SubbagController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbag');
    Route::put('/subbag/agenda/{id}', [SubbagController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbag');
    Route::get('/subbag/agenda/tindaklanjut/{id}', [SubbagController::class, 'tindakLanjut'])->name('tindakLanjutSubbag');
    Route::put('/subbag/agenda/tindaklanjut/{id}', [SubbagController::class, 'storeTindakLanjut'])->name('storeTindakLanjutSubbag');
    Route::get('/subbag/agenda/saya', [SubbagController::class, 'indexAgendaSaya'])->name('agendaSayaSubbag');
    Route::get('/subbag/agenda/selesaikan/{id}', [SubbagController::class, 'selesaikan'])->name('selesaikanAgendaSubbag');

    // Laporan
    Route::get('/subbag/laporan/{id}/upload', [SubbagController::class, 'uploadLaporan'])->name('uploadLaporanSubbag');
    Route::put('/subbag/laporan/{id}', [SubbagController::class, 'storeLaporan'])->name('storeLaporanSubbag');

    // Disposisi
    Route::get('/subbag/disposisi', [SubbagController::class, 'indexDisposisi'])->name('disposisiSubbag');

    // Arsip
    Route::get('/subbag/arsip', [SubbagController::class, 'indexArsip'])->name('arsipSubbag');
    Route::get('/subbag/arsip/create', [SubbagController::class, 'createArsip'])->name('createArsipSubbag');
    Route::post('/subbag/arsip/store', [SubbagController::class, 'storeArsip'])->name('storeArsipSubbag');
    Route::get('/subbag/arsip/{id}/edit', [SubbagController::class, 'editArsip'])->name('editArsipSubbag');
    Route::put('/subbag/arsip/{id}', [SubbagController::class, 'updateArsip'])->name('updateArsipSubbag');

    // Berkas
    Route::get('/subbag/peraturan', [SubbagController::class, 'peraturanIndex'])->name('peraturanSubbag');
    Route::get('/subbag/apbd', [SubbagController::class, 'apbdIndex'])->name('apbdSubbag');
    Route::get('/subbag/keuangan', [SubbagController::class, 'keuanganIndex'])->name('keuanganSubbag');
    Route::get('/subbag/slide', [SubbagController::class, 'slideIndex'])->name('slideSubbag');
    Route::get('/subbag/lainnya', [SubbagController::class, 'lainnyaIndex'])->name('lainnyaSubbag');
    Route::get('/subbag/suratmasuk', [SubbagController::class, 'suratMasukIndex'])->name('suratMasukSubbag');

    // Dokumentasi
    Route::get('/subbag/dokumentasi', [SubbagController::class, 'indexDokumentasi'])->name('dokumentasiSubbag');
    Route::get('/subbag/dokumentasi/create', [SubbagController::class, 'createDokumentasi'])->name('createDokumentasiSubbag');
    Route::post('/subbag/dokumentasi/store', [SubbagController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbag');
    Route::get('/subbag/dokumentasi/{id}', [SubbagController::class, 'showDokumentasi'])->name('showDokumentasiSubbag');
    Route::get('/subbag/dokumentasi/{id}/edit', [SubbagController::class, 'editDokumentasi'])->name('editDokumentasiSubbag');
    Route::put('/subbag/dokumentasi/{id}', [SubbagController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbag');
    Route::delete('/subbag/dokumentasi/{id}', [SubbagController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbag');

    // Ganti Password
    Route::get('/subbag/gantipassword', [SubbagController::class, 'gantiPassword'])->name('gantiPasswordSubbag');
    Route::put('/subbag/gantipassword/{id}', [SubbagController::class, 'updatePassword'])->name('updatePasswordSubbag');

    // Filter Arsip
    Route::get('/subbag/filterperaturan', [SubbagController::class, 'peraturanFilter'])->name('filterPeraturanSubbag');
    Route::get('/subbag/filterapbd', [SubbagController::class, 'apbdFilter'])->name('filterApbdSubbag');
    Route::get('/subbag/filterkeuangan', [SubbagController::class, 'keuanganFilter'])->name('filterKeuanganSubbag');
    Route::get('/subbag/filterslide', [SubbagController::class, 'slideFilter'])->name('filterSlideSubbag');
    Route::get('/subbag/filterlainnya', [SubbagController::class, 'lainnyaFilter'])->name('filterLainnyaSubbag');
    Route::get('/subbag/filtersuratmasuk', [SubbagController::class, 'suratMasukFilter'])->name('filterSuratMasukSubbag');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Subbid
Route::middleware(['auth', 'subbid'])->group(function () {
    Route::get('/subbid/dashboard', [SubbidController::class, 'dashboard'])->name('dashboardSubbid');

    // Agenda
    Route::get('/subbid/agenda', [SubbidController::class, 'indexAgenda'])->name('agendaSubbid');
    Route::get('/subbid/agenda/{id}/disposisi', [SubbidController::class, 'disposisiAgenda'])->name('disposisiAgendaSubbid');
    Route::put('/subbid/agenda/{id}', [SubbidController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaSubbid');
    Route::get('/subbid/agenda/tindaklanjut/{id}', [SubbidController::class, 'tindakLanjut'])->name('tindakLanjutSubbid');
    Route::put('/subbid/agenda/tindaklanjut/{id}', [SubbidController::class, 'storeTindakLanjut'])->name('storeTindakLanjutSubbid');
    Route::get('/subbid/agenda/saya', [SubbidController::class, 'indexAgendaSaya'])->name('agendaSayaSubbid');
    Route::get('/subbid/agenda/selesaikan/{id}', [SubbidController::class, 'selesaikan'])->name('selesaikanAgendaSubbid');

    // Laporan
    Route::get('/subbid/laporan/{id}/upload', [SubbidController::class, 'uploadLaporan'])->name('uploadLaporanSubbid');
    Route::put('/subbid/laporan/{id}', [SubbidController::class, 'storeLaporan'])->name('storeLaporanSubbid');

    // Disposisi
    Route::get('/subbid/disposisi', [SubbidController::class, 'indexDisposisi'])->name('disposisiSubbid');

    // Arsip
    Route::get('/subbid/arsip', [SubbidController::class, 'indexArsip'])->name('arsipSubbid');
    Route::get('/subbid/arsip/create', [SubbidController::class, 'createArsip'])->name('createArsipSubbid');
    Route::post('/subbid/arsip/store', [SubbidController::class, 'storeArsip'])->name('storeArsipSubbid');
    Route::get('/subbid/arsip/{id}/edit', [SubbidController::class, 'editArsip'])->name('editArsipSubbid');
    Route::put('/subbid/arsip/{id}', [SubbidController::class, 'updateArsip'])->name('updateArsipSubbid');

    // Berkas
    Route::get('/subbid/peraturan', [SubbidController::class, 'peraturanIndex'])->name('peraturanSubbid');
    Route::get('/subbid/apbd', [SubbidController::class, 'apbdIndex'])->name('apbdSubbid');
    Route::get('/subbid/keuangan', [SubbidController::class, 'keuanganIndex'])->name('keuanganSubbid');
    Route::get('/subbid/slide', [SubbidController::class, 'slideIndex'])->name('slideSubbid');
    Route::get('/subbid/lainnya', [SubbidController::class, 'lainnyaIndex'])->name('lainnyaSubbid');
    Route::get('/subbid/suratmasuk', [SubbidController::class, 'suratMasukIndex'])->name('suratMasukSubbid');

    // Dokumentasi
    Route::get('/subbid/dokumentasi', [SubbidController::class, 'indexDokumentasi'])->name('dokumentasiSubbid');
    Route::get('/subbid/dokumentasi/create', [SubbidController::class, 'createDokumentasi'])->name('createDokumentasiSubbid');
    Route::post('/subbid/dokumentasi/store', [SubbidController::class, 'storeDokumentasi'])->name('storeDokumentasiSubbid');
    Route::get('/subbid/dokumentasi/{id}', [SubbidController::class, 'showDokumentasi'])->name('showDokumentasiSubbid');
    Route::get('/subbid/dokumentasi/{id}/edit', [SubbidController::class, 'editDokumentasi'])->name('editDokumentasiSubbid');
    Route::put('/subbid/dokumentasi/{id}', [SubbidController::class, 'updateDokumentasi'])->name('updateDokumentasiSubbid');
    Route::delete('/subbid/dokumentasi/{id}', [SubbidController::class, 'destroyDokumentasi'])->name('deleteDokumentasiSubbid');

    // Ganti Password
    Route::get('/subbid/gantipassword', [SubbidController::class, 'gantiPassword'])->name('gantiPasswordSubbid');
    Route::put('/subbid/gantipassword/{id}', [SubbidController::class, 'updatePassword'])->name('updatePasswordSubbid');

    // Filter Arsip
    Route::get('/subbid/filterperaturan', [SubbidController::class, 'peraturanFilter'])->name('filterPeraturanSubbid');
    Route::get('/subbid/filterapbd', [SubbidController::class, 'apbdFilter'])->name('filterApbdSubbid');
    Route::get('/subbid/filterkeuangan', [SubbidController::class, 'keuanganFilter'])->name('filterKeuanganSubbid');
    Route::get('/subbid/filterslide', [SubbidController::class, 'slideFilter'])->name('filterSlideSubbid');
    Route::get('/subbid/filterlainnya', [SubbidController::class, 'lainnyaFilter'])->name('filterLainnyaSubbid');
    Route::get('/subbid/filtersuratmasuk', [SubbidController::class, 'suratMasukFilter'])->name('filterSuratMasukSubbid');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Admin Pembantu
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboardAdmin');

    // Staff
    Route::get('/admin/staff', [AdminController::class, 'indexStaff'])->name('staffAdmin');
    Route::get('/admin/staff/status/{id}', [AdminController::class, 'status'])->name('statusStaff');
    Route::get('/admin/staff/create', [AdminController::class, 'createStaff'])->name('createStaffAdmin');
    Route::post('/admin/staff/store', [AdminController::class, 'storeStaff'])->name('storeStaffAdmin');
    Route::get('/admin/staff/{id}/edit', [AdminController::class, 'editStaff'])->name('editStaffAdmin');
    Route::put('/admin/staff/{id}', [AdminController::class, 'updateStaff'])->name('updateStaffAdmin');

    // Agenda
    Route::get('/admin/agenda', [AdminController::class, 'indexAgenda'])->name('agendaAdmin');
    Route::get('/admin/agenda/disposisi', [AdminController::class, 'disposisiAgenda'])->name('disposisiAgendaAdmin');
    Route::get('/admin/agenda/create', [AdminController::class, 'createAgenda'])->name('createAgendaAdmin');
    Route::post('/admin/agenda/store', [AdminController::class, 'storeAgenda'])->name('storeAgendaAdmin');
    Route::get('/admin/agenda/{id}/edit', [AdminController::class, 'editAgenda'])->name('editAgendaAdmin');
    Route::put('/admin/agenda/{id}', [AdminController::class, 'updateAgenda'])->name('updateAgendaAdmin');
    Route::delete('/admin/agenda/{id}', [AdminController::class, 'destroyAgenda'])->name('deleteAgendaAdmin');

    // Arsip
    Route::get('/admin/arsip', [AdminController::class, 'indexArsip'])->name('arsipAdmin');
    Route::get('/admin/arsip/create', [AdminController::class, 'createArsip'])->name('createArsipAdmin');
    Route::post('/admin/arsip/store', [AdminController::class, 'storeArsip'])->name('storeArsipAdmin');
    Route::get('/admin/arsip/{id}/edit', [AdminController::class, 'editArsip'])->name('editArsipAdmin');
    Route::put('/admin/arsip/{id}', [AdminController::class, 'updateArsip'])->name('updateArsipAdmin');
    
    // Dokumentasi
    Route::get('/admin/dokumentasi', [AdminController::class, 'indexDokumentasi'])->name('dokumentasiAdmin');
    Route::get('/admin/dokumentasi/create', [AdminController::class, 'createDokumentasi'])->name('createDokumentasiAdmin');
    Route::post('/admin/dokumentasi/store', [AdminController::class, 'storeDokumentasi'])->name('storeDokumentasiAdmin');
    Route::get('admin/dokumentasi/{id}', [AdminController::class, 'showDokumentasi'])->name('showDokumentasiAdmin');
    Route::get('/admin/dokumentasi/{id}/edit', [AdminController::class, 'editDokumentasi'])->name('editDokumentasiAdmin');
    Route::put('/admin/dokumentasi/{id}', [AdminController::class, 'updateDokumentasi'])->name('updateDokumentasiAdmin');
    Route::delete('/admin/dokumentasi/{id}', [AdminController::class, 'destroyDokumentasi'])->name('deleteDokumentasiAdmin');

    // Berkas
    Route::get('/admin/peraturan', [AdminController::class, 'peraturanIndex'])->name('peraturanAdmin');
    Route::get('/admin/apbd', [AdminController::class, 'apbdIndex'])->name('apbdAdmin');
    Route::get('/admin/keuangan', [AdminController::class, 'keuanganIndex'])->name('keuanganAdmin');
    Route::get('/admin/slide', [AdminController::class, 'slideIndex'])->name('slideAdmin');
    Route::get('/admin/lainnya', [AdminController::class, 'lainnyaIndex'])->name('lainnyaAdmin');
    Route::get('/admin/suratmasuk', [AdminController::class, 'suratMasukIndex'])->name('suratMasukAdmin');

    // Ganti Password
    Route::get('/admin/gantipassword', [AdminController::class, 'gantiPassword'])->name('gantiPasswordAdmin');
    Route::put('/admin/gantipassword/{id}', [AdminController::class, 'updatePassword'])->name('updatePasswordAdmin');

    // Filter Arsip
    Route::get('/admin/filterperaturan', [AdminController::class, 'peraturanFilter'])->name('filterPeraturanAdmin');
    Route::get('/admin/filterapbd', [AdminController::class, 'apbdFilter'])->name('filterApbdAdmin');
    Route::get('/admin/filterkeuangan', [AdminController::class, 'keuanganFilter'])->name('filterKeuanganAdmin');
    Route::get('/admin/filterslide', [AdminController::class, 'slideFilter'])->name('filterSlideAdmin');
    Route::get('/admin/filterlainnya', [AdminController::class, 'lainnyaFilter'])->name('filterLainnyaAdmin');
    Route::get('/admin/filtersuratmasuk', [AdminController::class, 'suratMasukFilter'])->name('filterSuratMasukAdmin');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Staff
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('dashboardStaff');

    // Agenda
    Route::get('/staff/agenda', [StaffController::class, 'indexAgenda'])->name('agendaStaff');
    Route::put('/staff/agenda/{id}', [StaffController::class, 'storeDisposisiAgenda'])->name('updateDisposisiAgendaStaff');
    Route::get('/staff/agenda/tindaklanjut/{id}', [StaffController::class, 'tindakLanjut'])->name('tindakLanjutStaff');
    Route::put('/staff/agenda/tindaklanjut/{id}', [StaffController::class, 'storeTindakLanjut'])->name('storeTindakLanjutStaff');
    Route::get('/staff/agenda/saya', [StaffController::class, 'indexAgendaSaya'])->name('agendaSayaStaff');
    Route::get('/staff/agenda/selesaikan/{id}', [StaffController::class, 'selesaikan'])->name('selesaikanAgendaStaff');

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
    Route::get('/staff/suratmasuk', [StaffController::class, 'suratMasukIndex'])->name('suratMasukStaff');

    // Dokumentasi
    Route::get('/staff/dokumentasi', [StaffController::class, 'indexDokumentasi'])->name('dokumentasiStaff');
    Route::get('/staff/dokumentasi/create', [StaffController::class, 'createDokumentasi'])->name('createDokumentasiStaff');
    Route::post('/staff/dokumentasi/store', [StaffController::class, 'storeDokumentasi'])->name('storeDokumentasiStaff');
    Route::get('/staff/dokumentasi/{id}', [StaffController::class, 'showDokumentasi'])->name('showDokumentasiStaff');
    Route::get('/staff/dokumentasi/{id}/edit', [StaffController::class, 'editDokumentasi'])->name('editDokumentasiStaff');
    Route::put('/staff/dokumentasi/{id}', [StaffController::class, 'updateDokumentasi'])->name('updateDokumentasiStaff');
    Route::delete('/staff/dokumentasi/{id}', [StaffController::class, 'destroyDokumentasi'])->name('deleteDokumentasiStaff');

    // Ganti Password
    Route::get('/staff/gantipassword', [StaffController::class, 'gantiPassword'])->name('gantiPasswordStaff');
    Route::put('/staff/gantipassword/{id}', [StaffController::class, 'updatePassword'])->name('updatePasswordStaff');

    // Filter Arsip
    Route::get('/staff/filterperaturan', [StaffController::class, 'peraturanFilter'])->name('filterPeraturanStaff');
    Route::get('/staff/filterapbd', [StaffController::class, 'apbdFilter'])->name('filterApbdStaff');
    Route::get('/staff/filterkeuangan', [StaffController::class, 'keuanganFilter'])->name('filterKeuanganStaff');
    Route::get('/staff/filterslide', [StaffController::class, 'slideFilter'])->name('filterSlideStaff');
    Route::get('/staff/filterlainnya', [StaffController::class, 'lainnyaFilter'])->name('filterLainnyaStaff');
    Route::get('/staff/filtersuratmasuk', [StaffController::class, 'suratMasukFilter'])->name('filterSuratMasukStaff');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});