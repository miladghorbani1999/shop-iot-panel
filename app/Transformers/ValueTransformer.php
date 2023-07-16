<?php

namespace App\Transformers;

use App\Models\Value;
use League\Fractal\TransformerAbstract;

class ValueTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [

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
    public function transform(Value $value)
    {
        return [
            'id' => $value->id,
            'value' => $value->value,
        ];
    }

}
