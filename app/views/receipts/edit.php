<?php require_once '../app/views/layout/header.php'; ?>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Receipt</h2>
    <form method="POST" action="/receipt/receipt/update">
        <input type="hidden" name="id" value="<?= $data['receipt']['id'] ?>">
        <!-- Header Receipt -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. PO <span class="text-red-500">*</span></label>
                <input type="text" name="no_po" required value="<?= htmlspecialchars($data['receipt']['no_po']) ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. SJ/BAPP</label>
                <input type="text" name="no_sj_bapp" value="<?= htmlspecialchars($data['receipt']['no_sj_bapp']) ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Receipt PO</label>
                <input type="text" name="no_receipt_po" value="<?= htmlspecialchars($data['receipt']['no_receipt_po']) ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. PAP</label>
                <input type="text" name="no_pap" value="<?= htmlspecialchars($data['receipt']['no_pap']) ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Vendor/Supplier <span class="text-red-500">*</span></label>
                <input type="text" name="vendor_supplier" required value="<?= htmlspecialchars($data['receipt']['vendor_supplier']) ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Receipt PO <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_receipt_po" required value="<?= htmlspecialchars($data['receipt']['tanggal_receipt_po']) ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
        </div>

        <!-- Items -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Daftar Item</h3>
            <div id="items-container">
                <?php $i = 0; foreach($data['items'] as $item): ?>
                <div class="item-row grid grid-cols-1 sm:grid-cols-5 gap-2 mb-2 items-end">
                    <div class="sm:col-span-2">
                        <select name="items[<?= $i ?>][item_id]" required class="w-full border rounded-lg px-3 py-2">
                            <option value="">Pilih Barang</option>
                            <?php foreach($data['allItems'] as $allItem): ?>
                            <option value="<?= $allItem['id'] ?>" <?= $allItem['id'] == $item['item_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($allItem['kode_barang'] . ' - ' . $allItem['nama_barang']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <input type="text" name="items[<?= $i ?>][nama_user]" value="<?= htmlspecialchars($item['nama_user']) ?>" placeholder="Nama user" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <input type="number" name="items[<?= $i ?>][jumlah]" value="<?= $item['jumlah'] ?>" min="1" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <input type="text" name="items[<?= $i ?>][satuan]" value="<?= htmlspecialchars($item['satuan']) ?>" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="remove-item text-red-500 hover:text-red-700">Hapus</button>
                    </div>
                </div>
                <?php $i++; endforeach; ?>
            </div>
            <button type="button" id="add-item" class="mt-2 inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">
                + Tambah Item
            </button>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="/receipt/home/index" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">Update</button>
        </div>
    </form>
</div>

<script>
let itemIndex = <?= count($data['items']) ?>;
document.getElementById('add-item').addEventListener('click', function() {
    const container = document.getElementById('items-container');
    const newRow = document.createElement('div');
    newRow.className = 'item-row grid grid-cols-1 sm:grid-cols-5 gap-2 mb-2 items-end';
    newRow.innerHTML = `
        <div class="sm:col-span-2">
            <select name="items[${itemIndex}][item_id]" required class="w-full border rounded-lg px-3 py-2">
                <option value="">Pilih Barang</option>
                <?php foreach($data['allItems'] as $allItem): ?>
                <option value="<?= $allItem['id'] ?>"><?= htmlspecialchars($allItem['kode_barang'] . ' - ' . $allItem['nama_barang']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <input type="text" name="items[${itemIndex}][nama_user]" placeholder="Nama user" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <input type="number" name="items[${itemIndex}][jumlah]" value="1" min="1" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <input type="text" name="items[${itemIndex}][satuan]" value="Unit" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div class="flex justify-end">
            <button type="button" class="remove-item text-red-500 hover:text-red-700">Hapus</button>
        </div>
    `;
    container.appendChild(newRow);
    itemIndex++;
});

document.addEventListener('click', function(e) {
    if(e.target.classList.contains('remove-item')) {
        e.target.closest('.item-row').remove();
    }
});
</script>

<?php require_once '../app/views/layout/footer.php'; ?>