<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Permintaan Kendaraan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Permintaan Kendaraan</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Permintaan Kendaraan</h2>
      <a href="form_permintaan_kendaraan.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Permintaan</a>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
      <table class="w-full table-auto text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">Supir</th>
            <th class="p-2 text-left">No Polisi</th>
            <th class="p-2 text-left">Kepemilikan</th>
            <th class="p-2 text-left">Jadwal</th>
            <th class="p-2 text-left">Tujuan</th>
            <th class="p-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-2">Pak Joko</td>
            <td class="p-2">BK1234AA</td>
            <td class="p-2">Milik Perusahaan</td>
            <td class="p-2">2025-07-20 → 2025-07-22</td>
            <td class="p-2">Luar Wilayah</td>
            <td class="p-2 space-x-2">
              <a href="edit_permintaan.html?id=1" class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Update</a>
              <button onclick="hapusData(1)" class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Delete</button>
            </td>
          </tr>
          <!-- Data lainnya akan di-loop dari backend -->
        </tbody>
      </table>
    </div>
  </main>

  <script>
    fetch('sidebar.html')
      .then(res => res.text())
      .then(html => {
        document.getElementById('sidebar-container').innerHTML = html;
      });

    function hapusData(id) {
      if (confirm("Yakin ingin menghapus data ini?")) {
        alert("Data ID " + id + " dihapus (simulasi)");
        // AJAX atau redirect ke route penghapusan bisa ditambahkan
      }
    }
  </script>

</body>
</html>
