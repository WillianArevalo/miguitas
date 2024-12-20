<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function images()
    {
        return $this->hasMany(PolicyImage::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($policy) {
            $policy->slug = Str::slug($policy->name);
        });
    }
}