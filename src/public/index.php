<?php
require_once './../Core/Autoload.php';


use Controller\ProductController;
use Controller\UserController;
use Core\Autoload;
use Core\App;
use Core\Container;
use Service\CartService;
use Service\OrderService;

Autoload::registrate(dirname(__DIR__,1));
$loggerService = new \Service\Logger\LoggerFileService();
$container = new \Core\Container();
$container->set(\Service\Auth\AuthServiceInterface::class, function(Container $container) {
    return new \Service\Auth\AuthSessionService();
});
$container->set(\Service\Logger\LoggerServiceInterface::class, function(Container $container) {
    return new \Service\Logger\LoggerFileService();
});
$container->set(\Controller\CartController::class, function (\Core\Container $container) {
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);
    $cartService = $container->get(CartService::class);
    return new \Controller\CartController($authService, $cartService);
});
$container->set(\Controller\OrderController::class, function (\Core\Container $container) {
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);
    $cartService = $container->get(CartService::class);
    $orderService = $container->get(OrderService::class);
    return new \Controller\OrderController($authService, $cartService, $orderService);
});
$container->set(ProductController::class, function (\Core\Container $container) {
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);
    $cartService = $container->get(CartService::class);
    return new \Controller\ProductController($authService, $cartService);
});
$container->set(UserController::class, function (\Core\Container $container) {
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);
    return new \Controller\UserController($authService);
});
$app = new App($loggerService, $container);

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

