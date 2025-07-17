<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-4xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Berita</h2>
      </div>

      <form class="space-y-6" method="POST" action="/berita" enctype="multipart/form-data">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Judul -->
        <div>
          <label class="block font-semibold mb-1">Judul</label>
          <input type="text" name="judul" class="w-full p-2 border rounded" placeholder="Judul berita">
        </div>

        <!-- Sumber Media -->
        <div>
          <label class="block font-semibold mb-1">Sumber Media</label>
          <input type="text" name="sumber_media" class="w-full p-2 border rounded" placeholder="Contoh: Detik.com">
        </div>

        <!-- Link -->
        <div>
          <label class="block font-semibold mb-1">Link</label>
          <input type="url" name="link" class="w-full p-2 border rounded" placeholder="https://...">
        </div>

        <!-- Jenis Berita -->
        <div>
          <label class="block font-semibold mb-1">Jenis Berita</label>
          <select name="jenis_berita" class="w-full p-2 border rounded">
            <option value="">-- Pilih Jenis --</option>
            <option value="positif">Positif</option>
            <option value="negatif">Negatif</option>
          </select>
        </div>

        <!-- Tanggal Publikasi -->
        <div>
          <label class="block font-semibold mb-1">Tanggal Publikasi</label>
          <input type="date" name="tanggal_publikasi" class="w-full p-2 border rounded">
        </div>

        <!-- Upload Gambar -->
        <div>
          <label class="block font-semibold mb-1">Gambar</label>
          <input type="file" name="gambar" class="w-full p-2 border rounded bg-white">
          <small class="text-sm text-gray-600">Format .jpg, .png, dsb. Akan disimpan ke `storage/app/public/berita/`</small>
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
