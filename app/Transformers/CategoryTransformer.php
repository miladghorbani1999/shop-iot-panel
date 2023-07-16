<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'title_fa' => $category->title_fa,
            'title_en' => $category->title_en,
            'code' => $category->code,
            'content_description' => $category->content_description,
            'content_box' => $category->content_box,
            'return_reason_alert' => $category->return_reason_alert,
        ];
    }

    public function includeProduct(Category $category): Collection
    {
        return $this->collection($category->products, new ProductTransformer());
    }

}
