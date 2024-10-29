<?php

namespace DTO;

class CreateOrderDTO
{
    public function __construct(
        private int $user_id,
        private string $name,
        private string $email,
        private string $phone,
        private int $sum,
    )

    {
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

}