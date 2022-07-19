<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function __construct(){

        $this->middleware('can:user')->only('getUser');
        $this->middleware('can:updateUser')->only('update');
        $this->middleware('can:showAllUser')->only('index');
        $this->middleware('can:deleteMyUser')->only('delete');
    }


    /**
     * @header jwt token
     *
     * Devuelve el usuario que esta logeado
     *
     * return json(user)
    */
    public function getUser(){


        $user = JWTAuth::parseToken()->authenticate();

        return response()->json(compact('user'));

    }

    /**
     * @header jwt token
     *
     * Elimina el usuario que esta logeado
     *
     * @return void
     */
    public function delete(){
        $id = Auth::id();

        User::destroy($id);

        return response()->json([
            'status' => 1,
            'message' => 'Usuario eliminado exitosamente',
            'code' => 200
        ]);
    }


    /**
     * @header jwt Token
     * @param Request $request
     *
     * Actualizacion de usuario logeado
     *
     * @return Response json(status, message, code)
     */
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'document'=> 'nullable|integer|digits_between:6,10',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|min:8|string|confirmed',
        ]);

            if($validator->fails()){

            return response()->json([
                'status' => 1,
                'message' => 'Datos no validos para la actualizacion',
                'code' => 400
            ]);

            }
        $user = Auth::user();

        if ( ! $request->get('document') == ''){

            $user->document = $request->get('document');

        }

        if ( ! $request->get('name') == ''){

            $user->name = $request->get('name');

        }

        if ( ! $request->get('email') == ''){

        $user->email = $request->get('email');

        }

        if ( ! $request->get('password') == ''){

            $user->password = Hash::make($request->get('password'));

        }

        $user->save();

        return response()->json([
            'status' => 1,
            'message' => 'Usuario actualizado correctamente',
            'code' => 200
        ]);

    }
    /**
    * @header jwt Token
    *
    * Muestra todos los Usuarios
    *
    * @return Users<array>
    */
    public function index(){

        return User::all();

    }
}
