@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 mt-10 rounded-xl shadow-lg">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">
            {{ isset($tiket) ? 'Edit Tiket Pesawat' : 'Tambah Tiket Pesawat' }}
        </h2>
    </div>

    <form method="POST" 
        action="{{ isset($tiket) ? route('superadmin.tiketpesawat.edit', $tiket->id) : route('superadmin.tiketpesawat.store') }}">
        @csrf

        <!-- Pegawai -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Pegawai</label>
            <select name="pegawai_id" class="w-full p-2 border rounded">
                <option value="">-- Pilih Pegawai --</option>
                @foreach($pegawai as $p)
                    <option value="{{ $p->id }}" {{ isset($tiket) && $tiket->pegawai_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tujuan -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tujuan</label>
            <select name="tujuan" class="w-full p-2 border rounded">
                <option value="dalam wilayah" {{ isset($tiket) && $tiket->tujuan == 'dalam wilayah' ? 'selected' : '' }}>Dalam Wilayah</option>
                <option value="luar wilayah" {{ isset($tiket) && $tiket->tujuan == 'luar wilayah' ? 'selected' : '' }}>Luar Wilayah</option>
            </select>
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full p-2 border rounded" 
                   value="{{ isset($tiket) ? $tiket->tanggal : '' }}">
        </div>

        <!-- Biaya -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Biaya</label>
            <input type="number" name="biaya" class="w-full p-2 border rounded" 
                   value="{{ isset($tiket) ? $tiket->biaya : '' }}" step="0.01">
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('superadmin.tiketpesawat') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Kembali</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                {{ isset($tiket) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection
