<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Admin;


class AdminController extends Controller
{
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
                if (! $token = auth()->guard('admins')->JWTAuth::attempt($credentials)) {

                    return response()->json(['error' => 'invalid_credentials'], 400);

                }
            } catch (JWTException $e) {

                return response()->json(['error' => 'could_not_create_token'], 500);

            }

        return response()->json(compact('token'));
        }
}
