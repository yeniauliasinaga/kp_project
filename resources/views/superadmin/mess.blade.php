<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mess</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Mess</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Daftar Mess</h2>
      <div class="flex gap-3">
        <!-- Tambah Button -->
        <a href="../staff/form_proposal.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Berita</a>
      </div>
    </div>

   <!-- data_mess.html -->
    <div class="p-6">
      <h2 class="text-xl font-bold mb-4">Data Mess</h2>
      <table class="w-full table-auto bg-white shadow rounded text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2">Lokasi</th>
            <th class="p-2">Nomor Kamar</th>
            <th class="p-2">Jumlah Bed</th>
            <th class="p-2">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-2">Parapat</td>
            <td class="p-2">101</td>
            <td class="p-2">2</td>
            <td class="p-2 text-green-600">Tersedia</td>
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
