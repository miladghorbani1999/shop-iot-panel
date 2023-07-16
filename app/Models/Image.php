<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{

    use HasFactory;

    public $preventsLazyLoading = true;

    protected $fillable = [
        'model_id',
        'model_type',
        'link',
        'type',
        'webp_url'
    ];

    protected $casts = [
        'link' => 'array',
        'webp_url' => 'array',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
