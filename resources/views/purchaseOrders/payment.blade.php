@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h5>Medios de pago</h5>
        </div>
    </div>
    
    <div class="row mt-5 justify-content-center">
        
        <div class="col-6">
       
            <div class= "custom-payment mb-4" style="1px solid">
                <form id="frmPaymentpo" method="POST" action="{{route('po.create')}}">  
                    @csrf

                    <input name="sendingPrice" type="hidden" value="{{$sendingPrice}}">
                    <input name="postalcode" type="hidden" value="{{$postalcode}}">
                    <button type="submit" style="background-color: #fff; border: none; cursor: pointer; width: 100%; text-align: left;">
                        <h3>TARJETA DE DÉBITO O CRÉDITO
                            <div style="float: right;">
                                >
                            </div>
                        </h3>    
                    </button>
                </form>
            </div>
            
            <div class= "custom-payment" style="1px solid">
                <h3>TRANSFERENCIA BANCARIA (PRÓXIMAMENTE)</h3>
            </div> 
            
        </div>
       
        <div class="col"></div>
        <div class="col-5 bg-white justify-content-center" style="1px solid; border-radius: 20px;">
            <div class="p-3">
                <div class="row">
                    <div class="col">
                        <h2>Subtotal</h2>
                    </div>
                    <div class="col-3 text-right">
                        ${{number_format($subtotal,2)}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2>Envio</h2>
                    </div>
                    <div class="col-3 text-right">
                        <input type="hidden" name="sendingPrice" value="{{$sendingPrice}}" />
                        ${{number_format($sendingPrice,2)}}
                    </div> 
                </div>
                <hr />
                <div class="row mt-3">
                    <div class="col">
                        <h2><b>Total a pagar</b></h2>
                    </div>
                    <div class="col-3 text-right">
                        <b>${{number_format($subtotal+$sendingPrice,2)}}</b>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
