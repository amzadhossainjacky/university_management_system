<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;

class AuthController extends Controller
{
    //user login
    public function login(Request $request){
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                $data = array();
                $data['message'] = 'success';
                $data['token'] = $token;
                $data['user'] = $user;

                return response()->json($data, 200);
            }
        } catch (\Throwable $th) {
            
             return response([
                 'message' => $th->getMessage()
             ], 401);
        }

         return response([
                 'message' => "Invalid Mail Or Password"
             ], 401);

    }

    //user register
    public function register(Request $request){
        try {

            $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json($validator->errors());
            }

            $user= User::create([
            'name' =>$request->name,
            'role_id' =>2,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            ]);

            $token = $user->createToken('app')->accessToken;

            $data = array();
            $data['message'] = 'success';
            $data['token'] = $token;
            $data['user'] = $user;

            return response()->json($data, 200);


        } catch (\Throwable $th) {
            
             return response([
                 'message' => $th->getMessage()
             ], 401);
        }
    }

    //logout user
    public function logout(Request $request){
        try {
            $accessToken = Auth::user()->token();
            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update([
                    'revoked' => true
                ]);

            $accessToken->revoke();

            $data = array();
            $data['message'] = 'success';
            return response()->json($data, 200); 
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }

    //student info
    public function student(){
        return response([
            'data' => Auth::user()
        ], 200);
    }

    //admin info
    public function admin(){
        return response([
            'data' => Auth::user()
        ], 200);
    }

}
