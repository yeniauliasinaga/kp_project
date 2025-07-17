<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Hotel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Penginapan Hotel</h2>
      </div>

      <form class="space-y-6" method="POST" action="/hotel">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Pegawai -->
        <div>
          <label class="block font-semibold mb-1">Pegawai</label>
          <select name="pegawai_id" class="w-full p-2 border rounded">
            <option value="">-- Pilih Pegawai --</option>
            <!-- Diisi dari backend -->
            <option value="1">Yeni Aulia</option>
            <option value="2">Andi Saputra</option>
          </select>
        </div>

        <!-- Nama Hotel -->
        <div>
          <label class="block font-semibold mb-1">Nama Hotel</label>
          <input type="text" name="nama_hotel" class="w-full p-2 border rounded" placeholder="Contoh: Hotel Santika Medan">
        </div>

        <!-- Unit -->
        <div>
          <label class="block font-semibold mb-1">Unit/Divisi</label>
          <select name="unit_id" class="w-full p-2 border rounded">
            <option value="">-- Pilih Unit --</option>
            <!-- Diisi dari backend -->
            <option value="1">Umum</option>
            <option value="2">Humas</option>
          </select>
        </div>

        <!-- Biaya -->
        <div>
          <label class="block font-semibold mb-1">Biaya</label>
          <input type="number" name="biaya" step="0.01" class="w-full p-2 border rounded" placeholder="Contoh: 750000.00">
        </div>

        <!-- Tanggal Masuk -->
        <div>
          <label class="block font-semibold mb-1">Tanggal Masuk</label>
          <input type="date" name="tanggal_masuk" class="w-full p-2 border rounded">
        </div>

        <!-- Tanggal Keluar -->
        <div>
          <label class="block font-semibold mb-1">Tanggal Keluar</label>
          <input type="date" name="tanggal_keluar" class="w-full p-2 border rounded">
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
          <button type="reset" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Reset</button>
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
