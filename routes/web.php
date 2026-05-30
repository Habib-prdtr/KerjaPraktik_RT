<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\KegiatanRtController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// ======================================================
// AUTH ROUTES (Guest only)
// ======================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout (butuh auth)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ======================================================
// ADMIN ROUTES (Hanya role: admin)
// ======================================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // Kartu Keluarga
    Route::resource('kartu-keluarga', KartuKeluargaController::class);

    // Warga
    Route::resource('warga', WargaController::class);

    // Surat (admin hanya lihat & update status)
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/{surat}', [SuratController::class, 'show'])->name('surat.show');
    Route::patch('/surat/{surat}/status', [SuratController::class, 'updateStatus'])->name('surat.update-status');

    // Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/tanggapi', [PengaduanController::class, 'tanggapi'])->name('pengaduan.tanggapi');

    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class);

    // Kegiatan RT
    Route::resource('kegiatan', KegiatanRtController::class);

    // Manajemen User
    Route::resource('user', UserController::class);
});

// ======================================================
// WARGA ROUTES (Hanya user yang sudah login)
// ======================================================
Route::middleware(['auth', 'is_warga'])->prefix('warga')->name('warga.')->group(function () {

    // Dashboard Warga
    Route::get('/dashboard', [DashboardController::class, 'wargaDashboard'])->name('dashboard');

    // Surat
    Route::get('/surat', [SuratController::class, 'mySurat'])->name('surat.index');
    Route::get('/surat/buat', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{surat}', [SuratController::class, 'showMySurat'])->name('surat.show');
    Route::delete('/surat/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');

    // Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'myPengaduan'])->name('pengaduan.index');
    Route::get('/pengaduan/buat', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'showMyPengaduan'])->name('pengaduan.show');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

    // Pengumuman (read only)
    Route::get('/pengumuman', [PengumumanController::class, 'listWarga'])->name('pengumuman.index');
    Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'showWarga'])->name('pengumuman.show');

    // Kegiatan RT (read only)
    Route::get('/kegiatan', [KegiatanRtController::class, 'listWarga'])->name('kegiatan.index');
    Route::get('/kegiatan/{kegiatan}', [KegiatanRtController::class, 'showWarga'])->name('kegiatan.show');
});

// ======================================================
// PROFIL (Semua user yang login)
// ======================================================
Route::middleware('auth')->group(function () {
    Route::get('/profil', [UserController::class, 'profile'])->name('profile');
    Route::patch('/profil', [UserController::class, 'updateProfile'])->name('profile.update');
});

// ======================================================
// ROOT — redirect ke login
// ======================================================
Route::get('/', function () {
    return redirect()->route('login');
});
