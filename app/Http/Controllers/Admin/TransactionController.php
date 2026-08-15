<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->with(['user', 'items'])
            ->latest()
            ->paginate(20);

        return view('admin.transactions.index', [
            'orders' => $orders,
        ]);
    }
}
