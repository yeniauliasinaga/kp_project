@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow mt-10">
    <h2 class="text-xl font-bold text-green-700 mb-6">
        {{ isset($kegiatan) ? 'Edit Kegiatan' : 'Tambah Kegiatan' }}
    </h2>

    <form method="POST" action="{{ isset($kegiatan) ? route('staff.kegiatan.update', $kegiatan->id) : route('staff.kegiatan.store') }}">
         @csrf
        @if (isset($kegiatan))
        @method('PUT')
        @endif

        {{-- Nama Kegiatan --}}
        <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Kegiatan</label>
        <input type="text" name="nama_kegiatan" class="w-full p-2 border rounded"
            value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan ?? '') }}" required>
        </div>

        {{-- Tempat --}}
        <div class="mb-4">
        <label class="block font-semibold mb-1">Tempat</label>
        <input type="text" name="tempat" class="w-full p-2 border rounded"
            value="{{ old('tempat', $kegiatan->tempat ?? '') }}" required>
        </div>

        {{-- Waktu Mulai --}}
        <div class="mb-4">
        <label class="block font-semibold mb-1">Waktu Mulai</label>
        <input type="datetime-local" name="waktu_mulai" class="w-full p-2 border rounded"
            value="{{ old('waktu_mulai', isset($kegiatan) ? date('Y-m-d\TH:i', strtotime($kegiatan->waktu_mulai)) : '') }}" required>
        </div>

        {{-- Waktu Selesai --}}
        <div class="mb-4">
        <label class="block font-semibold mb-1">Waktu Selesai</label>
        <input type="datetime-local" name="waktu_selesai" class="w-full p-2 border rounded"
            value="{{ old('waktu_selesai', isset($kegiatan) ? date('Y-m-d\TH:i', strtotime($kegiatan->waktu_selesai)) : '') }}" required>
        </div>

        {{-- Biaya --}}
        <div class="mb-4">
        <label class="block font-semibold mb-1">Biaya</label>
        <input type="number" name="biaya" class="w-full p-2 border rounded"
            value="{{ old('biaya', $kegiatan->biaya ?? '') }}" required>
        </div>

        {{-- Status --}}
        <div class="mb-4">
        <label class="block font-semibold mb-1">Status</label>
        <select name="status" class="w-full p-2 border rounded" required>
            <option value="akan_datang" {{ old('status', $kegiatan->status ?? '') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
            <option value="berlangsung" {{ old('status', $kegiatan->status ?? '') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
            <option value="selesai" {{ old('status', $kegiatan->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between">
        <a href="{{ route('staff.kegiatan') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            {{ isset($kegiatan) ? 'Update' : 'Simpan' }}
        </button>
        </div>

    </form>
</div>
@endsection
