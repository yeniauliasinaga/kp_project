@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Kegiatan</h2>
        <div class="flex gap-3">
            <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
                <option value="all">Semua Status</option>
                <option value="akan_datang">Akan Datang</option>
                <option value="berlangsung">Sedang Berlangsung</option>
                <option value="selesai">Selesai</option>
            </select>

            <a href="{{ route('staff.kegiatan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Kegiatan</a>
        </div>
    </div>

    <table id="kegiatanTable" class="w-full table-auto border-collapse bg-white text-sm ">
        <thead>
            <tr class="text-left text-green-900">
                <th class="py-2">Nama</th>
                <th class="py-2">Tempat</th>
                <th class="py-2">Biaya</th>
                <th class="py-2">Mulai</th>
                <th class="py-2">Selesai</th>
                <th class="py-2">Status</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatan as $item)
                <tr data-status="{{ $item->status }}">
                    <td class="py-2">{{ $item->nama_kegiatan }}</td>
                    <td class="py-2">{{ $item->tempat }}</td>
                    <td class="py-2">Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }}</td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') }}</td>
                    <td class="p-2 text-{{ $item->status == 'berlangsung' ? 'green' : ($item->status == 'akan_datang' ? 'blue' : 'gray') }}-600 font-medium">
                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                    </td>
                    <td class="py-2">
                        <a href="{{ route('staff.kegiatan.edit', $item->id) }}"
                           class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterSelect = document.getElementById('filterStatus');
        const table = document.getElementById('kegiatanTable');
        const rows = table.querySelectorAll('tbody tr');

        filterSelect.addEventListener('change', () => {
            const filter = filterSelect.value;
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                
                if (filter === 'all' || filter === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection