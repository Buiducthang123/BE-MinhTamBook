<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'total_amount',
        'payment_method',
        'status',
        'shipping_fee',
        'voucher_code',
        'discount_amount',
        'amount',
        'payment_date',
        'transaction_id',
        'ref_id',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
