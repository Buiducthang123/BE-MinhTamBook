<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountTiers extends Model
{
    protected $fillable = [
        'book_id',
        'minimum_quantity',
        'price',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
