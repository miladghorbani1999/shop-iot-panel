<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title_fa',
        'title_en',
        'code',
        'content_description',
        'content_box',
        'return_reason_alert',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
