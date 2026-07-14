<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/complete-profile/peserta', function () {
    $institutions = \App\Models\Institution::orderBy('name')->get();
    return view('auth.complete-profile-peserta', compact('institutions'));
})->name('complete-profile-peserta');

Route::get('/complete-profile/instansi', function () {
    $institutions = \App\Models\Institution::orderBy('name')->get();
    return view('auth.complete-profile-instansi', compact('institutions'));
})->name('complete-profile-instansi');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/complete-profile', function () {
    return view('auth.complete-profile');
})->name('complete-profile');

// Peserta (Siswa) Route
Route::prefix('perjalananku')->middleware(['auth', 'role:peserta'])->group(function () {
    Route::get('/', function () {
        return view('peserta.perjalananku.index');
    })->name('perjalananku.index');

    Route::prefix('asesmen')->group(function () {
        Route::get('minat', [\App\Http\Controllers\Peserta\AssessmentController::class, 'minat'])->name('asesmen.minat');
        Route::post('minat', [\App\Http\Controllers\Peserta\AssessmentController::class, 'storeMinat'])->name('asesmen.minat.store');
        Route::get('minat/hasil', [\App\Http\Controllers\Peserta\AssessmentController::class, 'minatHasil'])->name('asesmen.minat.hasil');

        Route::get('kapasitas', [\App\Http\Controllers\Peserta\AssessmentController::class, 'kapasitas'])->name('asesmen.kapasitas');
        Route::post('kapasitas', [\App\Http\Controllers\Peserta\AssessmentController::class, 'storeKapasitas'])->name('asesmen.kapasitas.store');
        Route::get('kapasitas/hasil', [\App\Http\Controllers\Peserta\AssessmentController::class, 'kapasitasHasil'])->name('asesmen.kapasitas.hasil');

        Route::get('nilaikarier', [\App\Http\Controllers\Peserta\AssessmentController::class, 'nilaiKarier'])->name('asesmen.nilaikarier');
        Route::post('nilaikarier', [\App\Http\Controllers\Peserta\AssessmentController::class, 'storeNilaiKarier'])->name('asesmen.nilaikarier.store');
        Route::get('nilaikarier/hasil', [\App\Http\Controllers\Peserta\AssessmentController::class, 'nilaiKarierHasil'])->name('asesmen.nilaikarier.hasil');
    });

    Route::prefix('eksplorasi-karier')->group(function () {
        Route::get('/', [\App\Http\Controllers\Peserta\EksplorasiController::class, 'index'])->name('eksplorasi.index');
        Route::post('/', [\App\Http\Controllers\Peserta\EksplorasiController::class, 'store'])->name('eksplorasi.store');
        Route::get('hasil', [\App\Http\Controllers\Peserta\EksplorasiController::class, 'hasil'])->name('eksplorasi.hasil');
    });

    Route::get('keputusan-karier', [\App\Http\Controllers\Peserta\KeputusanController::class, 'index'])->name('keputusan.index');
    Route::post('keputusan-karier', [\App\Http\Controllers\Peserta\KeputusanController::class, 'store'])->name('keputusan.store');
});

Route::get('/hasilkeputusan', [\App\Http\Controllers\Peserta\HasilController::class, 'index'])->middleware(['auth', 'role:peserta'])->name('hasilkeputusan');
Route::get('/hasilkeputusan/{id}', [\App\Http\Controllers\Peserta\HasilController::class, 'show'])->middleware(['auth', 'role:peserta'])->name('hasilkeputusan.show');

// --- ADMIN ROUTES ---
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/peserta', [\App\Http\Controllers\AdminController::class, 'peserta'])->name('admin.peserta.index');
    Route::get('/peserta/{id}', [\App\Http\Controllers\AdminController::class, 'pesertaDetail'])->name('admin.peserta.show');
    Route::patch('/peserta/{id}/approve', [\App\Http\Controllers\AdminController::class, 'pesertaApprove'])->name('admin.peserta.approve');
});

// --- SUPER ADMIN ROUTES ---
Route::prefix('superadmin')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    
    Route::get('/admin', [\App\Http\Controllers\SuperAdminController::class, 'adminList'])->name('superadmin.admin.index');
    
    Route::get('/admin/{admin_id}/peserta', [\App\Http\Controllers\SuperAdminController::class, 'adminPeserta'])->name('superadmin.admin.peserta');
    
    Route::get('/peserta', [\App\Http\Controllers\SuperAdminController::class, 'pesertaList'])->name('superadmin.peserta.index');
    
    Route::get('/peserta/{id}', [\App\Http\Controllers\SuperAdminController::class, 'pesertaDetail'])->name('superadmin.peserta.show');
    
    Route::patch('/admin/{id}/approve', [\App\Http\Controllers\SuperAdminController::class, 'adminApprove'])->name('superadmin.admin.approve');
    
    Route::patch('/admin/{id}/deactivate', [\App\Http\Controllers\SuperAdminController::class, 'adminDeactivate'])->name('superadmin.admin.deactivate');
});
