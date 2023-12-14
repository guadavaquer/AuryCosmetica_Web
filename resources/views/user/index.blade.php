@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col">
            <h5>Gestión de usuarios</h5>
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
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Administrador</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
   

@if(count($users) > 0)
    @foreach ($users as $u) 
        <tr>
        <td>{{$u->id}}</td>
        <td>{{$u->name}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->is_admin ? 'Si' : 'No'}}</td>
        <td> <a href="{{route('users.edit',$u)}}" style='color:black'><i class="fa-light fa-pen-to-square"></i></a></td>
        <td> <a href="{{route('users.delete',$u)}}" style='color:black'><i class='fa-light fa-trash-can'></i></a></td>
        </tr>  

    @endforeach

@else 
    <tr><td colspan=6>No se encontraron registros</div></div>
@endif


</table>

<div class="row justify-content-center">
        {{ $users->links() }}
    <div>

@endsection