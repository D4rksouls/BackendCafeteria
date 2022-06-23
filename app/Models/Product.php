<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /*
    |   Los campos name_product, stock, value
    |   pueden ser llenado por peticiones post de API
    |   o por medio de fomularios
    */
    protected $fillable =[
        'name_product',
         'stock',
         'value',
        ];

    /*
    |   El campos id_product
    |   NO pueden ser llenado por peticiones post de API
    |   o por medio de fomularios
    */

    protected $guarded = [
        'id_product',
    ];
}
