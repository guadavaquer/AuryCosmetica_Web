<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;
    protected $table='purchase_order_details';
    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'unit_price'
    ];
}
