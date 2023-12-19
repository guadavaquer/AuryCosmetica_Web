@extends('layouts.app')

@section('content')

        <div class="row m-auto align-items-center">
            <div class="row">

                <div class="col justify-content-center mb-4 mt-4">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="img/Carrusel-01.jpg" alt="Primer imagen carrusel">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/Carrusel-02.jpg" alt="Segunda imagen carrusel">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/Carrusel-03.jpg" alt="Tercer imagen carrusel">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/Carrusel-04.jpg" alt="Cuarta imagen carrusel">
                            </div>
                        </div>
                    </div>
                    <section class="h-100 gradient-form mt-1 mb-5">
                </div>
            </div>
        </div>

        <div class="row m-auto align-items-center">
            <div style= "box-shadow: 3px 3px 11 border-radius: 25px" class="col-4 mb-4">
                <img src="img/Card-01.png" height="250" width="250" alt="Imágen apto veganos">
            </div>
            <div class="col-4 mb-4 text-center">
                <img src="img/Card-02.png" height="250" width="250" alt="Imágen cruelty free">
            </div>
            <div class="col-4 mb-4 text-right">
                <img src="img/Card-03.png" height="250" width="250" alt="Imágen sin parabenos">
            </div>

        </div>

@endsection