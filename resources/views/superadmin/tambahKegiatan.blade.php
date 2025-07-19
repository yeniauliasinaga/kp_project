@extends('layouts.app')

@section('title', isset($kegiatan) ? 'Edit Kegiatan' : 'Form Tambah Kegiatan')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-yellow-100 p-8 mt-10 rounded-xl shadow-lg">

  <div class="mb-6 text-center">
    <h2 class="text-xl font-bold text-green-700">
      {{ isset($kegiatan) ? 'Form Edit Kegiatan' : 'Form Tambah Kegiatan' }}
    </h2>
  </div>

  <form 
    action="{{ isset($kegiatan) ? route('superadmin.kegiatan.update', $kegiatan->id) : route('superadmin.kegiatan.store') }}" 
    method="POST"
    class="space-y-6"
  >
    @csrf
    @if (isset($kegiatan))
      @method('PUT')
    @endif

    <!-- Nama Kegiatan -->
    <div>
      <label class="block font-semibold mb-1">Nama Kegiatan</label>
      <input type="text" name="nama_kegiatan" class="w-full p-2 border rounded" placeholder="Contoh: Rapat Koordinasi" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan ?? '') }}" required>
    </div>

    <!-- Tempat -->
    <div>
      <label class="block font-semibold mb-1">Tempat</label>
      <input type="text" name="tempat" class="w-full p-2 border rounded" placeholder="Contoh: Aula Lantai 2" value="{{ old('tempat', $kegiatan->tempat ?? '') }}" required>
    </div>

    <!-- Biaya -->
    <div>
      <label class="block font-semibold mb-1">Biaya (Rp)</label>
      <input type="number" name="biaya"  step="0.01" class="w-full p-2 border rounded" placeholder="Contoh: 1500000" value="{{ old('biaya', $kegiatan->biaya ?? '') }}" required>
    </div>

    <!-- Waktu Mulai -->
    <div>
      <label class="block font-semibold mb-1">Waktu Mulai</label>
      <input 
        type="datetime-local" 
        name="waktu_mulai" 
        class="w-full p-2 border rounded"
        value="{{ old('waktu_mulai', isset($kegiatan) ? \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('Y-m-d\TH:i') : '') }}"
        required
      >
    </div>

    <!-- Waktu Selesai -->
    <div>
      <label class="block font-semibold mb-1">Waktu Selesai</label>
      <input 
        type="datetime-local" 
        name="waktu_selesai" 
        class="w-full p-2 border rounded"
        value="{{ old('waktu_selesai', isset($kegiatan) ? \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('Y-m-d\TH:i') : '') }}"
        required
      >
    </div>

    <!-- Status -->
    <div>
      <label class="block font-semibold mb-1">Status</label>
      <select name="status" class="w-full p-2 border rounded" required>
        <option value="berlangsung" {{ old('status', $kegiatan->status ?? '') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
        <option value="selesai" {{ old('status', $kegiatan->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
      </select>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end space-x-4">
      <a href="{{ route('superadmin.kegiatan') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
      <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        {{ isset($kegiatan) ? 'Update' : 'Simpan' }}
      </button>
    </div>
  </form>
</div>
@endsection
