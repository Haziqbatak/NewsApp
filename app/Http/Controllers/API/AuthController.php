<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {
        try {
            //code...
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);


            // credential login
            $credentials = request(['email', 'password']);
            if (!Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ])) {
                return ResponseFormatter::error([
                    'message'  => 'Unautorized'
                ], 'Authentication Failed', 500);
            };

            $user = User::where('email', $credentials['email'])->first();
            if (!Hash::check($request->password, $user->password,  [])) {
                throw new \Exception('Invalid Credentials');
            };

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authentication succes', 200);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message'  => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
            //throw $th;
        }
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:225',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6'
            ]);

            if ($request->password != $request->confirm_password) {
                return ResponseFormatter::error([
                    'message' => 'Password not Macth'
                ], 'Authenthic Failed', 200);
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

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success(
            $token,
            'Token Revoked',
            'Token Revoked',
            200
        );
    }
    
    public function AllUsers(){
        $user = User::where('role', 'user')->get();
        return ResponseFormatter::success(
            $user, 'Data user berhasil diambil'
        );
    }

    public function updatePassword(Request $request){
        try {
            // validate
            $this->validate($request,[
                'old_password' => 'required',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6'
            ]);
    
            // get data user
            $user = Auth::user();
    
            // check old password
            if(!Hash::check($request->old_password, $user->password)){
                return ResponseFormatter::error([
                    'message' => 'Password Lama Tidak Sama'
                ], 'Authentication Failed', 401);
            }
    
            // check new password and confirm password
            if($request->new_password != $request->confirm_password){
                return ResponseFormatter::error([
                    'message' => 'Password Tidak Sesuai'
                ], 'Authentication Failed', 401);
            }
    
            // update password
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            return ResponseFormatter::success([
                'message' => 'Password Berhasil Diubah'
            ], 'Authenticated', 200);
    
        } catch (\Throwable $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function createProfile(Request $request)
    {
        try {
            $this->validate($request, [
                'first_name' => 'required|string|max:200',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // get usr login
            $user = auth()->user();

                //  upload gambar baru 
                $image = $request->file('image');
                $image->storeAs('public/profile', $image->hashName());

                // update image
                $user->profile()->create([
                    'first_name' => $request->first_name,
                    'image'      => $image->hashName()
                ]);
            
            return ResponseFormatter::success([
                'profile'=>$user->profile
            ], 
            'profile updated'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
}
