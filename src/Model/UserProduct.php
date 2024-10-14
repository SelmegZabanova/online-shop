<?php
require_once './../Model/Database.php';

class UserProduct
{
    private PDO $pdo;
    public function __construct()
    {
        $pdo = new Database();
        $this->pdo = $pdo->connect();
    }
    public function select($user_id, $product_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function add($user_id, $product_id, $amount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
    public function addMore($user_id, $product_id, $amount)
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET amount = amount+:amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
}