@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold text-green-700 mb-6">
        {{ isset($permintaan) ? 'Edit Permintaan Kendaraan' : 'Tambah Permintaan Kendaraan' }}
    </h2>

    <form action="{{ isset($permintaan) ? route('staff.permintaankendaraan.update', $permintaan->id) : route('staff.permintaankendaraan.store') }}" method="POST">
        @csrf

        {{-- No Polisi --}}
        <div class="mb-4">
            <label for="no_polisi" class="block font-semibold text-gray-700">Pilih Kendaraan</label>
            <select name="no_polisi" id="no_polisi" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
                <option value=""> Pilih Kendaraan </option>
                @foreach($kendaraan as $k)
                    <option value="{{ $k->no_polisi }}"
                        {{ (old('no_polisi') ?? $permintaan->no_polisi ?? '') == $k->no_polisi ? 'selected' : '' }}>
                        {{ $k->no_polisi }} - {{ $k->jenis }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Supir --}}
        <div class="mb-4">
            <label for="supir_id" class="block font-semibold text-gray-700">Pilih Supir</label>
            <select name="supir_id" id="supir_id" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
                <option value=""> Pilih Supir </option>
                @foreach($supir as $s)
                    <option value="{{ $s->id }}"
                        {{ (old('supir_id') ?? $permintaan->supir_id ?? '') == $s->id ? 'selected' : '' }}>
                        {{ $s->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status Kepemilikan --}}
        <div class="mb-4">
            <label for="status_kepemilikan" class="block font-semibold text-gray-700">Status Kepemilikan</label>
            <select name="status_kepemilikan" id="status_kepemilikan" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
                <option value=""> Pilih Status </option>
                <option value="milik perusahaan"
                    {{ (old('status_kepemilikan') ?? $permintaan->status_kepemilikan ?? '') == 'milik perusahaan' ? 'selected' : '' }}>
                    Milik Perusahaan
                </option>
                <option value="sewa"
                    {{ (old('status_kepemilikan') ?? $permintaan->status_kepemilikan ?? '') == 'sewa' ? 'selected' : '' }}>
                    Sewa
                </option>
            </select>
        </div>

        {{-- Jadwal Berangkat --}}
        <div class="mb-4">
            <label for="jadwal_berangkat" class="block font-semibold text-gray-700">Jadwal Berangkat</label>
            <input type="datetime-local" name="jadwal_berangkat" id="jadwal_berangkat"
                   class="w-full border-gray-300 rounded-lg shadow-sm"
                   value="{{ old('jadwal_berangkat') ?? (isset($permintaan) ? \Carbon\Carbon::parse($permintaan->jadwal_berangkat)->format('Y-m-d\TH:i') : '') }}"
                   required>
        </div>

        {{-- Jadwal Pulang --}}
        <div class="mb-4">
            <label for="jadwal_pulang" class="block font-semibold text-gray-700">Jadwal Pulang</label>
            <input type="datetime-local" name="jadwal_pulang" id="jadwal_pulang"
                   class="w-full border-gray-300 rounded-lg shadow-sm"
                   value="{{ old('jadwal_pulang') ?? (isset($permintaan) ? \Carbon\Carbon::parse($permintaan->jadwal_pulang)->format('Y-m-d\TH:i') : '') }}"
                   required>
        </div>

        {{-- Tujuan --}}
        <div class="mb-6">
            <label for="tujuan" class="block font-semibold text-gray-700">Tujuan</label>
            <select name="tujuan" id="tujuan" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
                <option value=""> Pilih Tujuan </option>
                <option value="dalam wilayah"
                    {{ (old('tujuan') ?? $permintaan->tujuan ?? '') == 'dalam wilayah' ? 'selected' : '' }}>
                    Dalam Wilayah
                </option>
                <option value="luar wilayah"
                    {{ (old('tujuan') ?? $permintaan->tujuan ?? '') == 'luar wilayah' ? 'selected' : '' }}>
                    Luar Wilayah
                </option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between">
            <a href="{{ route('staff.permintaankendaraan') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                {{ isset($permintaan) ? 'Perbarui' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection
