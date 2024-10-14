<?php
require_once '../Model/Product.php';
class CartController
{
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function getCart()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            $user_id = $_SESSION['user_id'];

            $productsInCart = $this->product->showCart($user_id);
            $totalPrice = $this->product->getTotalPrice();
        }
        require_once './../View/cart.php';
    }
}