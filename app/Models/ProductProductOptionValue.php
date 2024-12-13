<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProductOptionValue extends Model
{
    protected $table = "product_product_option_value";
    protected $fillable = ["product_id", "product_option_value_id"];
}
