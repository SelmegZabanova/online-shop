<?php

namespace DTO;

class CreateReviewDTO
{
    public function __construct(
        private int $user_id,
        private string $user_name,
        private int $product_id,
        private int $rating,
        private string $text
    )
    {

    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getUserName() :string
    {
        return $this->user_name;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getText(): string
    {
        return $this->text;
    }


}