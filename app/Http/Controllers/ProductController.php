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
     * @header jwt Token
     *
     * Muestra todos los productos
     *
     * @return Response Products<array>
     */
    public function index(){

        return Product::all();

    }



    /**
     * @header jwt Token
     * @param  int  $id
     *
     * Mostrar el producto especificado.
     *
     * @return Response producto buscado
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
     * @header jwt Token
     * @param  \Illuminate\Http\Request  $request
     *
     * Almacenar un producto recién.
     *
     * @return \Illuminate\Http\Response  json(status, message, code)
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

        return response()->json([
            'status' => 1,
            'message' => 'Producto Creado exitosamente',
            'code' => 201
        ]);
    }



    /**
     * @header jwt Token
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * Actualizar el recurso especificado en el almacén  segun el id del producto.
     *
     * @return Response  json(status, message, code)
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
     * @header jwt Token
     * @param  int  $id
     *
     * Eliminar el recurso especificado del almacenamiento segun el id.
     *
     * @return Response   json(status, message, code)
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
            'status' => 1,
            'message' => 'El producto fue eliminado correctamente',
            'code' => 200
        ]);

    }
}
