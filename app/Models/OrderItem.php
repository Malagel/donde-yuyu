<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['order_id', 'product_id', 'price', 'quantity'])]
class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}