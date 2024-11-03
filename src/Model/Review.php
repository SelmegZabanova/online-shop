<?php

namespace Model;

class Review extends Model
{
    private int $id;
    private int $userId;
    private string $userName;
    private int $productId;
    private int $rating;
    private string $text;

    public static function create(int $user_id,string $user_name, int $product_id, int $rating, string $text)
    {
        $stmt = self::getPDO()->prepare('INSERT INTO reviews (user_id,user_name,product_id,rating,text) VALUES (:user_id, :user_name,:product_id, :rating,:text) ');

        $stmt->execute(["user_id" => $user_id, "user_name"=> $user_name,'product_id' => $product_id, 'rating' => $rating, 'text' => $text]);

    }
    public static function getAllReviewsByProductId(int $productId):array|null
    {
        $stmt = self::getPDO()->prepare('SELECT * FROM reviews WHERE product_id = :product_id');
        $stmt->execute(["product_id" => $productId]);
        $data = $stmt->fetchAll();
        $reviews=[];
        if($data === false) {
            return null;
        }
        foreach($data as $review) {
            $obj = new Review();
            $obj->id = $review["id"];
            $obj->userId = $review["user_id"];
            $obj->userName = $review["user_name"];
            $obj->productId = $review["product_id"];
            $obj->rating = $review["rating"];
            $obj->text = $review["text"];

            $reviews[]=$obj;
        }
        return $reviews;
    }
    public static function getAverageRatingByProductId(int $productId):float
    {
        $stmt = self::getPDO()->prepare('SELECT AVG(rating) FROM reviews WHERE product_id = :product_id');
        $stmt->execute(["product_id" => $productId]);
        $result = $stmt->fetch();
        if (empty($result[0])){
            return 0.0;
        }
        return $result[0];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }




}