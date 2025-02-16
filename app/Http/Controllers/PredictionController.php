<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    public function sendOrdersToFlask()
    {
        try {
            // Fetch orders for the last week to ensure we have enough data
            $orders = OrderDetail::query()
                ->orderBy('order_date', 'desc')
                ->orderBy('order_time', 'desc')
                ->take(100)  // Limit to last 100 orders for performance
                ->get();
            
            if ($orders->isEmpty()) {
                Log::warning('No orders found in database');
                return view('predict')->with('error', 'No orders found');
            }
    
            // Format the data
            $formattedData = $orders->map(function ($order) {
                if (!$order->order_date || !$order->order_time) {
                    Log::warning('Missing required fields for order ID: ' . $order->order_id);
                    return null;
                }
    
                return [
                    'order_id' => $order->order_id,
                    'pizza_id' => $order->pizza_id,
                    'quantity' => (int)$order->quantity,
                    'order_date' => $order->order_date->format('Y-m-d'),
                    'order_time' => $order->order_time->format('H:i:s'),
                    'unit_price' => (float)$order->unit_price,
                    'total_price' => (float)$order->total_price,
                    'pizza_size' => $order->pizza_size,
                    'pizza_category' => $order->pizza_category,
                    'pizza_ingredients' => $order->pizza_ingredients,
                    'pizza_name' => $order->pizza_name,
                ];
            })
            ->filter()
            ->values()
            ->toArray();
    
            if (empty($formattedData)) {
                Log::warning('No valid orders after formatting');
                return view('predict')->with('error', 'No valid orders to process');
            }
    
            // Log the payload for debugging
            Log::debug('Sending payload to Flask API:', ['payload' => json_encode(['order_details' => $formattedData])]);
    
            // Send request to Flask API
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post('http://127.0.0.1:5000/predict-peak-times', [
                    'order_details' => $formattedData
                ]);
    
            // Log the response
            Log::info('Flask API Response:', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);
    
            if ($response->successful()) {
                $predictions = $response->json()['predictions'] ?? [];
                Log::info('Received predictions:', ['count' => count($predictions)]);
                return view('predict', ['predictions' => $predictions]);
            }
    
            Log::error('Flask API Error:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
    
            return view('predict')->with('error', 'Failed to retrieve predictions');
    
        } catch (\Exception $e) {
            Log::error('Prediction Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return view('predict')->with('error', 'An error occurred while processing the request');
        }
    }
}