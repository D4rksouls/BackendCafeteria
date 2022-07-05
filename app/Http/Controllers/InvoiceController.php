<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller
{
    public function __construct(){

        $this->middleware('can:createInvoices')->only('Factura');

    }

    public function Factura(Request $request){

        $id = Auth::id();

            $invoices = Invoice::create([
                'id_client' => $id,
                'all_value' => '',
            ]);

        //return response()->json(compact('id'));
    }
}
