@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Data Tiket Pesawat</h2>

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

    <table class="w-full table-auto bg-white shadow rounded text-sm text-center">
        <thead class="bg-white-200">
            <tr>
                <th class="p-4">Pegawai</th>
                <th class="p-4">Unit</th>
                <th class="p-4">Tujuan</th>
                <th class="p-4">Tanggal</th>
                <th class="p-4">Biaya</th>
                <th class="p-4">Resi</th>
                <th class="p-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tiket as $row)
                <tr>
                    <td class="p-4">{{ $row->pegawai->nama ?? '-' }}</td>
                    <td class="p-4">{{ $row->pegawai->unit->nama_unit ?? '-' }}</td>
                    <td class="p-4">{{ $row->tujuan }}</td>
                    <td class="p-4">{{ $row->tanggal }}</td>
                    <td class="p-4">Rp{{ number_format($row->biaya, 0, ',', '.') }}</td>
                    <td class="p-4">
                        @if($row->resi)
                            @php
                                $ext = pathinfo($row->resi, PATHINFO_EXTENSION);
                            @endphp
                            @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <a href="{{ asset($row->resi) }}" target="_blank">
                                    <img src="{{ asset($row->resi) }}" alt="Resi" class="w-20 h-16 object-cover mx-auto border rounded shadow">
                                </a>
                            @elseif(strtolower($ext) === 'pdf')
                                <a href="{{ asset($row->resi) }}" target="_blank" class="text-blue-600 underline">Lihat PDF</a>
                            @else
                                <span class="text-gray-400 italic">File tidak dikenali</span>
                            @endif
                        @else
                            <span class="text-gray-400 italic">Tidak ada resi</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <a href="{{ route('superadmin.tiketpesawat.edit', $row->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('superadmin.tiketpesawat.delete', $row->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-2 text-center text-gray-500">Belum ada data tiket</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
