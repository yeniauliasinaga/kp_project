@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 mt-10 rounded-xl shadow-lg">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">
            {{ isset($proposal) ? 'Edit Proposal' : 'Form Tambah Proposal' }}
        </h2>
    </div>

    <form class="space-y-6"
        method="POST"
        action="{{ isset($proposal) ? route('staff.proposal.update', $proposal->id) : route('staff.proposal.store') }}">
        @csrf

        @if(isset($proposal))
            @method('POST') {{-- karena route update pakai POST juga --}}
        @endif

        <!-- Nama Instansi -->
        <div>
            <label class="block font-semibold mb-1">Nama Instansi</label>
            <input type="text" name="nama_instansi" class="w-full p-2 border rounded"
                placeholder="Contoh: Yayasan Harapan Baru"
                value="{{ old('nama_instansi', $proposal->nama_instansi ?? '') }}">
        </div>

        <!-- Disposisi -->
        <div>
            <label class="block font-semibold mb-1">Disposisi</label>
            <select name="disposisi" class="w-full p-2 border rounded">
                <option value="">-- Pilih Disposisi --</option>
                <option value="disetujui" {{ (old('disposisi', $proposal->disposisi ?? '') == 'disetujui') ? 'selected' : '' }}>Disetujui</option>
                <option value="tidak disetujui" {{ (old('disposisi', $proposal->disposisi ?? '') == 'tidak disetujui') ? 'selected' : '' }}>Tidak Disetujui</option>
            </select>
        </div>

        <!-- Nilai Bantuan -->
        <div>
            <label class="block font-semibold mb-1">Nilai Bantuan (Rp)</label>
            <input type="number" step="0.01" name="nilai_bantuan" class="w-full p-2 border rounded"
                placeholder="Contoh: 1000000.00"
                value="{{ old('nilai_bantuan', $proposal->nilai_bantuan ?? '') }}">
        </div>

        <!-- Tanggal Proposal -->
        <div>
            <label class="block font-semibold mb-1">Tanggal Proposal</label>
            <input type="date" name="tanggal_proposal" class="w-full p-2 border rounded"
                value="{{ old('tanggal_proposal', $proposal->tanggal_proposal ?? '') }}">
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full p-2 border rounded"
                placeholder="Deskripsi atau keterangan tambahan...">{{ old('deskripsi', $proposal->deskripsi ?? '') }}</textarea>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('superadmin.proposal') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
