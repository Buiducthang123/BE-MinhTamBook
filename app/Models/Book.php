<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'publisher_id',
        'title',
        'slug',
        'ISBN',
        'cover_image',
        'description',
        'thumbnail',
        'is_sale',
        'price',
        'discount',
        'pages',
        'weight',
        'dimension_length',
        'dimension_width',
        'deleted_at',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function discountTiers()
    {
        return $this->hasMany(DiscountTiers::class);
    }

    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }

}
