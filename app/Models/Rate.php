<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        "department",
        "municipality",
        "district",
        "cost",
        "description"
    ];
}