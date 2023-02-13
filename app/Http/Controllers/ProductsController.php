<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    const productsPerPage = 6;

    public function index(){
        $products = Product::where('name','like','%'.request()->query('search').'%')->orderBy('name')->paginate(self::productsPerPage);
        return view('products.index',[ 'products' => $products, 'error' => Session::get('error'),'add' => Session::get('add') ]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:191'],
            'unit_price' => ['required','numeric','regex:/^((?!0)\d{1,6}|0|\.\d{1,2})($|\.$|\.\d{1,2}$)/u'],
            'description' => ['required','max:500'],
            'image' => ['required']
        ],[
            'required' => 'El campo es requerido.',
            'numeric' => 'El campo debe ser numérico.',
            'regex' => 'El formato no coincide, se admiten como máximo hasta 6 números enteros y hasta 2 decimales.',
            'max' => 'El tamaño máximo del campo no debe exceder los :max caracteres.'
        ]);

        $validator->stopOnFirstFailure()->validate();

        /*if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();
            $request->image->storeAs('products',$imageName,'public');
        } else {
            $imageName = "";
        }*/
        $imageName = $request->image->getClientOriginalName();
        $request->image->storeAs('products',$imageName,'public');
        
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'unit_price' => $request->unit_price,
            'image' => $imageName
        ]);
    
        return redirect()->route('products.catalog');
    }

    public function show(Product $product){        
        return view('products.show',[ 'product' => $product]);
    }

    public function edit(Product $product){        
        return view('products.edit',[ 'product' => $product]);
    }

    public function update(Request $request, Product $product){
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:191'],
            'unit_price' => ['required','numeric','regex:/^((?!0)\d{1,6}|0|\.\d{1,2})($|\.$|\.\d{1,2}$)/u'],
            'description' => ['required','max:500']
        ],[
            'required' => 'El campo es requerido.',
            'numeric' => 'El campo debe ser numérico.',
            'regex' => 'El formato no coincide, se admiten como máximo hasta 6 números enteros y hasta 2 decimales.',
            'max' => 'El tamaño máximo del campo no debe exceder los :max caracteres.'
        ]);

        $validator->stopOnFirstFailure()->validate();

        
        if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();
            $request->image->storeAs('products',$imageName,'public');
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'unit_price' => $request->unit_price,
            'image' => $imageName
        ]);
        return redirect()->route('products.catalog');
    }

    public function destroy(Product $product)  
    {  
       $product->delete();
       return redirect()->route('products.catalog');     
    } 
    
    public function catalog(){
        $products = Product::where('name','like','%'.request()->query('search').'%')->orderBy('name')->paginate(self::productsPerPage);       
        return view('products.catalog',[ 'products' => $products ]);
    }

    

}
