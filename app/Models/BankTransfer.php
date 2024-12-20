<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    protected $fillable = [
        'order_id',
        'bank_detail_id',
        'reference',
        'document',
        'status',
        'description'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}