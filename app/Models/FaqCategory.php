<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class FaqCategory extends Model
{
    use HasFactory;

    protected $table = "faq_category";
    protected $fillable = ["name", "slug", "active"];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($faqCategory) {
            $faqCategory->slug = Str::slug($faqCategory->name);
        });
    }
}