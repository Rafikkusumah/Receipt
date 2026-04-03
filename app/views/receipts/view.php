<?php require_once '../app/views/layout/header.php'; ?>

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-start mb-6">
        <h2 class="text-2xl font-bold">Detail Receipt</h2>
        <div class="space-x-2">
            <a href="/receipt/receipt/print?id=<?= $data['receipt']['id'] ?>" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg inline-block">Cetak</a>
            <?php if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
                <a href="/receipt/receipt/edit?id=<?= $data['receipt']['id'] ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg inline-block">Edit</a>
            <?php endif; ?>
            <a href="/receipt/home/index" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg inline-block">Kembali</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div><span class="font-semibold">No. PO:</span> <?= htmlspecialchars($data['receipt']['no_po']) ?></div>
        <div><span class="font-semibold">No. SJ/BAPP:</span> <?= htmlspecialchars($data['receipt']['no_sj_bapp']) ?></div>
        <div><span class="font-semibold">No. Receipt PO:</span> <?= htmlspecialchars($data['receipt']['no_receipt_po']) ?></div>
        <div><span class="font-semibold">No. PAP:</span> <?= htmlspecialchars($data['receipt']['no_pap']) ?></div>
        <div><span class="font-semibold">Vendor/Supplier:</span> <?= htmlspecialchars($data['receipt']['vendor_supplier']) ?></div>
        <div><span class="font-semibold">Tanggal Receipt PO:</span> <?= htmlspecialchars($data['receipt']['tanggal_receipt_po']) ?></div>
    </div>

    <h3 class="text-lg font-semibold mb-3">Item-Item</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full border">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 border">Kode Barang</th>
                    <th class="px-4 py-2 border">Nama Barang</th>
                    <th class="px-4 py-2 border">Nama User</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['items'] as $item): ?>
                <tr>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($item['kode_barang']) ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($item['nama_barang']) ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($item['nama_user']) ?></td>
                    <td class="px-4 py-2 border text-center"><?= $item['jumlah'] ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($item['satuan']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>