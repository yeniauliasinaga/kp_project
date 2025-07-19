@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Data Penginapan Hotel</h1> -->

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Data Penginapan Hotel</h2>
        <a href="{{ route('superadmin.hotel.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
            + Tambah Hotel
        </a>
    </div>

    <table class="w-full table-auto bg-white shadow rounded text-sm">
        <thead class="bg-gray-200">
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
            @foreach ($hotels as $hotel)
                <tr>
                    <td class="p-2">{{ $hotel->pegawai->nama ?? '-' }}</td>
                    <td class="p-2">{{ $hotel->nama_hotel }}</td>
                    <td class="p-2">{{ $hotel->unit->nama_unit ?? '-' }}</td>
                    <td class="p-2">{{ $hotel->tanggal_masuk }}</td>
                    <td class="p-2">{{ $hotel->tanggal_keluar }}</td>
                    <td class="p-2">Rp{{ number_format($hotel->biaya, 0, ',', '.') }}</td>
                    <td class="p-2 space-x-2">
                        <a href="{{ route('superadmin.hotel.edit', $hotel->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('superadmin.hotel.delete', $hotel->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
