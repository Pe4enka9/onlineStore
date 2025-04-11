<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Просмотр списка заказов пользователя
    public function userOrders(Request $request): JsonResponse
    {
        $orders = Order::where('user_id', $request->user()->id)->get();

        return response()->json(['data' => OrderResource::collection($orders)]);
    }
}
