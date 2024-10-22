<?php
namespace Controller;
use Model\Product;
use Service\AuthService;
use Service\CartService;

class ProductController
{
    private CartService $cartService;
    private AuthService $authService;
    public function __construct()
    {
        $this->cartService = new CartService();
        $this->authService = new AuthService();

    }
    public function getCatalog()
    {
        if (!$this->authService->check()) {
            header("Location:/login");
        } else {

            $products = Product::getAllProducts();
            require_once './../View/catalog.php';

        }
        require_once './../View/catalog.php';
    }
    public function addProduct() {
        if(!$this->authService->check()) {
            header("Location:/login");
        } else {
            $userId = $this->authService->getCurrentUser()->getId();
            $product_id = $_POST['product_id'];
            if(empty($_POST['amount'])) {
                $amount = 1;
            } else {
                $amount = $_POST['amount'];
            }
            $this->cartService->add($userId, $product_id,$amount);


            header("Location:/catalog");
        }
    }

}