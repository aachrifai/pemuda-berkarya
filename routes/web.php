<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\PemudaController;
use App\Http\Controllers\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN DEPAN (PUBLIK) ---
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/daftar-pemuda', [PublicController::class, 'simpanPemuda'])->name('pemuda.store');
Route::get('/semua-agenda', [PublicController::class, 'semuaKegiatan'])->name('public.kegiatan.semua');

// Kirim Aspirasi (Publik)
Route::post('/kirim-aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');

// Detail Kegiatan & Daftar (Publik)
Route::get('/agenda/{id}', [PublicController::class, 'detailKegiatan'])->name('public.kegiatan.detail');
Route::post('/agenda/{id}/daftar', [PublicController::class, 'daftarKegiatan'])->name('public.kegiatan.daftar');

// --- DASHBOARD ADMIN ---
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- AREA KHUSUS ADMIN (LOGIN REQUIRED) ---
Route::middleware('auth')->group(function () {
    
    // 1. Profil Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. MANAJEMEN SLIDER / GAMBAR DEPAN
    Route::get('/admin/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/admin/slider', [SliderController::class, 'store'])->name('slider.store');
    Route::delete('/admin/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

    // 3. MANAJEMEN DATA PEMUDA / ANGGOTA
    Route::get('/admin/pemuda', [PemudaController::class, 'index'])->name('admin.pemuda.index');
    Route::get('/admin/pemuda/{id}/edit', [PemudaController::class, 'edit'])->name('admin.pemuda.edit');
    Route::put('/admin/pemuda/{id}', [PemudaController::class, 'update'])->name('admin.pemuda.update');
    Route::delete('/admin/pemuda/{id}', [PemudaController::class, 'destroy'])->name('admin.pemuda.destroy');

    // 4. MANAJEMEN KEGIATAN
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/tambah', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
    
    // Aksi Kegiatan (Edit, Update, Hapus, Lihat Peserta, PDF)
    Route::get('/kegiatan/{id}/peserta', [KegiatanController::class, 'lihatPeserta'])->name('kegiatan.peserta');
    Route::get('/kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    
    // Route Cetak PDF (Disini posisinya agar rapi)
    Route::get('/kegiatan/{id}/cetak-pdf', [KegiatanController::class, 'cetakPdf'])->name('kegiatan.pdf');

    // 5. MANAJEMEN ASPIRASI
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::delete('/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');

});

require __DIR__.'/auth.php';