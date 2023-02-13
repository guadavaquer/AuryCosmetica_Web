@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h5>Productos</h5>

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
    @if(!empty($error))
    <div class="row">
        <div class="col alert alert-danger">
            {{$error}}
        </div>
    </div>
    @endif
    @if(!empty($add))
    <div class="row">
        <div class="col alert-success">
            Se añadió el producto exitosamente.
        </div>
    </div>
    @endif
    <div class="row align-items-center">
        <div class="col">
        @if(count($products) > 0)
            @php
                $i = 0;   
            @endphp
            @foreach ($products as $p)
                @if ($i == 0)
                <div class="row">
                @endif
                    <div class="col">
                        <div class="card rounded-3 text-black m-4 display: flex;">
                            <a href="{{ route('products.show',$p)}}">
                                <img src="{{ Storage::url('/products/'.$p->image) }}" class="card-img" alt="Imágen bálsamo labial">
                            </a>
                            <div class="cart-overlay">                                
                                <form id="frmaddcart{{$p->id}}" method="post" action="{{ route('cart.store')}}"> 
                                    @csrf
                                    @method("POST")
                                    <input name="product_id" type="hidden" value="{{$p->id}}">
                                    <img src="{{ URL::asset('img/Agregar_producto.png') }}" onclick="frmaddcart{{$p->id}}.submit()" />
                                </form>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">{{$p->name}}</h6>
                                <h6 class="card-text align-content-center">${{$p->unit_price}}</h6>
                            </div>
                        </div>
                    </div>
                @php
                if ($i == 2){
                    $i = 0;
                    echo "</div>";

                }
                else{
                    $i++;
                }
                @endphp
            @endforeach

            @if ($i != 0)
                @for($j=$i; $j < 3; $j++)
                    <div class="col"></div>
                @endfor
                </div>
            @endif
        @else
            <p>No se encontraron productos</p>            
        @endif
        </div>
    </div>

    <div class="row m-auto justify-content-center">
        {{ $products->links() }}
    <div>

{{-- 
    <div class="row container w-80 m-auto align-items-center">
        <div class="row">

            <div class="col">
                <div class="card rounded-3 text-black m-4 display: flex;">
                    <img src="img/Producto-01.png" class="card-img-top" alt="Imágen bálsamo labial">
                    <div class="card-body">
                        <h6 class="card-title">Bálsamo labial</h6>
                        <h6 class="card-text align-content-center">$400</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-3 text-black m-4">
                    <img src="img/Producto-02.png" class="card-img-top" alt="Imágen Bombas efervescentes x3">
                    <div class="card-body">
                        <h6 class="card-title">Bombas efervescentes x3</h6>
                        <h6 class="card-text align-content-center">$2200</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-3 text-black m-4">
                    <img src="img/Producto-03.png" class="card-img-top" alt="Imágen Jabonera de bambú">
                    <div class="card-body">
                        <h6 class="card-title">Jabonera de bambú</h6>
                        <h6 class="card-text align-content-center">$600</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row container w-80 m-auto">

            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-04.png" class="card-img-top" alt="Imágen Jabones de soja x3">
                    <div class="card-body">
                        <h6 class="card-title">Jabones de soja x3</h6>
                        <h6 class="card-text align-content-center">$900</h6>
                    </div>
                </div>
            </div>
            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-05.png" class="card-img-top" alt="Imágen Máscara facial">
                    <div class="card-body">
                        <h6 class="card-title">Máscara facial</h6>
                        <h6 class="card-text align-content-center">$1300</h6>
                    </div>
                </div>
            </div>
            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-06.png" class="card-img-top" alt="Imágen Rodillo de cuarzo">
                    <div class="card-body">
                        <h6 class="card-title">Rodillo de cuarzo</h6>
                        <h6 class="card-text align-content-center">$1100</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container w-80 m-auto">

            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-07.png" class="card-img-top" alt="Imágen Sales para baño">
                    <div class="card-body">
                        <h6 class="card-title">Sales para baño</h6>
                        <h6 class="card-text align-content-center">$1500</h6>
                    </div>
                </div>
            </div>
            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-08.png" class="card-img-top" alt="Imágen Sérum facial">
                    <div class="card-body">
                        <h6 class="card-title">Sérum facial</h6>
                        <h6 class="card-text align-content-center">$1400</h6>
                    </div>
                </div>
            </div>
            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-09.png" class="card-img-top" alt="Imágen Sólido (Acondicionador)">
                    <div class="card-body">
                        <h6 class="card-title">Sólido (Acondicionador)</h6>
                        <h6 class="card-text align-content-center">$600</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container w-80 m-auto">

            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-10.png" class="card-img-top" alt="Imágen Sólido (Shampoo)">
                    <div class="card-body">
                        <h6 class="card-title">Sólido (Shampoo)</h6>
                        <h6 class="card-text align-content-center">$600</h6>
                    </div>
                </div>
            </div>
            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-11.png" class="card-img-top" alt="Imágen Vela de soja (lavanda)">
                    <div class="card-body">
                        <h6 class="card-title">Vela de soja (lavanda)</h6>
                        <h6 class="card-text align-content-center">$1200</h6>
                    </div>
                </div>
            </div>
            <div class="col mr-4">
                <div class="card rounded-3 text-black mt-3 mb-3">
                    <img src="img/Producto-12.png" class="card-img-top" alt="Imágen Vela de soja (limón)">
                    <div class="card-body">
                        <h6 class="card-title">Vela de soja (limón)</h6>
                        <h6 class="card-text align-content-center">$1200</h6>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
@endsection
