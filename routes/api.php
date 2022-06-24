<?php

use App\Models\Product;
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

/*
|   Existe un endpoint que es accesible por medio del metodo GET y el endpoint es products
|   Cuando hagamos referencia a ese endpoint o URI se va a ejecutar la funcion de retornarnos
|   toda la lista de los articulos que estan en nuestra base de datos.  (utilizando magic method por
|   medio de ORM de eloquent)
*/
Route::get('products', function() {
    return Product::all();
});

/*
|   Existe un endpoint que es accesible por medio del metodo GET y el endpoint es products
|   y se le envia {id}, donde este mismo se resive como @param  $id de la funcion
|   en donde se usa magic method 'find' con el @param  $id. Que lo que hace es buscar
|   ese id dentro de los productos.
*/
Route::get('products/{id}', function($id) {
    return Product::find($id);
});

/*
|   Existe un endpoint que es accesible por medio del metodo POST que es products.
|   Cuando envie la informacion por medio del metodo POST hacia la ruta products
|   va a recibir un "@param Request $Request' y va crear un producto con la informacion
|   del Request
*/
Route::post('products', function(Request $request) {
    return Product::create($request->all());
});

/*
|   Existe un endpoint que es accesible por medio del metodo PUT que es products
|   y se le envia {id}, ademas de recibir un "@param Request $Request'. Para luego de ello
|   Buscar el Producto que tiene ese id con 'findOrFail' que en el caso de que no lo encuentre
|   nos envia un mesaje de error.
|   Por ultimo en el caso de que si lo encuentre actualiza ese producto con la informacion del Request
*/
Route::put('products/{id}', function(Request $request, $id) {
    $product = Product::findOrFail($id);
    $product->update($request->all());
    return $product;
});

/*
|   Existe un endpoint que es accesible por medio del metodo DELETE que es products
|   y se le envia {id}, que lo que hace es recibir ese @param  $id para buscar el producto
|   para luego de ello proceder a eliminarlo.
*/
Route::delete('products/{id}', function($id) {
    Product::find($id)->delete();
    return 204;
});

