<?php

namespace Service;


use DTO\CreateOrderDTO;
use Model\Product;
use Model\ProductsInOrder;
use Model\Order;

use Model\Model;
use Model\UserProduct;


class OrderService
{
    private Order $order;
    private ProductsInOrder $productsInOrder;

    public function __construct()
    {
        $this->order = new Order();
        $this->productsInOrder = new ProductsInOrder();


    }
    public function create(CreateOrderDto $orderDTO): void
    {
        $pdo = Model::getPdo();
        $pdo->beginTransaction();
        try {
            $order_id = $this->order->createOrder($orderDTO->getUserId(), $orderDTO->getName(), $orderDTO->getEmail(), $orderDTO->getPhone(), $orderDTO->getSum());
            $productsInCart = Product::getCartByUser($orderDTO->getUserId());
            foreach ($productsInCart as $value) {

                $this->productsInOrder->GetProductsInOrder($order_id, $value->getId(), $value->getAmount());

            }
            UserProduct::clearCart($orderDTO->getUserId());
        } catch (\PDOException $exception) {
            $pdo->rollBack();
            throw $exception;
        }
        $pdo->commit();
    }


}