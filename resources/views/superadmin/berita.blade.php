@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Title & Tombol --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Berita</h2>
        <a href="{{ route('superadmin.berita.create') }}" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">+ Tambah Berita</a>
    </div>

    {{-- Filter & Table --}}
    <div class="mb-6">
        <div class="flex items-center mb-3 gap-3">
            <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
                <option value="all">Semua Jenis</option>
                <option value="positif">Positif</option>
                <option value="negatif">Negatif</option>
            </select>
        </div>

        <div class="overflow-auto">
            <table class="w-full table-auto bg-white shadow rounded text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 text-left">Judul</th>
                        <th class="p-2 text-left">Jenis</th>
                        <th class="p-2 text-left">Tanggal Publikasi</th>
                        <th class="p-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($berita as $row)
                        <tr data-status="{{ $row->jenis_berita }}">
                            <td class="p-2">{{ $row->judul }}</td>
                            <td class="p-2 text-{{ $row->jenis_berita == 'positif' ? 'green' : 'red' }}-600 capitalize">{{ ucfirst($row->jenis_berita) }}</td>
                            <td class="p-2">{{ $row->tanggal_publikasi }}</td>
                            <td class="p-2">
                                <a href="{{ route('superadmin.berita.edit', $row->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                                <form action="{{ route('superadmin.berita.delete', $row->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-2 text-center text-gray-500">Tidak ada berita</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Highlight 3 Berita Terbaru --}}
    <h3 class="text-xl font-bold text-green-700 mb-4">Highlight Berita Terbaru</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($berita->sortByDesc('tanggal_publikasi')->take(3) as $row)
            <div class="bg-white rounded shadow p-4">
                <img src="{{ asset('asset/img/berita/' . $row->gambar) }}" alt="Gambar Berita" class="w-full h-40 object-cover rounded mb-3">
                <h3 class="text-lg font-bold mb-1">{{ $row->judul }}</h3>
                <p class="text-sm text-gray-600 mb-1">Jenis: {{ ucfirst($row->jenis_berita) }}</p>
                <p class="text-sm text-gray-600 mb-3">Tanggal: {{ $row->tanggal_publikasi }}</p>
            </div>
        @endforeach
    </div>
</div>

{{-- JS Filter Table --}}
<script>
    const filterSelect = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('tbody tr[data-status]');

    filterSelect.addEventListener('change', () => {
        const filter = filterSelect.value;
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            row.style.display = (filter === 'all' || filter === status) ? '' : 'none';
        });
    });
</script>
@endsection
