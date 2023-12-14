<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function store($po_id, Request $request){
        $address = Address::create([
            'purchase_order_id' => $po_id,
            'name'=> $request->name,
            'last_name'=>$request->last_name,
            'phone_number'=>$request->phone_number,
            'address' => $request->address,
            'department' => $request->department,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city
        ]);
        return true;
    }
}
