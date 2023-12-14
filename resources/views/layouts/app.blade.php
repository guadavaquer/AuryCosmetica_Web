@php
    $cart = App\Http\Controllers\CartController::cart();
    $countCart = 0;
    if($cart){
        $countCart = count($cart);
    }
    /*echo $cart;*/
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://db.onlinewebfonts.com/c/315a69a04f15dd467d257e3db2f2916f?family=Autography" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/css/fontawesome/all.min.css','resources/css/styles.css'])


</head>
<body id="app" class="h-100 gradient-form" style="display: flex; flex-direction: column; min-height: 100vh;">
    <nav class="navbar navbar-expand-lg navbar-background navbar-light">
        <div class="col">
            <a href="{{ route('index') }}"><img class="img-fluid" src="{{ URL::asset('img/IconoAury.png') }}" alt="Logo Aury" width="120"
                    height="70"></a>
        </div>
        <div class="col">
            <div class="row justify-content-center">
                <h1 class="mb-0">Aury</h1>                
            </div>
            <div class="row justify-content-center">
                <h2>Cosmética natural</h2>
            </div>
        </div>
        <div class="col text-right">
            <h3>
                @guest
                    <div style="display:inline-block"><a href="{{ route('register') }}">Unete</a> 
                        | 
                        <a href="{{ route('login') }}">Iniciar sesión</a></div>
                    <div style="display:inline-block; font-size:1.3rem" class="align-middle"><i class="fa-light fa-circle-user ml-2" ></i></div>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           ¡Hola {{ Auth::user()->name }}!
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </h3>
        </div>
    </nav>

    
    
    <div class="navbar navbar-expand-lg">
        <div class="col mt-3 mb-2">
            <h4>
                <ul style="padding-left: 2%; text-align-center">
                    <li><a href="{{ route('index') }}">INICIO</a></li>
                    <li><a href="{{ route('quienes_somos') }}">QUIENES SOMOS</a></li>
                    <li><a href="{{ route('products.index') }}">PRODUCTOS</a></li>
                    <li><a href="{{ route('contacto') }}">CONTACTO</a></li>                    
                    <li><a href="{{ route('envios') }}">ENVÍOS</a></li>
                    @if(Auth::user() and Auth::user()->is_admin)
                    <li><a href="{{ route('products.catalog') }}">CATALOGO DE PRODUCTOS</a></li>
                    <li><a href="{{ route('users.index') }}">GESTIÓN DE USUARIOS</a></li>
                    <li><a href="{{ route('po.index') }}">ORDENES</a></li>
                    @endif
                </ul>
            </h4>
        </div>
        <div class="col-2 mt-2 mb-2  text-right"><a href="{{ route('cart.index')}}"><i class="fa-light fa-bag-shopping" style="font-size: 1.6rem"></i> ({{$countCart}})</a></div>
    </div>

    
    
    <main style="background-color: #EDE7F6;">
        <div class="container p-5 mb-5">
            @yield('content')
        </div>
    </main>





    <footer class="pie-pagina" style="margin-top: auto">
        <div class="grupo-1">
            <div class="box">
                <div>
                    <h6 class='mt-2'>NUESTRO CONTACTO</h6>
                </div>
                <div class="row justify-content-center">
                    <h3><a><i class="fa-brands fa-whatsapp mr-2"></i></a>
                    11-2222-3333</h3>
                </div>
                <div class="row justify-content-center">
                    <h3><a><i class="fa-light fa-envelope mr-2"></i></a>
                    info@auryweb.com.ar</h3>
                </div>
            </div>
            <div class="box">
                <figure>
                    <a href="{{ route('index') }}"><img class="img-fluid" src="{{ URL::asset('img/IconoAury.png') }}" alt="Logo Aury" width="120"
                            height="70"></a>
                </figure>
            </div>
            <div>
                <h6 class='mt-2'>SEGUINOS EN NUESTRAS REDES</h6>
                <div class="row justify-content-center mt-3">
                    <a><i class="fa-brands fa-instagram mr-3"></i></a>
                    <a><i class="fa-brands fa-facebook-f mr-3"></i></a>
                    <a><i class="fa-brands fa-twitter mr-3"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mb-2">
            <small>© Copyright Aury Cosmética Natural 2022</small>
        </div>
    </footer>
</body>
</html>
