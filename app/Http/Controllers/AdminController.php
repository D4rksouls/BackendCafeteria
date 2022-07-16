<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct(){

        $this->middleware('can:deleteAdminUser')->only('deleteAdmin');
        $this->middleware('can:updateAdminUser')->only('updateAdmin');
    }


    public function deleteAdmin($id){
        if(! User::find($id)){
            return response()->json([
                'status' => 0,
                'message' => 'Usuario No existe',
                'code' => 400
            ]);
        }

        User::destroy($id);

        return response()->json([
            'status' => 1,
            'message' => 'Usuario Eliminado Correctamente',
            'code' => 201
        ]);
    }

    public function updateAdmin($id,Request $request){
        $validator = Validator::make($request->all(), [
            'document'=> 'nullable|integer|digits_between:6,10',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|min:8|string|confirmed',
        ]);

            if($validator->fails()){

            return response()->json([
                'status' => 0,
                'message' => 'Los datos ingresados no son validos',
                'code' => 201
            ]);

            }

            if(! User::find($id)){
                return response()->json([
                    'status' => 0,
                    'message' => 'Usuario No existe',
                    'code' => 400
                ]);
            }

        $user = User::find($id);

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
            'code' => 201
        ]);
    }



}
