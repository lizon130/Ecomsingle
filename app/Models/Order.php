<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_phone_number',
        'shipping_city_name',
        'shipping_postal_code',
        'product_name',
        'quantity',
        'total_price',


    ];
}
