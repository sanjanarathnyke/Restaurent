<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'address_line1',
        'address_line2',
        'city',
        'country',
        'postcode',
        'email',
        'phone',
        'order_note',
    ];
    
}
