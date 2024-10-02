<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        require_once './get_login.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handle_login.php';
    } else {
        echo "$requestMethod не поддерживается";
    }
}elseif ($requestUri === '/registrate') {
    if($requestMethod === 'GET') {
        require_once './get_registration.php';
} elseif ($requestMethod === 'POST') {
    require_once './handle_registration.php';
}
}elseif ($requestUri === '/catalog') {
    require_once './catalog.php';
}else{
    http_response_code(404);
    require_once './404.php';
}
