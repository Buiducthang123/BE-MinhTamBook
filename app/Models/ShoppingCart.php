<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = [
        'user_id',
        'book_edition_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookEdition()
    {
        return $this->belongsTo(BookEditions::class);
    }
}
