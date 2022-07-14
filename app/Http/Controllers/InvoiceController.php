<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\Content;
use App\Models\Product;


class InvoiceController extends Controller
{
    public function __construct(){

        $this->middleware('can:createInvoices')->only('Factura');
        $this->middleware('can:buyInvoices')->only('Buy');

    }
/**
 *
 * Crea la factura para poder añadir los productos
 *
 *
 */
    public function Factura(){

        $id = Auth::id();

            $invoices = Invoice::create([
                'id_client' => $id,
                'all_value' => '',
            ]);

        return response()->json(["status"=>"invoice created correctly"],201);
    }
/**
 * Le resta el stock que el cliente se llevo dentro de la base de datos y
 * actualiza el valor total de la factura
 *
 */
    public function Buy(){
        $id = Auth::id();
        $invoices = DB::select('select max(id) AS id from invoices where id_client = :id limit 1', ['id' => $id]);

        foreach($invoices as $invoice){
            $invoiceid= $invoice->id;
        }

        $contents = DB::select('select id_product, stock  from contents where id_invoice = :id', ['id' => $invoiceid]);
        $values = DB::select('select sum(value) as allvalue  from contents where id_invoice = :id', ['id' => $invoiceid]);

        foreach($contents as $content){
            $product = Product::find($content->id_product);
            $product->stock = $product->stock - $content->stock;
            $product->save();
        }


        foreach($values as $value){
            $invoices = Invoice::find($invoiceid);
            $invoices->all_value = $value->allvalue;
            $invoices->save();
        }
        return response()->json(["message" => "Congratulations on your purchase"]);
    }


}
