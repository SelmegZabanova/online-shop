<?php
require_once './../Model/Database.php';

class User
{
    private PDO $pdo;
    public function __construct()
    {
        $pdo = new Database();
        $this->pdo = $pdo->connect();
    }
    public function create(string $name, string $email, string $password)
    {

        $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }
    public function getByEmail(string $email): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch();
        return $result;
    }
}


