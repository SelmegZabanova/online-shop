<?php
$errors = [];
if(isset($_POST['name'])) {
    $name = $_POST["name"];
    if (empty($name)) {
        $errors["name"] = 'имя не может быть пустым';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'имя не может содержать меньше двух символов';

    }
} else {
    $errors['name'] = 'введите имя';
    }


if(isset($_POST["email"])) {
    $email = $_POST["email"];
    if (empty($email)) {
        $errors['email'] = 'email не может быть пустым';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "email указан некорректно";
    }
}else {
        $errors['email'] = 'введите email';
    }

if (isset($_POST["psw"])) {
    $password = $_POST["psw"];
    $passwordRep = $_POST["psw-repeat"];
    if(strlen($password) < 6) {
        $errors['psw'] = 'пароль должен содержать больше 6 символов';
    }
    if ($password !== $passwordRep) {
        $errors['psw-repeat'] = 'пароли не совпадают';
    }
} else{
    $errors['psw'] = 'введите пароль';
}



if(empty($errors)) {
    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash]);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    print_r($stmt->fetch());
} else {
    require_once './get_registration.php';
}