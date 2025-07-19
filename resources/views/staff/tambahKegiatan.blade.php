<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Kegiatan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Kegiatan</h2>
      </div>

      <form class="space-y-6" method="POST" action="/kegiatan">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Nama Kegiatan -->
        <div>
          <label class="block font-semibold mb-1">Nama Kegiatan</label>
          <input type="text" name="nama_kegiatan" class="w-full p-2 border rounded" placeholder="Contoh: Rapat Koordinasi">
        </div>

        <!-- Tempat -->
        <div>
          <label class="block font-semibold mb-1">Tempat</label>
          <input type="text" name="tempat" class="w-full p-2 border rounded" placeholder="Contoh: Ruang Serbaguna Lt. 2">
        </div>

        <!-- Biaya -->
        <div>
          <label class="block font-semibold mb-1">Biaya (Rp)</label>
          <input type="number" step="0.01" name="biaya" class="w-full p-2 border rounded" placeholder="Contoh: 1500000.00">
        </div>

        <!-- Waktu Mulai -->
        <div>
          <label class="block font-semibold mb-1">Waktu Mulai</label>
          <input type="date" name="waktu_mulai" class="w-full p-2 border rounded">
        </div>

        <!-- Waktu Selesai -->
        <div>
          <label class="block font-semibold mb-1">Waktu Selesai</label>
          <input type="date" name="waktu_selesai" class="w-full p-2 border rounded">
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
      })
      .catch(err => console.error('Gagal memuat sidebar:', err));
  </script>

</body>
</html>
