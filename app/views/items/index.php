<?php require_once '../app/views/layout/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Master Barang</h2>
    <a href="/receipt/item/create" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">+ Tambah Barang</a>
</div>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Barang</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($data['items'])): ?>
            <tr><td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data.</td></tr>
            <?php else: ?>
                <?php foreach($data['items'] as $item): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($item['kode_barang']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($item['nama_barang']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                        <a href="/receipt/item/edit?id=<?= $item['id'] ?>" class="text-blue-600 hover:text-blue-900">Edit</a>
                        <a href="/receipt/item/delete?id=<?= $item['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-900">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>