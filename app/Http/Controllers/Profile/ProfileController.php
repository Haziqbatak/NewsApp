<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $title = 'profile';
        return view('home.profile.index', compact('title'));
    }

    public function changePassword()
    {
        $title = 'changePassword';

        return view('home.profile.changePassword', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        $currentPasswordStatus = Hash::check(
            $request->current_password, auth()->user()->password
        );

        if($currentPasswordStatus){
            if($request->password == $request->confirm_password){
                $user = auth()->user();

                $user->password = Hash::make($request->password);
                $user->save;
                return redirect()->back()->with('succes','update berhasil');
            }
        }else{
            return redirect()->back()->with('errors', 'Current Password is Cannot');
        }
    }

    public function allUser(){
        $title = 'all User';
        return view('home.user.index' , compact('title'));
    }
}
