@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col">
            <h5>Ordenes de compra</h5>
        </div>

    <div class="col-3 text-right mt-4">
            <form id="frmsearch" method="get">
                @csrf
                <div class="input-group">
                    <input name="search" type="search" class="form-control btn-search border-right-0 " placeholder="Buscar"
                        aria-label="Search" value="{{ request()->get('search') }}" onblur="frmsearch.submit()" />
                    
                    <div class="input-group-append">
                        <span class="btn btn-search border-left-0 py-1 align-middle" id="search-addon">
                            <i class="fa-light fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>  
            </form> 
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Precio total</th>
                <th scope="col">Fecha</th>
                <th scope="col">ID Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
   

@if(count($po) > 0)
    @foreach ($po as $o) 
        <tr>
        <td>{{$o->purchase_order_id}}</td>
        <td>${{number_format($o->total_amount+$o->send_price,2)}}</td>
        <td>{{\Carbon\Carbon::parse($o->created_at)->format('d/m/Y')}}</td>
        <td>{{$o->user_id}}</td>
        <td>{{$o->name}}</td>
        <td>{{$o->email}}</td>
        </tr>  

    @endforeach

@else 
    <tr><td colspan=6>No se encontraron registros</div></tr>
@endif


</table>

<div class="row justify-content-center">
        {{ $po->links() }}
    <div>
@endsection