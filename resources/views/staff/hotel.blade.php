<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Penginapan Hotel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Data Penginapan Hotel</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Data Penginapan Hotel</h2>
      <div class="flex gap-3">
        <!-- Filter by Status -->
        <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
          <option value="all">Jenis</option>
          <option value="positif">Positif</option>
          <option value="negatif">Negatif</option>
        </select>

        <!-- Tambah Button -->
        <a href="../staff/form_proposal.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Berita</a>
      </div>
    </div>

   <!-- hotel.html -->
    <div class="p-6">
      <h2 class="text-xl font-bold mb-4">Data Penginapan Hotel</h2>
      <table class="w-full table-auto bg-white shadow rounded text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">Pegawai</th>
            <th class="p-2 text-left">Hotel</th>
            <th class="p-2 text-left">Unit</th>
            <th class="p-2 text-left">Tanggal Masuk</th>
            <th class="p-2 text-left">Tanggal Keluar</th>
            <th class="p-2 text-left">Biaya</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-2">Andi Saputra</td>
            <td class="p-2">Hotel Grand</td>
            <td class="p-2">Humas</td>
            <td class="p-2">2025-07-18</td>
            <td class="p-2">2025-07-20</td>
            <td class="p-2">Rp3.500.000</td>
          </tr>
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
    const rows = document.querySelectorAll('#proposalTable tr');

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
