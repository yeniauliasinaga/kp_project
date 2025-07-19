@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow-md w-full max-w-xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-6 text-green-700">
        {{ isset($checkin) ? 'Edit Check-In Mess' : 'Form Check-In Mess' }}
    </h2>

    <form action="{{ isset($checkin) ? route('staff.checkinMess.update', $checkin->id) : route('staff.checkinMess.store') }}" method="POST">
        @csrf

        @if(isset($checkin))
            {{-- Jika edit, method tetap POST karena routenya POST --}}
            <input type="hidden" name="id" value="{{ $checkin->id }}">
        @endif

        <!-- mess_id -->
        <div class="mb-4">
            <label for="mess_id" class="block font-medium mb-1">Pilih Mess</label>
            <select name="mess_id" id="mess_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Mess --</option>
                @foreach($dataMess as $mess)
                    <option value="{{ $mess->id }}" {{ (isset($checkin) && $checkin->mess_id == $mess->id) ? 'selected' : '' }}>
                        {{ $mess->lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- nama_tamu -->
        <div class="mb-4">
            <label for="nama_tamu" class="block font-medium mb-1">Nama Tamu</label>
            <input type="text" id="nama_tamu" name="nama_tamu" class="w-full border rounded px-3 py-2" value="{{ old('nama_tamu', $checkin->nama_tamu ?? '') }}" required>
        </div>

        <!-- asal -->
        <div class="mb-4">
            <label for="asal" class="block font-medium mb-1">Asal</label>
            <input type="text" id="asal" name="asal" class="w-full border rounded px-3 py-2" value="{{ old('asal', $checkin->asal ?? '') }}" required>
        </div>

        <!-- waktu_mulai -->
        <div class="mb-4">
            <label for="waktu_mulai" class="block font-medium mb-1">Waktu Mulai</label>
            <input type="date" id="waktu_mulai" name="waktu_mulai" class="w-full border rounded px-3 py-2" value="{{ old('waktu_mulai', isset($checkin) ? \Carbon\Carbon::parse($checkin->waktu_mulai)->format('Y-m-d') : '') }}" required>
        </div>

        <!-- waktu_selesai -->
        <div class="mb-4">
            <label for="waktu_selesai" class="block font-medium mb-1">Waktu Selesai</label>
            <input type="date" id="waktu_selesai" name="waktu_selesai" class="w-full border rounded px-3 py-2" value="{{ old('waktu_selesai', isset($checkin) ? \Carbon\Carbon::parse($checkin->waktu_selesai)->format('Y-m-d') : '') }}" required>
        </div>

        <!-- biaya -->
        <div class="mb-4">
            <label for="biaya" class="block font-medium mb-1">Biaya</label>
            <input type="number" id="biaya" name="biaya" class="w-full border rounded px-3 py-2" value="{{ old('biaya', $checkin->biaya ?? '') }}" required>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('staff.checkinMess') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
