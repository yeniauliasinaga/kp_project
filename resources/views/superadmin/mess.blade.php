@extends('layouts.app')

@section('title', 'Daftar Mess')

@section('content')
<div class="p-6">
    <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Mess</h1> -->

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Data Mess</h2>
        <div class="flex gap-3">
            <!-- Tombol Tambah Mess -->
            <a href="{{ route('superadmin.datamess.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Mess</a>
        </div>
    </div>

    <table class="w-full table-auto bg-white shadow rounded text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">Lokasi</th>
                <th class="p-2 text-left">Nomor Kamar</th>
                <th class="p-2 text-left">Jumlah Bed</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mess as $messItem)
            <tr>
                <td class="p-2">{{ $messItem->lokasi }}</td>
                <td class="p-2">{{ $messItem->nomor_kamar }}</td>
                <td class="p-2">{{ $messItem->jumlah_bed }}</td>
                <td class="p-2 text-{{ $messItem->status == 'tersedia' ? 'green' : 'red' }}-600 capitalize">{{ $messItem->status }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('superadmin.datamess.edit', $messItem->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                    <form action="{{ route('superadmin.datamess.delete', $messItem->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus mess ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">Tidak ada data mess tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
