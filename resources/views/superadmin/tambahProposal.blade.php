<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Proposal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Proposal</h2>
      </div>

      <form class="space-y-6" method="POST" action="/proposal">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Nama Instansi -->
        <div>
          <label class="block font-semibold mb-1">Nama Instansi</label>
          <input type="text" name="nama_instansi" class="w-full p-2 border rounded" placeholder="Contoh: Yayasan Harapan Baru">
        </div>

        <!-- Disposisi -->
        <div>
          <label class="block font-semibold mb-1">Disposisi</label>
          <select name="disposisi" class="w-full p-2 border rounded">
            <option value="">-- Pilih Disposisi --</option>
            <option value="disetujui">Disetujui</option>
            <option value="tidak disetujui">Tidak Disetujui</option>
          </select>
        </div>

        <!-- Nilai Bantuan -->
        <div>
          <label class="block font-semibold mb-1">Nilai Bantuan (Rp)</label>
          <input type="number" step="0.01" name="nilai_bantuan" class="w-full p-2 border rounded" placeholder="Contoh: 1000000.00">
        </div>

        <!-- Tanggal Proposal -->
        <div>
          <label class="block font-semibold mb-1">Tanggal Proposal</label>
          <input type="date" name="tanggal_proposal" class="w-full p-2 border rounded">
        </div>

        <!-- Deskripsi -->
        <div>
          <label class="block font-semibold mb-1">Deskripsi</label>
          <textarea name="deskripsi" rows="4" class="w-full p-2 border rounded" placeholder="Deskripsi atau keterangan tambahan..."></textarea>
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
