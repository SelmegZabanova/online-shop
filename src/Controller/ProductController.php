<?php
class ProductController
{
    public function getCatalog()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location:/login");
        } else {
            require_once './../Model/Product.php';
            $product = new Product();
            $products = $product->showCatalog();

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
            require_once './../Model/UserProduct.php';
            $userProduct = new UserProduct();
            $result = $userProduct->select($user_id, $product_id);
            if(empty($result)) {
                $userProduct->add($user_id, $product_id, $amount);
            } else {
               $userProduct->addMore($user_id, $product_id, $amount);
            }
            require_once './../View/catalog.php';
        }
    }

}