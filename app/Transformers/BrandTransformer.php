<?php

namespace App\Transformers;

use App\Models\Brand;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class BrandTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'images'
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
    public function transform(Brand $brand)
    {
        $brand->load('images');
        return [
            'id' => $brand->id,
            'code' => $brand->code,
            'title_fa' => $brand->title_fa,
            'title_en' => $brand->title_en,
            'url' => $brand->url,
            'visibility' => $brand->visibility,
            'is_premium' => $brand->is_premium,
            'is_miscellaneous' => $brand->is_miscellaneous,
            'is_name_similar' => $brand->is_name_similar,
            'review' => $brand->review,
        ];
    }

    public function includeProduct(Brand $brand): Collection
    {
        return $this->collection($brand->products, new ProductTransformer());
    }

    public function includeImages(Brand $brand): Collection
    {
        return $this->collection($brand->images, new ImageTransformer());
    }
}
