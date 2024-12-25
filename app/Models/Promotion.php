<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'discount',
        'description',
        'start_date',
        'end_date',
    ];


    public function casts()
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
