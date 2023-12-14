@extends('layouts.app')

@section('content')
<form name="frm" id="frm" >
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
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" minlength="1" maxlength="100" value="{{$request->name}}" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="lastName">Apellido</label>
                        <input name="last_name" type="text" class="form-control @error('lastName') is-invalid @enderror" placeholder="Apellido" minlength="1" maxlength="100" value="{{$request->last_name}}"/>
                    </div>
                </div>
               <div class="col">
                    <div class="form-group">
                        <label for="phone_number">Teléfono</label>
                        <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Teléfono" minlength="1" maxlength="20" value="{{$request->phone_number}}"/>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección" minlength="1" maxlength="500" value="{{$request->address}}"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="department">Dpto/Piso</label>
                        <input name="department" type="text" class="form-control @error('department') is-invalid @enderror" placeholder="Depto/Piso" maxlength="50" value="{{$request->department}}"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="postal_code">Código Postal</label>
                        <input readonly name="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" placeholder="Código postal" minlength="4" maxlength="4" value="{{$postalcode}}"/>
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
                        <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" placeholder="Provincia" minlength="1" maxlength="100" value="{{$request->state}}"/>
                    </div>
                </div>
                <div class="col">
                <div class="form-group">
                        <label for="city">Ciudad</label>
                        <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" placeholder="Ciudad" minlength="1" maxlength="100" value="{{$request->city}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col">
            <h5>Medios de pago</h5>
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
                                    <option value="VISA">VISA</option>
                                    <option value="MASTERCARD">MASTERCARD</option>
                                    <option value="AMEX">AMEX</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="card_number">Numero de tarjeta</label>
                                <input name="card_number" id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" placeholder="xxxx xxxx xxxx xxxx" minlength="19" maxlength="19" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="card_exp">Fecha de vencimiento</label>
                                <input name="card_exp" type="text" class="form-control @error('card_exp') is-invalid @enderror" placeholder="MM/YY" minlength="5" maxlength="5"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="card_verif_code">Código de verificación</label>
                                <input name="card_verif_code" type="text" class="form-control @error('card_verif_code') is-invalid @enderror" placeholder="xxxx" minlength="3" maxlength="4"/>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col"></div>
                <div class="col-5 bg-white justify-content-center" style="1px solid; border-radius: 20px;">
                    <div class="p-3">
                        @foreach($cart as $c)
                            <div class="row">
                                <div class="col">
                                    <h2>{{$c->name}}</h2>
                                </div>
                                <div class="col-3 text-right">
                                    ${{$c->unit_price}}
                                </div>
                            </div>
                        @endforeach
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
                                <h2><b>Total</b></h2>
                            </div>
                            <div class="col-3 text-right">
                                <b>${{number_format($total+$sendingPrice,2)}}</b>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col text-center">
                <a class="mr-2" href="{{ route('products.index')}}"> <input type="button" class="btn" value="CANCELAR" style="color: black; background-color: rgb(179 157 219);"/></a>
                <input type="button" onclick="submitForm(1);" class="btn mr-2" value="CONTINUAR" style="color: black; background-color: rgb(179 157 219);"/>
            </div>
        </div>
    </div>

<!-- 
    <div class= "row mt-5 ml-5">
        <div class= "col-6">
            <div class="row">
                <a href="{{route('po.create')}}"><input type=button style="background-color: white; height:2.5rem;width:20rem" value="TARJETA DE DÉBITO O CRÉDITO"/></a> 
            </div>

            <div class="row mt-5 ">
                <form id="frmTransferencia" method="post" action="{{route('po.store')}}">
                    @csrf
                    <input type=button style="background-color: white; height:2.5rem;width:20rem" value="TRANSFERENCIA BANCARIA" onclick="pagarTransferencia()" />
                </form>
                
            </div>
        </div>
        
        <div class= "col-5 bg-white pt-4 ml-4">
            @foreach($cart as $c)
                <div class="row">
                    <div class="col">
                        <h2>{{$c->name}}</h2>
                    </div>
                    <div class="col-3 text-right">
                        ${{$c->unit_price}}
                    </div>
                </div>
            @endforeach
            <hr />
            <div class="row mt-3">
            <div class="col">
                    <h2><b>Total</b></h2>
                </div>
                <div class="col text-right">
                <b>${{$total}}</b>
                </div>

            </div>
        </div>
    </div> -->

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

        function submitForm(d){
            var frm = document.getElementById('frm');
            if(d==0){
                //calculo de precio
                frm.method="GET";
                frm.action="{{route('po.create')}}";
            }
            else{
                //Creacion de orden
                frm.method="POST";
                frm.action="{{route('po.store')}}";
            }
            frm.submit();
        }
        
        
    </script>
</form>
@endsection