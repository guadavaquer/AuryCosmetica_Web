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
    @if(count($cart)==0)
        <div class="alert alert-warning">
            El carrito de compras está vacío
        </div>
    @endif
    <div class="row mt-5 justify-content-center">
       
        <div class="col-6">
            @foreach($cart as $c)
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="custom_card">
                        <img src={{Storage::url('/products/'.$c->image)}} class="card-img-top" />
                        </div>
                    </div>
                    <div class="col-5 my-auto">
                        <div class="row">
                            <div class="col-12 text-center">
                             
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
                                <div class="col text-right p-0"><span type="submit" onclick="frmRmv{{$c->id}}.submit()" class="fa-light fa-circle-minus" style="font-size:1.6rem"></span></div>
                            </form>
                                <div class="col-4">                                
                                    <input type="text" class="form-control text-center" value="{{$c->quantity}}" readonly >
                                </div>
                            <form id="frmAdd{{$c->id}}" method="post" action="{{route('cart.add',$c)}}">
                                @csrf
                                @method("PUT")
                                <div class="col p-0"><span type="submit" onclick="frmAdd{{$c->id}}.submit()" class="fa-light fa-circle-plus" style="font-size:1.6rem"></span></div>
                            </form>
                        </div>

                        
                    </div>
                    <div class="col-1"></div>
                </div>
            @endforeach
        </div>
        <div class="col-4  pl-5 content-align-center">
            <form id="frmSendingPrice" method="GET" action="{{route('cart.index')}}">
            <div class="row">
                <div class="col">
                    <input name="postalcode" type="text" class="form-control" placeholder="Código postal" value="@isset($postalcode) {{$postalcode}} @endisset"  minlength="4" maxlength="4" />
                </div>
                <div class="col">
                    <input type="button" value="CALCULAR" onclick="submit()" />
                </div>
            </div>
            </form>
            <div class="row mt-3">
                <div class="col">
                    <h2>Subtotal</h2>
                </div>
                <div class="col pr-5 text-right">
                    ${{$subtotal}}
                </div>
            </div>
            <div class="row">
                <div class="col mt-2">
                    <h2>Envio</h2>
                </div>
                <div class="col col pr-5 text-right mt-2">
                    ${{$sendingPrice}}
                </div>
            </div>
            
            <div class="row">
                <hr class="border w-80 pl-0 ml-3" style="border:0.75px solid black !important">
            </div>
            <div class="row">
                <div class="col">
                    <h5>Total</h5>
                </div>
                <div class="col pr-5 text-right">
                    ${{$subtotal+$sendingPrice}}
                </div>
            </div>
            <div class="col-1  pl-5 pr-5 content-align-center mt-2">
                <div class="col text-center ml-3"> 
                    <h3>
                        @if(count($cart)>0)
                            <form id="frmCreatepo" method="GET" action="{{route('po.create')}}">
                                <input name="sendingPrice" type="hidden" value="{{$sendingPrice}}">
                                <input name="postalcode" type="hidden" value="{{$postalcode}}">
                            <!-- <a href="{{route('po.create',$sendingPrice)}}"> -->
                                <input type="button" style="color: white; background-color: black; border-color: black; height:1.8rem;width:9rem" value="Iniciar compra" onclick="submit()"/>
                                <!-- </a> -->
                            </form>
                        @endif
                    </h3>
                </div>
            </div>
            <div class="row pl-5 content-align-center mt-3 ml-2">
                <div class="col">
                <a href="{{route('products.index')}}">VER MAS PRODUCTOS</a>
            </div>
            </div>
        </div> 
    </div>
@endsection
