<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\QueryException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::join('products','carts.product_id','=','products.id')->where('carts.user_id','=',Auth::id())->select('carts.*','products.name','products.unit_price','products.image')->get();
        $subtotal = 0;
        foreach($cart as $c){
            $subtotal = $subtotal + $c->unit_price*$c->quantity;
        }
        

        return view('cart.index',[ 'cart' => $cart, 'subtotal' =>$subtotal ]);
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
        return redirect()->route('cart.index');
    }

    public function add($id){
        Cart::where('id','=',$id)->increment('quantity');
        return redirect()->route('cart.index');
    }

    public function sendingprice(Request $request){
        $postalcode = $request->postalcode;
        return redirect()->route('cart.index',['postalcode' => $postalcode]);
    }
}
