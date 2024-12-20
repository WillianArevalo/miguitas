<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function dedication()
    {
        return $this->hasOne(Dedication::class, "product_id", "product_id")->where("order_id", $this->order_id);
    }

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total'
    ];
}