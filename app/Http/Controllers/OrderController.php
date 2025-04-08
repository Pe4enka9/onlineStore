<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    // Просмотр всех заказов
    public function index(): View
    {
        $orders = Order::all();

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }
}
