<?php

namespace App\Http\Controllers;

use lluminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    public function sendOrdersToFlask()
    {
        // Fetch and format the order data
        $formattedData = Order::all()->map(function ($order) {
            return [
                'order_id' => $order->order_id,
                'pizza_id' => $order->pizza_id,
                'quantity' => $order->quantity,
                'order_date' => $order->order_date,
                'order_time' => $order->order_time,
                'unit_price' => $order->unit_price,
                'total_price' => $order->total_price,
                'pizza_size' => $order->pizza_size,
                'pizza_category' => $order->pizza_category,
                'pizza_ingredients' => $order->pizza_ingredients,
                'pizza_name' => $order->pizza_name,
            ];
        });

        // Send the data to the Flask API for processing
        $response = Http::post('http://127.0.0.1:5000/predict-peak-times', [
            'order_details' => $formattedData,
        ]);

        // Handle the response
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['message' => 'Failed to retrieve predictions'], 500);
        }
    }
}




