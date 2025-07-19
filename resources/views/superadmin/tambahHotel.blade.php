@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md p-6 mt-10 rounded">
    <h2 class="text-xl font-bold text-green-700 mb-4">
        {{ isset($hotel) ? 'Edit' : 'Tambah' }} Data Hotel
    </h2>

    {{-- Tampilkan error jika validasi gagal --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
            <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($hotel) ? route('superadmin.hotel.update', $hotel->id) : route('superadmin.hotel.store') }}" method="POST">
        @csrf
        @if (isset($hotel))
            @method('PUT')
        @endif

        {{-- Pegawai --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Pegawai</label>
            <select name="pegawai_id" id="pegawaiSelect" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach ($pegawais as $pegawai)
                    <option 
                        value="{{ $pegawai->id }}"
                        data-unit="{{ $pegawai->unit->nama_unit ?? '' }}"
                        data-unit-id="{{ $pegawai->unit_id }}"
                        {{ old('pegawai_id', $hotel->pegawai_id ?? '') == $pegawai->id ? 'selected' : '' }}>
                        {{ $pegawai->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Unit (readonly + hidden) --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Unit</label>
            <input type="text" id="unitField" class="w-full border rounded p-2 bg-gray-100" readonly
                value="{{ old('pegawai_id') 
                    ? ($pegawais->firstWhere('id', old('pegawai_id'))?->unit->nama_unit ?? '-') 
                    : ($hotel->pegawai->unit->nama_unit ?? '-') }}">
            <input type="hidden" name="unit_id" id="unitIdField"
                value="{{ old('pegawai_id') 
                    ? ($pegawais->firstWhere('id', old('pegawai_id'))?->unit_id ?? '') 
                    : ($hotel->unit_id ?? '') }}">
        </div>

        {{-- Nama Hotel --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Hotel</label>
            <input type="text" name="nama_hotel" class="w-full border rounded p-2" required
                value="{{ old('nama_hotel', $hotel->nama_hotel ?? '') }}">
        </div>

        {{-- Biaya --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Biaya</label>
            <input type="number" name="biaya" class="w-full border rounded p-2" required
                value="{{ old('biaya', $hotel->biaya ?? '') }}">
        </div>

        {{-- Tanggal Masuk --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="w-full border rounded p-2" required
                value="{{ old('tanggal_masuk', $hotel->tanggal_masuk ?? '') }}">
        </div>

        {{-- Tanggal Keluar --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Keluar</label>
            <input type="date" name="tanggal_keluar" class="w-full border rounded p-2" required
                value="{{ old('tanggal_keluar', $hotel->tanggal_keluar ?? '') }}">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-2">
            <a href="{{ route('superadmin.hotel') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Batal
            </a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan
            </button>
        </div>
    </form>
</div>

{{-- Script: Update otomatis unit --}}
<script>
    document.getElementById('pegawaiSelect').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const unitName = selectedOption.getAttribute('data-unit') || '-';
        const unitId = selectedOption.getAttribute('data-unit-id') || '';

        document.getElementById('unitField').value = unitName;
        document.getElementById('unitIdField').value = unitId;
    });
</script>
@endsection
