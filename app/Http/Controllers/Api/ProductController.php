<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Просмотр товара
    public function show(Product $product): JsonResponse
    {
        return response()->json(new ProductResource($product));
    }

    // Покупка
    public function buy(Request $request, Product $product): JsonResponse
    {
        $request = new Request([
            'price' => $product->price,
            'product_id' => $product->id,
            'user_id' => $request->user()->id,
            'webhook_url' => url('/payment-webhook'),
        ]);

        return (new PaymentController())->payment($request);
    }

    // Конец покупки
    public function finalPayment(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'numeric', 'in:2,3'],
            'order_id' => ['required', 'string'],
        ]);

        $status = $validated['status'];
        $orderId = $validated['order_id'];

        if (!$status) {
            return response()->json(['success' => false], 422);
        }

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['success' => false], 404);
        }

        $order->update([
            'status_id' => $status,
        ]);

        return response()->json(['success' => true]);
    }
}
