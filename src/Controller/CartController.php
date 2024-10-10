<?php
class CartController
{
    public function getCart()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            $user_id = $_SESSION['user_id'];
            require_once '../Model/Product.php';
            $product = new Product();
            $data = $product->showCart($user_id);
        }
        require_once './../View/cart.php';
    }
}