<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PolicyImage extends Model
{
    use HasFactory;

    protected $table = 'policie_images';
    protected $fillable = ['policy_id', 'file_path'];

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
}