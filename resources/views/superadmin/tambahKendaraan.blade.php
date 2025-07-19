@extends('layouts.app')

@section('title', isset($kendaraan) ? 'Edit Kendaraan' : 'Form Tambah Kendaraan')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-yellow-100 p-8 mt-10 rounded-xl shadow-lg">

  <div class="mb-6 text-center">
    <h2 class="text-xl font-bold text-green-700">
      {{ isset($kendaraan) ? 'Form Edit Kendaraan' : 'Form Tambah Kendaraan' }}
    </h2>
  </div>

  <form 
    action="{{ isset($kendaraan) ? route('superadmin.kendaraan.update', $kendaraan->id) : route('superadmin.kendaraan.store') }}" 
    method="POST" 
    class="space-y-6"
  >
    @csrf
    @if (isset($kendaraan))
      @method('POST') {{-- bisa juga @method('PUT') kalau route-nya pakai PUT --}}
    @endif

    <!-- No Polisi -->
    <div>
      <label class="block font-semibold mb-1">No Polisi</label>
      <input 
        type="text" 
        name="no_polisi" 
        class="w-full p-2 border rounded" 
        placeholder="Contoh: BK 1234 AB"
        value="{{ old('no_polisi', $kendaraan->no_polisi ?? '') }}"
        required
      >
    </div>

    <!-- Merek -->
    <div>
      <label class="block font-semibold mb-1">Merek</label>
      <input 
        type="text" 
        name="merek" 
        class="w-full p-2 border rounded" 
        placeholder="Contoh: Toyota"
        value="{{ old('merek', $kendaraan->merek ?? '') }}"
        required
      >
    </div>

    <!-- Model -->
    <div>
      <label class="block font-semibold mb-1">Model</label>
      <input 
        type="text" 
        name="model" 
        class="w-full p-2 border rounded" 
        placeholder="Contoh: Avanza"
        value="{{ old('model', $kendaraan->model ?? '') }}"
        required
      >
    </div>

    <!-- Bahan Bakar -->
    <div>
      <label class="block font-semibold mb-1">Bahan Bakar</label>
      <input 
        type="text" 
        name="bahan_bakar" 
        class="w-full p-2 border rounded" 
        placeholder="Contoh: Bensin / Solar"
        value="{{ old('bahan_bakar', $kendaraan->bahan_bakar ?? '') }}"
        required
      >
    </div>

    <!-- Status Kepemilikan -->
    <div>
      <label class="block font-semibold mb-1">Status Kepemilikan</label>
      <select name="status_kepemilikan" class="w-full p-2 border rounded" required>
        <option value="">-- Pilih Kepemilikan --</option>
        <option value="milik perusahaan" {{ (old('status_kepemilikan', $kendaraan->status_kepemilikan ?? '') == 'milik perusahaan') ? 'selected' : '' }}>Milik Perusahaan</option>
        <option value="sewa" {{ (old('status_kepemilikan', $kendaraan->status_kepemilikan ?? '') == 'sewa') ? 'selected' : '' }}>Sewa</option>
      </select>
    </div>

    <!-- Status -->
    <div>
      <label class="block font-semibold mb-1">Status</label>
      <select name="status" class="w-full p-2 border rounded" required>
        <option value="tersedia" {{ (old('status', $kendaraan->status ?? '') == 'tersedia') ? 'selected' : '' }}>Tersedia</option>
        <option value="digunakan" {{ (old('status', $kendaraan->status ?? '') == 'digunakan') ? 'selected' : '' }}>Digunakan</option>
      </select>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end space-x-4">
      <a href="{{ route('superadmin.kendaraan') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
      <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        {{ isset($kendaraan) ? 'Update' : 'Simpan' }}
      </button>
    </div>
  </form>
</div>
@endsection
