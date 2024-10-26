<?php
//require_once './../Model/User.php';
namespace Controller;
use Model\User;
use Request\LoginRequest;
use Request\RegistrateRequest;
use Service\Auth\AuthServiceInterface;
use Service\Auth\AuthSessionService;

class UserController
{
    private AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
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

            User::create($name, $email, $hash);

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
            $result = $this->authService->login($email, $password);
            if($result){
                header('Location: /catalog');
            }
             if(isset($errors)) {
                 $errors['password'] = 'неправильный пароль или почта';
             }

        }

        require_once './../View/login.php';
    }


}