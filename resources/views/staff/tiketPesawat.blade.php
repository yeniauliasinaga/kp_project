@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
  <h1 class="text-2xl font-bold text-green-700 mb-6">Data Tiket Pesawat</h1>

  {{-- Dropdown Filter --}}
  <div class="flex justify-between items-center mb-4">
    <form action="{{ route('staff.tiketPesawat') }}" method="GET" id="filterForm">
      <select name="unit" id="unitSelect" class="border px-3 py-2 rounded text-sm">
        <option value=""> Semua Unit </option>
        @foreach($unitOptions as $unit)
          <option value="{{ $unit }}" {{ request('unit') == $unit -> id ? 'selected' : '' }}>
            {{ $unit -> nama_unit }}
          </option>
        @endforeach
      </select>
    </form>

    {{-- Tombol Tambah --}}
    <a href="{{ route('staff.tiketPesawat.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
      + Tambah Tiket Pesawat
    </a>
  </div>

  {{-- Tabel Tiket Pesawat --}}
  <div class="bg-white shadow rounded overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-3 text-left">Pegawai</th>
          <th class="p-3 text-left">Unit</th>
          <th class="p-3 text-left">Tujuan</th>
          <th class="p-3 text-left">Tanggal</th>
          <th class="p-3 text-left">Biaya</th>
          <th class="p-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tiketPesawat as $tiket)
          <tr class="border-t">
            <td class="p-3">{{ $tiket->pegawai->nama ?? '-' }}</td>
            <td class="p-3">{{ $tiket->pegawai->unit->nama_unit ?? '-' }}</td>
            <td class="p-3">{{ $tiket->tujuan }}</td>
            <td class="p-3">{{ $tiket->tanggal }}</td>
            <td class="p-3">Rp{{ number_format($tiket->biaya, 0, ',', '.') }}</td>
            <td class="p-3">
              <a href="{{ route('staff.tiketPesawat.edit', $tiket->id) }}" class="text-blue-600 hover:underline">Edit</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="p-3 text-center text-gray-500">Tidak ada data tiket.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Script Auto-Submit --}}
<script>
  document.getElementById('unitSelect').addEventListener('change', function () {
    document.getElementById('filterForm').submit();
  });
</script>
@endsection
