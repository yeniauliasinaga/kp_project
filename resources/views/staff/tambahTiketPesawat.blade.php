@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg mt-10">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">
            {{ isset($tiket) ? 'Edit Tiket Pesawat' : 'Form Tiket Pesawat' }}
        </h2>
    </div>

    <form method="POST" action="{{ isset($tiket) ? route('staff.tiketPesawat.update', $tiket->id) : route('staff.tiketPesawat.store') }}">
        @csrf
        @if(isset($tiket))
            @method('PUT')
        @endif

        <!-- Pegawai -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Pegawai</label>
            <select name="pegawai_id" class="w-full p-2 border rounded" required>
                <option value=""> Pilih Pegawai </option>
                @foreach($pegawai as $p)
                    <option value="{{ $p->id }}" {{ old('pegawai_id', $tiket->pegawai_id ?? '') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tujuan -->
      <div class="mb-4">
          <label class="block font-semibold mb-1">Tujuan</label>
          <select name="tujuan" class="w-full p-2 border rounded" required>
              <option value="">Pilih Tujuan</option>
              <option value="dalam wilayah" {{ old('tujuan', $tiket->tujuan ?? '') == 'dalam wilayah' ? 'selected' : '' }}>Dalam Wilayah</option>
              <option value="luar wilayah" {{ old('tujuan', $tiket->tujuan ?? '') == 'luar wilayah' ? 'selected' : '' }}>Luar Wilayah</option>
          </select>
      </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full p-2 border rounded"
                   value="{{ old('tanggal', isset($tiket) ? \Carbon\Carbon::parse($tiket->tanggal)->format('Y-m-d') : '') }}" required>
        </div>

        <!-- Biaya -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Biaya</label>
            <input type="number" name="biaya" step="0.01" class="w-full p-2 border rounded"
                   value="{{ old('biaya', $tiket->biaya ?? '') }}" placeholder="Contoh: 1500000.00" required>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('staff.tiketPesawat') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                {{ isset($tiket) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection
