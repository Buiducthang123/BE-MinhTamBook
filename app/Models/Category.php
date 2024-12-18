<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'avatar'];

    protected $appends = ['quantity_book', 'level'];

    public function getLevelAttribute()
    {
        $level = 0;
        $category = $this;
        while ($category->parent) {
            $level++;
            $category = $category->parent;
        }
        return $level;
    }

    public function getQuantityBookAttribute()
    {
        return $this->books()->count();
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
