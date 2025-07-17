<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Kendaraan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Data Kendaraan</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Daftar Kendaraan</h2>
      <div class="flex gap-3">
        <!-- Filter by Status -->
        <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
          <option value="all">Semua Status</option>
          <option value="tersedia">Tersedia</option>
          <option value="digunakan">Digunakan</option>
        </select>

        <!-- Tombol Tambah -->
        <a href="../staff/form_kendaraan.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Kendaraan</a>
      </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
      <table class="w-full table-auto text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">No Polisi</th>
            <th class="p-2 text-left">Merek</th>
            <th class="p-2 text-left">Model</th>
            <th class="p-2 text-left">Bahan Bakar</th>
            <th class="p-2 text-left">Status Kepemilikan</th>
            <th class="p-2 text-left">Status</th>
          </tr>
        </thead>
        <tbody id="kendaraanTable">
          <!-- Contoh data statis -->
          <tr data-status="tersedia">
            <td class="p-2">BK 1234 AB</td>
            <td class="p-2">Toyota</td>
            <td class="p-2">Avanza</td>
            <td class="p-2">Bensin</td>
            <td class="p-2">Milik Perusahaan</td>
            <td class="p-2 text-green-600 font-medium">Tersedia</td>
          </tr>
          <tr data-status="digunakan">
            <td class="p-2">BK 5678 CD</td>
            <td class="p-2">Daihatsu</td>
            <td class="p-2">Xenia</td>
            <td class="p-2">Solar</td>
            <td class="p-2">Sewa</td>
            <td class="p-2 text-red-600 font-medium">Digunakan</td>
          </tr>
          <!-- Untuk versi dinamis gunakan loop Blade @foreach -->
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
    const rows = document.querySelectorAll('#kendaraanTable tr');

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
