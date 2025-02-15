<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'subtotal',
        'service_charge',
        'total',
        'payment_method',
    ];
}
