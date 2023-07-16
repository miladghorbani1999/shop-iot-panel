<?php

namespace App\Transformers;

use App\Models\Attribute;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class AttributeTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'values'
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Attribute $attribute)
    {
        $attribute->load('values');
        return [
            'id' => $attribute->id,
            'title' => $attribute->title,
            'parent_id' => $attribute->parent_id,
        ];
    }

    public function includeValues(Attribute $attribute): Collection
    {
        return $this->collection($attribute->values, new ValueTransformer());
    }

}
