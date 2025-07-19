@extends('layouts.app')

@section('content')
<main class="flex-1 p-6">
  <h1 class="text-2xl font-bold text-green-700 mb-4">Dashboard Superadmin</h1>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div onclick="toggleTable('mobil')" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:bg-green-50">
      <h2 class="text-lg font-semibold text-gray-700">Mobil Tersedia</h2>
      <p class="text-3xl font-bold text-green-600">{{ $mobilTersedia }}</p>
    </div>
    <div onclick="toggleTable('mess')" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:bg-green-50">
      <h2 class="text-lg font-semibold text-gray-700">Mess Tersedia</h2>
      <p class="text-3xl font-bold text-green-600">{{ $messTersedia }}</p>
    </div>
    <div onclick="toggleTable('acara')" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:bg-green-50">
      <h2 class="text-lg font-semibold text-gray-700">Acara Berlangsung</h2>
      <p class="text-3xl font-bold text-green-600">{{ $acaraBerlangsung }}</p>
    </div>
  </div>

  <!-- Detail Table Mobil -->
  <div id="table-mobil" class="hidden bg-white rounded-lg p-4 mb-6 shadow">
    <h2 class="text-lg font-semibold mb-2">Detail Mobil</h2>
    <table class="w-full text-sm table-auto">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2">No Polisi</th>
          <th class="p-2">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($mobilList as $mobil)
          <tr>
            <td class="p-2">{{ $mobil->no_polisi }}</td>
            <td class="p-2">{{ $mobil->status }}</td>
          </tr>
        @empty
          <tr><td colspan="2" class="p-2 text-center text-gray-500">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Detail Table Mess -->
  <div id="table-mess" class="hidden bg-white rounded-lg p-4 mb-6 shadow">
    <h2 class="text-lg font-semibold mb-2">Detail Mess</h2>
    <table class="w-full text-sm table-auto">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2">Lokasi</th>
          <th class="p-2">Nomor Kamar</th>
          <th class="p-2">Jumlah Bed</th>
          <th class="p-2">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($messList as $mess)
          <tr>
            <td class="p-2">{{ $mess->lokasi }}</td>
            <td class="p-2">{{ $mess->nomor_kamar }}</td>
            <td class="p-2">{{ $mess->jumlah_bed }}</td>
            <td class="p-2">
              <span class="px-2 py-1 rounded text-white text-sm
                {{ $mess->status == 'tersedia' ? 'bg-green-500' : 'bg-red-500' }}">
                {{ ucfirst($mess->status) }}
              </span>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="p-2 text-center text-gray-500">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Detail Table Acara -->
  <div id="table-acara" class="hidden bg-white rounded-lg p-4 mb-6 shadow">
    <h2 class="text-lg font-semibold mb-2">Acara Berlangsung</h2>
    <table class="w-full text-sm table-auto">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2">Nama Kegiatan</th>
          <th class="p-2">Tempat</th>
          <th class="p-2">Waktu</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($acaraList as $acara)
          <tr>
            <td class="p-2">{{ $acara->nama_kegiatan }}</td>
            <td class="p-2">{{ $acara->tempat }}</td>
            <td class="p-2">{{ \Carbon\Carbon::parse($acara->waktu_mulai)->translatedFormat('d F Y') }}</td>
          </tr>
        @empty
          <tr><td colspan="3" class="p-2 text-center text-gray-500">Tidak ada acara</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- === Carousel Berita === -->
  <div x-data="{ activeSlide: 0 }" class="mt-10">
    <h2 class="text-xl font-bold text-green-700 mb-4">Berita Terbaru</h2>
    <div class="relative w-full overflow-hidden rounded-xl shadow-lg bg-white">
      <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + activeSlide * 100 + '%)'">
        @foreach($beritaList as $berita)
          <div class="min-w-full p-4">
            <img src="{{ asset('asset/img/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                 class="w-full h-64 object-cover rounded mb-4">
            <h3 class="text-lg font-semibold">{{ $berita->judul }}</h3>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}</p>
          </div>
        @endforeach
      </div>

      <!-- Navigation Button -->
      <div class="absolute inset-0 flex items-center justify-between px-4">
        <button @click="activeSlide = (activeSlide - 1 + {{ count($beritaList) }}) % {{ count($beritaList) }}"
                class="bg-white rounded-full shadow p-2 hover:bg-green-200">
          <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button @click="activeSlide = (activeSlide + 1) % {{ count($beritaList) }}"
                class="bg-white rounded-full shadow p-2 hover:bg-green-200">
          <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

</main>
@endsection

@push('scripts')
<script>
  function toggleTable(id) {
    ['mobil', 'mess', 'acara'].forEach(name => {
      document.getElementById('table-' + name).classList.add('hidden');
    });
    document.getElementById('table-' + id).classList.toggle('hidden');
  }
</script>
@endpush
