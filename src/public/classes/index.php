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
        if ($this->requestMethod === 'GET') {
            require_once './get_login.php';
        } elseif ($this->requestMethod === 'POST') {
            require_once './classes/user.php';
            $user = new User();
            $user->LoginValidation($_POST['email'], $_POST['password']);
            $user->Login();
        } else {
            echo "requestMethod не поддерживается";
        }
    }
}
public function registrate()
{
    if ($this->requestUri === '/registrate') {
        if($this->requestMethod === 'GET') {
            require_once './get_registration.php';
        } elseif ($this->requestMethod === 'POST') {
            include './classes/user.php';
            $user = new User();
            $user->setData($_POST['name'], $_POST['email'], $_POST['psw'], $_POST['psw-repeat']);
            $user->Register();
        }
    }
    }
    public function getCatalog()
    {
        if ($this->requestUri === '/catalog') {
            require_once './classes/catalog.php';
            $Catalog = new Catalog();
            $Catalog->getCatalog();
        }
    }
    public function addProduct()
    {
        if ($this->requestUri === '/add_product') {
            if ($this->requestMethod === 'GET') {
                require_once './get_add_product.php';
            } elseif ($this->requestMethod === 'POST') {
                require_once './classes/catalog.php';
                $Catalog = new Catalog();
                $Catalog->getCatalog();
                $Catalog->addProduct();
            }
        }
    }
    public function openCart()
    {
        if ($this->requestUri === '/cart') {
            require_once './classes/catalog.php';
            $Catalog = new Catalog();
            $Catalog->getCart();
        }
    }


}
