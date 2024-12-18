<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'book_id',
        'quantity',
        'discount_amount',
        'final_amount',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
