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
        <thead class="bg-white-200">
            <tr>
                <th class="p-2 px-8 py-4 text-left">Pegawai</th>
                <th class="p-2 text-left">NIP</th>
                <th class="p-2 text-left">NRK</th>
                <th class="p-2 text-left">Hotel</th>
                <th class="p-2 text-left">Unit</th>
                <th class="p-2 text-left">Tanggal Masuk</th>
                <th class="p-2 text-left">Tanggal Keluar</th>
                <th class="p-2 text-left">Biaya</th>
                <th class="p-2 text-left">Bukti Resi</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hotels as $hotel)
                <tr>
                    <td class="p-2 px-8">{{ $hotel->pegawai->nama ?? '-' }}</td>
                    <td class="p-2">{{ $hotel->pegawai->nip ?? '-' }}</td>
                    <td class="p-2">{{ $hotel->pegawai->nrk ?? '-' }}</td>
                    <td class="p-2">{{ $hotel->nama_hotel }}</td>
                    <td class="p-2">{{ $hotel->unit->nama_unit ?? '-' }}</td>
                    <td class="p-2">{{ $hotel->tanggal_masuk }}</td>
                    <td class="p-2">{{ $hotel->tanggal_keluar }}</td>
                    <td class="p-2">Rp{{ number_format($hotel->biaya, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">
                        @if ($hotel->bukti_resi)
                            @php
                                // Coba cek di folder 'tiket' dulu
                                $pathTiket = 'asset/img/tiket/' . basename($hotel->bukti_resi);
                                $fullTiket = public_path($pathTiket);

                                // Coba juga di folder 'hotel'
                                $pathHotel = 'asset/img/hotel/' . basename($hotel->bukti_resi);
                                $fullHotel = public_path($pathHotel);

                                // Tentukan path yang valid
                                if (file_exists($fullTiket)) {
                                    $finalPath = $pathTiket;
                                } elseif (file_exists($fullHotel)) {
                                    $finalPath = $pathHotel;
                                } else {
                                    $finalPath = null;
                                }
                            @endphp

                            @if ($finalPath)
                                @if (Str::endsWith($finalPath, '.pdf'))
                                    <a href="{{ asset($finalPath) }}" target="_blank" class="text-blue-600 underline">
                                        Lihat Resi PDF
                                    </a>
                                @else
                                    <img src="{{ asset($finalPath) }}" alt="Bukti Resi" class="w-20 h-auto">
                                @endif
                            @else
                                <span class="text-red-500 italic">File tidak ditemukan</span>
                            @endif
                        @else
                            <span class="text-gray-400 italic">Tidak Ada Resi</span>
                        @endif
                    </td>
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
