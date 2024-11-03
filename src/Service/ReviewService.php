<?php

namespace Service;

use DTO\CreateReviewDTO;
use Model\Product;
use Model\Review;

class ReviewService
{
    public function addReview(CreateReviewDTO $dto):void
    {
        Review::create($dto->getUserId(),$dto->getUserName(),$dto->getProductId(),$dto->getRating(),$dto->getText());
    }


}