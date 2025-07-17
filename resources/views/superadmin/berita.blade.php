<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Berita</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Daftar Berita</h2>
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

    <!-- Tabel Berita -->
    <div class="bg-white p-4 rounded shadow">
      <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-xs uppercase bg-gray-100 text-gray-600">
          <tr>
            <th class="px-4 py-2">Gambar</th>
            <th class="px-4 py-2">Judul</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Berita 1 -->
          <tr class="border-b" data-status="positif">
            <td class="px-4 py-2">
              <img src="storage/berita/berita1.jpg" alt="Berita 1" class="w-24 h-16 object-cover rounded" />
            </td>
            <td class="px-4 py-2">Rapat Umum PTPN III</td>
            <td class="px-4 py-2">2025-07-15</td>
            <td class="px-4 py-2 space-x-2">
              <a href="edit_berita.html?id=1" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Update</a>
              <button onclick="hapusBerita(1)" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Delete</button>
            </td>
          </tr>

          <!-- Berita 2 -->
          <tr class="border-b" data-status="positif">
            <td class="px-4 py-2">
              <img src="storage/berita/berita2.jpg" alt="Berita 2" class="w-24 h-16 object-cover rounded" />
            </td>
            <td class="px-4 py-2">CSR Sosialisasi Petani</td>
            <td class="px-4 py-2">2025-07-13</td>
            <td class="px-4 py-2 space-x-2">
              <a href="edit_berita.html?id=2" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Update</a>
              <button onclick="hapusBerita(2)" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Delete</button>
            </td>
          </tr>

          <!-- Berita 3 -->
          <tr class="border-b" data-status="negatif">
            <td class="px-4 py-2">
              <img src="storage/berita/berita3.jpg" alt="Berita 3" class="w-24 h-16 object-cover rounded" />
            </td>
            <td class="px-4 py-2">Kunjungan Direksi</td>
            <td class="px-4 py-2">2025-07-10</td>
            <td class="px-4 py-2 space-x-2">
              <a href="tambahBerita?id=3" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Update</a>
              <button onclick="hapusBerita(3)" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Sidebar Loader -->
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
    const rows = document.querySelectorAll('tbody tr');

    filterSelect.addEventListener('change', () => {
      const filter = filterSelect.value;
      rows.forEach(row => {
        const status = row.getAttribute('data-status');
        row.style.display = (filter === 'all' || filter === status) ? '' : 'none';
      });
    });
  </script>

  <!-- Hapus Berita -->
  <script>
    function hapusBerita(id) {
      if (confirm("Yakin ingin menghapus berita ini?")) {
        // Logika penghapusan (simulasi)
        alert("Berita dengan ID " + id + " dihapus (simulasi)");
        // Contoh: bisa tambahkan AJAX atau redirect
      }
    }
  </script>

</body>
</html>
