<?php

namespace Service;

use Model\UserProduct;
use Model\Product;

class ProductService
{
    private UserProduct $userProduct;
    private Product $product;
    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->product = new Product();
    }
    public function add(int $user_id, int $product_id, int $amount)
    {
        $result = $this->userProduct->checkUserExist($user_id, $product_id);
        if(!$result) {
            $this->userProduct->add($user_id, $product_id, $amount);
        } else {
            $this->userProduct->addMore($user_id, $product_id, $amount);
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