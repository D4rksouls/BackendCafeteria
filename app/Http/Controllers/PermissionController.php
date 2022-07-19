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
     * @header jwt Token
     * @param  Request  $request (rol = 'rol para actualizar')
     *
     * Actualizacion del rol de usuario
     *
     * @return Response json(status, message, code)
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
        }else{
            return response()->json([
                'status' => 0,
                'message' => 'Rol ingresado Invalido',
                'code' => 400
            ]);
        }

        $user->save();
        $role = $user->getRoleNames();
        return response()->json([
            'status' => 1,
            'message' => 'Rol actualizado exitosamente',
            'code' => 200
        ]);

    }
}
