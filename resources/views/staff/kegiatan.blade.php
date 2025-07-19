@extends('layouts.app')

@section('content')
<div class="p-6">

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Kegiatan</h2>
    <a href="{{ route('staff.kegiatan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Kegiatan</a>
  </div>

    <!-- <h2 class="text-2xl font-bold mb-4 text-green-700">Daftar Kegiatan</h2>

    <a href="{{ route('staff.kegiatan.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white py-2 rounded mb-4 inline-block">Tambah Kegiatan</a> -->

    <table class="w-full table-auto border-collapse bg-white">
        <thead>
            <tr class="text-left text-green-900 text-sm">
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
                <tr class="text-left text-sm">
                    <td class="py-2">{{ $item->nama_kegiatan }}</td>
                    <td class="py-2">{{ $item->tempat }}</td>
                    <td class="py-2">Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }}</td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') }}</td>
                    <td class="p-2 text-{{ $item->status == 'berlangsung' ? 'green' : ($item->status == 'akan_datang' ? 'blue' : 'gray') }}-600 font-medium">
                        {{ ucfirst($item->status) }}
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
