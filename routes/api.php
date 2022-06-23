<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas API para su aplicación. Estas
| las rutas son cargadas por el RouteServiceProvider dentro de un grupo que
| se le asigna el grupo de middleware "api". ¡Disfruta construyendo tu API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


