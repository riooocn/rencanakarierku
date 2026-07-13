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
    return view('auth.complete-profile-peserta');
})->name('complete-profile-peserta');

Route::get('/complete-profile/instansi', function () {
    return view('auth.complete-profile-instansi');
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
Route::prefix('perjalananku')->group(function () {
    Route::get('/', function () {
        return view('peserta.perjalananku.index');
    })->name('perjalananku.index');

    Route::prefix('asesmen')->group(function () {
        Route::get('minat', function () { return view('peserta.asesmen.minat'); })->name('asesmen.minat');
        Route::post('minat', function () { return redirect()->route('asesmen.minat.hasil'); })->name('asesmen.minat.store');
        Route::get('minat/hasil', function () { return view('peserta.asesmen.minat-hasil'); })->name('asesmen.minat.hasil');
        
        Route::get('kapasitas', function () { return view('peserta.asesmen.kapasitas'); })->name('asesmen.kapasitas');
        Route::post('kapasitas', function () { return redirect()->route('asesmen.kapasitas.hasil'); })->name('asesmen.kapasitas.store');
        Route::get('kapasitas/hasil', function () { return view('peserta.asesmen.kapasitas-hasil'); })->name('asesmen.kapasitas.hasil');
        
        Route::get('nilaikarier', function () { return view('peserta.asesmen.nilaikarier'); })->name('asesmen.nilaikarier');
        Route::post('nilaikarier', function () { return redirect()->route('asesmen.nilaikarier.hasil'); })->name('asesmen.nilaikarier.store');
        Route::get('nilaikarier/hasil', function () { return view('peserta.asesmen.nilaikarier-hasil'); })->name('asesmen.nilaikarier.hasil');
    });

    Route::prefix('eksplorasi-karier')->group(function () {
        Route::get('/', function () { return view('peserta.eksplorasi.index'); })->name('eksplorasi.index');
        Route::get('hasil', function () { return view('peserta.eksplorasi.hasil'); })->name('eksplorasi.hasil');
    });

    Route::get('keputusan-karier', function () { return view('peserta.keputusan.index'); })->name('keputusan.index');
});

Route::get('/hasilkeputusan', function () {
    return view('peserta.hasilkeputusan');
})->name('hasilkeputusan');

// --- ADMIN ROUTES ---
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/peserta', function () {
        return view('admin.peserta.index');
    })->name('admin.peserta.index');

    Route::get('/peserta/{id}', function ($id) {
        return view('admin.peserta.show', compact('id'));
    })->name('admin.peserta.show');
});

// --- SUPER ADMIN ROUTES ---
Route::prefix('superadmin')->group(function () {
    Route::get('/', function () {
        return view('superadmin.dashboard');
    })->name('superadmin.dashboard');

    Route::get('/admin', function () {
        return view('superadmin.admin.index');
    })->name('superadmin.admin.index');

    Route::get('/admin/{admin_id}/peserta', function ($admin_id) {
        return view('superadmin.peserta.index', compact('admin_id')); 
    })->name('superadmin.admin.peserta');

    Route::get('/peserta', function () {
        return view('superadmin.peserta.index');
    })->name('superadmin.peserta.index');

    Route::get('/peserta/{id}', function ($id) {
        return view('superadmin.peserta.show', compact('id'));
    })->name('superadmin.peserta.show');

    // Action endpoints
    Route::patch('/admin/{id}/approve', function ($id) {
        return back();
    })->name('superadmin.admin.approve');

    Route::patch('/admin/{id}/deactivate', function ($id) {
        return back();
    })->name('superadmin.admin.deactivate');
});
