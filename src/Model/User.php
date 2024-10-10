<?php
class User
{

public function create(string $name, string $email, string $password)
{
    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
}
public function login(string $email, string $password)
{
    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetch();
    return $result;
}
}