<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetProductRequest;
use App\Services\Shop\Facades\ShopFacade;
use App\Transformers\ProductTransformer;

class ProductController extends Controller
{

    public function index(GetProductRequest $request)
    {
        $request->checkRegex();
        $product = ShopFacade::via($request->input('type'))
            ->setEntity($request->input('entity'))
            ->setIdentifier($request->input('url'))
            ->product();
        return fractal($product, ProductTransformer::class)
            ->withResourceName('products')
            ->respond();
    }
}
