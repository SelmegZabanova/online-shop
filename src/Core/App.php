<?php
namespace Core;


class App
{
    private array $routes = [
        '/login' => [
            'GET' => [
                'class' => 'Controller\UserController',
                'method' => 'getLoginForm' ,
            ],
            'POST' => [
                'class' => 'Controller\UserController',
                'method' => 'login' ,
            ]
        ],
        '/registrate' => [
            'GET' => [
                'class' => 'Controller\UserController',
                'method' => 'getRegisterForm' ,
            ],
            'POST' => [
                'class' => 'Controller\UserController',
                'method' => 'register' ,
            ]
        ],
        '/catalog' => [
            'GET' => [
                'class' => 'Controller\ProductController',
                'method' => 'getCatalog' ,
            ],
            'POST' => [
                'class' => 'Controller\ProductController',
                'method' => 'addProduct' ,
            ]
            ],
        '/cart' => [
            'GET' => [
                'class' => 'Controller\CartController',
                'method' => 'getCart' ,
            ]
            ],
        '/order' => [
            'GET' => [
                'class' => 'Controller\OrderController',
                'method' => 'getOrderForm' ,
            ],
            'POST' => [
                'class' => 'Controller\OrderController',
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
            }else{
                http_response_code(405);
            }
        } else {
            http_response_code(404);
            require_once './404.php';
        }
    }

};