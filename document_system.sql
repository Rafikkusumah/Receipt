CREATE DATABASE document_system;
USE document_system;

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(50) NOT NULL UNIQUE,
    nama_barang VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE receipts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_po VARCHAR(100) NOT NULL,
    no_sj_bapp VARCHAR(100),
    no_receipt_po VARCHAR(100),
    no_pap VARCHAR(100),
    vendor_supplier VARCHAR(255) NOT NULL,
    tanggal_receipt_po DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE receipt_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receipt_id INT NOT NULL,
    item_id INT NOT NULL,
    nama_user VARCHAR(255) NOT NULL,
    jumlah INT NOT NULL DEFAULT 1,
    satuan VARCHAR(50) NOT NULL DEFAULT 'Unit',
    FOREIGN KEY (receipt_id) REFERENCES receipts(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES items(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Default admin: username = admin, password = admin123 (bcrypt hash)
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');