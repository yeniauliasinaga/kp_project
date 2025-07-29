@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Supir</h1> -->

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Data Supir</h2>
        <a href="{{ route('superadmin.supir.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
           + Tambah Supir
        </a>
    </div>

    <div class="p-4 bg-white shadow rounded">
        <table class="w-full table-auto text-sm">
            <thead class="bg-white-200">
                <tr>
                    <th class="p-2 text-left">Nama</th>
                    <th class="p-2 text-left">Tanggal Lahir</th>
                    <th class="p-2 text-left">Jenis Kelamin</th>
                    <th class="p-2 text-left">No Telepon</th>
                    <th class="p-2 text-left">NIK</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supirs as $supir)
                <tr>
                    <td class="p-2">{{ $supir->nama_lengkap }}</td>
                    <td class="p-2">{{ $supir->tanggal_lahir }}</td>
                    <td class="p-2 capitalize">{{ $supir->jenis_kelamin }}</td>
                    <td class="p-2">{{ $supir->no_telepon }}</td>
                    <td class="p-2">{{ $supir->nik }}</td>
                    <td class="p-2 text-{{ $supir->status == 'tersedia' ? 'green' : 'red' }}-600 capitalize">{{ $supir->status }}</td>
                    <td class="p-2 space-x-2">
                        <a href="{{ route('superadmin.supir.edit', $supir->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('superadmin.supir.delete', $supir->id) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus supir ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($supirs->isEmpty())
                <tr>
                    <td colspan="7" class="p-2 text-center text-gray-500">Tidak ada data supir.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
