<?php

namespace App\Controller;

use App\Model\Product\ProductRepository;
use App\Model\Shopping\Cart as ICart;
use App\Model\Shopping\CartItem;
use App\Mvc\Controller;

class Cart extends Controller
{
    private $product;
    private $cart;

    public function __construct(ProductRepository $product, ICart $cart)
    {
        parent::__construct();
        $this->product = $product;
        $this->cart = $cart;
    }

    public function index()
    {
        $this->view->set('cartTotal', $this->cart->getTotal());
        $this->view->set('cartItems', $this->cart->getCartItems());
        $this->view->render("cart");
    }

    public function add()
    {
        if (isset($_POST['id']) && preg_match("/^[0-9]+/", $_POST['id'])) {
            $product = $this->product->getProduct($_POST['id']);
            $cartItem = new CartItem($product, 1);
            $this->cart->add($cartItem);
        }
        header("Location: index.php?page=cart");
    }

    public function update()
    {
        if (isset($_POST['id']) && preg_match("/^[0-9]+/", $_POST['id'])) {
            $product = $this->product->getProduct($_POST['id']);
            $carItem = new CartItem($product, $_POST['quantity']);
            $this->cart->update($carItem);
        }
        header("Location: index.php?page=cart");
    }

    public function delete()
    {
        if (isset($_GET['id']) && preg_match("/^[0-9]+/", $_GET['id'])) {
            $this->cart->delete($_GET['id']);
        }
        header("Location: index.php?page=cart");
    }
}
