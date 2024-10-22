<?php
namespace Controller;
use DTO\CreateOrderDTO;
use Request\OrderRequest;
use Service\AuthService;
use Service\OrderService;
use Service\CartService;
use Model\Product;
class OrderController
{

    private OrderService $orderService;
    private CartService $productService;
    private AuthService $authService;
    public function __construct()
    {

        $this->orderService = new OrderService();

        $this->productService = new CartService();
        $this->authService = new AuthService();
    }
public function getOrderForm()
{
    if (!$this->authService->check()) {
        header("Location: /login");
    } else {
        $userId = $this->authService->getCurrentUser()->getId();

        $productsInCart = Product::getCartByUser($userId);
        if($productsInCart !== null){
            $totalPrice = $this->productService->getTotalPrice($productsInCart);
        }
    }
    require_once './../View/order.php';
}
public function createOrder(OrderRequest $orderRequest)
{

    $userId = $this->authService->getCurrentUser()->getId();

    $errors = $orderRequest->validateOrder($orderRequest);
    $productsInCart = Product::getCartByUser($userId);

    if(empty($errors)) {
        if(!is_null($productsInCart))
        {
            $name = $orderRequest->getName();
            $email = $orderRequest->getEmail();
            $phone = $orderRequest->getPhone();
            $sum = $this->productService->getTotalPrice($productsInCart);

            $DTO = new CreateOrderDTO($userId, $name, $email, $phone, $sum);
            $this->orderService->create($DTO);

        }
    } else {


        $totalPrice = $this->productService->getTotalPrice($productsInCart);
        require_once './../View/order.php';
    }
}


}