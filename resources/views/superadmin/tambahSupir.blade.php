<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Supir</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-3xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Supir</h2>
      </div>

      <form class="space-y-6" method="POST" action="/supir">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Nama Lengkap -->
        <div>
          <label class="block font-semibold mb-1">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="w-full p-2 border rounded" placeholder="Masukkan nama lengkap">
        </div>

        <!-- Tanggal Lahir -->
        <div>
          <label class="block font-semibold mb-1">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" class="w-full p-2 border rounded">
        </div>

        <!-- Jenis Kelamin -->
        <div>
          <label class="block font-semibold mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" class="w-full p-2 border rounded">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
          </select>
        </div>

        <!-- No Telepon -->
        <div>
          <label class="block font-semibold mb-1">No. Telepon</label>
          <input type="text" name="no_telepon" class="w-full p-2 border rounded" placeholder="Contoh: 081234567890">
        </div>

        <!-- Alamat -->
        <div>
          <label class="block font-semibold mb-1">Alamat</label>
          <textarea name="alamat" rows="3" class="w-full p-2 border rounded" placeholder="Alamat lengkap"></textarea>
        </div>

        <!-- NIK -->
        <div>
          <label class="block font-semibold mb-1">NIK</label>
          <input type="text" name="nik" class="w-full p-2 border rounded" placeholder="Nomor Induk Kependudukan">
        </div>

        <!-- Status -->
        <div>
          <label class="block font-semibold mb-1">Status</label>
          <select name="status" class="w-full p-2 border rounded">
            <option value="tersedia" selected>Tersedia</option>
            <option value="bertugas">Bertugas</option>
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
