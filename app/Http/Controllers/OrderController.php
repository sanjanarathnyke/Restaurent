<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class orderController extends Controller
{
    public function showChart()
    {
        $orders = Order::select('payment_method', DB::raw('COALESCE(SUM(total), 0) as total'))
        ->groupBy('payment_method')
        ->get();

        $quantityData = Order::select('name', DB::raw('COALESCE(SUM(quantity), 0) as total_quantity'))
        ->groupBy('name')
        ->get();

        return view('report', compact('orders','quantityData'));
    }
}
