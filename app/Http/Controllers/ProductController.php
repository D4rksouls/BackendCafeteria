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
        $this->middleware('can:showAllProductsStore')->only('index');
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
            return response()->json([
                'status' => 0,
                'message' => 'El producto no existe',
                'code' => 400
            ]);
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

            return response()->json([
                'status' => 0,
                'message' => 'Datos no validos para la creacion del producto',
                'code' => 400
            ]);

            }

        $product = Product::create([
            'name_product' => $request->get('name_product'),
            'stock' => $request->get('stock'),
            'value' => $request->get('value'),
            'selectstock' => 1
        ]);

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
            'name_product'=> 'required|string|max:255',
            'stock' => 'required|integer',
            'value' => 'required|numeric',
        ]);

            if($validator->fails()){

            return response()->json([
                'status' => 0,
                'message' => 'Datos no validos para la actualizacion del producto',
                'code' => 400
            ]);

            }

            if(! Product::find($id)){
                return response()->json([
                    'status' => 0,
                    'message' => 'El producto no existe',
                    'code' => 400
                ]);
            }

        $product = Product::find($id);
        $product->update([
            'name_product' => $request->get('name_product'),
            'stock' => $request->get('stock'),
            'value' => $request->get('value'),
            'selectstock' => 1
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Producto actualizado correctamente',
            'code' => 200
        ]);

    }



    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    json(@param $product = null, @status: 204)
     */
    public function destroy($id){

        if(! Product::find($id)){
            return response()->json([
                'status' => 0,
                'message' => 'El producto no existe',
                'code' => 400
            ]);
        }

        Product::find($id)->delete();
        return response()->json([
            'status' => 0,
            'message' => 'El producto fue eliminado correctamente',
            'code' => 200
        ]);

    }
}
