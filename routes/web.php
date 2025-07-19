<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuperadminController;

// Route untuk tamu
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
require __DIR__.'/auth.php';

// Route yang membutuhkan login
Route::middleware(['auth', 'verified'])->group(function () {
    // Redirect setelah login
    Route::get('/dashboard', function () {
        if (!auth()->user()->pegawai) {
            abort(403, 'Akun tidak memiliki hak akses');
        }
        
        return auth()->user()->pegawai->role === 'superadmin'
            ? redirect()->route('superadmin.dashboard')
            : redirect()->route('staff.dashboard');
    })->name('dashboard');

    // ROUTE SUPERADMIN
    // Halaman dashboard superadmin
        Route::prefix('superadmin')->middleware(['auth', 'role:superadmin'])->controller(SuperadminController::class)->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [SuperadminController::class, 'dashboard'])->name('superadmin.dashboard');
        // Route::get('/dashboard', 'dashboard')->name('superadmin.dashboard');

        // ==================== BERITA ====================
        Route::get('/berita', 'berita')->name('superadmin.berita');
        Route::get('/berita/tambah', 'beritaCreate')->name('superadmin.berita.create');
        Route::post('/berita/tambah', 'beritaStore')->name('superadmin.berita.store');
        Route::get('/berita/edit/{id}', 'beritaEdit')->name('superadmin.berita.edit');
        Route::post('/berita/update/{id}', 'beritaUpdate')->name('superadmin.berita.update');
        Route::delete('/berita/delete/{id}', 'beritaDestroy')->name('superadmin.berita.delete');

        // ==================== KEGIATAN ====================
        Route::get('/kegiatan', 'kegiatan')->name('superadmin.kegiatan');
        Route::get('/kegiatan/tambah', 'kegiatanCreate')->name('superadmin.kegiatan.create');
        Route::post('/kegiatan/tambah', 'kegiatanStore')->name('superadmin.kegiatan.store');
        Route::get('/kegiatan/edit/{id}', 'kegiatanEdit')->name('superadmin.kegiatan.edit');
        Route::put('/kegiatan/update/{id}', 'kegiatanUpdate')->name('superadmin.kegiatan.update');
        Route::delete('/kegiatan/delete/{id}', 'kegiatanDestroy')->name('superadmin.kegiatan.delete');


        // ==================== KENDARAAN ====================
        Route::get('/kendaraan', 'kendaraan')->name('superadmin.kendaraan');
        Route::get('/kendaraan/tambah', 'kendaraanCreate')->name('superadmin.kendaraan.create');
        Route::post('/kendaraan/tambah', 'kendaraanStore')->name('superadmin.kendaraan.store');
        Route::get('/kendaraan/edit/{id}', 'kendaraanEdit')->name('superadmin.kendaraan.edit');
        Route::post('/kendaraan/update/{id}', 'kendaraanUpdate')->name('superadmin.kendaraan.update');
        Route::delete('/kendaraan/delete/{id}', 'kendaraanDestroy')->name('superadmin.kendaraan.delete');

        // ==================== MESS ====================
        Route::get('/mess', 'datamess')->name('superadmin.datamess');
        Route::get('/mess/tambah', 'messCreate')->name('superadmin.datamess.create');
        Route::post('/mess/tambah', 'messStore')->name('superadmin.datamess.store');
        Route::get('/mess/edit/{id}', 'messEdit')->name('superadmin.datamess.edit');
        Route::post('/mess/update/{id}', 'messUpdate')->name('superadmin.datamess.update');
        Route::delete('/mess/delete/{id}', 'messDestroy')->name('superadmin.datamess.delete');

        
        // ==================== TIKET PESAWAT ====================
        Route::get('/tiket-pesawat', 'tiketPesawat')->name('superadmin.tiketpesawat');
        Route::get('/tiket-pesawat/tambah', 'tiketPesawatCreate')->name('superadmin.tiketpesawat.create');
        Route::post('/tiket-pesawat/tambah', 'tiketPesawatStore')->name('superadmin.tiketpesawat.store');
        Route::match(['get', 'post'], '/tiket-pesawat/edit/{id}', 'tiketPesawatEdit')->name('superadmin.tiketpesawat.edit');
        Route::delete('/tiket-pesawat/delete/{id}', 'tiketPesawatDestroy')->name('superadmin.tiketpesawat.delete');


        // ==================== HOTEL ====================
        Route::get('/hotel', 'hotel')->name('superadmin.hotel');
        Route::get('/hotel/tambah', 'hotelCreate')->name('superadmin.hotel.create');
        Route::post('/hotel/tambah', 'hotelStore')->name('superadmin.hotel.store');
        Route::get('/hotel/edit/{id}', 'hotelEdit')->name('superadmin.hotel.edit');
        // Route::post('/hotel/update/{id}', 'hotelUpdate')->name('superadmin.hotel.update');
        Route::match(['put', 'patch'], '/hotel/update/{id}', 'hotelUpdate')->name('superadmin.hotel.update');
        Route::delete('/hotel/delete/{id}', 'hotelDestroy')->name('superadmin.hotel.delete');

        // ==================== PROPOSAL ====================
        Route::get('/proposal', 'proposal')->name('superadmin.proposal');
        Route::get('/proposal/tambah', 'proposalCreate')->name('superadmin.proposal.create');
        Route::post('/proposal/tambah', 'proposalStore')->name('superadmin.proposal.store');
        Route::get('/proposal/edit/{id}', 'proposalEdit')->name('superadmin.proposal.edit');
        Route::post('/proposal/update/{id}', 'proposalUpdate')->name('superadmin.proposal.update');
        Route::delete('/proposal/delete/{id}', 'proposalDestroy')->name('superadmin.proposal.delete');

        // ==================== PEGAWAI ====================
        Route::get('/pegawai', 'pegawai')->name('superadmin.pegawai');
        Route::get('/pegawai/tambah', 'pegawaiCreate')->name('superadmin.pegawai.create');
        Route::post('/pegawai/tambah', 'pegawaiStore')->name('superadmin.pegawai.store');
        Route::get('/pegawai/edit/{id}', 'pegawaiEdit')->name('superadmin.pegawai.edit');
        Route::post('/pegawai/update/{id}', 'pegawaiUpdate')->name('superadmin.pegawai.update');
        Route::delete('/pegawai/delete/{id}', 'pegawaiDestroy')->name('superadmin.pegawai.delete');

        // ==================== SUPIR ====================
        Route::get('/supir', 'supir')->name('superadmin.supir');
        Route::get('/supir/tambah', 'supirCreate')->name('superadmin.supir.create');
        Route::post('/supir/tambah', 'supirStore')->name('superadmin.supir.store');
        Route::get('/supir/edit/{id}', 'supirEdit')->name('superadmin.supir.edit');
        Route::post('/supir/update/{id}', 'supirUpdate')->name('superadmin.supir.update');
        Route::delete('/supir/delete/{id}', 'supirDestroy')->name('superadmin.supir.delete');
    });


    Route::prefix('staff')->middleware(['auth', 'role:staff'])->controller(StaffController::class)->group(function () {
        
        Route::get('/dashboard', 'dashboard')->name('staff.dashboard');

        // Berita
        Route::get('/berita', 'berita')->name('staff.berita');
        Route::get('/berita/tambah', 'beritaCreate')->name('staff.berita.create');
        Route::post('/berita/tambah', 'beritaStore')->name('staff.berita.store');
        Route::get('/berita/edit/{id}', 'beritaEdit')->name('staff.berita.edit');
        Route::post('/berita/update/{id}', 'beritaUpdate')->name('staff.berita.update');

        // Kegiatan
        Route::get('/kegiatan', 'kegiatan')->name('staff.kegiatan');
        Route::get('/kegiatan/tambah', 'kegiatanCreate')->name('staff.kegiatan.create');
        Route::post('/kegiatan/tambah', 'kegiatanStore')->name('staff.kegiatan.store');
        Route::get('/kegiatan/edit/{id}', 'kegiatanEdit')->name('staff.kegiatan.edit');
        Route::post('/kegiatan/update/{id}', 'kegiatanUpdate')->name('staff.kegiatan.update');

        // Tiket Pesawat
        Route::get('/tiket-pesawat', 'tiketPesawat')->name('staff.tiketPesawat');
        Route::get('/tiket-pesawat/tambah', 'tiketPesawatCreate')->name('staff.tiketPesawat.create');
        Route::post('/tiket-pesawat/tambah', 'tiketPesawatStore')->name('staff.tiketPesawat.store');
        Route::get('/tiket-pesawat/edit/{id}', 'tiketPesawatEdit')->name('staff.tiketPesawat.edit');
        Route::post('/tiket-pesawat/update/{id}', 'tiketPesawatUpdate')->name('staff.tiketPesawat.update');

        // Checkin Mess
        Route::get('/checkin-mess', 'checkinMess')->name('staff.checkinMess');
        Route::get('/checkin-mess/tambah', 'checkinMessCreate')->name('staff.checkinMess.create');
        Route::post('/checkin-mess/tambah', 'checkinMessStore')->name('staff.checkinMess.store');
        Route::get('/checkin-mess/edit/{id}', 'checkinMessEdit')->name('staff.checkinMess.edit');
        Route::post('/checkin-mess/update/{id}', 'checkinMessUpdate')->name('staff.checkinMess.update');

        // Permintaan Kendaraan
        Route::get('/permintaan-kendaraan', 'permintaanKendaraan')->name('staff.permintaankendaraan');
        Route::get('/permintaan-kendaraan/tambah', 'permintaanKendaraanCreate')->name('staff.permintaankendaraan.create');
        Route::post('/permintaan-kendaraan/tambah', 'permintaanKendaraanStore')->name('staff.permintaankendaraan.store');
        Route::get('/permintaan-kendaraan/edit/{id}', 'permintaanKendaraanEdit')->name('staff.permintaankendaraan.edit');
        Route::post('/permintaan-kendaraan/update/{id}', 'permintaanKendaraanUpdate')->name('staff.permintaankendaraan.update');

        // Hotel
        Route::get('/hotel', 'hotel')->name('staff.hotel');
        Route::get('/hotel/tambah', 'hotelCreate')->name('staff.hotel.create');
        Route::post('/hotel/tambah', 'hotelStore')->name('staff.hotel.store');
        Route::get('/hotel/edit/{id}', 'hotelEdit')->name('staff.hotel.edit');
        Route::post('/hotel/update/{id}', 'hotelUpdate')->name('staff.hotel.update');

        // Proposal
        Route::get('/proposal', 'proposal')->name('staff.proposal');
        Route::get('/proposal/tambah', 'proposalCreate')->name('staff.proposal.create');
        Route::post('/proposal/tambah', 'proposalStore')->name('staff.proposal.store');
        Route::get('/proposal/edit/{id}', 'proposalEdit')->name('staff.proposal.edit');
        Route::post('/proposal/update/{id}', 'proposalUpdate')->name('staff.proposal.update');
    });


});