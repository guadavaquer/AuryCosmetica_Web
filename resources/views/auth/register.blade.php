@extends('layouts.app')

@section('content')
<div style="background-color: #EDE7F6;">
    <div class="row container w-50 m-auto align-items-center p-2">
    <div class="col">
        <div class="card p-2 mt-3 mb-5" style="background-color:white">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3"><h5>{{ __('Registrar usuario') }}</h5></div>        
                        <div class="row">
                            <div class="col form-group">
                                <label for="Nombre" class="form-label text-md-end">{{ __('Nombre') }}</label>
                                <input id="name" type="text" width="100" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Ingresar nombre">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>                            
                        </div>

                        {{-- <div class="row">
                            <div class="col form-group">
                                <label for="Apellido" class="form-label text-md-end">{{ __('Apellido') }}</label>
                                <input id="apellido" type="text" width="100" class="form-control" name="apellido" value="{{ old('apellido') }}" required autofocus placeholder="Ingresar apellido">
                             </div>                            
                        </div> --}}

                        <div class="row">
                            <div class="col form-group">
                                <label for="Email" class="form-label text-md-end">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ingresar email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>                            
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Contraseña" class="form-label text-md-end">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Ingresar contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>                            
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="RepetirContraseña" class="form-label text-md-end">{{ __('Repetir contraseña') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ingresar nuevamente contraseña">
                             </div>                            
                        </div>
                        <div class="row mt-4">
                            <div class="col form-group">
                                <input  style="border-radius:15px" type="submit" value="{{ __('Únete') }}" class="btn  ff-RobotoRegular text-white form-control">
                                
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
