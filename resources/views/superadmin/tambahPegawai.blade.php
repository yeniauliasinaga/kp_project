@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-yellow-100 rounded-xl shadow-lg">
  <h2 class="text-xl font-bold text-green-700 mb-6 text-center">
    {{ isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai' }}
  </h2>

  <form method="POST" action="{{ isset($pegawai) ? route('superadmin.pegawai.update', $pegawai->id) : route('superadmin.pegawai.store') }}">
    @csrf

    <!-- Email & Password hanya saat tambah -->
    @if (!isset($pegawai))
    <div class="mb-4">
      <label class="block font-semibold mb-1">Email</label>
      <input type="email" name="email" class="w-full p-2 border rounded" placeholder="Email user">
    </div>
    <div class="mb-4">
      <label class="block font-semibold mb-1">Password</label>
      <input type="password" name="password" class="w-full p-2 border rounded" placeholder="Password user">
    </div>
    @endif

    <div class="mb-4">
      <label class="block font-semibold mb-1">Nama Pegawai</label>
      <input type="text" name="nama" class="w-full p-2 border rounded" value="{{ old('nama', $pegawai->nama ?? '') }}">
    </div>

    <div class="mb-4">
      <label class="block font-semibold mb-1">NIP</label>
      <input type="text" name="nip" class="w-full p-2 border rounded" value="{{ old('nip', $pegawai->nip ?? '') }}">
    </div>

    <div class="mb-4">
      <label class="block font-semibold mb-1">Jabatan</label>
      <input type="text" name="jabatan" class="w-full p-2 border rounded" value="{{ old('jabatan', $pegawai->jabatan ?? '') }}">
    </div>

    <div class="mb-4">
      <label class="block font-semibold mb-1">Role</label>
      <select name="role" class="w-full p-2 border rounded">
        <option value="">-- Pilih Role --</option>
        <option value="staff" {{ (old('role', $pegawai->role ?? '') == 'staff') ? 'selected' : '' }}>Staff</option>
        <option value="superadmin" {{ (old('role', $pegawai->role ?? '') == 'superadmin') ? 'selected' : '' }}>Superadmin</option>
      </select>
    </div>

    <div class="mb-4">
      <label class="block font-semibold mb-1">Unit</label>
      <select name="unit_id" class="w-full p-2 border rounded">
        <option value="">-- Pilih Unit --</option>
        @foreach(App\Models\Unit::all() as $unit)
        <option value="{{ $unit->id }}" {{ (old('unit_id', $pegawai->unit_id ?? '') == $unit->id) ? 'selected' : '' }}>{{ $unit->nama_unit }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-6">
      <label class="block font-semibold mb-1">Alamat</label>
      <textarea name="alamat" rows="3" class="w-full p-2 border rounded">{{ old('alamat', $pegawai->alamat ?? '') }}</textarea>
    </div>

    <div class="flex justify-end gap-4">
      <a href="{{ route('superadmin.pegawai') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
      <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        {{ isset($pegawai) ? 'Update' : 'Simpan' }}
      </button>
    </div>
  </form>
</div>
@endsection
