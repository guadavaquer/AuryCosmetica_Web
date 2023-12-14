<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_id',
        'name',
        'last_name',
        'phone_number',
        'address',
        'department',
        'postal_code',
        'country',
        'state',
        'city'
    ];
}
