<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'order_details';

    // Specify the primary key if it's different from the default 'id'
    protected $primaryKey = 'order_details_id';

    // Define the attributes that are mass assignable
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

}
