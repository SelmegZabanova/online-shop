<?php

namespace Request;

class RegistrateRequest extends Request
{
    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }
    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }
    public function getPassword(): ?string
    {
        return $this->data['psw'] ?? null;
    }
    public function validateRegistration(RegistrateRequest $registrateRequest): array
    {
        $data = $registrateRequest->getData();
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


}