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

