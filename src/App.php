<?php
require_once '../Controller/UserController.php';
require_once '../Controller/ProductController.php';
require_once '../Controller/CartController.php';
require_once '../Controller/OrderController.php';

class App
{
    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestUri === '/login') {
            if ($requestMethod === 'GET') {
                $UserController = new UserController();
                $UserController->getLoginForm();
            } elseif ($requestMethod === 'POST') {
                $UserController = new UserController();
                $UserController->login();
            } else {
                echo "$requestMethod не поддерживается";
            }
        } elseif ($requestUri === '/registrate') {
            if ($requestMethod === 'GET') {
                $UserController = new UserController();
                $UserController->getRegisterForm();
            } elseif ($requestMethod === 'POST') {
                $UserController = new UserController();
                $UserController->register();
            }
        } elseif ($requestUri === '/catalog') {
            $ProductController = new ProductController();
            $ProductController->getCatalog();
        } elseif ($requestUri === '/add_product') {
            if ($requestMethod === 'POST') {
                $ProductController = new ProductController();
                $ProductController->addProduct();
            }
        } elseif ($requestUri === '/cart') {
            $CartController = new CartController();
            $CartController->getCart();
        } elseif ($requestUri === '/order') {
            if ($requestMethod === 'GET') {
                $OrderController = new OrderController();
                $OrderController->getOrderForm();
            } elseif ($requestMethod === 'POST') {
                $OrderController = new OrderController();
                $OrderController->createOrder();
            }
        } else {
            http_response_code(404);
            require_once './404.php';
        }

    }
}