<?php

namespace Service;

use DTO\CreateOrderDTO;
use Model\Product;
use Model\ProductsInOrder;
use Model\Order;

class OrderService
{
    private Order $order;
    private Product $product;
    private ProductsInOrder $productsInOrder;
    public function __construct()
    {
        $this->order = new Order();
        $this->product = new Product();
        $this->productsInOrder = new ProductsInOrder();



    }
    public function create(CreateOrderDto $orderDTO)
    {
        $order_id = $this->order->createOrder($orderDTO->getUserId(),$orderDTO->getName(),$orderDTO->getEmail(),$orderDTO->getPhone(),$orderDTO->getSum());
        $productsInCart = $this->product->getCartByUser($orderDTO->getUserId());
        foreach( $productsInCart as $value) {

            $this->productsInOrder->GetProductsInOrder($order_id, $value->getId(),$value->getAmount());

        }
    }

}