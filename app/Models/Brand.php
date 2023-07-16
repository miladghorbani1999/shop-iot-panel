<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'id',
        'code',
        'title_fa',
        'title_en',
        'url',
        'visibility',
        'is_premium',
        'is_miscellaneous',
        'is_name_similar',
        'review',
    ];

    protected $casts = [
        'url' => 'array',
        'review' => 'array',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'model');
    }
}
