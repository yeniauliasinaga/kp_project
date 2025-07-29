@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Data Kendaraan</h2>
    <a href="{{ route('superadmin.kendaraan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
      + Tambah Kendaraan
    </a>
  </div>

  <div class="mb-4">
    <label for="filterStatus" class="text-sm text-gray-700">Filter Status:</label>
    <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700 ml-2">
      <option value="all">Semua</option>
      <option value="tersedia">Tersedia</option>
      <option value="digunakan">Digunakan</option>
    </select>
  </div>

  <div class="bg-white shadow rounded-xl overflow-x-auto">
    <table class="min-w-full table-auto text-sm text-left">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="px-4 py-2">No Polisi</th>
          <th class="px-4 py-2">Merek</th>
          <th class="px-4 py-2">Model</th>
          <th class="px-4 py-2">Bahan Bakar</th>
          <th class="px-4 py-2">Status Kepemilikan</th>
          <th class="px-4 py-2">Status</th>
          <th class="px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody id="kendaraanTable">
        @foreach ($kendaraans as $kendaraan)
          <tr data-status="{{ strtolower($kendaraan->status) }}" class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">{{ $kendaraan->no_polisi }}</td>
            <td class="px-4 py-2">{{ $kendaraan->merek }}</td>
            <td class="px-4 py-2">{{ $kendaraan->model }}</td>
            <td class="px-4 py-2">{{ $kendaraan->bahan_bakar }}</td>
            <td class="px-4 py-2">{{ $kendaraan->status_kepemilikan }}</td>
            <td class="px-4 py-2 {{ strtolower($kendaraan->status) === 'tersedia' ? 'text-green-600' : 'text-red-600' }}">
              {{ ucfirst($kendaraan->status) }}
            </td>
            <td class="px-4 py-2 space-x-2">
              <a href="{{ route('superadmin.kendaraan.edit', $kendaraan->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
              <form action="{{ route('superadmin.kendaraan.delete', $kendaraan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    const filterSelect = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('#kendaraanTable tr');

    filterSelect.addEventListener('change', () => {
      const filter = filterSelect.value.toLowerCase();
      rows.forEach(row => {
        const status = row.getAttribute('data-status');
        row.style.display = (filter === 'all' || filter === status) ? '' : 'none';
      });
    });
  </script>
@endsection
