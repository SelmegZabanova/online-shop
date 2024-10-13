<?php
require_once './../Model/Order.php';
require_once './../Model/ProductsInOrder.php';
class OrderController
{
public function getOrderForm()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login");
    } else {
        $user_id = $_SESSION['user_id'];
        $product = new Product();
        $data = $product->showCart($user_id);
        $result = $product->getTotalPrice();
    }
    require_once './../View/order.php';
}
public function createOrder()
{
    session_start();
    $user_id = $_SESSION['user_id'];
    $product = new Product();
    $errors = $this->validateOrder($_POST);
    $data = $product->showCart($user_id);

    if(empty($errors)) {
        if(isset($data))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $sum = $product->getTotalPrice();
            $Order = new Order();
            $order_id = $Order->createOrder($user_id , $name, $email, $phone, $sum);
            $data = $product->showCart($user_id);
            foreach( $data as $value) {
                $ProductInOrder = new ProductsInOrder();
                $ProductInOrder->GetProductsInOrder($order_id, $value['product_id'],$value['amount']);

            }



        }

    } else {
        session_start();
        $user_id = $_SESSION['user_id'];
        $product = new Product();
        $data = $product->showCart($user_id);
        $result = $product->getTotalPrice();
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