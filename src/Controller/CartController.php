<?php

namespace Controller;

use Model\Product;
use Service\ProductService;

class CartController
{
    private Product $product;
    private ProductService $productService;
    public function __construct()
    {
        $this->product = new Product();
        $this->productService = new ProductService();
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
                $totalPrice = $this->productService->getTotalPrice($productsInCart);
            }

        }
        require_once './../View/cart.php';
    }

}