@extends('layouts.app')

@section('title', 'Daftar Berita')

@section('content')
    <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Berita</h1>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Daftar Berita</h2>
        <div class="flex gap-3">
            <!-- Filter by Status -->
            <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
                <option value="all">Jenis</option>
                <option value="positif">Positif</option>
                <option value="negatif">Negatif</option>
            </select>

            <!-- Tambah Button -->
            <a href="{{ route('staff.berita.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Berita</a>
        </div>
    </div>

    <!-- Tabel Berita -->
    <div class="bg-white p-4 rounded shadow">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-2">Gambar</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Sumber Media</th>
                    <th class="px-4 py-2">Jenis</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beritas as $berita)
                <tr class="border-b" data-status="{{ $berita->jenis_berita }}">
                    <td class="px-4 py-2">
                        <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-24 h-16 object-cover rounded" />
                    </td>
                    <td class="px-4 py-2">{{ $berita->judul }}</td>
                    <td class="px-4 py-2">{{ $berita->sumber_media }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs {{ $berita->jenis_berita === 'positif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($berita->jenis_berita) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $berita->tanggal_publikasi->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('staff.berita.edit', $berita->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Update</a>
                        <form action="{{ route('staff.berita.destroy', $berita->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete(this.form)" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        // Filter Script
        const filterSelect = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('tbody tr');

        filterSelect.addEventListener('change', () => {
            const filter = filterSelect.value;
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                row.style.display = (filter === 'all' || filter === status) ? '' : 'none';
            });
        });

        // Hapus Berita
        function confirmDelete(form) {
            if (confirm("Yakin ingin menghapus berita ini?")) {
                form.submit();
            }
        }
    </script>
@endpush