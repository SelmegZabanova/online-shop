<?php

namespace Request;

class ProductRequest extends Request
{
    public function getProductId()
    {
        return $this->data['id'];
    }


}