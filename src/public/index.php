<?php
include './../Controller/IndexController.php';
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$IndexController = new IndexController($requestMethod, $requestUri);
if($requestUri === '/registrate') {
    $IndexController->registrate();
} elseif($requestUri === '/login') {
    $IndexController->login();
} elseif($requestUri === '/catalog') {
    $IndexController->getCatalog();
} elseif($requestUri === '/add_product') {
    $IndexController->addProduct();
} elseif($requestUri === '/cart') {
    $IndexController->openCart();
} else {
    http_response_code(404);
    require_once './404.php';
}
//if($requestUri === '/login') {
//    if ($requestMethod === 'GET') {
//        require_once './get_login.php';
//    } elseif ($requestMethod === 'POST') {
//        require_once './classes/user.php';
//        $user = new User();
//        $user->LoginValidation($_POST['email'], $_POST['password']);
//        $user->Login();
//    } else {
//        echo "$requestMethod не поддерживается";
//    }
//}elseif ($requestUri === '/registrate') {
//    if($requestMethod === 'GET') {
//        require_once './get_registration.php';
//} elseif ($requestMethod === 'POST') {
//    include './classes/user.php';
//        $user = new User();
//        $user->setData($_POST['name'], $_POST['email'], $_POST['psw'], $_POST['psw-repeat']);
//        $user->Register();
//    }
//}elseif ($requestUri === '/catalog') {
//    require_once './classes/catalog.php';
//    $Catalog = new Catalog();
//    $Catalog->getCatalog();
//}elseif($requestUri === '/add_product') {
//        if($requestMethod === 'GET') {
//            require_once './get_add_product.php';
//        } elseif($requestMethod === 'POST') {
//            require_once './classes/catalog.php';
//            $Catalog = new Catalog();
//            $Catalog->getCatalog();
//            $Catalog->addProduct();
//        }
//    }elseif($requestUri === '/cart') {
//    require_once './classes/catalog.php';
//    $Catalog = new Catalog();
//    $Catalog->getCart();
//} else{
//    http_response_code(404);
//    require_once './404.php';
//}

