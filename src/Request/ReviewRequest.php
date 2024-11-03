<?php

namespace Request;

class ReviewRequest extends Request
{
    public function getUserName()
    {
        return $this->data['userName'] ?? null;
    }
    public function getProductId()
    {
        return $this->data['product_id'] ?? null;
    }
    public function getRating()
    {
        return $this->data['rating'] ?? null;
    }
    public function getReviewText()
    {
        return $this->data['review_text'] ?? null;
    }
    public function validateReviewText():array
    {
        $data = $this->getData();
        $errors = [];
        if(isset($data['review_text'])) {
            $text = $data['review_text'];
            if (empty($text)) {
                $errors['text'] = 'Отзыв не может быть пустым';
            } elseif (strlen($text) > 1000) {
                $errors['text'] = 'Отзыв не может превышать 1000 символов';
            }
        }
        if(isset($data['rating'])) {
            $rating = $data['rating'];
        }
        if ($rating < 1 || $rating > 5) {
            $errors['rating'] = 'Рейтинг должен быть от 1 до 5.';
        }
        return $errors;
    }
}