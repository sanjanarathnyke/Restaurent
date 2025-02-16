{{-- resources/views/predictions/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Peak Time Predictions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="predictionData()" class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Peak Time Predictions</h1>
            <p class="text-gray-600">Optimize your staffing with AI-powered predictions</p>
        </div>
    
    
        <!-- Error State -->
        @if(isset($error))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $error }}</span>
            </div>
        @endif
    
        <!-- Prediction Results -->
        @if(isset($predictions) && is_array($predictions) && count($predictions) > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($predictions as $prediction)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $prediction['day'] ?? 'N/A' }}</h3>
                                </div>
                                <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                                    {{ isset($prediction['hour']) ? sprintf('%02d:00', $prediction['hour']) : 'N/A' }}
                                </span>
                            </div>
    
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-600">Predicted Orders:</span>
                                <span class="text-2xl font-bold text-blue-600">{{ $prediction['predicted_orders'] ?? 0 }}</span>
                            </div>
    
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Busyness Level:</span>
                                    @php
                                        $predictedOrders = $prediction['predicted_orders'] ?? 0;
                                        $busyClass = $predictedOrders >= 200 ? 'text-red-500' : ($predictedOrders >= 100 ? 'text-yellow-500' : 'text-green-500');
                                        $busyText = $predictedOrders >= 200 ? 'Very Busy' : ($predictedOrders >= 100 ? 'Moderate' : 'Light');
                                    @endphp
                                    <span class="{{ $busyClass }}">{{ $busyText }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600">No predictions available. Try refreshing the page.</p>
            </div>
        @endif
    
        <!-- Popular Items Section -->
        @if(isset($popularItems) && is_array($popularItems) && count($popularItems) > 0)
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Popular Items</h2>
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($popularItems as $item)
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                            <p>Quantity Sold: {{ $item['quantity_sold'] }}</p>
                            <p>Sales Percentage: {{ $item['sales_percentage'] }}%</p>
                            <p>Revenue: ${{ number_format($item['total_revenue'], 2) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    
        <!-- Refresh Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('predict.peak.times') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                Refresh Predictions
            </a>
        </div>
    </div>
</body>
</html>