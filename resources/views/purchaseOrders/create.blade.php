@extends('layouts.app')

@section('content')
<form name="frm" id="frm" method="POST" action="{{route('po.store')}}">
@csrf
    @if($errors)
        <div class="row mb-5">
            <div class="col alert-danger">
                @foreach ($errors->all() as $message)
                    {{$message}}
                @endforeach
            </div>
        </div>
    @endif 
    @if(isset($errorSendingPrice))
        <div class="row mb-5">
            <div class="col alert-danger">
                $errorSendingPrice
            </div>
        </div>
    @endif 
    <div class="row">
        <div class="col">
            <h5>Domicilio de envío</h5>
        </div>
    </div>

    <div class= "row mt-3  justify-content-center ">
        <div class= "col-10 ">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" minlength="1" maxlength="100" value="{{old('name')}}" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="lastName">Apellido</label>
                        <input name="last_name" type="text" class="form-control @error('lastName') is-invalid @enderror" placeholder="Apellido" minlength="1" maxlength="100" value="{{old('last_name')}}"/>
                    </div>
                </div>
               <div class="col">
                    <div class="form-group">
                        <label for="phone_number">Teléfono</label>
                        <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Teléfono" minlength="1" maxlength="20" value="{{old('phone_number')}}"/>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección" minlength="1" maxlength="500" value="{{old('address')}}"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="department">Dpto/Piso</label>
                        <input name="department" type="text" class="form-control @error('department') is-invalid @enderror" placeholder="Depto/Piso" maxlength="50" value="{{old('department')}}"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="postal_code">Código Postal</label>
                        <input readonly name="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" placeholder="Código postal" minlength="4" maxlength="4" value="{{$postalcode ?? old('postal_code')}}"/>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="country">País</label>
                        <input name="country" type="text" class="form-control @error('country') is-invalid @enderror" value="Argentina" readonly />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="state">Provincia</label>
                        <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" placeholder="Provincia" minlength="1" maxlength="100" value="{{old('state')}}"/>
                    </div>
                </div>
                <div class="col">
                <div class="form-group">
                        <label for="city">Ciudad</label>
                        <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" placeholder="Ciudad" minlength="1" maxlength="100" value="{{old('city')}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col">
            <h5>Pago con tarjeta</h5>
        </div>
    </div>

    <div class= "row justify-content-center mt-3">
        <div class= "col-10 ">
            
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="card_type">Tipo de tarjeta</label>
                                <select name="card_type"  class="form-control @error('card_type') is-invalid @enderror" style="background-color:transparent; border-radius: 20px; border-color: rgb(179 157 219);">
                                    <option value="VISA" {{ old('card_type') == 'VISA' ? 'selected' : '' }}>VISA</option>
                                    <option value="MASTERCARD" {{ old('card_type') == 'MASTERCARD' ? 'selected' : '' }}>MASTERCARD</option>
                                    <option value="AMEX" {{ old('card_type') == 'AMEX' ? 'selected' : '' }}>AMEX</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="card_number">Numero de tarjeta</label>
                                <input name="card_number" id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" placeholder="xxxx xxxx xxxx xxxx" minlength="19" maxlength="19" value="{{old('card_number')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="card_exp">Fecha de vencimiento</label>
                                <input name="card_exp" type="text" class="form-control @error('card_exp') is-invalid @enderror" placeholder="MM/YY" minlength="5" maxlength="5" value="{{old('card_exp')}}"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="card_verif_code">Código de verificación</label>
                                <input name="card_verif_code" type="text" class="form-control @error('card_verif_code') is-invalid @enderror" placeholder="xxxx" minlength="3" maxlength="4" value="{{old('card_verif_code')}}"/>
                            </div>
                        </div>
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
    </div>

    <div class="row mt-5">
        <div class="col text-center">
                <a class="mr-2" href="{{ route('cart.index')}}"> <input type="button" class="btn" value="CANCELAR" style="color: black; background-color: rgb(179 157 219);"/></a>
                <input type="button" onclick="submitForm();" class="btn mr-2" value="CONTINUAR" style="color: black; background-color: rgb(179 157 219);"/>
            </div>
        </div>
    </div>

    <script language="javascript" type="text/javascript">
        var cardNum = document.getElementById('card_number');
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

    
        
        function submitForm() {
            document.getElementById("frm").submit();          
        }
 
    </script>
</form>
@endsection