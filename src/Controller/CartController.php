<?php

namespace Controller;

use Model\Product;


class CartController
{
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function getCart():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            $user_id = $_SESSION['user_id'];

            $productsInCart = $this->product->getCartByUser($user_id);
            if(!is_null($productsInCart)){
                $totalPrice = $this->getTotalPrice($productsInCart);
            }

        }
        require_once './../View/cart.php';
    }
    public function getTotalPrice(array $productsInCart):float
    {
        $result = 0;
        foreach ($productsInCart as $product) {
            $result += $product->getAmount() * $product->getPrice();
        }
        return $result;
    }
}