<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
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
