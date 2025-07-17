<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Permintaan Kendaraan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Permintaan Kendaraan</h2>
      </div>

      <form method="POST" action="/permintaan-kendaraan">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Supir -->
        <div class="mb-4">
          <label class="block font-semibold mb-1">Supir</label>
          <select name="supir_id" class="w-full p-2 border rounded">
            <option value="">-- Pilih Supir --</option>
            <!-- Isi dari database -->
            <option value="1">Supir A</option>
            <option value="2">Supir B</option>
          </select>
        </div>

        <!-- No Polisi -->
        <div class="mb-4">
          <label class="block font-semibold mb-1">Nomor Polisi</label>
          <select name="no_polisi" class="w-full p-2 border rounded">
            <option value="">-- Pilih Kendaraan --</option>
            <!-- Isi dari database -->
            <option value="BK1234AA">BK1234AA</option>
            <option value="BK5678BB">BK5678BB</option>
          </select>
        </div>

        <!-- Status Kepemilikan -->
        <div class="mb-4">
          <label class="block font-semibold mb-1">Status Kepemilikan</label>
          <select name="status_kepemilikan" class="w-full p-2 border rounded">
            <option value="">-- Pilih --</option>
            <option value="milik perusahaan">Milik Perusahaan</option>
            <option value="sewa">Sewa</option>
          </select>
        </div>

        <!-- Jadwal -->
        <div class="flex gap-4 mb-4">
          <div class="flex-1">
            <label class="block font-semibold mb-1">Jadwal Berangkat</label>
            <input type="date" name="jadwal_berangkat" class="w-full p-2 border rounded">
          </div>
          <div class="flex-1">
            <label class="block font-semibold mb-1">Jadwal Pulang</label>
            <input type="date" name="jadwal_pulang" class="w-full p-2 border rounded">
          </div>
        </div>

        <!-- Tujuan -->
        <div class="mb-6">
          <label class="block font-semibold mb-1">Tujuan</label>
          <select name="tujuan" class="w-full p-2 border rounded">
            <option value="">-- Pilih --</option>
            <option value="dalam wilayah">Dalam Wilayah</option>
            <option value="luar wilayah">Luar Wilayah</option>
          </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
          <button type="reset" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</button>
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
      });
  </script>

</body>
</html>
