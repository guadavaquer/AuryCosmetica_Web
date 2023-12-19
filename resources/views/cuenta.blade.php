@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h5>Mi cuenta</h5>
        </div>
    </div>


    <div class="row mt-5 justify-content-center">
        
        <div class="col-6">
       
            <div class= "custom-payment mb-4" style="1px solid">

                <div>
                    <h3>MIS DATOS</h3>   
                        <ul>
                            <li class= "custom-li mt-4"> <span class="fa-light fa-user mr-2"></span> Usuario: {{ Auth::user()->name }}</li>
                            <li class= "custom-li"> <span class= "fa-light fa-envelope mr-2"></span> Mail: {{ Auth::user()->email }}</li>
                            <li class= "custom-li"> <span class= "fa-light fa-address-card mr-2"></span> DNI: {{ Auth::user()->dni }}</li>
                            <li class= "custom-li"> <span class= "fa-light fa-phone mr-2"></span> Teléfono: {{ Auth::user()->phone }}</li>
                        </ul>
                </div>
            </div>

        </div>
       
        <div class="col-6">

            <div class= "custom-payment mb-4" style="1px solid">

                <h3>MIS PEDIDOS</h3>  
                @foreach($orders as $o) 
                    <div class="row">
                        <div class="col">
                            <h3 class="ml-5">Orden # {{$o->id}}</h3>
                        </div>
                        <div class="col">
                            <h3>Total ${{number_format($o->total_amount + $o->send_price,2)}}</h3>
                        </div>    
                    </div>
                    
                    @endforeach
            </div>
        </div>
    </div>

@endsection
