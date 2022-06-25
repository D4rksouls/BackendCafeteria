<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    public function authenticate(Request $request){

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
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);

    }


    public function getAuthenticatedUser(){

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

    public function logout(){

            Auth::logout();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully logged out',
             ]);
    }

}
