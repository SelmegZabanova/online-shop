<?php
class Index
{

private $requestUri;
private $requestMethod;
public function __construct($requestMethod, $requestUri)
{
    $this->requestUri = $requestUri;
    $this->requestMethod = $requestMethod;
}
public function login()
{
    if($this->requestUri === '/login') {
        require_once './../../Controller/UserController.php';
        if ($this->requestMethod === 'GET') {
            $UserController = new UserController();
            $UserController->getLoginForm();
        } elseif ($this->requestMethod === 'POST') {
            $userControlller = new UserController();
            $userControlller->LoginValidation($_POST['email'], $_POST['password']);
            $userControlller->Login();
        } else {
            echo "requestMethod не поддерживается";
        }
    }
}
public function registrate()
{
    if ($this->requestUri === '/registrate') {
        if($this->requestMethod === 'GET') {
            require_once './../../Controller/UserController.php';
            $userController = new UserController();
            $userController->getRegisterForm();

        } elseif ($this->requestMethod === 'POST') {
            require_once './../../Controller/UserController.php';
            $userController = new UserController();
            $userController->setData($_POST['name'], $_POST['email'], $_POST['psw'], $_POST['psw-repeat']);
            $userController->Register();
        }
    }
    }
    public function getCatalog()
    {
        if ($this->requestUri === '/catalog') {
            require_once './../../Controller/ProductController.php';
            $ProductController = new ProductController();
            $ProductController->getCatalog();
        }
    }
    public function addProduct()
    {
        if ($this->requestUri === '/add_product') {
            require_once './../../Controller/ProductController.php';
            if ($this->requestMethod === 'POST') {
                $ProductController = new ProductController();
                $ProductController->getCatalog();
                $ProductController->addProduct();
            }
        }
    }
    public function openCart()
    {
        if ($this->requestUri === '/cart') {
            require_once './../../Controller/CartController.php';
            $Cart = new CartController();
            $Cart->getCart();
        }
    }


}
