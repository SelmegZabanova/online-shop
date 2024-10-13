<?php

class ProductsInOrder
{
    public function GetProductsInOrder(int $order_id, int $product_id, int $amount)
    {
        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        $stmt = $pdo->prepare('INSERT INTO products_in_order (order_id, product_id, amount) VALUES (:order_id, :product_id, :amount)');
        $stmt->execute(["order_id" => $order_id, 'product_id' => $product_id, 'amount' => $amount]);
        $result = $stmt->fetch();
        return $result;
    }



}