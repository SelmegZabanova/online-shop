<?php

class Order
{
    public function createOrder(int $user_id , string $name, string $email, int $phone, int $sum):int
    {
        $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        $stmt = $pdo->prepare('INSERT INTO orders (user_id, name, email, phone, sum) VALUES (:user_id, :name, :email, :phone, :sum) RETURNING id ');
        $stmt->execute(["user_id" => $user_id, 'name' => $name, 'email' => $email, 'phone' => $phone, 'sum' => $sum]);
        $result = $stmt->fetch();
        return $result['id'];
    }
}