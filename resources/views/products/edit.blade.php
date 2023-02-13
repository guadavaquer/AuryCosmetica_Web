@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h5><a href="{{ route("products.catalog")}}">Catálogo de productos</a> > Edición </h5>
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
    <form id="frm" method="post" action="{{route('products.update',$product)}}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
    <div class="row mt-5">
        <div class="col-4">
            <div clas="row">
                <div class="form-group">
                    <label for="name">NOMBRE DEL PRODUCTO</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}" />
                </div>
            </div>
            <div clas="row">
                <div class="form-group">
                    <label for="unit_price">IMPORTE TOTAL</label>
                    <input name="unit_price" type="text" class="form-control @error('unit_price') is-invalid @enderror" value="{{$product->unit_price}}" />
                </div>
            </div>
            <div clas="row">
                <div class="form-group">
                    <label for="image">IMAGEN</label>                    
                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*" />{{$product->image}}
                </div>
            </div>
        </div>
        <div class="col-2">
        </div>
        <div class="col-4">
            <div class="row mb-2">
                <label for="description">DESCRIPCIÓN</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{$product->description}}</textarea>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                <input type="button" class="btn" onclick="frm.submit()" value="ACEPTAR" style="color: black; background-color: rgb(179 157 219);"/>
                </div>
                <div class="col">
                <a href="{{ route('products.catalog')}}"> <input type="button" class="btn" value="CANCELAR" style="color: black; background-color: rgb(179 157 219);"/></a>
                </div>
            </div>            
        </div>
    </div>
</form>


@endsection