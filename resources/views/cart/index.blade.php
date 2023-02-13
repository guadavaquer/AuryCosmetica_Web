@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h5>Carrito de compras</h5>
        </div>
    </div>
    @if($errors)
        <div class="row">
            <div class="col alert-danger">
                @foreach ($errors->all() as $message)
                    {{$message}}
                @endforeach
            </div>
        </div>
    @endif 
    <div class="row mt-5 justify-content-center">
        <div class="col-6">
            @foreach($cart as $c)
                <div class="row mb-3">
                    <div class="col-6 " >
                        <div class="card">
                        <img src={{Storage::url('/products/'.$c->image)}} class="card-img-top" />
                        </div>
                    </div>
                    <div class="col-6 my-auto ">
                        <div class="row">
                            <div class="col-12 text-center ">
                                <h2>{{$c->name}}
                                    
                                    <form id="frm{{$c->id}}" method="post" action="{{route('cart.destroy',$c)}}" class="p-0 m-0 d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <span class="fa fa-trash" type="submit" onclick="frm{{$c->id}}.submit()"></span>
                                    </form>
                                    
                                </h2>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                ${{$c->unit_price}}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                        <form id="frmRmv{{$c->id}}" method="post" action="{{route('cart.remove',$c->id)}}">
                                @csrf
                                @method("PUT")
                                <div class="col text-right p-0"><span type="submit" onclick="frmRmv{{$c->id}}.submit()" class="fa-regular fa-circle-minus" style="font-size:1.6rem"></span></div>
                            </form>
                                <div class="col-4">                                
                                    <input type="text" class="form-control text-center" value="{{$c->quantity}}" readonly >
                                </div>
                            <form id="frmAdd{{$c->id}}" method="post" action="{{route('cart.add',$c)}}">
                                @csrf
                                @method("PUT")
                                <div class="col p-0"><span type="submit" onclick="frmAdd{{$c->id}}.submit()" class="fa-regular fa-circle-plus" style="font-size:1.6rem"></span></div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-4">
            {{-- <form id="frmSendingPrice" method="post" action="{{route('cart.sendingprice')}}">
            <div class="row">
                <div class="col">
                    <input name="postalcode" type="text" class="form-control" placeholder="Tu código postal" value=@isset($postalcode) $postalcode @endisset />
                </div>
                <div class="col">
                    <input type="button" value="CALCULAR"  />
                </div>
            </div>
            </form> --}}
            <div class="row ">
                <div class="col ">
                    <h5>Subtotal</h5>
                </div>
                <div class="col">
                    ${{$subtotal}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Envio </h5>
                </div>
                <div class="col">
                    $0
                </div>
            </div>
            <div class="row">
                <hr class="border w-80 pl-0 ml-3" style="border:1px solid black !important">
            </div>
            <div class="row">
                <div class="col">
                    <h5>Total</h5>
                </div>
                <div class="col">
                    ${{$subtotal}}
                </div>
            </div>
            <div class="row mt-5 ">
                <div class="col text-center">
                <input type="button" value="Iniciar compra" />
                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col">
                <a href="{{route('products.index')}}">VER MAS PRODUCTOS</a>
            </div>
            </div>
        </div> 
    </div>
@endsection
