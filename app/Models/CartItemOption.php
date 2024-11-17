<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItemOption extends Model
{
    protected $fillable = [
        "cart_item_id",
        "product_option_value_id",
        "option_price"
    ];

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class, "cart_item_id");
    }

    public function productOptionValue()
    {
        return $this->belongsTo(ProductOptionValue::class, "product_option_value_id");
    }
}
