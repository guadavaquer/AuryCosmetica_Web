<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\HomeController;
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

    Route::get('/users',[UserController::class,"index"])->name('users.index');
    Route::get('/users/{user}/edit',[UserController::class,"edit"])->name('users.edit');
    Route::put('/users/{user}',[UserController::class,"update"])->name('users.update');
    Route::delete('/users/{user}',[UserController::class,"destroy"])->name('users.destroy');
    Route::get('/users/{user}/delete',[UserController::class,"delete"])->name('users.delete');

});

Route::group(['middleware' => ['auth']],function(){
    Route::get('/cart',[CartController::class,"index"])->name('cart.index');
    Route::post('/cart',[CartController::class,"store"])->name('cart.store');
    Route::get('/cart/create',[CartController::class,"create"])->name('cart.create');
    Route::put('/cart/{cart}',[CartController::class,"update"])->name('cart.update');
    Route::delete('/cart/{cart}',[CartController::class,"destroy"])->name('cart.destroy');
    Route::get('/cart/{cart}/edit',[CartController::class,"edit"])->name('cart.edit');
    Route::put('/cart/{id}/remove',[CartController::class,"remove"])->name('cart.remove');
    Route::put('/cart/{id}/add',[CartController::class,"add"])->name('cart.add');

    Route::get('/purchaseOrder',[PurchaseOrderController::class,"index"])->name('po.index');
    Route::post('/purchaseOrder',[PurchaseOrderController::class,"store"])->name('po.store');
    Route::get('/purchaseOrder/create',[PurchaseOrderController::class,"create"]); // Se invoca al retornar las validaciones del formulario de creacion de orden en el metodo Store de la PO
    Route::post('/purchaseOrder/create',[PurchaseOrderController::class,"create"])->name('po.create'); // Se usa para enviar la informacion de sending price y postal code desde la pagina payment
    Route::post('/purchaseOrder/payment',[PurchaseOrderController::class,"payment"])->name('po.payment');

    Route::get('/cuenta',[HomeController::class,"cuenta"])->name('cuenta');
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
