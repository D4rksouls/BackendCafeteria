<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){

        $products = DB::table('products')->get();

        return view('store', ['products' => $products]);
    }

    /**
     * Almacenar un recurso recién creado en el almacén.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string  $name
     * @param integer $i
     * @param float $value
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = new Product();
        $product->name_product = $_POST['name'];
        $product->stock = $_POST['i'];
        $product->value = $_POST['value'];
        $product->save();

        echo "Guardando";
        return redirect()->route('store');

    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Actualizar el recurso especificado en el almacén.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
