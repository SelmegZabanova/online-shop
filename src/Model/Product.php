<?php
namespace Model;
class Product extends Model
{

    public function showCatalog()
    {

        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }
    public function showCart($user_id):array|false
    {

        $stmt = $this->pdo->prepare("SELECT * FROM products INNER JOIN user_products ON products.id = user_products.product_id WHERE user_products.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getTotalPrice()
    {
        $user_id = $_SESSION['user_id'];
        $data = $this->showCart($user_id);
        $result = 0;
        foreach ($data as $value) {
            $multi = $value['amount'] * (int)$value['price'];
            $result += $multi;
        }
        return $result;
    }
}
