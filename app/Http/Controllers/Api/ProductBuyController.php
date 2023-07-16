<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rfid;
use Bavix\Wallet\Internal\Exceptions\ExceptionInterface;
use Illuminate\Http\Request;

class ProductBuyController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'product_ids' => ['required', 'array'],
            'product_ids.*.p_id' => ['required', 'exists:products,id'],
            'rfid' => ['required', 'string', 'exists:rfids,code']
        ]);
        $rfid = Rfid::query()
            ->where('code', $request->rfid)
            ->first();
        $sum = collect($request->product_ids)
            ->sum(function ($data) use ($rfid) {
                $product = Product::find($data['p_id']);
                return $product->price * $data['count'];
            });


        if ($sum > $rfid->user->balance) {
            return response()->json([
                'success' => false,
                'message' => 'کمبود موجودی'
            ]);
        }
        collect($request->product_ids)->each(/**
         * @throws ExceptionInterface
         */ function ($data) use ($rfid) {
            $count = 0;
            $product = Product::find($data['p_id']);
            while ($count != $data['count']) {
                $product->users()->attach($rfid->user->id, [
                    'price' => $product->price,
                    'title_fa' => $product->title_fa,
                ]);
                $rfid->user->withdraw($product->price);
                $count += 1;
            }

        });


        return response()->json([
            'success' => false,
            'message' => 'خرید انجام شد'
        ]);
    }
}
