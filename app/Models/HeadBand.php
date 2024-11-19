<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadBand extends Model
{
    protected $fillable = [
        'title',
        'link',
        'link_text',
        'active',
    ];
}