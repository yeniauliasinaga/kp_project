<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Kendaraan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4">
    <!-- Sidebar akan dimuat lewat fetch -->
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-4xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <!-- Header -->
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Kendaraan</h2>
      </div>

      <!-- Form -->
      <form class="space-y-6">

        <!-- No Polisi -->
        <div>
          <label class="block font-semibold mb-1">No Polisi</label>
          <input type="text" name="no_polisi" class="w-full p-2 border rounded" placeholder="Contoh: BK 1234 AB">
        </div>

        <!-- Merek -->
        <div>
          <label class="block font-semibold mb-1">Merek</label>
          <input type="text" name="merek" class="w-full p-2 border rounded" placeholder="Contoh: Toyota">
        </div>

        <!-- Model -->
        <div>
          <label class="block font-semibold mb-1">Model</label>
          <input type="text" name="model" class="w-full p-2 border rounded" placeholder="Contoh: Avanza">
        </div>

        <!-- Bahan Bakar -->
        <div>
          <label class="block font-semibold mb-1">Bahan Bakar</label>
          <input type="text" name="bahan_bakar" class="w-full p-2 border rounded" placeholder="Contoh: Bensin / Solar">
        </div>

        <!-- Status Kepemilikan -->
        <div>
          <label class="block font-semibold mb-1">Status Kepemilikan</label>
          <select name="status_kepemilikan" class="w-full p-2 border rounded">
            <option value="">-- Pilih Kepemilikan --</option>
            <option value="milik perusahaan">Milik Perusahaan</option>
            <option value="sewa">Sewa</option>
          </select>
        </div>

        <!-- Status -->
        <div>
          <label class="block font-semibold mb-1">Status</label>
          <select name="status" class="w-full p-2 border rounded">
            <option value="tersedia" selected>Tersedia</option>
            <option value="digunakan">Digunakan</option>
          </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
          <button type="button" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</button>
          <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>

      </form>
    </div>
  </main>

  <!-- Load Sidebar -->
  <script>
    fetch('sidebar.html')
      .then(res => res.text())
      .then(html => {
        document.getElementById('sidebar-container').innerHTML = html;
      })
      .catch(err => console.error('Gagal memuat sidebar:', err));
  </script>

</body>
</html>
