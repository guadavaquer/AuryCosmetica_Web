@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col">
            <h5>Catalogo de productos</h5>
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
    <div class="row">
        <div class="col">
            <p class="align-left"><a href="{{route('products.create')}}"> <input type="button" class="btn btn-primary" style="color: black; background-color: rgb(179 157 219);" value="AGREGAR PRODUCTO" /></a></p>
        </div>
    </div>
  
    <div class="row mt-4">
        <div class="col">
        @if(count($products) > 0)
            @php
                $i = 0;   
            @endphp
            @foreach ($products as $p)
                @if ($i == 0)
                <div class="row">
                @endif
                    <div class="col-4">
                        <div class="row">
                            <div class="col-8">
                                <div class="card rounded-3 text-black">
                                    <img src="{{ Storage::url('/products/'.$p->image) }}" class="card-img-top" alt="Imágen {{$p->name}}">
                                    <div class="card-body">
                                        <h6 class="card-title">{{$p->name}}</h6>
                                        <h6 class="card-text align-content-center">${{$p->unit_price}}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 my-auto">
                                <a href="{{route('products.edit',$p)}}"><span class="fa-light fa-pen-to-square" style="font-size:1.5rem; color:rgb(179 157 219);" ></span></a>
                            </div>
                            <div class="col-1 my-auto">
                                <form id="frmdelete{{$p->id}}"  method="post" action="{{route('products.destroy',$p)}}">
                                    @csrf
                                    @method('DELETE')
                                    <span class="fa-light fa-trash-can pl-3 submit" type="submit" style="font-size:1.5rem; color:rgb(179 157 219);" onclick="d({{$p->id}});"></span>
                                </form>
                                
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
                    <div class="col-4"></div>
                @endfor
                </div>
            @endif
        @else
            <div class="col">
                <p>No se encontraron productos</p>
            </div>
        @endif
    </div>
    </div>

    <div class="row justify-content-center">
        {{ $products->links() }}
    <div>

    <script language="javascript" type="text/javascript">
        function d(id){
            if(confirm('¿Está seguro que desea eliminar el producto?')){
                
                    frm = document.getElementById('frmdelete'+id);
                    frm.submit();
                
            }
        }
    </script>
@endsection
