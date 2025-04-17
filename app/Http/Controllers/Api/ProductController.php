<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WebhookRequest;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    // Все товары
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json(ProductResource::collection($products));
    }

    // Просмотр товара
    public function show(Product $product): JsonResponse
    {
        return response()->json(new ProductResource($product));
    }

    /**
     * Покупка
     *
     * @throws ConnectionException
     */
    public function buy(Request $request, Product $product): JsonResponse
    {
        $order = Order::create([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
            'price' => $product->price,
        ]);

        $response = Http::post('http://127.0.0.1:8081/api/create-link', [
            'price' => $product->price,
            'webhook_url' => url('/api/payment-webhook'),
        ]);

        if ($response->successful()) {
            $responseData = $response->json();

            $order->update([
                'payment_id' => $responseData['payment_id'],
            ]);

            return response()->json([
                'pay_url' => $responseData['pay_url'],
            ]);
        }

        return response()->json(['success' => false], 500);
    }

    // Webhook
    public function webhook(WebhookRequest $request): JsonResponse
    {
        $order = Order::where('payment_id', $request->input('payment_id'))->first();

        $order->update([
            'status_id' => $request->input('status'),
        ]);

        return response()->json(null, 204);
    }
}
