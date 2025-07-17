<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Proposal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Proposal</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Daftar Proposal</h2>
      <div class="flex gap-3">
        <!-- Filter by Status -->
        <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
          <option value="all">Semua Status</option>
          <option value="disetujui">Disetujui</option>
          <option value="tidak disetujui">Tidak disetujui</option>
        </select>

        <!-- Tambah Button -->
        <a href="../staff/form_proposal.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Proposal</a>
      </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
      <table class="w-full table-auto text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">Instansi</th>
            <th class="p-2 text-left">Disposisi</th>
            <th class="p-2 text-left">Nilai Bantuan</th>
            <th class="p-2 text-left">Tanggal</th>
            <th class="p-2 text-left">Deskripsi</th>
          </tr>
        </thead>
        <tbody id="proposalTable">
          <tr data-status="disetujui">
            <td class="p-2">PT Mitra Jaya</td>
            <td class="p-2">Disetujui</td>
            <td class="p-2">Rp10.000.000</td>
            <td class="p-2">2025-07-01</td>
            <td class="p-2">Permohonan CSR untuk kegiatan sosial.</td>
          </tr>
          <tr data-status="tidak disetujui">
            <td class="p-2">CV Sejahtera</td>
            <td class="p-2">Tidak Disetujui</td>
            <td class="p-2">Rp5.000.000</td>
            <td class="p-2">2025-06-15</td>
            <td class="p-2">Proposal tidak memenuhi kriteria bantuan.</td>
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
