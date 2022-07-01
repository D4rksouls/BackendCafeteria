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
        $this->middleware('can:deleteUser')->only('delete');
        $this->middleware('can:showAllUser')->only('index');
    }


    /**
     * @param User $user
     *  Process trata de validar el token del usuario. si este no lo encuentra da json(['user_not_found'], 404) o
     *      nos devuelve el error correspondiente
     *  En el caso de que si logre autenticarlo devuelve el usuario
     *
     * @return Response json(compact('user'))
     */
    public function getUser(){

        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
            }
        } catch (JWTException $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                return response()->json(['status' => 'Token is Invalid']);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){

                return response()->json(['status' => 'Token is Expired']);

            }else{

                return response()->json(['status' => 'Authorization Token not found']);

            }

        }
        return response()->json(compact('user'));

    }

    /**
     * Eliminar Usuario
     *
     * @param $id
     * @return void response()->json([])
     */
    public function delete($id){
        User::destroy($id);

        return response()->json(['status' => 'User successfully removed']);
    }

    /**
     * Recibe el request y segun los datos de este actualiza el usuario
     *
     *
     * @param Resquest $request
     * @return void response()->json([])
     */

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'document'=> 'nullable|integer|digits_between:6,10',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|min:8|string|confirmed',
        ]);

            if($validator->fails()){

            return response()->json($validator->errors()->toJson(), 400);

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

        return response()->json(['status' => 'User successfully updated']);

    }
    /**
    * Muestra todos los Usuarios
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){

        return User::all();

    }
}
