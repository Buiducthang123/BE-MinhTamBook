<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'publisher_id',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }

    public function bookEditions()
    {
        return $this->hasMany(BookEditions::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }


}
