<?php
namespace Controller;
use DTO\CreateOrderDTO;
use Model\Product;
use Request\OrderRequest;
use Service\Auth\AuthServiceInterface;
use Service\Auth\AuthSessionService;
use Service\CartService;
use Service\OrderService;

class OrderController
{

    private OrderService $orderService;
    private CartService $cartService;
    private AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService,CartService $cartService, OrderService $orderService, )
    {
        $this->authService = $authService;
       $this->cartService = $cartService;
        $this->orderService = $orderService;

    }
public function getOrderForm()
{
    if (!$this->authService->check()) {
        header("Location: /login");
    } else {
        $userId = $this->authService->getCurrentUser()->getId();

        $productsInCart = Product::getCartByUser($userId);
        if($productsInCart !== null){
            $totalPrice = $this->cartService->getTotalPrice($productsInCart);
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
            $sum = $this->cartService->getTotalPrice($productsInCart);

            $DTO = new CreateOrderDTO($userId, $name, $email, $phone, $sum);
            $this->orderService->create($DTO);

        }
    } else {


        $totalPrice = $this->cartService->getTotalPrice($productsInCart);
        require_once './../View/order.php';
    }
}


}