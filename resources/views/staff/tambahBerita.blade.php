@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
    <div class="w-full max-w-4xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
        <div class="mb-6 text-center">
            <h2 class="text-xl font-bold text-green-700">Form Tambah Berita</h2>
        </div>

        <form class="space-y-6" method="POST" action="{{ route('staff.berita.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block font-semibold mb-1">Judul</label>
                <input type="text" name="judul" class="w-full p-2 border rounded" placeholder="Judul berita" value="{{ old('judul') }}">
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sumber Media -->
            <div>
                <label class="block font-semibold mb-1">Sumber Media</label>
                <input type="text" name="sumber_media" class="w-full p-2 border rounded" placeholder="Contoh: Detik.com" value="{{ old('sumber_media') }}">
                @error('sumber_media')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Link -->
            <div>
                <label class="block font-semibold mb-1">Link</label>
                <input type="url" name="link" class="w-full p-2 border rounded" placeholder="https://..." value="{{ old('link') }}">
                @error('link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Berita -->
            <div>
                <label class="block font-semibold mb-1">Jenis Berita</label>
                <select name="jenis_berita" class="w-full p-2 border rounded">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="positif" {{ old('jenis_berita') == 'positif' ? 'selected' : '' }}>Positif</option>
                    <option value="negatif" {{ old('jenis_berita') == 'negatif' ? 'selected' : '' }}>Negatif</option>
                </select>
                @error('jenis_berita')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Publikasi -->
            <div>
                <label class="block font-semibold mb-1">Tanggal Publikasi</label>
                <input type="date" name="tanggal_publikasi" class="w-full p-2 border rounded" value="{{ old('tanggal_publikasi') }}">
                @error('tanggal_publikasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block font-semibold mb-1">Gambar</label>
                <input type="file" name="gambar" class="w-full p-2 border rounded bg-white">
                @error('gambar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <small class="text-sm text-gray-600">Format .jpg, .png, dsb. Maksimal 2MB</small>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-4">
                <button type="reset" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Reset</button>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection