@extends('staff.staffLayout')

@section('content')
<main class="flex-1 p-6">
  <h1 class="text-2xl font-bold text-green-700 mb-4">Dashboard Staff</h1>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div onclick="toggleTable('mobil')" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:bg-green-50">
      <h2 class="text-lg font-semibold text-gray-700">Mobil Tersedia</h2>
      <p class="text-3xl font-bold text-green-600">5</p>
    </div>
    <div onclick="toggleTable('mess')" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:bg-green-50">
      <h2 class="text-lg font-semibold text-gray-700">Mess Tersedia</h2>
      <p class="text-3xl font-bold text-green-600">8</p>
    </div>
    <div onclick="toggleTable('acara')" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:bg-green-50">
      <h2 class="text-lg font-semibold text-gray-700">Acara Berlangsung</h2>
      <p class="text-3xl font-bold text-green-600">2</p>
    </div>
  </div>

  <!-- Detail Table Section -->
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
        <tr><td class="p-2">BK 1234 AB</td><td class="p-2">Tersedia</td></tr>
        <tr><td class="p-2">BK 5678 CD</td><td class="p-2">Digunakan</td></tr>
      </tbody>
    </table>
  </div>

  <div id="table-mess" class="hidden bg-white rounded-lg p-4 mb-6 shadow">
    <h2 class="text-lg font-semibold mb-2">Detail Mess</h2>
    <table class="w-full text-sm table-auto">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2">Nama Mess</th>
          <th class="p-2">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr><td class="p-2">Mess A</td><td class="p-2">Tersedia</td></tr>
        <tr><td class="p-2">Mess B</td><td class="p-2">Terisi</td></tr>
      </tbody>
    </table>
  </div>

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
        <tr><td class="p-2">Rapat Regional</td><td class="p-2">Medan</td><td class="p-2">11 Juli 2025</td></tr>
        <tr><td class="p-2">Pelatihan CSR</td><td class="p-2">Pematangsiantar</td><td class="p-2">12 Juli 2025</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Filter dan Tabel Kegiatan -->
  <div class="bg-white p-4 rounded-lg shadow">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
      <h2 class="text-lg font-semibold">Kegiatan</h2>
      <div class="flex items-center gap-2">
        <label>Dari:</label>
        <input type="date" id="startDate" class="p-2 border rounded">
        <label>Sampai:</label>
        <input type="date" id="endDate" class="p-2 border rounded">
        <button onclick="filterByDate()" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Filter</button>
      </div>
    </div>
    <table class="w-full text-sm table-auto">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2">Nama</th>
          <th class="p-2">Tanggal</th>
          <th class="p-2">Status</th>
        </tr>
      </thead>
      <tbody id="kegiatan-table-body">
        <tr><td class="p-2">Workshop IT</td><td class="p-2">2025-07-13</td><td class="p-2">Mendatang</td></tr>
        <tr><td class="p-2">Sosialisasi K3</td><td class="p-2">2025-07-08</td><td class="p-2">Lewat</td></tr>
      </tbody>
    </table>
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

  function filterByDate() {
    const start = new Date(document.getElementById('startDate').value);
    const end = new Date(document.getElementById('endDate').value);
    const rows = document.querySelectorAll('#kegiatan-table-body tr');

    rows.forEach(row => {
      const dateText = row.children[1].textContent;
      const rowDate = new Date(dateText);
      if (!isNaN(start) && !isNaN(end)) {
        row.style.display = rowDate >= start && rowDate <= end ? '' : 'none';
      } else {
        row.style.display = '';
      }
    });
  }
</script>
@endpush
