@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Check-In Mess</h1>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Check-In Tamu</h2>
        <div class="flex gap-3">
            <a href="{{ route('staff.checkinMess.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Check-In</a>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
        <table class="w-full table-auto text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Nama Tamu</th>
                    <th class="p-2 text-left">Asal</th>
                    <th class="p-2 text-left">Mess</th>
                    <th class="p-2 text-left">Waktu Mulai</th>
                    <th class="p-2 text-left">Waktu Selesai</th>
                    <th class="p-2 text-left">Biaya</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkins as $item)
                <tr>
                    <td class="p-2">{{ $item->nama_tamu }}</td>
                    <td class="p-2">{{ $item->asal }}</td>
                    <td class="p-2">{{ $item->mess->lokasi ?? '-' }}</td>
                    <td class="p-2">{{ $item->waktu_mulai }}</td>
                    <td class="p-2">{{ $item->waktu_selesai }}</td>
                    <td class="p-2">Rp{{ number_format($item->biaya, 0, ',', '.') }}</td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('staff.checkinMess.edit', $item->id) }}" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                    </td>
                </tr>
                @endforeach

                @if($checkins->isEmpty())
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">Belum ada data check-in.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
