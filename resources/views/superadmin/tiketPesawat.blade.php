@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Data Tiket Pesawat</h1>

      <div class="mb-4 flex justify-between items-center">
        <!-- Filter Unit -->
        <form method="GET" action="{{ route('superadmin.tiketpesawat') }}" class="flex items-center gap-2">
            <label for="unit" class="text-sm font-semibold">Filter Unit:</label>
            <select name="unit" id="unit" onchange="this.form.submit()" class="p-2 border rounded text-sm">
                <option value="">Semua Unit</option>
                @foreach($unitList as $unit)
                    <option value="{{ $unit->id }}" {{ request('unit') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->nama_unit }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Button Tambah -->
        <a href="{{ route('superadmin.tiketpesawat.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Tiket Pesawat</a>
    </div>


    <table class="w-full table-auto bg-white shadow rounded text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">Pegawai</th>
                <th class="p-2 text-left">Unit</th>
                <th class="p-2 text-left">Tujuan</th>
                <th class="p-2 text-left">Tanggal</th>
                <th class="p-2 text-left">Biaya</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tiket as $row)
                <tr>
                    <td class="p-2">{{ $row->pegawai->nama ?? '-' }}</td>
                    <td class="p-2">{{ $row->pegawai->unit->nama_unit ?? '-' }}</td>
                    <td class="p-2">{{ $row->tujuan }}</td>
                    <td class="p-2">{{ $row->tanggal }}</td>
                    <td class="p-2">Rp{{ number_format($row->biaya, 0, ',', '.') }}</td>
                    <td class="p-2">
                        <a href="{{ route('superadmin.tiketpesawat.edit', $row->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('superadmin.tiketpesawat.delete', $row->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="p-2 text-center text-gray-500">Belum ada data tiket</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
