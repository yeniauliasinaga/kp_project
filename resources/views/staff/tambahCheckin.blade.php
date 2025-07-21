@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow-md w-full max-w-xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-6 text-green-700">
        {{ isset($checkin) ? 'Edit Check-In Mess' : 'Form Check-In Mess' }}
    </h2>

    <form action="{{ isset($checkin) ? route('staff.checkinMess.update', $checkin->id) : route('staff.checkinMess.store') }}" method="POST">
        @csrf
        @if(isset($checkin))
            @method('PATCH')
        @endif

        {{-- Lokasi --}}
        <div class="mb-4">
            <label for="lokasi" class="block font-medium mb-1">Pilih Lokasi</label>
            <select id="lokasi" class="w-full border rounded px-3 py-2" required onchange="filterKamar()">
                <option value="">-- Pilih Lokasi --</option>
                @foreach($dataMess->pluck('lokasi')->unique() as $lokasi)
                    <option value="{{ $lokasi }}" {{ (isset($checkin) && $checkin->mess->lokasi == $lokasi) ? 'selected' : '' }}>
                        {{ $lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kamar --}}
        <div class="mb-4">
            <label for="mess_id" class="block font-medium mb-1">Pilih Nomor Kamar</label>
            <select name="mess_id" id="mess_id" class="w-full border rounded px-3 py-2" required onchange="updateBed()">
                <option value="">-- Pilih Kamar --</option>
                @foreach($dataMess as $mess)
                    <option value="{{ $mess->id }}"
                        data-lokasi="{{ $mess->lokasi }}"
                        data-bed="{{ $mess->jumlah_bed }}"
                        class="kamar-option {{ (isset($checkin) && $mess->lokasi == $checkin->mess->lokasi) ? '' : 'hidden' }}"
                        {{ (isset($checkin) && $checkin->mess_id == $mess->id) ? 'selected' : '' }}>
                        {{ $mess->nomor_kamar }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Bed --}}
        <div class="mb-4">
            <label for="jumlah_bed" class="block font-medium mb-1">Jumlah Bed</label>
            <input type="number" id="jumlah_bed" class="w-full border rounded px-3 py-2 bg-gray-100" readonly
                value="{{ isset($checkin) ? $checkin->mess->jumlah_bed : '' }}">
        </div>

        {{-- Nama Tamu --}}
        <div class="mb-4">
            <label for="nama_tamu" class="block font-medium mb-1">Nama Tamu</label>
            <input type="text" id="nama_tamu" name="nama_tamu" class="w-full border rounded px-3 py-2"
                value="{{ old('nama_tamu', $checkin->nama_tamu ?? '') }}" required>
        </div>

        {{-- Asal --}}
        <div class="mb-4">
            <label for="asal" class="block font-medium mb-1">Asal</label>
            <input type="text" id="asal" name="asal" class="w-full border rounded px-3 py-2"
                value="{{ old('asal', $checkin->asal ?? '') }}" required>
        </div>

        {{-- Waktu Mulai --}}
        <div class="mb-4">
            <label for="waktu_mulai" class="block font-medium mb-1">Waktu Mulai</label>
            <input type="date" id="waktu_mulai" name="waktu_mulai" class="w-full border rounded px-3 py-2"
                value="{{ old('waktu_mulai', isset($checkin) ? date('Y-m-d', strtotime($checkin->waktu_mulai)) : '') }}" required>
        </div>

        {{-- Waktu Selesai --}}
        <div class="mb-4">
            <label for="waktu_selesai" class="block font-medium mb-1">Waktu Selesai</label>
            <input type="date" id="waktu_selesai" name="waktu_selesai" class="w-full border rounded px-3 py-2"
                value="{{ old('waktu_selesai', isset($checkin) ? date('Y-m-d', strtotime($checkin->waktu_selesai)) : '') }}" required>
        </div>

        {{-- Biaya --}}
        <div class="mb-4">
            <label for="biaya" class="block font-medium mb-1">Biaya</label>
            <input type="number" id="biaya" name="biaya" class="w-full border rounded px-3 py-2"
                value="{{ old('biaya', $checkin->biaya ?? '') }}" required>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-4">
            <a href="{{ route('staff.checkinMess') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                {{ isset($checkin) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>

<script>
    function filterKamar() {
        const lokasi = document.getElementById('lokasi').value;
        const kamarOptions = document.querySelectorAll('.kamar-option');
        const kamarSelect = document.getElementById('mess_id');
        const bedInput = document.getElementById('jumlah_bed');

        // Reset kamar dan bed
        kamarOptions.forEach(opt => {
            opt.classList.add('hidden');
            if (opt.dataset.lokasi === lokasi) {
                opt.classList.remove('hidden');
            }
        });

        // Jika pilihan sekarang tidak cocok, reset
        const selected = kamarSelect.querySelector('option:checked');
        if (!selected || selected.dataset.lokasi !== lokasi) {
            kamarSelect.value = '';
            bedInput.value = '';
        }
    }

    function updateBed() {
        const selected = document.querySelector('#mess_id option:checked');
        document.getElementById('jumlah_bed').value = selected?.dataset?.bed ?? '';
    }

    // Trigger filter & bed update on page load if editing
    window.addEventListener('DOMContentLoaded', () => {
        @if(isset($checkin))
            const lokasiSelect = document.getElementById('lokasi');
            const kamarSelect = document.getElementById('mess_id');

            // Tampilkan kamar sesuai lokasi
            filterKamar();

            // Pilih ulang kamar dan bed
            kamarSelect.value = "{{ $checkin->mess_id }}";
            updateBed();
        @endif
    });
</script>
@endsection
