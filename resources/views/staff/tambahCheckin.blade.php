<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Check-In Mess</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-xl">
    <h2 class="text-xl font-bold mb-6 text-green-700">Form Check-In Mess</h2>

    <form action="simpan_checkin.php" method="POST">
      <!-- Hidden input for ID if editing -->
      <input type="hidden" name="id" value="">

      <!-- mess_id -->
      <div class="mb-4">
        <label for="mess_id" class="block font-medium mb-1">Pilih Mess</label>
        <select name="mess_id" id="mess_id" class="w-full border rounded px-3 py-2">
          <!-- Isi dari database: contoh statis -->
          <option value="">-- Pilih Mess --</option>
          <option value="1">Mess A</option>
          <option value="2">Mess B</option>
        </select>
      </div>

      <!-- nama_tamu -->
      <div class="mb-4">
        <label for="nama_tamu" class="block font-medium mb-1">Nama Tamu</label>
        <input type="text" id="nama_tamu" name="nama_tamu" class="w-full border rounded px-3 py-2" required>
      </div>

      <!-- asal -->
      <div class="mb-4">
        <label for="asal" class="block font-medium mb-1">Asal</label>
        <input type="text" id="asal" name="asal" class="w-full border rounded px-3 py-2" required>
      </div>

      <!-- waktu_mulai -->
      <div class="mb-4">
        <label for="waktu_mulai" class="block font-medium mb-1">Waktu Mulai</label>
        <input type="date" id="waktu_mulai" name="waktu_mulai" class="w-full border rounded px-3 py-2" required>
      </div>

      <!-- waktu_selesai -->
      <div class="mb-4">
        <label for="waktu_selesai" class="block font-medium mb-1">Waktu Selesai</label>
        <input type="date" id="waktu_selesai" name="waktu_selesai" class="w-full border rounded px-3 py-2" required>
      </div>

      <!-- biaya -->
      <div class="mb-4">
        <label for="biaya" class="block font-medium mb-1">Biaya</label>
        <input type="number" step="0.01" id="biaya" name="biaya" class="w-full border rounded px-3 py-2" required>
      </div>

      <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
          <button type="reset" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Batal</button>
          <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
  </div>
</body>
</html>
