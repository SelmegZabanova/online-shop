<?php
require_once './../Model/Order.php';
require_once './../Model/ProductsInOrder.php';
class OrderController
{
    private Product $product;
    private Order $order;
    private ProductsInOrder $productsInOrder;
    public function __construct()
    {
        $this->product = new Product();
        $this->order = new Order();
        $this->productsInOrder = new ProductsInOrder();
    }
public function getOrderForm()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login");
    } else {
        $user_id = $_SESSION['user_id'];

        $productsInCart = $this->product->showCart($user_id);
        $totalPrice = $this->product->getTotalPrice();
    }
    require_once './../View/order.php';
}
public function createOrder()
{
    session_start();
    $user_id = $_SESSION['user_id'];

    $errors = $this->validateOrder($_POST);
    $productsInCart = $this->product->showCart($user_id);

    if(empty($errors)) {
        if(isset($productsInCart))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $sum = $this->product->getTotalPrice();

            $order_id = $this->order->createOrder($user_id , $name, $email, $phone, $sum);
            $productsInCart = $this->product->showCart($user_id);
            foreach( $productsInCart as $value) {

                $this->productsInOrder->GetProductsInOrder($order_id, $value['product_id'],$value['amount']);

            }



        }

    } else {
        session_start();
        $user_id = $_SESSION['user_id'];

        $productsInCart = $this->product->showCart($user_id);
        $totalPrice = $this->product->getTotalPrice();
        require_once './../View/order.php';
    }
}
public function validateOrder(array $data)
{
    $errors = [];
    if(isset($data['name'])) {
        $name = $data['name'];
        if (empty($name)) {
            $errors['name'] = 'Имя не может быть пустым';
        } elseif (strlen($name) < 2) {
            $errors['name'] = 'Имя не может содержать меньше двух символов';
        }
    }
    if(isset($data['email'])) {
        $email = $data['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "email указан некорректно";
        } if(empty($email)) {
            $errors['email'] = 'введите email';
        }
    }

    if(isset($data['phone'])) {
        $phone = $data['phone'];
        if (empty($phone)) {
            $errors['phone'] = 'введите номер телефона';
        }
    }
    return $errors;
}

}