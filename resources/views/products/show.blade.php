@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h5><a href="{{ route("products.index")}}">Productos</a> > {{$product->name}} </h5>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-4">
            <img src="{{ URL::asset('/storage/products/'.$product->image) }}" class="card-img-top" alt="Imágen {{$product->name}}">
        </div>
        <div class="col-2">
        </div>
        <div class="col-4">
            <div class="row justify-content-center mb-2">
               <h2> {{$product->name}}</h2>
            </div>
            <div class="row text-justify mb-2">
                {{$product->description}}
            </div>
            <div class="row justify-content-center mb-2">
                <b>${{$product->unit_price}}</b>
            </div>
            <div class="row justify-content-center">
                <form id="frmaddcart{{$product->id}}" method="post" action="{{ route('cart.store')}}"> 
                    @csrf
                    @method("POST")
                    <span class="btn btn-primary cart-link" onclick="frmaddcart{{$product->id}}.submit()">Agregar al carrito</span>
                </form>
            </div>
        </div>
    </div>


@endsection