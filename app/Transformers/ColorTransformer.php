<?php

namespace App\Transformers;

use App\Models\Color;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class ColorTransformer extends TransformerAbstract
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
    public function transform(Color $color)
    {
        return [
            'id' => $color->id,
            'title' => $color->title,
            'hex_code' => $color->hex_code,
        ];
    }

    public function includeProduct(Color $color): Collection
    {
        return $this->collection($color->products, new ProductTransformer());
    }

}
