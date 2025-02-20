<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login'); //mengarahkan langsung ke halaman login
});

// Routing bagian admin.
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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
