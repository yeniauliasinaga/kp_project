<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Check-In Mess</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60"></aside>

  <!-- Main -->
  <main class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Check-In Mess</h1>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Check-In Tamu</h2>
      <div class="flex gap-3">
        <!-- Tambah Button -->
        <a href="form_checkin.html" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Check-In</a>
      </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
      <table class="w-full table-auto text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">Nama Tamu</th>
            <th class="p-2 text-left">Asal</th>
            <th class="p-2 text-left">Mess</th>
            <th class="p-2 text-left">Waktu Mulai</th>
            <th class="p-2 text-left">Waktu Selesai</th>
            <th class="p-2 text-left">Biaya</th>
            <th class="p-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody id="checkinTable">
          <!-- Contoh data statis, nanti diganti dari backend -->
          <tr>
            <td class="p-2">Budi Santoso</td>
            <td class="p-2">Bandung</td>
            <td class="p-2">Mess A</td>
            <td class="p-2">2025-07-10</td>
            <td class="p-2">2025-07-12</td>
            <td class="p-2">Rp500.000</td>
            <td class="p-2 flex gap-2">
              <a href="form_checkin.html?id=1" class="text-blue-600 hover:underline">Edit</a>
              <form action="hapus_checkin.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                <input type="hidden" name="id" value="1">
                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
              </form>
            </td>
          </tr>

          <tr>
            <td class="p-2">Siti Aminah</td>
            <td class="p-2">Medan</td>
            <td class="p-2">Mess B</td>
            <td class="p-2">2025-07-15</td>
            <td class="p-2">2025-07-18</td>
            <td class="p-2">Rp750.000</td>
            <td class="p-2 flex gap-2">
              <a href="form_checkin.html?id=2" class="text-blue-600 hover:underline">Edit</a>
              <form action="hapus_checkin.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                <input type="hidden" name="id" value="2">
                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
              </form>
            </td>
          </tr>

          <!-- Tambahkan baris lainnya dari backend -->
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

</body>
</html>
