<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\PeriodeSeleksiController;



Route::get('/', [PeriodeSeleksiController::class, 'index'])->name('landing');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:ADMIN'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    
    Route::get('/pendaftar/{id}/edit', [AdminController::class, 'editJson'])->name('pendaftar.editJson');
    Route::get('/pendaftar/{id}/berkas', [AdminController::class, 'getBerkas'])->name('pendaftar.berkas');
    Route::put('/pendaftar/{id}/update', [AdminController::class, 'update'])->name('pendaftar.update');
    Route::post('/pendaftar/{id}/approve', [AdminController::class, 'approvePendaftar'])->name('approve');
    Route::delete('/pendaftar/{id}/reject', [AdminController::class, 'rejectPendaftar'])->name('reject');
    Route::delete('/pendaftar/{id}', [AdminController::class, 'destroy'])->name('delete');
    
     Route::post('/pendaftar/store', [AdminController::class, 'storePendaftar'])->name('pendaftar.store');

    
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/password', [AdminController::class, 'updatePassword'])->name('updatePassword');
    
    

Route::post('/store', [AdminController::class, 'store'])->name('store');
Route::get('/edit/{id}', [AdminController::class, 'editAdmin'])->name('edit');
Route::put('/admin/{id}/update', [AdminController::class, 'updateAdmin'])->name('updateAdmin'); 
Route::delete('/delete/{id}', [AdminController::class, 'destroyAdmin'])->name('delete'); 

    
    Route::post('/periode', [PeriodeSeleksiController::class, 'store'])->name('periode.store');
    Route::put('/periode/{id}', [PeriodeSeleksiController::class, 'update'])->name('periode.update');
    Route::delete('/periode/{id}', [PeriodeSeleksiController::class, 'destroy'])->name('periode.destroy');
    Route::post('/periode/{id}/activate', [PeriodeSeleksiController::class, 'activate'])->name('periode.activate');
    
    
    Route::prefix('seleksi')->name('seleksi.')->group(function () {
        Route::get('/', [SeleksiController::class, 'index'])->name('index');
        Route::post('/proses-otomatis', [SeleksiController::class, 'prosesSeleksiOtomatis'])->name('proses');
        
        
        Route::match(['POST', 'PUT'], '/{id}/update-status', [SeleksiController::class, 'updateStatus'])->name('updateStatus');
        
        Route::get('/export-pdf', [SeleksiController::class, 'exportPdf'])->name('pdf');
        Route::post('/reset', [SeleksiController::class, 'resetSeleksi'])->name('reset');
    });
});


Route::middleware(['auth', 'role:PENDAFTAR'])->prefix('pendaftar')->name('pendaftar.')->group(function () {
    Route::get('/dashboard', [PendaftarController::class, 'index'])->name('dashboard');
    Route::post('/update', [PendaftarController::class, 'update'])->name('update');
    Route::post('/upload-berkas', [PendaftarController::class, 'uploadBerkas'])->name('uploadBerkas');
    Route::post('/upload-prestasi', [PendaftarController::class, 'uploadPrestasi'])->name('uploadPrestasi');
    Route::delete('/prestasi/{id}', [PendaftarController::class, 'hapusPrestasi'])->name('hapusPrestasi');
    Route::get('terms', [PendaftarController::class, 'terms'])->name('terms');
    Route::delete('/berkas/{jenis}', [PendaftarController::class, 'hapusBerkas'])->name('hapusBerkas');
    Route::get('/profile', [PendaftarController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile', [PendaftarController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/dashboard/pdf', [PendaftarController::class, 'exportPdf'])->name('dashboard.pdf');
    Route::post('/lock-prestasi', [PendaftarController::class, 'lockPrestasi'])->name('lockPrestasi');
});


require __DIR__.'/auth.php';