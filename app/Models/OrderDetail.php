<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'order_details_id';

    protected $fillable = [
        'order_id',
        'pizza_id',
        'quantity',
        'order_date',
        'order_time',
        'unit_price',
        'total_price',
        'pizza_size',
        'pizza_category',
        'pizza_ingredients',
        'pizza_name',
    ];

    // Cast the date and time fields
    protected $casts = [
        'order_date' => 'date',
        'order_time' => 'datetime',
        'unit_price' => 'float',
        'total_price' => 'float',
        'quantity' => 'integer'
    ];

    // Define the relationship with Order if it exists
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}