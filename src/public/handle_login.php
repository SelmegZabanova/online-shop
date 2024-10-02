<?php
$errors = [];
if(!empty($_POST["email"])) {
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] =  "email указан некорректно";
    }
} else{
    $errors['email'] = 'введите email';
}

if(!empty($_POST["pass"])) {
    $pass = $_POST["pass"];
} else {
    $errors['pass'] = 'введите пароль';
}
if(empty($errors)) {
    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetch();
    if (!empty($result) and password_verify($pass, $result['password'])) {
       setcookie('user_id', $result['id']);
        return;
    } else {
        $errors['wrong_pass'] = 'неправильный пароль или почта';

    }
}

    require_once './get_login.php';
