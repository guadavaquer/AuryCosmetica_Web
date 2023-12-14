@extends('layouts.app')

@section('content')
<form method="POST" name="frm" action="{{route('po.store')}}">
{{$address}}
@csrf
<div class="row">
        <div class="col">
            <h5><a href="{{route('po.index')}}">Medios de pago</a> > Tarjeta de débito o crédito </h5>
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

<div class= "row mt-2  justify-content-center ">
    <div class= "col-8 bg-white p-5">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" minlength="20" maxlength="20"/>
                </div>
            </div>
            <div class="col">
            <div class="form-group">
                    <label for="name">Apellido</label>
                    <input name="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" placeholder="Apellido" minlength="20" maxlength="20"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Teléfono</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Teléfono" minlength="10" maxlength="10"/>
                </div>
            </div>
            <div class="col">
            <div class="form-group">
                    <label for="name">Dirección</label>
                    <input name="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" placeholder="Dirección" minlength="30" maxlength="30"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Código Postal</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="xxxx" minlength="4" maxlength="4"/>
                </div>
            </div>
            <div class="col">
            <div class="form-group">
                    <label for="name">País</label>
                    <input name="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" placeholder="Argentina" readonly />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Provincia</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Provincia" minlength="20" maxlength="20"/>
                </div>
            </div>
            <div class="col">
            <div class="form-group">
                    <label for="name">Ciudad</label>
                    <input name="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" placeholder="Ciudad" minlength="20" maxlength="20"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Tipo de tarjeta</label>
                    <select name="select"  class="form-control @error('name') is-invalid @enderror" >
                        <option value="">VISA</option>
                        <option value="">MASTERCARD</option>
                        <option value="">AMEX</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="name">Numero de tarjeta</label>
                    <input name="name" id="cr_no" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="xxxx xxxx xxxx xxxx" minlength="19" maxlength="19" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Fecha de vencimiento</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="MM/YY" minlength="5" maxlength="5"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="name">Código de verificación</label>
                    <input name="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" placeholder="xxx" minlength="3" maxlength="3"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center mt-4">
                    <input type="button" onclick="frm.submit()" class="btn mr-2" value="ACEPTAR" style="color: black; background-color: rgb(179 157 219);"/>
                    <a class="ml-2" href="{{ route('po.index')}}"> <input type="button" class="btn" value="CANCELAR" style="color: black; background-color: rgb(179 157 219);"/></a>
                </div>
            </div>
        </div>
        
    </div>
</form>

<script>
     var cardNum = document.getElementById('cr_no');
cardNum.onkeyup = function (e) {
    if (this.value == this.lastValue) return;
    var caretPosition = this.selectionStart;
    var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
    var parts = [];
    
    for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
        parts.push(sanitizedValue.substring(i, i + 4));
    }
    
    for (var i = caretPosition - 1; i >= 0; i--) {
        var c = this.value[i];
        if (c < '0' || c > '9') {
            caretPosition--;
        }
    }
    caretPosition += Math.floor(caretPosition / 4);
    
    this.value = this.lastValue = parts.join(' ');
    this.selectionStart = this.selectionEnd = caretPosition;
}
</script>

@endsection