<?php

namespace Core;
class App
{
    private array $routes = [];

    public function addRoute(string $uri, string $method, string $className, string $classMethod, string $requestClass = null): void
    {
        $this->routes[$uri][$method]['class'] = $className;
        $this->routes[$uri][$method]['method'] = $classMethod;
        $this->routes[$uri][$method]['request'] = $requestClass;
    }


    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($requestUri, $this->routes)) {
            if (array_key_exists($requestMethod, $this->routes[$requestUri])) {

                $object = new $this->routes[$requestUri][$requestMethod]['class'];
                $method = $this->routes[$requestUri][$requestMethod]['method'];
                $requestClass = $this->routes[$requestUri][$requestMethod]['request'];

                if (!empty($requestClass)) {
                    $request = new $requestClass($requestUri, $requestMethod, $_POST);
                    try{
                        $object->$method($request);
                    } catch(\Throwable $exception) {
                        $message = $exception->getMessage();
                        $file = $exception->getFile();
                        $line = $exception->getLine();

                        $errorFile = './../Storage/Log/error.txt';

                        file_put_contents($errorFile, $message, FILE_APPEND);
                        file_put_contents($errorFile, $file, FILE_APPEND);
                        file_put_contents($errorFile, $line, FILE_APPEND);

                        http_response_code(500);
                        require_once '../View/500.php';

                    }

                } else {
                    $object->$method();
                }



            }
        } else {
            http_response_code(404);
            require_once '../View/404.php';
        }
    }
}