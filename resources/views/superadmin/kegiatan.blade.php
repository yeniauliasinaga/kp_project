@extends('layouts.app') <!-- Sesuaikan dengan struktur layout kamu -->

@section('content')
<div class="p-6">
    <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Detail Kegiatan</h1> -->

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Kegiatan</h2>
        <div class="flex gap-3">
            <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
                <option value="all">Semua Status</option>
                <option value="akan_datang">Akan Datang</option>
                <option value="berlangsung">Sedang Berlangsung</option>
                <option value="selesai">Selesai</option>
            </select>

            <a href="{{ route('superadmin.kegiatan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Kegiatan</a>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
        <table class="w-full table-auto text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Nama Kegiatan</th>
                    <th class="p-2 text-left">Tempat</th>
                    <th class="p-2 text-left">Biaya</th>
                    <th class="p-2 text-left">Waktu Mulai</th>
                    <th class="p-2 text-left">Waktu Selesai</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody id="kegiatanTable">
                @foreach ($kegiatan as $item)
                <tr data-status="{{ strtolower($item->status) }}">
                    <td class="p-2">{{ $item->nama_kegiatan }}</td>
                    <td class="p-2">{{ $item->tempat }}</td>
                    <td class="p-2">Rp{{ number_format($item->biaya, 0, ',', '.') }}</td>
                    <td class="p-2">{{ $item->waktu_mulai }}</td>
                    <td class="p-2">{{ $item->waktu_selesai }}</td>
                    <td class="p-2 text-{{ $item->status == 'berlangsung' ? 'green' : ($item->status == 'akan_datang' ? 'blue' : 'gray') }}-600 font-medium">
                        {{ ucfirst($item->status) }}
                    </td>
                    <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('superadmin.kegiatan.edit', $item->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                    <form action="{{ route('superadmin.kegiatan.delete', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
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
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterSelect = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('#kegiatanTable tr');

        filterSelect.addEventListener('change', () => {
            const filter = filterSelect.value;
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                row.style.display = (filter === 'all' || filter === status) ? '' : 'none';
            });
        });
    });
</script>
