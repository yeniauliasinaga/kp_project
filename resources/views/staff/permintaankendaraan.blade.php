@extends('layouts.app')

@section('content')
<main class="flex-1 p-6 overflow-auto">
  <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Permintaan Kendaraan</h1> -->

  @if (session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Permintaan Kendaraan</h2>
    <a href="{{ route('staff.permintaankendaraan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Permintaan</a>
  </div>

  <div class="bg-white rounded-xl p-4 shadow">
    <table class="w-full table-auto text-sm">
      <thead class="text-green-900">
        <tr>
          <th class="p-2 text-left">Supir</th>
          <th class="p-2 text-left">No Polisi</th>
          <th class="p-2 text-left">Kepemilikan</th>
          <th class="p-2 text-left">Jadwal</th>
          <th class="p-2 text-left">Tujuan</th>
          <th class="p-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($permintaan as $item)
          <tr>
            <td class="p-2">{{ $item->supir->nama_lengkap ?? '-' }}</td>
            <td class="p-2">{{ $item->no_polisi }}</td>
            <td class="p-2 capitalize">{{ $item->status_kepemilikan }}</td>
            <td class="p-2">
              {{ \Carbon\Carbon::parse($item->jadwal_berangkat)->format('Y-m-d') }}
              →
              {{ \Carbon\Carbon::parse($item->jadwal_pulang)->format('Y-m-d') }}
            </td>
            <td class="p-2 capitalize">{{ $item->tujuan }}</td>
            <td class="p-2 space-x-2">
              <a href="{{ route('staff.permintaankendaraan.edit', $item->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">Tidak ada data permintaan kendaraan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>
@endsection
