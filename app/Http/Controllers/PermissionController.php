<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{

    public function __construct(){
        $this->middleware('can:updateRole')->only('roleUpdate');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updaterole(Request $request, $id){


        $user = User::findOrFail($id);
        $valor = $request->rol;

        if($valor == "admin"){

            $user->syncRoles(['admin']);

        }else if($valor == "seller"){

            $user->syncRoles(['seller']);

        }else if($valor == "custumer"){

            $user->syncRoles(['custumer']);
        }

        $user->save();
        $role = $user->getRoleNames();
        return response()->json(compact('user','role'), 201);

    }
}
