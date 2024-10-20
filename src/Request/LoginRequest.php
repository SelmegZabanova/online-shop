<?php

namespace Request;

class LoginRequest extends Request
{
    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }
    public function getPassword(): ?string
    {
        return $this->data['password'] ?? null;
    }
    public function validateLogin(LoginRequest $loginRequest): array
    {
        $data = $loginRequest->getData();
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