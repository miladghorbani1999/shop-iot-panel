<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'dk_id',
        'category_id',
        'title_fa',
        'title_en',
        'url',
        'expert_reviews',
        'meta',
        'seo',
        'status',
        'product_type',
        'brand_id',
        'review',
        'price',
    ];

    protected $casts = [
        'url' => 'array',
        'review' => 'array',
        'meta' => 'array',
        'seo' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(
            Attribute::class
            , 'attribute_value'
            ,'product_id'
            ,'attribute_id'
        )->withPivot([
            'value_id'
        ]);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class
            , 'product_user'
            ,'product_id'
            ,'user_id'
        )->withPivot([
            'title_fa',
            'price'
        ]);
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(Value::class, 'attribute_value')
            ->withPivotValue(['attribute_id']);
    }
}
