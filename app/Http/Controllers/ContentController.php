<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller{

    public function __construct(){

        $this->middleware('can:addContent')->only('Add');

        $this->middleware('can:destroyContent')->only('destroy');
    }

    /**
     * Añade los productos al carrito
     *
     */
    public function Add(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name_product' => 'required|string',
            'stock' => 'required|integer',
            'value' =>'required|float',
            'selectstock' => 'required|integer',
        ]);
            if($validator->fails()){
                 return response()->json([
                    'status' => 0,
                    'message' => 'Stock Invalido para la compra',
                    'code' => 400
                ]);
            }

        $id = Auth::id();

        $invoices = DB::table('invoices')
                    ->where('id_client','=',$id)
                    ->max('id');

            if(!Product::find($request->get('id'))){
                return response()->json([
                    'status' => 0,
                    'message' => 'Producto no existe',
                    'code' => 400
                ]);
            }




            if($request->get('stock') > Product::find($productid)->stock){
                return response()->json([
                    'status' => 0,
                    'message' => "Available inventory for ". Product::find($productid)->stock ." products",
                    'code' => 400
                ]);
            }

        $value = $request->get('value') * $request->get('selectstock');


        $contents = Content::create([
            'id_invoice' => $invoices,
            'id_product' => $productid,
            'stock' => $request->get('selectstock'),
            'value' => $value,
        ]);

        return response()->json(compact('contents'));

    }


    /**
     * Elimina contenido del carrito
     *
     *
     */
    public function destroy($id){

        if(!Content::find($id)){
            return response()->json([
                'status' => 0,
                'message' => 'Producto no existe',
                'code' => 400
            ]);
        }

        Content::find($id)->delete();
        return response()->json([
            'status' => 0,
            'message' => 'El producto fue eliminado correctamente de la factura',
            'code' => 400
        ]);
    }
}
