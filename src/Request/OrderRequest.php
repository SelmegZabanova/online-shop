<?php

namespace Request;

class OrderRequest extends Request
{
    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }
    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }
    public function getPhone(): ?string
    {
        return $this->data['phone'] ?? null;
    }
    public function validateOrder(OrderRequest $orderRequest):array
    {
        $data = $orderRequest->getData();
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
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "email указан некорректно";
            } if(empty($email)) {
                $errors['email'] = 'введите email';
            }
        }

        if(isset($data['phone'])) {
            $phone = $data['phone'];
            if (empty($phone)) {
                $errors['phone'] = 'введите номер телефона';
            } if(is_numeric($phone) === false) {
                $errors['phone'] = 'номер телефона введен некорректно';
            }
        }
        return $errors;
    }

}