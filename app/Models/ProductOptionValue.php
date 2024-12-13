<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    use HasFactory;

    protected $table = "product_option_values";
    protected $fillable = ["product_option_id", "value"];

    public function option()
    {
        return $this->belongsTo(ProductOption::class, "product_option_id");
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, "product_product_option_value");
    }

    public function variations()
    {
        return $this->belongsToMany(ProductVariation::class, "product_variation_option_value")
            ->withPivot("product_variation_id");
    }
}
