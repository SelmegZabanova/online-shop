<?php

class User
{
    private $name;
    private $email;
    private $password;
    private $errors;


//REGISTRATION
    public function setData($name, $email, $password, $passwordRepeat)
    {
        if (empty($name)) {
            $this->errors['name'] = 'Имя не может быть пустым';
        } elseif (strlen($name) < 2) {
            $this->errors['name'] = 'Имя не может содержать меньше двух символов';
        } else {
            $this->name = $name;
        }
        if (empty($email)) {
            $this->errors['email'] = 'Email не может быть пустым';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email указан некорректно';
        } else {
            $this->email = $email;
        }
        if (strlen($password) < 6) {
            $this->errors['password'] = 'Пароль должен содержать больше 6 символов';
        } elseif ($password !== $passwordRepeat) {
            $this->errors['password-repeat'] = 'Пароли не совпадают';
        } else {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    public function Register()
    {
        if (empty($this->errors)) {
            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $stmt->execute(['name' => $this->name, 'email' => $this->email, 'password' => $this->password]);
            header("Location: /login");
        } else {
            $errors = $this->errors;
            require_once './get_registration.php';
        }
    }

//LOGIN
    public function LoginValidation($email, $password)
    {
        if (empty($email)) {
            $this->errors['email'] = 'введите email';
        }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "email указан некорректно";
        } else {
            $this->email = $email;
        }
        if (empty($password)) {
            $this->errors['password'] = 'введите пароль';
        } else {
            $this->password = $password;
        }

    }

    public function Login()
    {
        if (empty($this->errors)) {
            $pdo = new PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute(['email' => $this->email]);
            $result = $stmt->fetch();
            if (!empty($result) and password_verify($this->password, $result['password'])) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                header('Location: /catalog');
            } else {
                $this->errors['wrong_pass'] = 'неправильный пароль или почта';

            }
        }
        $errors = $this->errors;
        require_once './get_login.php';
    }
}

