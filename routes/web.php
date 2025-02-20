<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanggapanController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login'); //mengarahkan langsung ke halaman login
});

// Routing bagian admin.
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Route untuk Tanggapan
    Route::get('tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
    Route::get('tanggapan/detail/{param}', [TanggapanController::class, 'detail'])->name('tanggapan.detail');
    Route::post('tanggapan', [TanggapanController::class, 'store'])->name('tanggapan.store');
});

// Routing bagian user.

Route::prefix('user')->middleware('auth')->group(function(){

    // route untuk dashboard user
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard.user');

    // route untuk index laporan saya
    Route::get('pengaduan-saya', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('buat-pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('pengaduan/detail/{param}', [PengaduanController::class, 'detail'])->name('pengaduan.detail');


});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
