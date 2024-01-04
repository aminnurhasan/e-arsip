<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminDashboardController;

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
Route::middleware(['auth', 'hak_akses:1'])->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboardSuperAdmin');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Hak Akses Kepala Badan
Route::middleware(['auth', 'hak_akses:2'])->group(function () {
    
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







