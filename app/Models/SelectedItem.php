<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    public function selectedItems()
    {
        return $this->hasMany(SelectedItem::class);
    }
}
