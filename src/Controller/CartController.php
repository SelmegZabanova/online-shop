<?php

namespace Controller;

use Model\UserProduct;

class CartController
{
    private UserProduct $userProduct;
    public function __construct()
    {
        $this->userProduct = new UserProduct();
    }
    public function getCart():void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            $user_id = $_SESSION['user_id'];

            $productsInCart = $this->userProduct->showCart($user_id);
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