<?php
namespace Controller;
use Model\Product;
use Service\Auth\AuthServiceInterface;
use Service\Auth\AuthSessionService;
use Service\CartService;

class ProductController
{
    private CartService $cartService;
    private AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService, CartService $cartService)
    {
        $this->authService = $authService;
        $this->cartService = $cartService;

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