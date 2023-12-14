<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store($po_id, Request $request){
        Payment::create([
            'purchase_order_id'=>$po_id,
            'card_type' => $request->card_type,
            'card_number' => $request->card_number
        ]);
        return true;
    }
}
