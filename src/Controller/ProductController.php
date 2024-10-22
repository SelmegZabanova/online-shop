<?php
//require_once './../Model/Product.php';
//require_once './../Model/UserProduct.php';
namespace Controller;
use Model\Product;
use Model\UserProduct;
use Service\ProductService;

class ProductController
{
    private Product $product;
    private ProductService $productService;
    public function __construct()
    {
        $this->product = new Product();
        $this->productService = new ProductService();
    }
    public function getCatalog()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location:/login");
        } else {

            $products = $this->product->getAllProducts();
            require_once './../View/catalog.php';

        }
        require_once './../View/catalog.php';
    }
    public function addProduct() {
        session_start();
        if(!isset($_SESSION['user_id'])) {
            header("Location:/login");
        } else {
            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];
            if(empty($_POST['amount'])) {
                $amount = 1;
            } else {
                $amount = $_POST['amount'];
            }
            $this->productService->add($user_id, $product_id,$amount);


            header("Location:/catalog");
        }
    }

}