<?php

namespace App\Models;

use App\Enums\BookTransactionStatus;
use App\Enums\BookTransactionType;
use App\Enums\OrderStatus;
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
        'short_description',
        'description',
        'thumbnail',
        'is_sale',
        'price',
        'discount',
        'pages',
        'weight',
        'height',
        'dimension_length',
        'dimension_width',
        'deleted_at',
    ];

    public function casts()
    {
        return [
            'thumbnail' => 'array',
        ];
    }

    protected $appends = ['quantity'];
    public function getQuantityAttribute()
    {
        // Lọc các giao dịch import với điều kiện status = success
        $import = $this->bookTransactions()
            ->where('type', BookTransactionType::IMPORT)
            ->where('status', BookTransactionStatus::SUCCESS)
            ->sum('quantity');
        $import = (int) $import;
        // Lọc các giao dịch export với điều kiện status = success
        $export = $this->bookTransactions()
            ->where('type', BookTransactionType::EXPORT)
            ->where('status', BookTransactionStatus::SUCCESS)
            ->sum('quantity');
        $export = (int) $export;

        //Kiểm tra sách trong order bán ra
        $orderExport = $this->orderItems()
            ->whereHas('order', function ($query) {
                $query->where('status', '!=', OrderStatus::CANCELLED);
            })
            ->sum('quantity');
        // Tổng số sách = import - export
        return $import - $export - $orderExport;
    }

    public function getDiscountAttribute()
    {
        //Kiểm tra xem sách có promotion không nếu có thì lấy giảm giá từ promotion
        // kiểm tra start_date và end_date của promotion tính theo giờ phút giây
        // nếu promotion đang diễn ra thì lấy giảm giá từ promotion
        // nếu promotion đã kết thúc thì lấy giảm giá từ discount mặc định của sách
        // nếu không có promotion thì lấy giảm giá mặc định của sách
        $promotion = $this->promotion;
        if ($promotion) {
            $start_date = strtotime($promotion->start_date); // chuyển ngày về giây
            $end_date = strtotime($promotion->end_date);
            $now = strtotime(now());
            if ($start_date <= $now && $now <= $end_date) {
                return $promotion->discount;
            }
        }
        return $this->attributes['discount'];
    }

    public function getThumbnailAttribute($value)
    {
        return json_decode($value);
    }

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
        return $this->belongsTo(Promotion::class);
    }

    public function bookTransactions()
    {
        return $this->hasMany(BookTransaction::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


}
