<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseOrder;
use App\Models\Address;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const poPerPage = 8;
    public function index()
    {
        /*$c = new CartController();
        $cart = $c->getCart();
        $total = $c->calcularTotal($cart);
        return view('purchaseOrders.index',[ 'cart' => $cart, 'total' =>$total ]);
        */
        $po = PurchaseOrder::join('users', 'purchase_orders.user_id', '=', 'users.id')
        ->where('purchase_orders.id','=',request()->query('search'))
        ->orWhere('users.id','=',request()->query('search'))
        ->orWhere('users.name','like','%'.request()->query('search').'%')
        ->orWhere('users.email','like','%'.request()->query('search').'%')
        ->select('purchase_orders.id as purchase_order_id',
        'purchase_orders.total_amount as total_amount',
        'purchase_orders.send_price as send_price',
        'purchase_orders.created_at as created_at',
        'users.id as user_id',
        'users.name as name',
        'users.email as email')
        ->orderBy('purchase_orders.id')->paginate(self::poPerPage)
        ;
        return view("purchaseOrders.index", ['po'=> $po]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $c = new CartController();
        $cart = $c->getCart();
        $total = $c->calcularTotal($cart);
        $sendingPrice = $request->input('sendingPrice');
        $postalcode = $request->input('postalcode');
        return view('purchaseOrders.create',[ 'cart' => $cart, 'subtotal' =>$total, 'sendingPrice'=>$sendingPrice, 'postalcode'=>$postalcode, 'request'=>$request]);
    }

    public function payment(Request $request)
    {
        $c = new CartController();
        $cart = $c->getCart();
        $total = $c->calcularTotal($cart);
        $sendingPrice = $request->input('sendingPrice');
        $postalcode = $request->input('postalcode');
        return view('purchaseOrders.payment',[ 'cart' => $cart, 'subtotal' =>$total, 'sendingPrice'=>$sendingPrice, 'postalcode'=>$postalcode, 'request'=>$request]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:100'],
            'last_name' => ['required','max:100'],
            'phone_number' => ['required','max:20'],
            'address' => ['required','max:500'],
            'department' => ['max:50'],
            'postal_code' => ['required','numeric','min:1000','max:9999'],
            'country' => ['required','max:100'],
            'state' => ['required','max:100'],
            'city' => ['required','max:100'],
            'card_type' => ['required','max:20'],
            'card_number' => ['required','max:19'],
            'card_exp' => ['required','max:5'],
            'card_verif_code' => ['required','max:4']
        ],[
            'required' => 'El campo es requerido.',
            'numeric' => 'El campo debe ser numérico.',
            'regex' => 'El formato no coincide, se admiten como máximo hasta 6 números enteros y hasta 2 decimales.',
            'max' => 'El tamaño máximo del campo no de,be exceder los :max caracteres.'
        ]);

        
        $validator->stopOnFirstFailure()->validate();
        
        if($request->sendingPrice==0){
            $errorSendingPrice ='Se debe calcular el costo de envio para continuar';
            return view('purchaseOrders.create',[ "errorSendingPrice" => $errorSendingPrice, "request" => $request]);
        }
        
        $c = new CartController();
        $cart = $c->getCart();

        //Crear la purchaseOrder en BBDD
        $po = PurchaseOrder::create([
            'user_id' => Auth::id(),
            'total_amount' =>  $c->calcularTotal($cart),
            'send_price' => $request->sendingPrice
        ]);

        $pod = new PurchaseOrderDetailController();
        $pod->store($po->id,$cart);
        
        $address = new AddressController();
        $address->store($po->id,$request);

        $payment = new PaymentController();
        $payment->store($po->id, $request);
        
        $c->delete();

        return view('purchaseOrders.message',[ "message" => "La orden de compra nro. " . (string)$po->id . " se creó satisfactoriamente"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
/*
    public function getPurchaseOrders(){
        return PurchaseOrder::where('user_id','=',Auth::id())->get();
    }
*/
}
