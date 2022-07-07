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
        $this->middleware('can:showContent')->only('show');
        $this->middleware('can:destroyContent')->only('destroy');
    }

    /**
     * Añade los productos al carrito
     *
     */
    public function Add($productid, Request $request){
        $validator = Validator::make($request->all(), [
            'stock' => 'required|integer',
        ]);
            if($validator->fails()){
                 return response()->json($validator->errors()->toJson(), 400);
            }

        $id = Auth::id();
        $invoices = DB::select('select max(id) AS id from invoices where id_client = :id limit 1', ['id' => $id]);

            if(!Product::find($productid)){
                return response()->json(["message" => "Product does not exist"],400);
            }

        $valueUnit = Product::find($productid)->value;


            if($request->get('stock') > Product::find($productid)->stock){
                return response()->json(["message" => "Available inventory for ". Product::find($productid)->stock ." products"],400);
            }

        $value = $valueUnit * $request->get('stock');

        foreach($invoices as $invoice){
            $invoiceid= $invoice->id;
        }

        $contents = Content::create([
            'id_invoice' => $invoiceid,
            'id_product' => $productid,
            'stock' => $request->get('stock'),
            'value' => $value,
        ]);

        //var_dump( $invoiceid);
        return response()->json(compact('contents'));

    }

    /**
     * Muerstra los productos que hay en el carrito
     *
     *
     */
    public function show(){
        $id = Auth::id();
        $sum = 0.00;
        $invoices = DB::select('select max(id) AS id from invoices where id_client = :id limit 1', ['id' => $id]);

        foreach($invoices as $invoice){
            $invoiceid = $invoice->id;
        }

        $contents = DB::select('select id_product, stock, value  from contents where id_invoice = :id', ['id' => $invoiceid]);


            foreach ($contents as $content) {
            $product = Product::find($content->id_product);
            $sum = $content->value + $sum;
            $name = $product->name_product;

            echo response()->json(compact('name','content'));

        }
            return response()->json(compact('sum'));


    }

    /**
     * Elimina contenido del carrito
     *
     *
     */
    public function destroy($id){

        if(!Content::find($id)){
            return response()->json(["message" => "Content  does not exist"],400);
        }

        Content::find($id)->delete();
        return response()->json(["message" => "Content successfully disposed"]);

    }
}
