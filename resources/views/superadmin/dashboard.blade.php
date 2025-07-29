@extends('layouts.app')

@section('content')
<main class="flex-1 p-6">
  <h1 class="text-2xl font-bold text-green-700 mb-4">Dashboard Superadmin</h1>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow">
      <h2 class="text-lg font-semibold text-gray-700">Mobil Tersedia</h2>
      <p class="text-3xl font-bold text-green-600">{{ $mobilTersedia }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <h2 class="text-lg font-semibold text-gray-700">Mess Tersedia</h2>
      <p class="text-3xl font-bold text-green-600">{{ $messTersedia }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <h2 class="text-lg font-semibold text-gray-700">Acara Berlangsung</h2>
      <p class="text-3xl font-bold text-green-600">{{ $acaraBerlangsung }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <h2 class="text-lg font-semibold text-gray-700">Proposal Disetujui</h2>
      <p class="text-3xl font-bold text-green-600">{{ $jumlahProposalDisetujui }}</p>
    </div>
  </div>

  <!-- === Highlight Kegiatan Carousel === -->
  <div x-data="{ activeSlide: 0 }" class="mt-10">
    <h2 class="text-xl font-bold text-green-700 mb-4">Highlight Kegiatan</h2>
    <div class="relative w-full overflow-hidden rounded-xl shadow-lg bg-white">
      <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + activeSlide * 100 + '%)'">
        @foreach($highlightKegiatan as $kegiatan)
          <div class="min-w-full p-4">
            <img src="{{ asset('asset/img/kegiatan/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->nama }}"
                 class="w-full h-64 object-cover rounded mb-4">
            <h3 class="text-lg font-semibold">{{ $kegiatan->nama_kegiatan }}</h3>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}</p>
          </div>
        @endforeach
      </div>
      <div class="absolute inset-0 flex items-center justify-between px-4">
        <button @click="activeSlide = (activeSlide - 1 + {{ count($highlightKegiatan) }}) % {{ count($highlightKegiatan) }}"
                class="bg-white rounded-full shadow p-2 hover:bg-green-200">
          <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button @click="activeSlide = (activeSlide + 1) % {{ count($highlightKegiatan) }}"
                class="bg-white rounded-full shadow p-2 hover:bg-green-200">
          <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- === Berita Terbaru Carousel === -->
<div x-data="{ beritaSlide: 0 }" class="mt-10">
  <h2 class="text-xl font-bold text-green-700 mb-4">Berita Terbaru</h2>
  <div class="relative w-full overflow-hidden rounded-xl shadow-lg bg-white">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + beritaSlide * 100 + '%)'">
      @foreach($beritaList as $berita)
        <div class="min-w-full p-4">
          <img src="{{ asset('asset/img/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
               class="w-full h-64 object-cover rounded mb-4">
          <h3 class="text-lg font-semibold">{{ $berita->judul }}</h3>
          <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}</p>
          <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($berita->isi), 100, '...') }}</p>
        </div>
      @endforeach
    </div>

    <!-- Navigasi Panah -->
    <div class="absolute inset-0 flex items-center justify-between px-4">
      <button @click="beritaSlide = (beritaSlide - 1 + {{ count($beritaList) }}) % {{ count($beritaList) }}"
              class="bg-white rounded-full shadow p-2 hover:bg-green-200">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button @click="beritaSlide = (beritaSlide + 1) % {{ count($beritaList) }}"
              class="bg-white rounded-full shadow p-2 hover:bg-green-200">
        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
  </div>
</div>


  <!-- === Acara Akan Datang === -->
  <div class="mt-10">
    <h2 class="text-xl font-bold text-green-700 mb-4">Acara Akan Datang</h2>
    <table class="w-full table-auto text-sm bg-white rounded shadow">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2">Nama Kegiatan</th>
          <th class="p-2">Tempat</th>
          <th class="p-2">Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($acaraAkanDatang as $acara)
          <tr>
            <td class="p-2">{{ $acara->nama_kegiatan }}</td>
            <td class="p-2">{{ $acara->tempat }}</td>
            <td class="p-2">{{ \Carbon\Carbon::parse($acara->waktu_mulai)->translatedFormat('d F Y') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- === Tiket Pesawat === -->
  <div class="mt-10">
    <h2 class="text-xl font-bold text-green-700 mb-4">Tiket Pesawat</h2>
    <table class="w-full table-auto text-sm bg-white rounded shadow">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2">Nama Pegawai</th>
          <th class="p-2">Tujuan</th>
          <th class="p-2">Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tiketPesawatList as $tiket)
          <tr>
            <td class="p-2">{{ $tiket->pegawai->nama }}</td>
            <td class="p-2">{{ $tiket->tujuan }}</td>
            <td class="p-2">{{ \Carbon\Carbon::parse($tiket->tanggal)->translatedFormat('d F Y') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- === Chart Proposal === -->
  <div class="mt-10">
    <h2 class="text-xl font-bold text-green-700 mb-4">Proposal</h2>
    <canvas id="proposalChart" class="w-full max-w-md"></canvas>
  </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
  const ctx = document.getElementById('proposalChart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Disetujui', 'Ditolak'],
      datasets: [{
        data: [{{ $jumlahProposalDisetujui }}, {{ $jumlahProposalDitolak }}],
        backgroundColor: ['#16a34a', '#dc2626'],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>
@endpush
