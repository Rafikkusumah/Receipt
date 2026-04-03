<?php
class HomeController extends Controller {
    public function index() {
        $receiptModel = $this->model('Receipt');
        $receipts = $receiptModel->getAll();
        $this->view('home/index', ['receipts' => $receipts]);
    }
    public function search() {
        $keyword = isset($_GET['q']) ? $_GET['q'] : '';
        $receiptModel = $this->model('Receipt');
        $receipts = $receiptModel->search($keyword);
        $this->view('home/index', ['receipts' => $receipts, 'keyword' => $keyword]);
    }
}