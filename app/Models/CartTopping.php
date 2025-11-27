<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartTopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'topping_id',
        'price',
    ];

    public function topping()
    {
        return $this->belongsTo(Topping::class, 'topping_id');
    }
}
