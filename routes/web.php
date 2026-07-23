<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', function () {
    $institutions = \App\Models\Institution::orderBy('name')->get();
    return view('contact', compact('institutions'));
})->name('contact');



Route::get('/dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    if ($user->role === 'superadmin') {
        return redirect('/superadmin');
    } elseif ($user->role === 'admin') {
        return redirect('/admin');
    }
    return redirect('/perjalananku');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/complete-profile/peserta', function () {
        $user = auth()->user();
        if ($user->institution_id || $user->role !== 'peserta') return redirect()->route('dashboard');
        
        $institutions = \App\Models\Institution::whereHas('users', function ($q) {
            $q->where('role', 'admin')->where('is_active', true);
        })->orderBy('name')->get();
        return view('auth.complete-profile-peserta', compact('institutions'));
    })->name('complete-profile-peserta');

    Route::get('/complete-profile/instansi', function () {
        $user = auth()->user();
        if ($user->institution_id || $user->role !== 'admin') return redirect()->route('dashboard');

        $institutions = \App\Models\Institution::orderBy('name')->get();
        return view('auth.complete-profile-instansi', compact('institutions'));
    })->name('complete-profile-instansi');

    Route::post('/complete-profile', [\App\Http\Controllers\Auth\ProfileCompletionController::class, 'store'])
        ->name('complete-profile.store');
});

require __DIR__.'/auth.php';


// Peserta (Siswa) Route
Route::prefix('perjalananku')->middleware(['auth', 'role:peserta'])->group(function () {
    Route::get('/', function () {
        $user = auth()->user();
        
        $latestMinat = \App\Models\AssessmentSession::where('user_id', $user->id)->where('asesmen_type', 'minat')->where('status', 'completed')->latest()->first();
        $latestKapasitas = \App\Models\AssessmentSession::where('user_id', $user->id)->where('asesmen_type', 'kapasitas')->where('status', 'completed')->latest()->first();
        $latestNilaiKarier = \App\Models\AssessmentSession::where('user_id', $user->id)->where('asesmen_type', 'nilai_karier')->where('status', 'completed')->latest()->first();
        
        $latestEksplorasi = \App\Models\EksplorasiKarier::where('user_id', $user->id)->latest('created_at')->first();
        $latestKeputusan = \App\Models\KeputusanKarier::where('user_id', $user->id)->latest('created_at')->first();

        // Determine link for Asesmen Diri sequentially based on timestamp
        $isAsesmenIncomplete = false;
        
        if (!$latestMinat) {
            $asesmenLink = route('asesmen.minat');
            $asesmenText = 'Mulai Tes';
            $isAsesmenIncomplete = true;
        } elseif (!$latestKapasitas || $latestKapasitas->created_at < $latestMinat->created_at) {
            $asesmenLink = route('asesmen.kapasitas');
            $asesmenText = 'Lanjut ke Tes Kapasitas';
            $isAsesmenIncomplete = true;
        } elseif (!$latestNilaiKarier || $latestNilaiKarier->created_at < $latestKapasitas->created_at) {
            $asesmenLink = route('asesmen.nilaikarier');
            $asesmenText = 'Lanjut ke Tes Nilai Karier';
            $isAsesmenIncomplete = true;
        } else {
            $asesmenLink = route('asesmen.nilaikarier.hasil');
            $asesmenText = 'Lihat Hasil Asesmen';
        }

        $asesmenCompleted = !$isAsesmenIncomplete;
        
        // Eksplorasi is unlocked if asesmen is completed
        // Keputusan is unlocked if eksplorasi is completed AND up to date
        $hasEksplorasi = $latestEksplorasi != null;
        
        $isEksplorasiUpToDate = $hasEksplorasi && $latestEksplorasi->created_at >= $latestNilaiKarier->created_at;
        
        $hasKeputusan = $latestKeputusan != null;
        $isKeputusanUpToDate = $hasKeputusan && $hasEksplorasi && $latestKeputusan->created_at >= $latestEksplorasi->created_at;

        return view('peserta.perjalananku.index', compact(
            'asesmenLink', 'asesmenText', 'asesmenCompleted', 
            'hasEksplorasi', 'hasKeputusan', 
            'isEksplorasiUpToDate', 'isKeputusanUpToDate'
        ));
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
    Route::get('/peserta/export', [\App\Http\Controllers\AdminController::class, 'exportExcel'])->name('admin.peserta.export');
    Route::get('/peserta/{id}', [\App\Http\Controllers\AdminController::class, 'pesertaDetail'])->name('admin.peserta.show');
    Route::get('/peserta/{id}/history/{history_id}', [\App\Http\Controllers\AdminController::class, 'pesertaHistoryDetail'])->name('admin.peserta.history.show');
    Route::patch('/peserta/{id}/approve', [\App\Http\Controllers\AdminController::class, 'pesertaApprove'])->name('admin.peserta.approve');
    Route::patch('/peserta/{id}/deactivate', [\App\Http\Controllers\AdminController::class, 'pesertaDeactivate'])->name('admin.peserta.deactivate');
    Route::delete('/peserta/{id}/reject', [\App\Http\Controllers\AdminController::class, 'pesertaReject'])->name('admin.peserta.reject');
});

// --- SUPER ADMIN ROUTES ---
Route::prefix('superadmin')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    
    Route::get('/admin', [\App\Http\Controllers\SuperAdminController::class, 'adminList'])->name('superadmin.admin.index');
    
    Route::patch('/admin/{id}/approve', [\App\Http\Controllers\SuperAdminController::class, 'adminApprove'])->name('superadmin.admin.approve');
    Route::patch('/admin/{id}/deactivate', [\App\Http\Controllers\SuperAdminController::class, 'adminDeactivate'])->name('superadmin.admin.deactivate');
    Route::delete('/admin/{id}/reject', [\App\Http\Controllers\SuperAdminController::class, 'adminReject'])->name('superadmin.admin.reject');
    
    Route::get('/admin/{admin_id}/peserta', [\App\Http\Controllers\SuperAdminController::class, 'adminPeserta'])->name('superadmin.admin.peserta');
    
    Route::get('/peserta', [\App\Http\Controllers\SuperAdminController::class, 'pesertaList'])->name('superadmin.peserta.index');
    Route::get('/peserta/export', [\App\Http\Controllers\SuperAdminController::class, 'exportExcel'])->name('superadmin.peserta.export');
    
    Route::get('/peserta/{id}', [\App\Http\Controllers\SuperAdminController::class, 'pesertaDetail'])->name('superadmin.peserta.show');
    Route::get('/peserta/{id}/history/{history_id}', [\App\Http\Controllers\SuperAdminController::class, 'pesertaHistoryDetail'])->name('superadmin.peserta.history.show');
    Route::patch('/peserta/{id}/approve', [\App\Http\Controllers\SuperAdminController::class, 'pesertaApprove'])->name('superadmin.peserta.approve');
    Route::patch('/peserta/{id}/deactivate', [\App\Http\Controllers\SuperAdminController::class, 'pesertaDeactivate'])->name('superadmin.peserta.deactivate');
    Route::delete('/peserta/{id}/reject', [\App\Http\Controllers\SuperAdminController::class, 'pesertaReject'])->name('superadmin.peserta.reject');
});
