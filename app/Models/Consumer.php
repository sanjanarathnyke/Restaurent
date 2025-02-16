<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'email',
        'phone',
    ];
    
}
