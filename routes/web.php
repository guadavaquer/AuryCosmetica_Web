<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['is_admin']],function(){
    Route::get('/products/catalog', [ProductsController::class,"catalog"])->name('products.catalog');
    Route::post('/products',[ProductsController::class,"store"])->name('products.store');
    Route::get('/products/create',[ProductsController::class,"create"])->name('products.create');
    Route::put('/products/{product}',[ProductsController::class,"update"])->name('products.update');
    Route::delete('/products/{product}',[ProductsController::class,"destroy"])->name('products.destroy');
    Route::get('/products/{product}/edit',[ProductsController::class,"edit"])->name('products.edit');
});

Route::group(['middleware' => ['auth']],function(){
    Route::get('/cart',[CartController::class,"index"])->name('cart.index');
    Route::post('/cart',[CartController::class,"store"])->name('cart.store');
    Route::get('/cart/create',[CartController::class,"create"])->name('cart.create');
    Route::get('/cart/{cart}',[CartController::class,"show"])->name('cart.show');
    Route::put('/cart/{cart}',[CartController::class,"update"])->name('cart.update');
    Route::delete('/cart/{cart}',[CartController::class,"destroy"])->name('cart.destroy');
    Route::get('/cart/{cart}/edit',[CartController::class,"edit"])->name('cart.edit');
    Route::put('/cart/{id}/remove',[CartController::class,"remove"])->name('cart.remove');
    Route::put('/cart/{id}/add',[CartController::class,"add"])->name('cart.add');
    //Route::post('/sendingprice',[CartController::class,"sendingprice"])->name('cart.sendingprice');
});

//Route::resource('products',ProductsController::class);
Route::get('/products',[ProductsController::class,"index"])->name('products.index');
Route::get('/products/{product}',[ProductsController::class,"show"])->name('products.show');

//Route::resource('cart',CartController::class);




//Route::get('/Cart', function(){ return view('quienes_somos'); })->name('cart.show');
Route::get('/QuienesSomos', function(){ return view('quienes_somos'); })->name('quienes_somos');
Route::get('/Contacto', function(){ return view('contacto'); })->name('contacto');
Route::get('/Envios', function(){ return view('envios'); })->name('envios');

Route::get('/', function () {
    return view('index');
})->name('index');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
