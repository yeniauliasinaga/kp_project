@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">

  <h2 class="text-2xl font-bold mb-6 text-green-700">
    {{ isset($kegiatan) ? 'Edit Kegiatan' : 'Tambah Kegiatan' }}
  </h2>

  {{-- Tampilkan error validasi --}}
  @if ($errors->any())
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
      <ul class="list-disc ml-6">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  
<form method="POST" enctype="multipart/form-data" action="{{ isset($kegiatan) ? route('superadmin.kegiatan.update', $kegiatan->id) : route('superadmin.kegiatan.store') }}">
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

    {{-- Gambar --}}
    <div class="mb-4">
      <label class="block font-semibold mb-1">Gambar Kegiatan</label>
      <input type="file" name="gambar" class="w-full p-2 border rounded" {{ isset($kegiatan) ? '' : 'required' }}>
      @if (isset($kegiatan) && $kegiatan->gambar)
        <img src="{{ asset('img/kegiatan/' . $kegiatan->gambar) }}" class="mt-2 w-32 rounded">
      @endif
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
      <a href="{{ route('superadmin.kegiatan') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
      <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        {{ isset($kegiatan) ? 'Update' : 'Simpan' }}
      </button>
    </div>

  </form>
</div>
@endsection
