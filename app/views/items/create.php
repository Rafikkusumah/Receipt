<?php require_once '../app/views/layout/header.php'; ?>

<div class="bg-white rounded-lg shadow p-6 max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-6">Tambah Barang</h2>
    <form method="POST" action="index.php?url=item/store">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
            <input type="text" name="kode_barang" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
            <input type="text" name="nama_barang" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="flex justify-end space-x-2">
            <a href="index.php?url=item/index" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>