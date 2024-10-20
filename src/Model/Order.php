<?php
namespace Model;

class Order extends Model
{

    public function createOrder(int $user_id , string $name, string $email, int $phone, int $sum):int
    {


        $stmt = $this->pdo->prepare('INSERT INTO orders (user_id, name, email, phone, sum) VALUES (:user_id, :name, :email, :phone, :sum) RETURNING id ');
        $stmt->execute(["user_id" => $user_id, 'name' => $name, 'email' => $email, 'phone' => $phone, 'sum' => $sum]);
        $orderId = $stmt->fetch();
        return $orderId['id'];
    }

}