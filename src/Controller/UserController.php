<?php
require_once './../Model/User.php';

class UserController
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }
 public function getRegisterForm()
 {
     require_once './../View/registrate.php';
 }

//REGISTRATION
    public function register()
    {
        $errors = $this->validateRegistration($_POST);

        if (empty($errors)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $this->user->create($name, $email, $hash);

            header("Location: /login");
        } else {
            require_once './../View/registrate.php';
        }
    }
    public function validateRegistration(array $data)
    {
        $errors = [];
        if(isset($data['name'])) {
            $name = $data['name'];
            if (empty($name)) {
                $errors['name'] = 'Имя не может быть пустым';
            } elseif (strlen($name) < 2) {
                $errors['name'] = 'Имя не может содержать меньше двух символов';
            }
        }
        if(isset($data['email'])) {
            $email = $data['email'];
            if (empty($email)) {
            $errors['email'] = 'Email не может быть пустым';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email указан некорректно';
            }
        }
        if(isset($data['psw'])) {
            $password = $data['psw'];

            if (strlen($password) < 6) {
                $errors['password'] = 'Пароль должен содержать больше 6 символов';
            } elseif ($password !== $data['psw-repeat']) {
                $errors['password-repeat'] = 'Пароли не совпадают';
            }
        }
        return $errors;
    }


//LOGIN
    public function getLoginForm()
{
    require_once './../View/login.php';
}
    public function login()
    {
        $errors = $this->validateLogin($_POST);
        if (empty($errors)) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->user->getByEmail($email);

            if (!empty($result) and password_verify($password, $result['password'])) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                header('Location: /catalog');
            }
             if(isset($errors)) {
                 $errors['password'] = 'неправильный пароль или почта';
             }

        }

        require_once './../View/login.php';
    }
    private function validateLogin(array $data)
    {
        $errors = [];
        if(isset($data['email'])) {
            $email = $data['email'];
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "email указан некорректно";
        } if(empty($email)) {
             $errors['email'] = 'введите email';
         }
        }

        if(isset($data['password'])) {
            $password = $data['password'];
            if (empty($password)) {
                $errors['password'] = 'введите пароль';
            }
        }
        return $errors;
    }


}