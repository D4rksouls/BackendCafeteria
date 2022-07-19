<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\Product;


class InvoiceController extends Controller
{
    public function __construct(){

        $this->middleware('can:buyInvoices')->only('Buy');

    }

/**
 * @header jwt Token
 * @param  $request (trae un array de productos comprados)
 * Le resta el stock que el cliente se llevo dentro de la base de datos
 *
 * return response json(status,message,code)
 */
    public function Buy(Request $request){

            $contents = $request->all();


            for($i=0 ; $i < sizeof($contents); $i++){
                $content = $contents[$i];
                $product = Product::find($content['id']);
                $product->stock = $product->stock - $content['selectstock'];
                $product->save();
            };



        return response()->json([
            'status' => 1,
            'message' => 'Felicidades por su compra',
            'code' => 200
        ]);
    }


}
