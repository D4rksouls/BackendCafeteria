<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas web para su aplicación. Estas
| las rutas son cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el grupo de middleware "web". ¡Ahora crea algo grandioso!
|
|
| '/' es la ruta de la url en este caso seria la url principal y en el caso de ser otra
| se espesificaria
*/


/*
|
|   Estas rutas /RouteName al estar en cada una de estas nos lleva a la vista correspondiente.
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('welcome');
/*
// falta Organizar
Route::get('/login', function () {
    return view('login');
})->name('login');

// falta Organizar
Route::get('/signIn', function () {
    return view('signIn');
})->name('signIn');

// falta Organizar
Route::get('/AdminUsers', function () {
    return view('AdminUsers');
})->name('AdminUsers');

// falta Organizar
Route::get('/store', [ProductController::class, 'index'])->name('store');

Route::post('/', [ProductController::class, 'create'])->name('save');

// falta Organizar
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// falta crear la vista stock
Route::get('/stock', function () {
    return view('stock');
})->name('stock');
*/
