<!-- resources/views/staff/hotel.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
  <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Data Penginapan Hotel</h1> -->

  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Data Penginapan Hotel</h2>
    <div class="flex gap-3">
      <!-- Filter by Unit -->
      <form method="GET" action="" class="flex items-center">
        <select name="unit" onchange="this.form.submit()" class="border p-2 rounded text-sm text-gray-700">
          <option value="">Semua Unit</option>
          @foreach($units as $unit)
            <option value="{{ $unit->id }}" {{ request('unit') == $unit->id ? 'selected' : '' }}>{{ $unit->nama_unit }}</option>
          @endforeach
        </select>
      </form>

      <a href="{{ route('staff.hotel.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Hotel</a>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow rounded text-sm">
      <thead class="bg-gray-200 text-left text-green-900 text-sm">
        <tr>
          <th class="p-2 text-left">Pegawai</th>
          <th class="p-2 text-left">Hotel</th>
          <th class="p-2 text-left">Unit</th>
          <th class="p-2 text-left">Tanggal Masuk</th>
          <th class="p-2 text-left">Tanggal Keluar</th>
          <th class="p-2 text-left">Biaya</th>
          <th class="p-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($hotels as $hotel)
          <tr class="border-b">
            <td class="p-2">{{ $hotel->pegawai->nama ?? '-' }}</td>
            <td class="p-2">{{ $hotel->nama_hotel }}</td>
            <td class="p-2">{{ $hotel->unit->nama_unit ?? '-' }}</td>
            <td class="p-2">{{ $hotel->tanggal_masuk }}</td>
            <td class="p-2">{{ $hotel->tanggal_keluar }}</td>
            <td class="p-2">Rp{{ number_format($hotel->biaya, 0, ',', '.') }}</td>
            <td class="p-2">
              <a href="{{ route('staff.hotel.edit', $hotel->id) }}" class="text-blue-600 hover:underline">Edit</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada data hotel.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
