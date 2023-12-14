@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col">
            <h5><a href="{{route("users.index")}}">Gestión de usuarios</a> > Edición </h5>
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
    <form id="frm" method="post" action="{{route('users.update',$user)}}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
    <div class="row mt-5 justify-content-center">
        <div class="col-4">
            <div clas="row">
                <div class="form-group">
                    <label for="name">NOMBRE</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}"  />
                </div>
            </div>
            <div clas="row">
                <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}"  />
                </div>
            </div>
            <div clas="row">
                <div class="form-group">
                    <label for="image">ADMINISTRADOR</label>                    
                    <input type="checkbox" name="is_admin"  @checked($user->is_admin) />
                </div>
            </div>

            <div clas="row">
                <div class="col text-center mt-4">
                    <input type="button" class="btn mr-2" onclick="frm.submit()" value="ACEPTAR" style="color: black; background-color: rgb(179 157 219);"/>

                     <a class="ml-2" href="{{ route('users.index')}}"> <input type="button" class="btn" value="CANCELAR" style="color: black; background-color: rgb(179 157 219);"/></a>
                </div>
            </div>
        </div>
    </div>

</form>

    
@endsection