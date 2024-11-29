<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'type',
        'message',
        'read',
        'user_id',
        'reference_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}