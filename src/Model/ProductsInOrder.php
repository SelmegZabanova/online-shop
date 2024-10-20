<?php
namespace Model;

class ProductsInOrder extends Model
{

    public function GetProductsInOrder(int $order_id, int $product_id, int $amount)
    {

        $stmt = $this->pdo->prepare('INSERT INTO products_in_order (order_id, product_id, amount) VALUES (:order_id, :product_id, :amount)');
        $stmt->execute(["order_id" => $order_id, 'product_id' => $product_id, 'amount' => $amount]);

    }



}