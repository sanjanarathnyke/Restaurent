<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    public function sendDataToFlask(Request $request)
    {
        // Retrieve the data from the 'order_details' table
        $orderDetails = OrderDetail::all();  // You can customize this query based on your needs
        
        // Optionally, you can format the data as needed
        $formattedData = $orderDetails->map(function ($order) {
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
    
        // Send the data to the Flask API
        return $this->sendToFlaskAPI($formattedData);
    }
    
    public function sendToFlaskAPI($data)
    {
        $response = Http::post('http://127.0.0.1:5000/peak-times', [
            'order_details' => $data,  // Adjust this key based on your Flask API's expected data structure
        ]);
    
        // Check if the request was successful
        if ($response->successful()) {
            return response()->json(['message' => 'Data sent successfully to Flask API']);
        } else {
            return response()->json(['message' => 'Failed to send data to Flask API'], 500);
        }
    }
    
    public function getPeakTimes()
    {
        $response = Http::get('http://127.0.0.1:5000/predict-peak-times', []);
    
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['message' => 'Failed to retrieve data'], 500);
        }
    }
    
}
