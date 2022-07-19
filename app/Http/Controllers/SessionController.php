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
    * @return Response  token, status, message, code.
    */
    public function login(Request $request){

            $credentials = $request->only('email', 'password');
            try {
                    if (! $token = JWTAuth::attempt($credentials)) {

                        return response()->json([
                            'status' => 0,
                            'message' => 'Credenciales invalidas',
                            'code' => 400
                        ]);

                    }
                } catch (JWTException $e) {

                    return response()->json([
                        'status' => 0,
                        'message' => 'No se pudo crear el token de acceso',
                        'code' => 400
                    ]);

                }
                $token = JWTAuth::attempt($credentials);
                $user = User::find(Auth::id());
                $rol = $user->getRoleNames();

            return response()->json([
                'data' => $token,
                'rol' => $rol,
                'status' => 1,
                'message' => 'Inicio de sesion exitoso',
                'code' => 200
            ]);
    }


    /**
     * @param  \Illuminate\Http\Request  $request (document, name, email, password, password_confirmation)
     * Process      $validator =Validator::make($request->all()  Valida que los datos recibidos si cumplan  // si la validacion falla devuelve un 400
     * Process      $user = User::create  Crea el Usuario y encripta la Password con el Hash

     *
     * @return Response json(statu, message, code)
     */

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'document'=>'required|integer|min:10',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

            if($validator->fails()){

            return response()->json([
                'status' => 0,
                'message' => 'El correo ya existe',
                'code' => 409
            ]);

            }

        $user = User::create([
            'document' => $request->get('document'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ])->assignRole('custumer');


        return response()->json([
            'status' => 1,
            'message' => 'Usuario registrado correctamente',
            'code' => 200
        ]);

    }


    /**
     * @header  token
     *
     * Invalida el token JWT del usuario para finalizar la sesion
     * En el caso de que salga error se le indica al usuario try again
     *
     * @return response json(status,message,code)
     */
    public function logout(){

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'status' => 1,
                'message' => 'Cierre de session exitoso',
                'code' => 200
            ]);
        } catch (JWTException $e) {
              JWTAuth::unsetToken();

                return response()->json([
                    'status' => 0,
                    'message' => 'Ocurrio un error, vuelve a intentar',
                    'code' => 500
                ]);
            }
    }
}
