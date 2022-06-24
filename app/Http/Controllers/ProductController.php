<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Muestra todos los productos
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return Product::all();

    }



    /**
     * Mostrar el producto especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        return Product::find($id);

    }



    /**
     * Almacenar un producto recién.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  json(@param $product, @status: 201)
     */
    public function store(Request $request){

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }



    /**
     * Actualizar el recurso especificado en el almacén.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);

    }



    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        Product::find($id)->delete();
        return response()->json(null, 204);

    }
}
