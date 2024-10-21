<?php
require_once './../Core/Autoload.php';
use Core\Autoload;
use Core\App;
Autoload::registrate(dirname(__DIR__,1));
$app = new App();
$app->addRoute('/login','GET', 'Controller\UserController', 'getLoginForm');
$app->addRoute('/login','POST', 'Controller\UserController', 'login', \Request\LoginRequest::class);

$app->addRoute('/registrate','GET', 'Controller\UserController', 'getRegisterForm');
$app->addRoute('/registrate','POST', 'Controller\UserController', 'register', \Request\RegistrateRequest::class );

$app->addRoute('/catalog','GET', 'Controller\ProductController', 'getCatalog');
$app->addRoute('/catalog','POST', 'Controller\ProductController', 'addProduct');

$app->addRoute('/cart','GET', 'Controller\CartController', 'getCart');

$app->addRoute('/order','GET', 'Controller\OrderController', 'getOrderForm');
$app->addRoute('/order','POST', 'Controller\OrderController', 'createOrder', \Request\OrderRequest::class );
$app->run();

