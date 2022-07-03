<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class SessionController extends Controller
{
    public function __construct(){

        $this->middleware('can:logoutUser')->only('logout');

    }

        /**
    * @param  \Illuminate\Http\Request  $request
    * @param $credentials para luego validarse si en la base hay un usuario que cumpla con esas credenciales
    *        Si se logra autentificar nos devuelte el token
    *        Si no, devuelve el estatus
    *
    * @return Response  json(token) o status
    */
    public function login(Request $request){

            $credentials = $request->only('email', 'password');
            try {
                    if (! $token = JWTAuth::attempt($credentials)) {

                        return response()->json(['error' => 'invalid_credentials'], 400);

                    }
                } catch (JWTException $e) {

                    return response()->json(['error' => 'could_not_create_token'], 500);

                }

            return response()->json(compact('token'));
    }


    /**
     * @param  \Illuminate\Http\Request  $request
     * Process     @param $validator =Validator::make($request->all()  Valida que los datos recibidos si cumplan  // si la validacion falla devuelve un 400
     * Process     @param $user = User::create  Crea el Usuario y encripta la Password con el Hash
     * Process     @param $token = JWTAuth::fromUser($user); Obtenemos el token correspondiente a ese usuario creado
     *
     * @return Response json(compact('user','token'),201)
     */

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'document'=>'required|integer|min:10',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

            if($validator->fails()){

            return response()->json($validator->errors()->toJson(), 400);

            }

        $user = User::create([
            'document' => $request->get('document'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ])->assignRole('custumer');

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);

    }


    /**
     * Invalida el token JWT del usuario para finalizar la sesion
     * En el caso de que salga error se le indica al usuario try again
     *
     * @return response ->json();
     */
    public function logout(){

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
              'status' => 'success',
              'message' => 'You have successfully logged out.'
            ]);
        } catch (JWTException $e) {
              JWTAuth::unsetToken();
              // algo salió mal tratando de validar un token inválido
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to logout, please try again.'
                ]);
            }
    }
}