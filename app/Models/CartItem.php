<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "cart_id",
        "product_id",
        "quantity",
        "sub_total",
        "price",
        "message_dedication",
        "color_dedication",
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function total()
    {
        return $this->quantity * $this->product->price;
    }

    public function options()
    {
        return $this->hasMany(CartItemOption::class, "cart_item_id");
    }

    public function dedication()
    {
        return $this->hasOne(Dedication::class);
    }
}