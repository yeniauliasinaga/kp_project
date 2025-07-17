<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuperadminController;

<<<<<<< Updated upstream
Route::get('/', function () {
    return view('superadmin.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

=======
// Authentication routes
>>>>>>> Stashed changes
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // Role-based redirection
    Route::get('/', function () {
        if (auth()->user()->pegawai->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        }
        return redirect()->route('staff.dashboard');
    });

    // Staff Routes
    Route::prefix('staff')->name('staff.')->middleware('can:staff')->group(function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
        
        // Berita Routes
        Route::prefix('berita')->group(function () {
            Route::get('/', [StaffController::class, 'beritaIndex'])->name('berita.index');
            Route::get('/tambah', [StaffController::class, 'beritaCreate'])->name('berita.create');
            Route::post('/', [StaffController::class, 'beritaStore'])->name('berita.store');
            Route::get('/{berita}/edit', [StaffController::class, 'beritaEdit'])->name('berita.edit');
            Route::put('/{berita}', [StaffController::class, 'beritaUpdate'])->name('berita.update');
            Route::delete('/{berita}', [StaffController::class, 'beritaDestroy'])->name('berita.destroy');
        });

        // Tambahkan rute untuk fitur lainnya (kegiatan, checkin mess, dll)
    });

    // Superadmin Routes
    Route::prefix('superadmin')->name('superadmin.')->middleware('can:superadmin')->group(function () {
        Route::get('/dashboard', [SuperadminController::class, 'dashboard'])->name('dashboard');
        
        // Berita Routes
        Route::prefix('berita')->group(function () {
            Route::get('/', [SuperadminController::class, 'beritaIndex'])->name('berita.index');
            Route::get('/tambah', [SuperadminController::class, 'beritaCreate'])->name('berita.create');
            Route::post('/', [SuperadminController::class, 'beritaStore'])->name('berita.store');
            Route::get('/{berita}/edit', [SuperadminController::class, 'beritaEdit'])->name('berita.edit');
            Route::put('/{berita}', [SuperadminController::class, 'beritaUpdate'])->name('berita.update');
            Route::delete('/{berita}', [SuperadminController::class, 'beritaDestroy'])->name('berita.destroy');
        });

        // Tambahkan rute untuk fitur lainnya (kendaraan, data mess, dll)
    });
});