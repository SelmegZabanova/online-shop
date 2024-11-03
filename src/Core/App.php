<?php

namespace Core;

use Service\Auth\AuthSessionService;
use Service\CartService;
use Service\Logger\LoggerFileService;
use Service\Logger\LoggerServiceInterface;
use Service\OrderService;

class App
{
    private LoggerServiceInterface $loggerService;
    private array $routes = [];
    private Container $container;
    public function __construct(LoggerServiceInterface $loggerService, Container $container)
    {
        $this->loggerService = $loggerService;
        $this->container = $container;
    }


    public function addRoute(string $uri, string $method, string $className, string $classMethod, string $requestClass = null): void
    {
        $this->routes[$uri][$method]['class'] = $className;
        $this->routes[$uri][$method]['method'] = $classMethod;
        $this->routes[$uri][$method]['request'] = $requestClass;
    }


    public function run(): void
    {
        $requestUri = $this->getRequestUri();
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($requestUri, $this->routes)) {
            if (array_key_exists($requestMethod, $this->routes[$requestUri])) {

                $class = $this->routes[$requestUri][$requestMethod]['class'];
                $object = $this->container->get($class);

                $method = $this->routes[$requestUri][$requestMethod]['method'];
                $requestClass = $this->routes[$requestUri][$requestMethod]['request'];

                if (!empty($requestClass)) {
                    if($requestMethod === 'POST')
                    {
                        $request = new $requestClass($requestUri, $requestMethod, $_POST);
                    }
                    elseif($requestMethod === 'GET')
                    {
                        $request = new $requestClass($requestUri, $requestMethod, $_GET);
                    }
                    try{
                        $object->$method($request);
                    } catch(\Throwable $exception) {
                        $this->loggerService->error('Произошла ошибка при обработке запроса',[
                            'message' => $exception->getMessage(),
                            'file' => $exception->getFile(),
                            'line' => $exception->getLine()
                        ]);

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
    public function getRequestUri(): string
    {
        $originalUri = $_SERVER['REQUEST_URI'];

        $uri = strpos($originalUri, '?');

        if ($uri !== false) {
            $requestUri = substr($originalUri, 0, $uri);
        } else {
            $requestUri = $_SERVER['REQUEST_URI'];
        }
        return $requestUri;
    }
}