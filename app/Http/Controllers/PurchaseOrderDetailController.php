<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrderDetail;

class PurchaseOrderDetailController extends Controller
{
    public function store($po_id, $cart){
        foreach($cart as $c){
            PurchaseOrderDetail::create([
                'purchase_order_id' => $po_id,
                'product_id' =>  $c->product_id,
                'quantity' => $c->quantity,
                'unit_price' => $c->unit_price
            ]);
        }
        return true;
    }
}
