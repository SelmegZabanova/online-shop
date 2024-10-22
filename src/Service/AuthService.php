<?php

namespace Service;

use Model\User;

class AuthService
{

    public function check():bool
    {
        $this->sessionStart();
        return isset($_SESSION['user_id']);
    }
    public function getCurrentUser(): ?User
    {
        if(!$this->check()) {
            return null;
        }
        $this->sessionStart();
        $user_id = $_SESSION['user_id'];
        return User::getById($user_id);
    }
    public function login(string $email, string $password): bool
    {
        $result = User::getByEmail($email);

        if (!empty($result) and password_verify($password, $result->getPassword())) {
            $this->sessionStart();
            $_SESSION['user_id'] = $result->getId();
            return true;
        } else {
            return false;
        }
    }

    private function sessionStart(): void
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

    }

}