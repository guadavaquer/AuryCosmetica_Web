@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h5>Contacto</h5>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <h3>SI TU CONSULTA ES SOBRE UN PEDIDO POR FAVOR DETALLANOS TU NÚMERO DE ORDEN DE COMPRA.</h3>
        </div>
    </div>
    <div class="row m-auto w-80 p-3">
        <div class="col">
            <form action="#" method="get">
                <div class="row">
                    <div class="col form-group">
                        <input type="text" name="nombre" placeholder="Nombre" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <input type="text" name="teléfono" placeholder="Teléfono" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <textarea style="border-color:  rgb(179 157 219);
                                                background-color: transparent; border-radius: 20px" name="mensaje" placeholder="Mensaje"
                            cols="30" rows="10" maxlength="300" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group text-right">
                        <h5>
                            <input style="border-radius:15px" type="submit" value="Enviar" class="btn ff-RobotoRegular text-white form-control w-25">
                        </h5>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
