<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['psw'];
$passwordRep = $_POST['psw-repeat'];

if(empty($name)){
    echo 'имя не может быть пустым';
}
$lenght = strlen($name);
for($i=0;$i<$lenght;)
{
    if (is_numeric($name[$i++]))
    echo 'имя не может содержать цифры';
}
if(strlen($name)<2) {
    echo 'имя не может содержать меньше двух символов';
}
if(empty($email)){
    echo 'email адрес не может быть пустым';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "email адрес указан некорректно.";
}
if($password != $passwordRep) {
    echo 'Пароли не совпадают';
}
else {


    $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash]);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    print_r($stmt->fetch());
}