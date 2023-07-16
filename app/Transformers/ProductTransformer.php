<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [

        'category',
        'images',
        'brand',
        'colors',
        'attributes'
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
    public function transform(Product $product)
    {
        $product->load(['category', 'brand', 'attributes', 'colors', 'images']);
        return [
            'id' => $product->id,
            'dk_id' => $product->dk_id,
            'category_id' => $product->category_id,
            'title_fa' => $product->title_fa,
            'title_en' => $product->title_en,
            'url' => $product->url,
            'expert_reviews' => $product->expert_reviews,
            'meta' => $product->meta,
            'seo' => $product->seo,
            'status' => $product->status,
            'product_type' => $product->product_type,
            'brand_id' => $product->brand_id,
            'price' => $product->price,
            'review' => $product->review,
        ];
    }

    public function includeCategory(Product $product): Item
    {

        return $this->item($product->category, new CategoryTransformer());
    }

    public function includeBrand(Product $product): Item
    {
        return $this->item($product->brand, new BrandTransformer());
    }

    public function includeColors(Product $product): Collection
    {
        return $this->collection($product->colors, new ColorTransformer());
    }

    public function includeImages(Product $product): Collection
    {
        return $this->collection($product->images, new ImageTransformer());
    }

    public function includeAttributes(Product $product): Collection
    {
        return $this->collection($product->attributes, new AttributeTransformer());
    }
}
