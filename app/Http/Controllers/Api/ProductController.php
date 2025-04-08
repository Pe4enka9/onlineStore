<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    // Просмотр товара
    public function show(Product $product): JsonResponse
    {
        return response()->json(new ProductResource($product));
    }

    // Покупка
    public function buy(Product $product): JsonResponse
    {

    }
}
