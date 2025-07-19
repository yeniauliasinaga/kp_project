@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 mt-10 rounded-xl shadow-lg">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">
            {{ isset($supir) ? 'Edit Supir' : 'Form Tambah Supir' }}
        </h2>
    </div>

    <form method="POST"
          action="{{ isset($supir) ? route('superadmin.supir.update', $supir->id) : route('superadmin.supir.store') }}"
          class="space-y-6">
        @csrf
        @if(isset($supir))
            @method('POST') {{-- Menyesuaikan route POST update --}}
        @endif

        <!-- Nama Lengkap -->
        <div>
            <label class="block font-semibold mb-1">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="w-full p-2 border rounded"
                value="{{ old('nama_lengkap', $supir->nama_lengkap ?? '') }}"
                placeholder="Masukkan nama lengkap">
        </div>

        <!-- Tanggal Lahir -->
        <div>
            <label class="block font-semibold mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="w-full p-2 border rounded"
                value="{{ old('tanggal_lahir', $supir->tanggal_lahir ?? '') }}">
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <label class="block font-semibold mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full p-2 border rounded">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="pria" {{ old('jenis_kelamin', $supir->jenis_kelamin ?? '') == 'pria' ? 'selected' : '' }}>Pria</option>
                <option value="wanita" {{ old('jenis_kelamin', $supir->jenis_kelamin ?? '') == 'wanita' ? 'selected' : '' }}>Wanita</option>
            </select>
        </div>

        <!-- No Telepon -->
        <div>
            <label class="block font-semibold mb-1">No. Telepon</label>
            <input type="text" name="no_telepon" class="w-full p-2 border rounded"
                value="{{ old('no_telepon', $supir->no_telepon ?? '') }}"
                placeholder="Contoh: 081234567890">
        </div>

        <!-- Alamat -->
        <div>
            <label class="block font-semibold mb-1">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full p-2 border rounded"
                placeholder="Alamat lengkap">{{ old('alamat', $supir->alamat ?? '') }}</textarea>
        </div>

        <!-- NIK -->
        <div>
            <label class="block font-semibold mb-1">NIK</label>
            <input type="text" name="nik" class="w-full p-2 border rounded"
                value="{{ old('nik', $supir->nik ?? '') }}"
                placeholder="Nomor Induk Kependudukan">
        </div>

        <!-- Status -->
        <div>
            <label class="block font-semibold mb-1">Status</label>
            <select name="status" class="w-full p-2 border rounded">
                <option value="tersedia" {{ old('status', $supir->status ?? '') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="bertugas" {{ old('status', $supir->status ?? '') == 'bertugas' ? 'selected' : '' }}>Bertugas</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('superadmin.supir') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
