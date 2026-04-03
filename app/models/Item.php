<?php
class Item extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM items ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($kode_barang, $nama_barang) {
        $stmt = $this->db->prepare("INSERT INTO items (kode_barang, nama_barang) VALUES (?, ?)");
        return $stmt->execute([$kode_barang, $nama_barang]);
    }
    public function update($id, $kode_barang, $nama_barang) {
        $stmt = $this->db->prepare("UPDATE items SET kode_barang = ?, nama_barang = ? WHERE id = ?");
        return $stmt->execute([$kode_barang, $nama_barang, $id]);
    }
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM items WHERE id = ?");
        return $stmt->execute([$id]);
    }
}