<?php
class ReceiptController extends Controller {
    private function isAdmin() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    private function redirectIfNotAdmin() {
        if (!$this->isAdmin()) {
            header('Location: /receipt/auth/login');
            exit;
        }
    }

    public function create() {
        $this->redirectIfNotAdmin();
        $itemModel = $this->model('Item');
        $items = $itemModel->getAll();
        $this->view('receipts/create', ['items' => $items]);
    }

    public function store() {
        $this->redirectIfNotAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $receiptModel = $this->model('Receipt');
            $data = [
                'no_po' => $_POST['no_po'],
                'no_sj_bapp' => $_POST['no_sj_bapp'],
                'no_receipt_po' => $_POST['no_receipt_po'],
                'no_pap' => $_POST['no_pap'],
                'vendor_supplier' => $_POST['vendor_supplier'],
                'tanggal_receipt_po' => $_POST['tanggal_receipt_po']
            ];
            if ($receiptModel->create($data)) {
                $receipt_id = $receiptModel->getLastInsertId();
                $receiptItemModel = $this->model('ReceiptItem');
                $items = $_POST['items'];
                foreach ($items as $item) {
                    $receiptItemModel->create($receipt_id, $item['item_id'], $item['nama_user'], $item['jumlah'], $item['satuan']);
                }
                header('Location: /receipt/home/index');
                exit;
            } else {
                echo "Failed to create receipt";
            }
        } else {
            header('Location: /receipt/receipt/create');
        }
    }

    public function edit() {
        $this->redirectIfNotAdmin();
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $receiptModel = $this->model('Receipt');
        $receipt = $receiptModel->getById($id);
        if (!$receipt) die('Receipt not found');
        $receiptItemModel = $this->model('ReceiptItem');
        $items = $receiptItemModel->getByReceiptId($id);
        $itemModel = $this->model('Item');
        $allItems = $itemModel->getAll();
        $this->view('receipts/edit', ['receipt' => $receipt, 'items' => $items, 'allItems' => $allItems]);
    }

    public function update() {
        $this->redirectIfNotAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $receiptModel = $this->model('Receipt');
            $data = [
                'no_po' => $_POST['no_po'],
                'no_sj_bapp' => $_POST['no_sj_bapp'],
                'no_receipt_po' => $_POST['no_receipt_po'],
                'no_pap' => $_POST['no_pap'],
                'vendor_supplier' => $_POST['vendor_supplier'],
                'tanggal_receipt_po' => $_POST['tanggal_receipt_po']
            ];
            if ($receiptModel->update($id, $data)) {
                $receiptItemModel = $this->model('ReceiptItem');
                $receiptItemModel->deleteByReceiptId($id);
                $items = $_POST['items'];
                foreach ($items as $item) {
                    $receiptItemModel->create($id, $item['item_id'], $item['nama_user'], $item['jumlah'], $item['satuan']);
                }
                header('Location: /receipt/home/index');
                exit;
            } else {
                echo "Failed to update";
            }
        } else {
            header('Location: /receipt/home/index');
        }
    }

    public function delete() {
        $this->redirectIfNotAdmin();
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $receiptModel = $this->model('Receipt');
        if ($receiptModel->delete($id)) {
            header('Location: /receipt/home/index');
            exit;
        } else {
            echo "Delete failed";
        }
    }

    // Method detail() menggantikan view()
    public function detail() {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $receiptModel = $this->model('Receipt');
        $receipt = $receiptModel->getById($id);
        if (!$receipt) die('Receipt not found');
        $receiptItemModel = $this->model('ReceiptItem');
        $items = $receiptItemModel->getByReceiptId($id);
        $this->view('receipts/view', ['receipt' => $receipt, 'items' => $items]);
    }

    public function print() {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $receiptModel = $this->model('Receipt');
        $receipt = $receiptModel->getById($id);
        if (!$receipt) die('Receipt not found');
        $receiptItemModel = $this->model('ReceiptItem');
        $items = $receiptItemModel->getByReceiptId($id);
        $this->view('receipts/print', ['receipt' => $receipt, 'items' => $items]);
    }
}