<?php

namespace Controller;

use Model\Product;
use Service\Auth\AuthServiceInterface;
use Service\Auth\AuthSessionService;
use Service\CartService;

class CartController
{
    private CartService $cartService;
    private AuthServiceInterface $authService;
    public function __construct( AuthServiceInterface $authService, CartService $cartService)
    {
        $this->authService = $authService;
       $this->cartService = $cartService;

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