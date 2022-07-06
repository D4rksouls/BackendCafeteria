<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct(){

        $this->middleware('can:DeleteProduct')->only('destroy');
        $this->middleware('can:updateProduct')->only('update');
        $this->middleware('can:createProduct')->only('create');
        $this->middleware('can:searchOneProduct')->only('show');
        $this->middleware('can:showAllProducts')->only('index');
    }
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

        if(! Product::find($id)){
            return response()->json(["message" => "Product does not exist"],400);
        }

        return Product::find($id);

    }



    /**
     * Almacenar un producto recién.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  json(@param $product, @status: 201)
     */
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name_product'=> 'required|string|max:255',
            'stock' => 'required|integer',
            'value' => 'required|numeric',

        ]);

            if($validator->fails()){

            return response()->json($validator->errors()->toJson(), 400);

            }

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }



    /**
     * Actualizar el recurso especificado en el almacén.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response  json(@param $product, @status: 200)
     */
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name_product'=> 'nullable|string|max:255',
            'stock' => 'nullable|integer',
            'value' => 'nullable|numeric',

        ]);

            if($validator->fails()){

            return response()->json($validator->errors()->toJson(), 400);

            }

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);

    }



    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    json(@param $product = null, @status: 204)
     */
    public function destroy($id){

        if(! Product::find($id)){
            return response()->json(["message" => "Product does not exist"],400);
        }

        Product::find($id)->delete();
        return response()->json(null, 204);

    }
}
