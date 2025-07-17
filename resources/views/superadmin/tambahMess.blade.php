<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Data Mess</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Data Mess</h2>
      </div>

      <form class="space-y-6" method="POST" action="/data-mess">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Lokasi -->
        <div>
          <label class="block font-semibold mb-1">Lokasi</label>
          <select name="lokasi" class="w-full p-2 border rounded">
            <option value="">-- Pilih Lokasi --</option>
            <option value="Berastagi">Berastagi</option>
            <option value="Parapat">Parapat</option>
            <option value="Kapten Muslim">Kapten Muslim</option>
            <option value="Auditor">Auditor</option>
            <option value="Direksi">Direksi</option>
          </select>
        </div>

        <!-- Nomor Kamar -->
        <div>
          <label class="block font-semibold mb-1">Nomor Kamar</label>
          <input type="text" name="nomor_kamar" class="w-full p-2 border rounded" placeholder="Contoh: A1, 101, B-02">
        </div>

        <!-- Jumlah Bed -->
        <div>
          <label class="block font-semibold mb-1">Jumlah Bed</label>
          <input type="number" name="jumlah_bed" class="w-full p-2 border rounded" placeholder="Contoh: 2" min="1">
        </div>

        <!-- Status -->
        <div>
          <label class="block font-semibold mb-1">Status</label>
          <select name="status" class="w-full p-2 border rounded">
            <option value="tersedia" selected>Tersedia</option>
            <option value="terpakai">Terpakai</option>
          </select>
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
