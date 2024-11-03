<?php
namespace Model;

class ProductsInOrder extends Model
{


    public static function GetProductsInOrder(int $order_id, int $product_id, int $amount)
    {
        $stmt = self::getPDO()->prepare('INSERT INTO products_in_order (order_id, product_id, amount) VALUES (:order_id, :product_id, :amount)');


        $stmt->execute(["order_id" => $order_id, 'product_id' => $product_id, 'amount' => $amount]);

    }
    public static function CheckProductInOrder(int $user_id, int $product_id):bool
    {
        $stmt = self::getPDO()->prepare("SELECT products_in_order.product_id FROM orders JOIN products_in_order ON orders.id = products_in_order.order_id
        WHERE orders.user_id = :user_id AND products_in_order.product_id = :product_id");
        $stmt->execute(["user_id" => $user_id, "product_id" => $product_id]);
        $result = $stmt->fetch();
        if($result) {
            return true;
        }
        return false;

    }



}