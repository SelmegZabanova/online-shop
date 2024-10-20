<?php

namespace Core;


class App
{
    private array $routes = [];

    public function addRoute(string $uri, string $method, string $className, string $classMethod): void
    {
        $this->routes[$uri][$method]['class'] = $className;
        $this->routes[$uri][$method]['method'] = $classMethod;
    }


    public function run():void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(array_key_exists($requestUri, $this->routes)) {
            if(array_key_exists($requestMethod, $this->routes[$requestUri])) {

                $object = new $this->routes[$requestUri][$requestMethod]['class'];
                $method = $this->routes[$requestUri][$requestMethod]['method'];
                if($requestMethod === "POST") {
                    $requestType = mb_substr($requestUri,1);
                    $requestType = ucfirst($requestType);
                    $requestClassname = "Request"."\\".$requestType."Request";
                    $request = new $requestClassname($requestUri, $requestMethod, $_POST);
                    $object->$method($request);
                } else {
                    $object->$method();
                }

            }else{
                http_response_code(405);
            }
        } else {
            http_response_code(404);
            require_once '../View/404.php';
        }
    }

}