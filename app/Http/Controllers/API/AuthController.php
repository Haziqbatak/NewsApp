<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    public function login(Request $request){
        try {
            //code...
            $this->validate($request, [
                'email' =>'required|email',
                'password' => 'required'
            ]);


            // credential login
            $credentials = request(['email', 'password']);
            if(!Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ])){
                return ResponseFormatter::error([
                    'message'  => 'Unautorized'
                ], 'Authentication Failed', 500);
            };

            $user = User::where('email', $credentials['email'])->first();
            if(!Hash::check($request->password, $user->password,  [])) {
                throw new \Exception('Invalid Credentials');
            };

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authentication Failed', 200);

        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message'  => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
            //throw $th;
        }
    }
    
    public function register(Request $request){
        try {
            $this->validate($request,[
                'name' => 'required|string|max:225',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6'
            ]);

            if($request->password != $request->confirm_password){
                return ResponseFormatter::error([
                    'message' => 'Password not Macth'
                ], 'Authenthic Failed' ,200);
            }
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // get data akun
            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            // resspones
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated', 200);

            // che
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Someting error',
                'error' => $error
            ], 'Authenthic', 500);
        }

        
    }
}
