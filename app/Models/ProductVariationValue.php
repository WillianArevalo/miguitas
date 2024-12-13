<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariationValue extends Model
{
    protected $fillable = ['product_variation_id', 'product_option_value_id'];

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    public function optionValue()
    {
        return $this->belongsTo(ProductOptionValue::class, 'product_option_value_id');
    }
}
