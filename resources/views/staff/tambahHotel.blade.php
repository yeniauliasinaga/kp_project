@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg mt-10">
  <div class="mb-6 text-center">
    <h2 class="text-xl font-bold text-green-700">
      {{ isset($hotel) ? 'Form Edit Penginapan Hotel' : 'Form Tambah Penginapan Hotel' }}
    </h2>
  </div>

  <form class="space-y-6" method="POST" 
        action="{{ isset($hotel) ? route('staff.hotel.update', $hotel->id) : route('staff.hotel.store') }}">
    @csrf
    @if(isset($hotel))
      @method('PUT')
    @endif

    {{-- Pegawai --}}
    <div>
      <label class="block font-semibold mb-1">Pegawai</label>
      <select name="pegawai_id" id="pegawai_id" class="w-full p-2 border rounded" required>
        <option value=""> Pilih Pegawai </option>
        @foreach ($pegawais as $pegawai)
          <option value="{{ $pegawai->id }}" 
                  data-unit="{{ $pegawai->unit_id }}"
                  {{ old('pegawai_id', $hotel->pegawai_id ?? '') == $pegawai->id ? 'selected' : '' }}>
            {{ $pegawai->nama }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Nama Hotel --}}
    <div>
      <label class="block font-semibold mb-1">Nama Hotel</label>
      <input type="text" name="nama_hotel" class="w-full p-2 border rounded"
             value="{{ old('nama_hotel', $hotel->nama_hotel ?? '') }}" 
             placeholder="Contoh: Hotel Santika Medan" required>
    </div>

    {{-- Unit --}}
    <div>
      <label class="block font-semibold mb-1">Unit/Divisi</label>
      <select name="unit_id" id="unit_id" class="w-full p-2 border rounded" required>
        <option value=""> Pilih Unit </option>
        @foreach ($units as $unit)
          <option value="{{ $unit->id }}" 
                  {{ old('unit_id', $hotel->unit_id ?? '') == $unit->id ? 'selected' : '' }}>
            {{ $unit->nama_unit }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Biaya --}}
    <div>
      <label class="block font-semibold mb-1">Biaya</label>
      <input type="number" name="biaya" step="0.01" class="w-full p-2 border rounded"
             value="{{ old('biaya', $hotel->biaya ?? '') }}" placeholder="Contoh: 750000.00" required>
    </div>

    {{-- Tanggal Masuk --}}
    <div>
      <label class="block font-semibold mb-1">Tanggal Masuk</label>
      <input type="date" name="tanggal_masuk" class="w-full p-2 border rounded"
             value="{{ old('tanggal_masuk', $hotel->tanggal_masuk ?? '') }}" required>
    </div>

    {{-- Tanggal Keluar --}}
    <div>
      <label class="block font-semibold mb-1">Tanggal Keluar</label>
      <input type="date" name="tanggal_keluar" class="w-full p-2 border rounded"
             value="{{ old('tanggal_keluar', $hotel->tanggal_keluar ?? '') }}" required>
    </div>

    {{-- Tombol --}}
    <div class="flex justify-end space-x-4">
      <a href="{{ route('staff.hotel') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
      <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        {{ isset($hotel) ? 'Update' : 'Simpan' }}
      </button>
    </div>
  </form>
</div>

{{-- JavaScript untuk auto update unit_id berdasarkan pegawai --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const pegawaiSelect = document.getElementById('pegawai_id');
    const unitSelect = document.getElementById('unit_id');

    pegawaiSelect.addEventListener('change', function () {
      const selectedOption = this.options[this.selectedIndex];
      const unitId = selectedOption.getAttribute('data-unit');

      if (unitId) {
        unitSelect.value = unitId;
      }
    });

    // Trigger change saat halaman load agar unit_id terisi jika sedang edit
    if (pegawaiSelect.value) {
      pegawaiSelect.dispatchEvent(new Event('change'));
    }
  });
</script>
@endsection
