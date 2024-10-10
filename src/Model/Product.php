<?php

class Product
{
public function showCatalog()
{
    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();
    return $products;
}
public function showCart($user_id)
{
    $pdo = new PDO('pgsql:host=postgres;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare("SELECT * FROM products INNER JOIN user_products ON products.id = user_products.product_id WHERE user_products.user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $data = $stmt->fetchAll();
    return $data;
}
}