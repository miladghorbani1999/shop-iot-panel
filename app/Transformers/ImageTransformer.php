<?php

namespace App\Transformers;

use App\Models\Image;
use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
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
     * @param Image $image
     * @return array
     */
    #[ArrayShape(['id' => "int|mixed", 'model_id' => "int|mixed", 'model_type' => "mixed|string", 'model' => "\Illuminate\Database\Eloquent\Model|mixed", 'link' => "array|mixed", 'type' => "mixed|string", 'webp_url' => "mixed"])]
    public function transform(Image $image): array
    {
        $image->load('model');
        return [
            'id' => $image->id,
            'model_id' => $image->model_id,
            'model_type' => $image->model_type,
            'model' => $image->model,
            'link' => $image->link,
            'type' => $image->type,
            'webp_url' => $image->webp_url,
        ];
    }

}
