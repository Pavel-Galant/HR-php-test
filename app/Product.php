<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id')
            ->withPivot('quantity', 'price');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
