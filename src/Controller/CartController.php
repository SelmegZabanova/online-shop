<?php

namespace Controller;

use Model\Product;
use Service\AuthService;
use Service\CartService;

class CartController
{
    private CartService $cartService;
    private AuthService $authService;
    public function __construct()
    {
        $this->cartService = new CartService();
        $this->authService = new AuthService();
    }
    public function getCart():void
    {

        if (!$this->authService->check()) {
            header("Location: /login");
        } else {
            $userId = $this->authService->getCurrentUser()->getId();


            $productsInCart = Product::getCartByUser($userId);
            if(!is_null($productsInCart)){
                $totalPrice = $this->cartService->getTotalPrice($productsInCart);
            }

        }
        require_once './../View/cart.php';
    }

}