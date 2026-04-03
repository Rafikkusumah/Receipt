<?php
class ReceiptItem extends Model {
    public function getByReceiptId($receipt_id) {
        $stmt = $this->db->prepare("SELECT ri.*, i.kode_barang, i.nama_barang 
                                    FROM receipt_items ri 
                                    JOIN items i ON ri.item_id = i.id 
                                    WHERE ri.receipt_id = ?");
        $stmt->execute([$receipt_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($receipt_id, $item_id, $nama_user, $jumlah, $satuan) {
        $stmt = $this->db->prepare("INSERT INTO receipt_items (receipt_id, item_id, nama_user, jumlah, satuan) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$receipt_id, $item_id, $nama_user, $jumlah, $satuan]);
    }
    public function deleteByReceiptId($receipt_id) {
        $stmt = $this->db->prepare("DELETE FROM receipt_items WHERE receipt_id = ?");
        return $stmt->execute([$receipt_id]);
    }
}