<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookPurchase extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'purchase_price',
        'purchase_date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
