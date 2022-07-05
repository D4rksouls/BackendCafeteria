<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller{

    public function __construct(){

        $this->middleware('can:addContent')->only('Add');
        $this->middleware('can:showInvoices')->only('show');

    }

    public function Add($productid, Request $request){

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

    public function show(){
        $id = Auth::id();
        $sum = 0.00;
        $invoices = DB::select('select max(id) AS id from invoices where id_client = :id limit 1', ['id' => $id]);

        foreach($invoices as $invoice){
            $invoiceid = $invoice->id;
        }

        $contents = DB::select('select id_product, stock, value  from contents where id_invoice = :id', ['id' => $invoiceid]);
            //echo "    Producto      |stock|  valor unidad   | valor total \n";

            foreach ($contents as $content) {
            $product = Product::find($content->id_product);
            $sum = $content->value + $sum;
            $name = $product->name_product;

            echo response()->json(compact('name','content'));
            //echo $product->name_product. " | ". $content->stock. " | ".$product->value. " | ".$content->value ."\n";
        }
            return response()->json(compact('sum'));
        //var_dump( $sum, $id, $invoices, $invoiceid, $contents);
       // return response()->json(compact('','content', 'sum'));

    }
}
