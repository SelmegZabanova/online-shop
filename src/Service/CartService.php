<?php

namespace Service;

use Model\UserProduct;
use Model\Product;

class CartService
{
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function add(int $user_id, int $product_id, int $amount)
    {
        $result = UserProduct::checkUserExist($user_id, $product_id);
        if(!$result) {
            UserProduct::add($user_id, $product_id, $amount);
        } else {
            UserProduct::addMore($user_id, $product_id, $amount);
        }
    }
    public function getTotalPrice(array $productsInCart):float
    {
        $result = 0;
        foreach ($productsInCart as $this->product) {
            $result += $this->product->getAmount() * $this->product->getPrice();
        }
        return $result;
    }

}