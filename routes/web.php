<?php

use Illuminate\Support\Facades\Route;

// Super Admin
use App\Http\Controllers\SuperAdminController;

// Kepala Badan
use App\Http\Controllers\KepalaBadanController;

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
    
    // Dokumentasi
    Route::get('/superadmin/dokumentasi', [SuperAdminController::class, 'indexDokumentasi'])->name('dokumentasiSuperAdmin');
    Route::get('/superadmin/dokumentasi/create', [SuperAdminController::class, 'createDokumentasi'])->name('createDokumentasiSuperAdmin');
    Route::post('/superadmin/dokumentasi/store', [SuperAdminController::class, 'storeDokumentasi'])->name('storeDokumentasiSuperAdmin');
    Route::get('superadmin/dokumentasi/{id}', [SuperAdminController::class, 'showDokumentasi'])->name('showDokumentasiSuperAdmin');
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
    Route::delete('/kepalabadan/dokumentasi/{id}', [KepalaBadanController::class, 'destroyDokumentasi'])->name('deleteDokumentasiKepalaBadan');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Sekretaris
Route::middleware(['auth', 'hak_akses:3'])->group(function () {
    
});

// Hak Akses Bidang Anggaran
Route::middleware(['auth', 'hak_akses:4'])->group(function () {
    
});

// Hak Akses Bidang Perbendaharaan
Route::middleware(['auth', 'hak_akses:5'])->group(function () {
    
});

// Hak Akses Bidang Akuntansi
Route::middleware(['auth', 'hak_akses:6'])->group(function () {
    
});

// Hak Akses Bidang Aset
Route::middleware(['auth', 'hak_akses:7'])->group(function () {
    
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







