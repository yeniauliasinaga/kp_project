@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg mt-6">
    <h2 class="text-xl font-bold text-center text-green-700 mb-6">
        {{ isset($berita) ? 'Form Edit Berita' : 'Form Tambah Berita' }}
    </h2>

    <form method="POST" action="{{ isset($berita) ? route('superadmin.berita.update', $berita->id) : route('superadmin.berita.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($berita))
            @method('POST')
        @endif

        <div class="space-y-4">
            <div>
                <label class="block font-semibold mb-1">Judul</label>
                <input type="text" name="judul" class="w-full p-2 border rounded" value="{{ old('judul', $berita->judul ?? '') }}">
            </div>

            <div>
                <label class="block font-semibold mb-1">Sumber Media</label>
                <input type="text" name="sumber_media" class="w-full p-2 border rounded" value="{{ old('sumber_media', $berita->sumber_media ?? '') }}">
            </div>

            <div>
                <label class="block font-semibold mb-1">Link</label>
                <input type="url" name="link" class="w-full p-2 border rounded" value="{{ old('link', $berita->link ?? '') }}">
            </div>

            <div>
                <label class="block font-semibold mb-1">Jenis Berita</label>
                <select name="jenis_berita" class="w-full p-2 border rounded">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="positif" {{ old('jenis_berita', $berita->jenis_berita ?? '') == 'positif' ? 'selected' : '' }}>Positif</option>
                    <option value="negatif" {{ old('jenis_berita', $berita->jenis_berita ?? '') == 'negatif' ? 'selected' : '' }}>Negatif</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tanggal Publikasi</label>
                <input type="date" name="tanggal_publikasi" class="w-full p-2 border rounded" value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi ?? '') }}">
            </div>

            <div>
                <label class="block font-semibold mb-1">Gambar</label>
                <input type="file" name="gambar" class="w-full p-2 border rounded bg-white">
                @if(isset($berita))
                    <div class="mt-2">
                        <img src="{{ asset('asset/img/berita/' . $berita->gambar) }}" alt="Gambar" class="w-32 h-20 object-cover rounded">
                    </div>
                @endif
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('superadmin.berita') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Kembali</a>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    {{ isset($berita) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
