<?php
//require_once './../Model/User.php';
namespace Controller;
use Model\User;
use Request\LoginRequest;
use Request\RegistrateRequest;

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
    public function register(RegistrateRequest $registrateRequest)
    {
        $errors = $registrateRequest->validateRegistration($registrateRequest);

        if (empty($errors)) {
            $name = $registrateRequest->getName();
            $email = $registrateRequest->getEmail();
            $password = $registrateRequest->getPassword();
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $this->user->create($name, $email, $hash);

            header("Location: /login");
        } else {
            require_once './../View/registrate.php';
        }
    }


//LOGIN
    public function getLoginForm()
{
    require_once './../View/login.php';
}
    public function login(LoginRequest $loginRequest)
    {
        $errors = $loginRequest->validateLogin();
        if (empty($errors)) {
            $email = $loginRequest->getEmail();
            $password = $loginRequest->getPassword();

            $result = $this->user->getByEmail($email);

            if (!empty($result) and password_verify($password, $result->getPassword())) {
                session_start();
                $_SESSION['user_id'] = $result->getId();
                header('Location: /catalog');
            }
             if(isset($errors)) {
                 $errors['password'] = 'неправильный пароль или почта';
             }

        }

        require_once './../View/login.php';
    }


}