<?php
//require_once './../Model/Order.php';
//require_once './../Model/ProductsInOrder.php';
namespace Controller;
use Model\UserProduct;
use Model\Order;
use Model\ProductsInOrder;
use Request\OrderRequest;
class OrderController
{
    private UserProduct $userProduct;
    private Order $order;
    private ProductsInOrder $productsInOrder;
    public function __construct()
    {
        $this->userProduct = new UserProduct();
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

        $productsInCart = $this->userProduct->showCart($user_id);
        if($productsInCart !== null){
            $totalPrice = $this->getTotalPrice($productsInCart);
        }
    }
    require_once './../View/order.php';
}
public function createOrder(OrderRequest $orderRequest)
{
    session_start();
    $user_id = $_SESSION['user_id'];

    $errors = $orderRequest->validateOrder($orderRequest);
    $productsInCart = $this->userProduct->showCart($user_id);

    if(empty($errors)) {
        if(!is_null($productsInCart))
        {
            $name = $orderRequest->getName();
            $email = $orderRequest->getEmail();
            $phone = $orderRequest->getPhone();
            $sum = $this->getTotalPrice($productsInCart);

            $order_id = $this->order->createOrder($user_id , $name, $email, $phone, $sum);
            $productsInCart = $this->userProduct->showCart($user_id);
            foreach( $productsInCart as $value) {

                $this->productsInOrder->GetProductsInOrder($order_id, $value->getId(),$value->getAmount());

            }
        }
    } else {


        $totalPrice = $this->getTotalPrice($productsInCart);
        require_once './../View/order.php';
    }
}
    public function getTotalPrice(array $productsInCart):float
    {
        $result = 0;
        foreach ($productsInCart as $product) {
            $result += $product->getAmount() * $product->getPrice();
        }
        return $result;
    }

}