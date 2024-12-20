<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $table = "product_options";
    protected $fillable = ["name"];

    public function values()
    {
        return $this->hasMany(ProductOptionValue::class);
    }
}
