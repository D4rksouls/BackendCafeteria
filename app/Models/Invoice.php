<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /*
    |   Los campos all_value
    |   NO pueden ser llenado por peticiones post de API
    |   o por medio de fomularios
    */
    protected $guarded =[
        'all_value',
        ];
}
