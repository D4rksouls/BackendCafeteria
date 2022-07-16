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

        return response()->json([
            'status' => 1,
            'message' => 'Factura creada correctamente',
            'code' => 201
        ]);
    }
/**
 * Le resta el stock que el cliente se llevo dentro de la base de datos y
 * actualiza el valor total de la factura
 *
 */
    public function Buy(){
        $id = Auth::id();
        $invoiceid = DB::table('invoices')
                    ->where('id_client','=',$id)
                    ->max('id');

        $contents =  DB::table('contents')
                        ->select('id_product', 'stock')
                        ->where('id_invoice','=',$invoiceid)
                        ->get();


        $value = DB::table('contents')
                        ->where('id_invoice','=',$invoiceid)
                        ->sum('value');


        foreach($contents as $content){
            $product = Product::find($content->id_product);
            $product->stock = $product->stock - $content->stock;
            $product->save();

            var_dump($product->stock);
        }

            $invoices = Invoice::find($invoiceid);
            $invoices->all_value = $value;
            $invoices->save();

            var_dump($invoices->all_value);

        return response()->json([
            'status' => 1,
            'message' => 'Felicidades por su compra',
            'code' => 200
        ]);
    }


}
