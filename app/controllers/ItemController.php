<?php
class ItemController extends Controller {
    private function isAdmin() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    private function redirectIfNotAdmin() {
        if (!$this->isAdmin()) {
            header('Location: /receipt/auth/login');
            exit;
        }
    }

    public function index() {
        $this->redirectIfNotAdmin();
        $itemModel = $this->model('Item');
        $items = $itemModel->getAll();
        $this->view('items/index', ['items' => $items]);
    }

    public function create() {
        $this->redirectIfNotAdmin();
        $this->view('items/create');
    }

    public function store() {
        $this->redirectIfNotAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $itemModel = $this->model('Item');
            $kode_barang = $_POST['kode_barang'];
            $nama_barang = $_POST['nama_barang'];
            if ($itemModel->create($kode_barang, $nama_barang)) {
                header('Location: /receipt/item/index');
                exit;
            } else {
                echo "Gagal menambah barang.";
            }
        } else {
            header('Location: /receipt/item/create');
        }
    }

    public function edit() {
        $this->redirectIfNotAdmin();
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $itemModel = $this->model('Item');
        $item = $itemModel->getById($id);
        if (!$item) die('Item tidak ditemukan');
        $this->view('items/edit', ['item' => $item]);
    }

    public function update() {
        $this->redirectIfNotAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $kode_barang = $_POST['kode_barang'];
            $nama_barang = $_POST['nama_barang'];
            $itemModel = $this->model('Item');
            if ($itemModel->update($id, $kode_barang, $nama_barang)) {
                header('Location: /receipt/item/index');
                exit;
            } else {
                echo "Gagal mengupdate barang.";
            }
        } else {
            header('Location: /receipt/item/index');
        }
    }

    public function delete() {
        $this->redirectIfNotAdmin();
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $itemModel = $this->model('Item');
        if ($itemModel->delete($id)) {
            header('Location: /receipt/item/index');
            exit;
        } else {
            echo "Gagal menghapus barang.";
        }
    }
}