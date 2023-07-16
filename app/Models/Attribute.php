<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'parent_id',
    ];

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(Value::class,'attribute_value')
            ->withPivot([
                'product_id'
            ]);
    }
}
