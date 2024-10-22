<?php
namespace Controller;
use DTO\CreateOrderDTO;
use Request\OrderRequest;
use Service\OrderService;
use Service\ProductService;
use Model\Product;
class OrderController
{

    private OrderService $orderService;
    private ProductService $productService;
    private Product $product;
    public function __construct()
    {

        $this->orderService = new OrderService();
        $this->product = new Product();
        $this->productService = new ProductService();
    }
public function getOrderForm()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login");
    } else {
        $user_id = $_SESSION['user_id'];

        $productsInCart = $this->product->getCartByUser($user_id);
        if($productsInCart !== null){
            $totalPrice = $this->productService->getTotalPrice($productsInCart);
        }
    }
    require_once './../View/order.php';
}
public function createOrder(OrderRequest $orderRequest)
{
    session_start();
    $user_id = $_SESSION['user_id'];

    $errors = $orderRequest->validateOrder($orderRequest);
    $productsInCart = $this->product->getCartByUser($user_id);

    if(empty($errors)) {
        if(!is_null($productsInCart))
        {
            $name = $orderRequest->getName();
            $email = $orderRequest->getEmail();
            $phone = $orderRequest->getPhone();
            $sum = $this->productService->getTotalPrice($productsInCart);
            $pdo = $this->product->getPDO();
            $DTO = new CreateOrderDTO($user_id, $name, $email, $phone, $sum, $pdo);
            $this->orderService->create($DTO);

        }
    } else {


        $totalPrice = $this->productService->getTotalPrice($productsInCart);
        require_once './../View/order.php';
    }
}


}