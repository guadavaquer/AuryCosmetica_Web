@extends('layouts.app')

@section('content')
<div style="background-color: #EDE7F6;">
    <div class="row container w-40 m-auto align-items-center p-2">
        <div class="col">
    
            <div class="card p-2 mt-3 mb-5" style="background-color:white">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3"><h5>{{ __('Iniciar sesión') }}</h5></div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="email" class="form-label text-md-end">{{ __('Usuario') }}</label>
                                <input id="email" type="email" width="100" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Ingresar email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="password" class="form-label text-md-end">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Ingresar contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                            
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col form-group">
                                <input style="border-radius:15px" type="submit" value="{{ __('Iniciar sesión') }}" class="btn  ff-RobotoRegular text-white form-control">
                                
                            </div>                            
                        </div>
                        
                        <div class="row text-center">
                            <div class="col form-group mt-4">
                                <label class="form-label text-md-end mr-3">{{ __('No tienes una cuenta?') }}</label>
                                <a href="{{route('register')}}"><input type="button" value="{{ __('Nuevo usuario') }}" class="btn  ff-RobotoRegular"></a>
                               
                            </div>                            
                        </div>
                        
                                
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
