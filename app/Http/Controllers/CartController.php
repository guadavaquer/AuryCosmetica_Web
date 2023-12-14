<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\PostalCodePrice;
use Illuminate\Database\QueryException;

class CartController extends Controller
{
    public function getCart(){
        return Cart::join('products','carts.product_id','=','products.id')->where('carts.user_id','=',Auth::id())->select('carts.*','products.name','products.unit_price','products.image')->get();
    }

    public function calcularTotal($cart){
        $total = 0;
        foreach($cart as $c){
            $total = $total + $c->unit_price*$c->quantity;
        }
        return $total;
    }
    public function getPostalCodePrice($postalCode){
        $postalCodePrice = PostalCodePrice::where('from_postal_code','<=',$postalCode)->where('to_postal_code','>=',$postalCode)->first();
        return $postalCodePrice->price;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {
        $cart = $this->getCart();
        $subtotal = $this->calcularTotal($cart);
        $sendingPrice = 0;
        if($request->postalcode>=1000 && $request->postalcode<10000){
            $sendingPrice = $this->getPostalCodePrice($request->postalcode);
        }
        return view('cart.index',[ 'cart' => $cart, 'subtotal' =>$subtotal, 'sendingPrice' => $sendingPrice,'postalcode' => $request->postalcode ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->input('product_id');

        /*if(!Auth::user()){
            return view('auth.login');
        }*/
        try{
            Cart::create([
                'product_id' => $product_id,
                'user_id' => Auth::id(),
                'quantity' => 1
            ]);
        }
        catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->route('products.index')->with([ 'error' => 'Ya se encuentra en el carrito']);
            }
        }
        return redirect()->route('products.index')->with(['add'=>'ok']);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index');  
    }

    public static function cart(){
        $cart = null;
        if(Auth::check()){
            $cart = Cart::where('user_id','=',Auth::id())->get();
        }
        return $cart;
    }

    public function remove($id){
        Cart::where('id','=',$id)->decrement('quantity');
        $cart = Cart::find($id);
        if($cart->quantity <= 0){
            $cart->delete();
        }
        return redirect()->route('cart.index');
    }

    public function add($id){
        Cart::where('id','=',$id)->increment('quantity');
        return redirect()->route('cart.index');
    }


    public function delete(){
        Cart::where('carts.user_id','=',Auth::id())->delete();
        return true;
    }
   
}
