<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Pegawai</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-start min-h-screen">

  <!-- Sidebar -->
  <aside id="sidebar-container" class="w-60 bg-white shadow-md p-4"></aside>

  <!-- Main Content -->
  <main class="flex-1 p-10">
    <div class="w-full max-w-4xl mx-auto bg-yellow-100 p-8 rounded-xl shadow-lg">
      <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-green-700">Form Tambah Pegawai</h2>
      </div>

      <form class="space-y-6" method="POST" action="/pegawai">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Email User -->
        <div>
          <label class="block font-semibold mb-1">Email</label>
          <input type="email" name="email" class="w-full p-2 border rounded" placeholder="Email user">
        </div>

        <!-- Password User -->
        <div>
          <label class="block font-semibold mb-1">Password</label>
          <input type="password" name="password" class="w-full p-2 border rounded" placeholder="Password user">
        </div>

        <!-- Nama -->
        <div>
          <label class="block font-semibold mb-1">Nama Pegawai</label>
          <input type="text" name="nama" class="w-full p-2 border rounded" placeholder="Masukkan nama lengkap">
        </div>

        <!-- NIP -->
        <div>
          <label class="block font-semibold mb-1">NIP</label>
          <input type="text" name="nip" class="w-full p-2 border rounded" placeholder="NIP Pegawai">
        </div>

        <!-- Jabatan -->
        <div>
          <label class="block font-semibold mb-1">Jabatan</label>
          <input type="text" name="jabatan" class="w-full p-2 border rounded" placeholder="Jabatan Pegawai">
        </div>

        <!-- Role -->
        <div>
          <label class="block font-semibold mb-1">Role</label>
          <select name="role" class="w-full p-2 border rounded">
            <option value="">-- Pilih Role --</option>
            <option value="staff">Staff</option>
            <option value="superadmin">Superadmin</option>
          </select>
        </div>

        <!-- Unit -->
        <div>
          <label class="block font-semibold mb-1">Unit</label>
          <select name="unit_id" class="w-full p-2 border rounded">
            <option value="">-- Pilih Unit --</option>
            <!-- Contoh dummy, nanti dari backend -->
            <option value="1">Umum</option>
            <option value="2">Humas</option>
          </select>
        </div>

        <!-- Alamat -->
        <div>
          <label class="block font-semibold mb-1">Alamat</label>
          <textarea name="alamat" rows="3" class="w-full p-2 border rounded" placeholder="Alamat pegawai"></textarea>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
          <button type="reset" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Reset</button>
          <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>

      </form>
    </div>
  </main>

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
