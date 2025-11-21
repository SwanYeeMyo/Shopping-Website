<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
