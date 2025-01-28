<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registerd extends Model
{
    protected $table = 'registered'; 
    protected $fillable = ['name', 'email', 'password']; 
}
