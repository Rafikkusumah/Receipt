<?php require_once '../app/views/layout/header.php'; ?>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Receipts List</h2>
    <form method="GET" action="/receipt/home/search" class="flex gap-2 w-full sm:w-auto">
        <input type="text" name="q" placeholder="Cari No.PO, Vendor, Kode Barang, atau Nama User"
               value="<?= isset($data['keyword']) ? htmlspecialchars($data['keyword']) : '' ?>"
               class="flex-1 sm:w-64 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">Cari</button>
    </form>
</div>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. PO</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendor/Supplier</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Receipt PO</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if(empty($data['receipts'])): ?>
                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td></tr>
            <?php else: ?>
                <?php foreach($data['receipts'] as $receipt): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($receipt['no_po']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($receipt['vendor_supplier']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($receipt['tanggal_receipt_po']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <!-- Link View menggunakan route baru -->
                        <a href="/receipt/receipt/detail?id=<?= $receipt['id'] ?>" class="text-blue-600 hover:text-blue-900">View</a>
                        <?php if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
                            | <a href="/receipt/receipt/edit?id=<?= $receipt['id'] ?>" class="text-green-600 hover:text-green-900">Edit</a>
                            | <a href="/receipt/receipt/delete?id=<?= $receipt['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-600 hover:text-red-900">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>