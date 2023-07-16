<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Value extends Model
{
    use HasFactory;
    public $preventsLazyLoading = true;
    protected $fillable = [
        'value'
    ];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_value')
            ->withPivot([
                'product_id'
            ]);
    }
}
