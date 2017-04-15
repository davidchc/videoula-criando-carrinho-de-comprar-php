<?php
session_start();
define("DIR", dirname(__FILE__));
define("DS", DIRECTORY_SEPARATOR);

include_once DIR.DS.'App'.DS.'Loader.php';

$loader = new App\Loader();
$loader->register();

$pdo               = new \PDO("mysql:host=localhost;dbname=shop", "root", "");
$productRepository = new App\Model\Product\ProductRepositoryPDO($pdo);


$page   = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';




switch ($page) {
    case 'cart':
        $sessionCart = new App\Model\Shopping\CartSession();
        $cart = new App\Controller\Cart($productRepository, $sessionCart);
        call_user_func_array(array($cart, $action), array());
    break;

    default:
        $home = new App\Controller\Home($productRepository);
        call_user_func_array(array($home, $action), array());
}
