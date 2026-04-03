<?php require_once '../app/views/layout/header.php'; ?>

<div class="bg-white rounded-lg shadow p-6 max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-6">Edit Barang</h2>
    <form method="POST" action="index.php?url=item/update">
        <input type="hidden" name="id" value="<?= $data['item']['id'] ?>">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
            <input type="text" name="kode_barang" required value="<?= htmlspecialchars($data['item']['kode_barang']) ?>" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
            <input type="text" name="nama_barang" required value="<?= htmlspecialchars($data['item']['nama_barang']) ?>" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div class="flex justify-end space-x-2">
            <a href="index.php?url=item/index" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Update</button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>