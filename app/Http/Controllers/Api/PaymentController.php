<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function payment(Request $request): JsonResponse
    {
        $request->validate([
            'price' => ['required', 'numeric', 'min:1'],
            'product_id' => ['required', 'numeric', Rule::exists(Product::class, 'id')],
            'user_id' => ['required', 'numeric', Rule::exists(User::class, 'id')],
            'webhook_url' => ['required', 'url'],
        ]);

        $orderId = uniqid('order_');

        Order::create([
            'order_id' => $orderId,
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
            'price' => $request->input('price'),
        ]);

        return response()->json([
            'pay_url' => url("/process-payment/$orderId"),
            'order_id' => $orderId,
        ]);
    }

    public function processPayment(Request $request, string $orderId): JsonResponse
    {
        $status = $request->input('credit_card') === '8888 0000 0000 1111' ? 2 : 3;

        $request = new Request([
            'status' => $status,
            'order_id' => $orderId,
        ]);

        return (new ProductController())->finalPayment($request);
    }
}
