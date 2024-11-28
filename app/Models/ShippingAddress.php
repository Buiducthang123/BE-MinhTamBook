<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    //
    protected $fillable = [
        'user_id',
        'receiver_name',
        'receiver_phone_number',
        'province',
        'district',
        'ward',
        'specific_address',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
