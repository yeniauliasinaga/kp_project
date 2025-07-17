<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pegawai</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Data Pegawai</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Data Pegawai</h2>
      <div class="flex gap-3">
        <!-- Tambah Button -->
        <a href="../staff/form_proposal.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Berita</a>
      </div>
    </div>

   <!-- pegawai.html -->
    <div class="p-6">
      <h2 class="text-xl font-bold mb-4">Data Pegawai</h2>
      <table class="w-full table-auto bg-white shadow rounded text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2">Nama</th>
            <th class="p-2">NIP</th>
            <th class="p-2">Jabatan</th>
            <th class="p-2">Role</th>
            <th class="p-2">Unit</th>
            <th class="p-2">Alamat</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-2">Yeni Aulia</td>
            <td class="p-2">19827364</td>
            <td class="p-2">Staf Humas</td>
            <td class="p-2">Staff</td>
            <td class="p-2">Humas</td>
            <td class="p-2">Jl. Setia Budi No. 88</td>
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
