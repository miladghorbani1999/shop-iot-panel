<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductListController extends Controller
{

    public function index(Request $request)
    {
        $q = $request->get('q');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort');
        $product = QueryBuilder::for(Product::class)
            ->allowedSorts(['title_fa', 'created_at'])
            ->where('title_fa', 'like', "%$q%")
            ->paginate($perPage)
            ->appends(['per_page' => $perPage, 'q' => $q, 'sort'=> $sort]);
        return fractal($product, ProductTransformer::class)
            ->withResourceName('products')
            ->respond();
    }

    public function show(Product $product)
    {
        return fractal($product, ProductTransformer::class)
            ->withResourceName('products')
            ->respond();
    }
}
