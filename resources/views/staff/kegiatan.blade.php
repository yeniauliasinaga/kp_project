@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Kegiatan</h2>
        <div class="flex gap-3">
            <!-- Filter by Status -->
            <form method="GET" action="{{ route('staff.kegiatan') }}" class="flex items-center">
                <select name="status" onchange="this.form.submit()" class="border p-2 rounded text-sm text-gray-700">
                    <option value="">Semua Status</option>
                    <option value="akan_datang" {{ request('status') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </form>

            <a href="{{ route('staff.kegiatan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Kegiatan</a>
        </div>
    </div>

    <table class="w-full table-auto border-collapse bg-white text-sm">
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
            @forelse ($kegiatan as $item)
                <tr>
                    <td class="py-2">{{ $item->nama_kegiatan }}</td>
                    <td class="py-2">{{ $item->tempat }}</td>
                    <td class="py-2">Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }}</td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') }}</td>
                    <td class="py-2">
                        <span class="text-sm font-semibold px-2 py-1 rounded
                            {{ $item->status == 'berlangsung' ? 'text-green-500' : ($item->status == 'akan_datang' ? 'text-blue-500' : 'text-gray-500') }}">
                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                        </span>
                    </td>
                    <td class="py-2">
                        <a href="{{ route('staff.kegiatan.edit', $item->id) }}"
                           class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500 py-4">Tidak ada kegiatan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
