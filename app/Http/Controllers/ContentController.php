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

    }

    public function Add($productid, Request $request){

        $id = Auth::id();
        $invoiceid = DB::select('select max(id) AS id from invoices where id_client = :id limit 1', ['id' => $id]);

        /* $invoiceid =DB::table('invoices')
                 ->select(DB::raw('MAX(id) as id'))
                 ->where('id_client','=', $id)
                 ->limit(1)
                 ->get(); */



        //$invoiceid =  intval($invoiceid);


        $valueUnit = Product::find($productid)->value;

        $value = $valueUnit * $request->get('stock');


        $contents = Content::create([
            'id_invoice' => $invoiceid['id'],
            'id_product' => $productid,
            'stock' => $request->get('stock'),
            'value' => $value,
        ]);


        return response()->json(compact('invoiceid'));

    }


}
