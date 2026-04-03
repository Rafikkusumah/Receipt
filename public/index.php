<?php
session_start();
define('BASE_URL', '/receipt/');
require_once '../app/config/database.php';
require_once '../app/core/Model.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Router.php';

$router = new Router();

$router->add('home/index', 'HomeController', 'index');
$router->add('home/search', 'HomeController', 'search');
$router->add('receipt/create', 'ReceiptController', 'create');
$router->add('receipt/store', 'ReceiptController', 'store');
$router->add('receipt/edit', 'ReceiptController', 'edit');
$router->add('receipt/update', 'ReceiptController', 'update');
$router->add('receipt/delete', 'ReceiptController', 'delete');
$router->add('receipt/detail', 'ReceiptController', 'detail');   // baris ini yang diubah
$router->add('receipt/print', 'ReceiptController', 'print');
$router->add('item/index', 'ItemController', 'index');
$router->add('item/create', 'ItemController', 'create');
$router->add('item/store', 'ItemController', 'store');
$router->add('item/edit', 'ItemController', 'edit');
$router->add('item/update', 'ItemController', 'update');
$router->add('item/delete', 'ItemController', 'delete');
$router->add('auth/login', 'AuthController', 'login');
$router->add('auth/authenticate', 'AuthController', 'authenticate');
$router->add('auth/logout', 'AuthController', 'logout');

$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
$router->dispatch($url);