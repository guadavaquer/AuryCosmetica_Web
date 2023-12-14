<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table='purchase_orders';
    protected $fillable = [
        'id',
        'user_id',
        'total_amount',
        'send_price',
        'created_at'
    ];
}
