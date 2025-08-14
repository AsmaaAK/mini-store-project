<?php

namespace MiniStore\Modules\Users;

class Admin extends User
{
    public function getRole():string
    {
        return 'admin';
    }

    public function addProduct(Product $product)
    {
    
    }

    public function updateProduct(Product $product)
    {
    
    }
}