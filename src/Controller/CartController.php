<?php
require_once '../Model/Product.php';
class CartController
{
    public function getCart()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            $user_id = $_SESSION['user_id'];
            $product = new Product();
            $data = $product->showCart($user_id);
            $result = $product->getTotalPrice();
        }
        require_once './../View/cart.php';
    }
}