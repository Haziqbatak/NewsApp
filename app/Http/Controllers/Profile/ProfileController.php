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
        $request->validate($request,[
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        $currentPasswordStatus = Hash::check(
            $request->current_password, auth()->user()->password
        );

        if($currentPasswordStatus){
            if($request->password == $request->confirm_password){
                
            }
        }else{
            return redirect()->back()->with('error', 'Current Password is Cannot');
        }
    }
}
