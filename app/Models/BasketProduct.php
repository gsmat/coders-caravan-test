<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    //basket_products: product_id  -> products: id
}
