<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // THIS LINE IS CRUCIAL - it must include 'image'
    protected $fillable = [
        'name',
        'sku',
        'image', 
        'price',
        'quantity',
    ];
}