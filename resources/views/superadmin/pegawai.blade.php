@extends('layouts.app')

@section('content')
<div class="p-6">
  <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Data Pegawai</h1> -->

  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Data Pegawai</h2>
    <a href="{{ route('superadmin.pegawai.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Pegawai</a>
  </div>

  <div class="bg-white shadow rounded p-4">
    <table class="w-full table-auto text-sm">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2">Nama</th>
          <th class="p-2">NIP</th>
          <th class="p-2">Jabatan</th>
          <th class="p-2">Role</th>
          <th class="p-2">Unit</th>
          <th class="p-2">Alamat</th>
          <th class="p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawai as $data)
          <tr class="border-b">
            <td class="p-2 text-center">{{ $data->nama }}</td>
            <td class="p-2 text-center">{{ $data->nip }}</td>
            <td class="p-2 text-center">{{ $data->jabatan }}</td>
            <td class="p-2 text-center">{{ ucfirst($data->role) }}</td>
            <td class="p-2 text-center">{{ $data->unit->nama_unit ?? '-' }}</td>
            <td class="p-2 text-center">{{ $data->alamat }}</td>
            <td class="p-2 text-center">
              <a href="{{ route('superadmin.pegawai.edit', $data->id) }}" class="text-blue-600 hover:underline">Edit</a>
              <form action="{{ route('superadmin.pegawai.delete', $data->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection