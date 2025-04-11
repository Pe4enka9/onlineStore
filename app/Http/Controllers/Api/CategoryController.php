<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    // Получение списка категорий
    public function index(): JsonResponse
    {
        return response()->json(['data' => CategoryResource::collection(Category::all())]);
    }

    // Получение списка товаров категории
    public function products(Category $category): JsonResponse
    {
        return response()->json(['data' => ProductResource::collection($category->products)]);
    }
}
