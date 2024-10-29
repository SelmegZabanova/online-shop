<?php

namespace Service\Auth;

use Model\User;

class AuthCookieService implements AuthServiceInterface
{
    public function check():bool
    {

        return isset($_COOKIE['user_id']);
    }
    public function getCurrentUser(): ?User
    {
        if(!$this->check()) {
            return null;
        }

        $user_id = $_COOKIE['user_id'];
        return User::getById($user_id);
    }
    public function login(string $email, string $password): bool
    {
        $result = User::getByEmail($email);

        if (!empty($result) and password_verify($password, $result->getPassword())) {

            $_COOKIE['user_id'] = $result->getId();
            return true;
        } else {
            return false;
        }
    }

}