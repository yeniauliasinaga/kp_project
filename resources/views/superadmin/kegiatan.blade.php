<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Kegiatan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">
  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Detail Kegiatan</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Daftar Kegiatan</h2>
      <div class="flex gap-3">
        <!-- Filter by Status -->
        <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
          <option value="all">Semua Status</option>
          <option value="berlangsung">Sedang Berlangsung</option>
          <option value="selesai">Selesai</option>
        </select>

        <!-- Tambah Button -->
        <a href="../staff/form_acara.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Kegiatan</a>
      </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
      <table class="w-full table-auto text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">Nama Kegiatan</th>
            <th class="p-2 text-left">Tempat</th>
            <th class="p-2 text-left">Biaya</th>
            <th class="p-2 text-left">Waktu Mulai</th>
            <th class="p-2 text-left">Waktu Selesai</th>
            <th class="p-2 text-left">Status</th>
          </tr>
        </thead>
        <tbody id="kegiatanTable">
          <tr data-status="berlangsung">
            <td class="p-2">Sosialisasi Perusahaan</td>
            <td class="p-2">Aula Kantor</td>
            <td class="p-2">Rp5.000.000</td>
            <td class="p-2">2025-07-10 09:00</td>
            <td class="p-2">2025-07-10 13:00</td>
            <td class="p-2 text-green-600 font-medium">Sedang Berlangsung</td>
          </tr>
          <tr data-status="selesai">
            <td class="p-2">Workshop Pelatihan</td>
            <td class="p-2">Hotel Grand</td>
            <td class="p-2">Rp8.000.000</td>
            <td class="p-2">2025-07-05 08:00</td>
            <td class="p-2">2025-07-06 17:00</td>
            <td class="p-2 text-gray-500 font-medium">Selesai</td>
          </tr>
          <!-- Tambah baris kegiatan lainnya -->
        </tbody>
      </table>
    </div>
  </main>

  <!-- Load Sidebar -->
  <script>
    fetch('sidebar.html')
      .then(res => res.text())
      .then(html => {
        document.getElementById('sidebar-container').innerHTML = html;
      });
  </script>

  <!-- Filter Script -->
  <script>
    const filterSelect = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('#kegiatanTable tr');

    filterSelect.addEventListener('change', () => {
      const filter = filterSelect.value;
      rows.forEach(row => {
        const status = row.getAttribute('data-status');
        row.style.display = (filter === 'all' || filter === status) ? '' : 'none';
      });
    });
  </script>
</body>
</html>
