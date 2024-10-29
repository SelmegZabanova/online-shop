<?php
namespace Model;
class UserProduct extends Model
{


    public static function checkUserExist(int $user_id, int $product_id): bool
    {
        $stmt = self::getPDO()->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");

        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $result = $stmt->fetchAll();
        if(empty($result)) {
            return false;
        }
        return true;
    }

    public static function add(int $user_id, int $product_id, int $amount): void
    {
        $stmt = self::getPDO()->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
    public static function addMore(int $user_id, int $product_id, int $amount): void
    {
        $stmt = self::getPDO()->prepare("UPDATE user_products SET amount = amount+:amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
    public static function clearCart(int $userId):void
    {
        $stmt = self::getPDO()->prepare("DELETE FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }

}