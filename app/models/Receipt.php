<?php
class Receipt extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM receipts ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM receipts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO receipts (no_po, no_sj_bapp, no_receipt_po, no_pap, vendor_supplier, tanggal_receipt_po) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['no_po'], $data['no_sj_bapp'], $data['no_receipt_po'], $data['no_pap'], $data['vendor_supplier'], $data['tanggal_receipt_po']]);
    }
    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE receipts SET no_po=?, no_sj_bapp=?, no_receipt_po=?, no_pap=?, vendor_supplier=?, tanggal_receipt_po=? WHERE id=?");
        return $stmt->execute([$data['no_po'], $data['no_sj_bapp'], $data['no_receipt_po'], $data['no_pap'], $data['vendor_supplier'], $data['tanggal_receipt_po'], $id]);
    }
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM receipts WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
    public function search($keyword) {
        $sql = "SELECT DISTINCT r.* FROM receipts r 
                LEFT JOIN receipt_items ri ON r.id = ri.receipt_id 
                LEFT JOIN items i ON ri.item_id = i.id 
                WHERE r.no_po LIKE :keyword 
                OR r.vendor_supplier LIKE :keyword 
                OR i.kode_barang LIKE :keyword 
                OR ri.nama_user LIKE :keyword 
                ORDER BY r.id DESC";
        $stmt = $this->db->prepare($sql);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}