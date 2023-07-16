<?php

namespace App\Services\DigikalaAdaptee\Adaptee;

use App\Enum\ImageTypeEnum;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Value;
use App\Services\DigikalaAdaptee\Contracts\AdapteeInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class ApiAdapter implements AdapteeInterface
{

    public function product(string $url)
    {
        $response = $this->getResponse($url, 'product not found.');
        $data = $response['data']['product'];

        $category = $this->storeCategory($data['category']);
        $brand = $this->storeBrand($data['brand']);


        $existProduct = Product::where('dk_id', $data['id'])->exists();
        $product = Product::query()
            ->updateOrCreate(
                [
                    'dk_id' => $data['id']
                ],
                Arr::only($data, [
                    'title_fa',
                    'title_en',
                    'url',
                    'status',
                    'product_type',
                    'review',
                    'meta',
                ]) + [
                    'seo' => $response['data']['seo'],
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'price' => $data['default_variant']['price']['selling_price'] / 10
                ]
            );

        $colors = $this->storeColor($response['data']['product']['colors']);

        $product->colors()->sync($colors, false);

        $this->storeAttribute($data['specifications'][0]['attributes'], $product->id);
        if (!$existProduct) {
            $this->storeImage(
                $response['data']['product']['images']['main'],
                $product->getMorphClass(),
                $product->id,
                ImageTypeEnum::GALLERY->value
            );
            $this->storeListImagesProduct($response['data']['product']['images']['list'], $product->getMorphClass(), $product->id);
        }

        return $product;
    }

    public function category(string $url)
    {
        $response = $this->getResponse($url, 'category not found.');
        return $this->storeCategory($response['data']['category']);
    }

    public function search(string $url)
    {
        $response = $this->getResponse($url, 'search not found.');
        $products = collect($response['data']['products'])->map(function ($product) {
            return [
                'id' => $product['id'],
                'title' => $product['title_fa'],
            ];
        })->toArray();
        return [
            'data' => $products,
            'pager' => $response['data']['pager'],
        ];
    }

    private function storeCategory(array $category)
    {
        $data = ['title_fa', 'code'];
        return Category::query()
            ->updateOrCreate(
                Arr::only($category, $data),
                Arr::except($category, $data)
            );
    }

    private function storeBrand(array $brand)
    {

        $data = ['title_fa', 'code'];
        $except = ['title_fa', 'code', 'logo'];
        $existBrand = Brand::where('title_fa', $brand['title_fa'])
            ->where('code', $brand['code'])
            ->exists();

        $store = Brand::query()
            ->updateOrCreate(
                Arr::only($brand, $data),
                Arr::except($brand, $except)
            );
        if (!$existBrand) {
            $this->storeImage($brand['logo'], $store->getMorphClass(), $store->id, ImageTypeEnum::LOGO->value);
        }
        return $store;
    }

    private function storeColor($colors)
    {
        return collect($colors)->map(function ($color) {
            return Color::query()
                ->updateOrCreate(
                    ['hex_code' => $color['hex_code']],
                    Arr::except($color, ['hex_code'])
                )->id;
        });

    }

    private function storeImage(array $image, string $modelType, int $modelId, string $type)
    {
        return Image::query()
            ->create([
                'model_type' => $modelType,
                'model_id' => $modelId,
                'type' => $type,
                'link' => $image['url'],
                'webp_url' => $image['webp_url'],
            ]);
    }


    private function storeListImagesProduct($images, $modelType, $modelId)
    {
        collect($images)->each(function ($image) use ($modelId, $modelType) {
            return $this->storeImage($image, $modelType, $modelId, ImageTypeEnum::LIST->value);
        });
    }

    /**
     * @param string $url
     * @param string $get
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function getResponse(string $url, string $get): \Illuminate\Http\Client\Response|\GuzzleHttp\Promise\PromiseInterface
    {
        $response = Http::get($url);
        if ($response->json()['status'] == 400) {
            abort($response->json()['status'], $get);
        } else if ($response->status() != 200 || $response->json()['status'] != 200) {
            abort($response->json()['status'], 'try again.');
        }
        return $response;
    }

    private function storeAttribute($attributes, $productId)
    {
        collect($attributes)->each(function ($att) use ($productId) {
            $stored = Attribute::query()
                ->firstOrCreate([
                    'title' => $att['title'],
                ])->load('values');
            $valueIds = collect($att['values'])->map(function ($value) {
                return Value::firstOrCreate([
                    'value' => $value,
                ])->id;

            });
            $stored->values()->syncWithPivotValues($valueIds, ['product_id' => $productId], false);
        });
    }

}
