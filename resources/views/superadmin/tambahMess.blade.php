@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 mt-10 rounded-xl shadow-lg">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">
            {{ isset($mess) ? 'Form Edit Data Mess' : 'Form Tambah Data Mess' }}
        </h2>
    </div>

    <form method="POST" 
        action="{{ isset($mess) ? route('superadmin.datamess.update', $mess->id) : route('superadmin.datamess.store') }}">
        @csrf
        @if(isset($mess))
            {{-- Jika edit, pakai method POST untuk update --}}
        @endif

        <!-- Lokasi -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Lokasi</label>
            <select name="lokasi" class="w-full p-2 border rounded">
                <option value="">-- Pilih Lokasi --</option>
                @foreach (['Berastagi', 'Parapat', 'Kapten Muslim', 'Auditor', 'Direksi'] as $lokasi)
                    <option value="{{ $lokasi }}" {{ (isset($mess) && $mess->lokasi === $lokasi) ? 'selected' : '' }}>
                        {{ $lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Nomor Kamar -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nomor Kamar</label>
            <input type="text" name="nomor_kamar" class="w-full p-2 border rounded" 
                value="{{ isset($mess) ? $mess->nomor_kamar : '' }}" placeholder="Contoh: A1, 101, B-02">
        </div>

        <!-- Jumlah Bed -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Jumlah Bed</label>
            <input type="number" name="jumlah_bed" class="w-full p-2 border rounded" min="1"
                value="{{ isset($mess) ? $mess->jumlah_bed : '' }}" placeholder="Contoh: 2">
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Status</label>
            <select name="status" class="w-full p-2 border rounded">
                <option value="tersedia" {{ (isset($mess) && $mess->status === 'tersedia') ? 'selected' : '' }}>Tersedia</option>
                <option value="terpakai" {{ (isset($mess) && $mess->status === 'terpakai') ? 'selected' : '' }}>Terpakai</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('superadmin.datamess') }}"
                class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Kembali</a>
            <button type="reset" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700">Reset</button>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                {{ isset($mess) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection
