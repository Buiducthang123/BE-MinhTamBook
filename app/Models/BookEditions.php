<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookEditions extends Model
{
    protected $fillable = [
        'book_id',
        'ISBN',
        'language',
        'format',
        'published_date',
        'short_description',
        'entry_price',
        'entry_quantity',
        'stock_quantity',
        'sold_quantity',
        'cover_image',
        'thumbnails',
        'pages',
        'weight',
        'dimension_length',
        'dimension_width',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
