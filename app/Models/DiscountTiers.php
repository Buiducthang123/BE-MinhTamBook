<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountTiers extends Model
{
    protected $fillable = [
        'book_id',
        'minimum_quantity',
        'discount_rate',
        'start_date',
        'end_date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
