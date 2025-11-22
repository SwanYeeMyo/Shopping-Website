<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    use HasFactory;
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'description',
        'image',
        'price',

    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class, 'product_id', 'product_id');
    }

    public function ratingsWithComment()
    {
        return $this->hasMany(ProductRating::class, 'product_id', 'product_id')
            ->whereNotNull('comment')
            ->where('comment', '<>', '')->orderBy('created_at', 'desc');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function toppings()
    {
        return $this->belongsToMany(
            Topping::class,
            'product_topping',
            'product_id',
            'topping_id'
        );
    }
}
