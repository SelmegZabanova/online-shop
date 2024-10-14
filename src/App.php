<?php
require_once '../Controller/UserController.php';
require_once '../Controller/ProductController.php';
require_once '../Controller/CartController.php';
require_once '../Controller/OrderController.php';

class App
{
    private array $routes = [
        '/login' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'getLoginForm' ,
            ],
            'POST' => [
                'class' => 'UserController',
                'method' => 'login' ,
            ]
        ],
        '/registrate' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'getRegisterForm' ,
            ],
            'POST' => [
                'class' => 'UserController',
                'method' => 'register' ,
            ]
        ],
        '/catalog' => [
            'GET' => [
                'class' => 'ProductController',
                'method' => 'getCatalog' ,
            ],
            'POST' => [
                'class' => 'ProductController',
                'method' => 'addProduct' ,
            ]
            ],
        '/cart' => [
            'GET' => [
                'class' => 'CartController',
                'method' => 'getCart' ,
            ]
            ],
        '/order' => [
            'GET' => [
                'class' => 'OrderController',
                'method' => 'getOrderForm' ,
            ],
            'POST' => [
                'class' => 'OrderController',
                'method' => 'createOrder' ,
            ]
            ]
        ];


    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(array_key_exists($requestUri, $this->routes)) {
            if(array_key_exists($requestMethod, $this->routes[$requestUri])) {

                $object = new $this->routes[$requestUri][$requestMethod]['class'];
                $method = $this->routes[$requestUri][$requestMethod]['method'];
                $object->$method();
            }
        } else {
            http_response_code(404);
            require_once './404.php';
        }
    }

};