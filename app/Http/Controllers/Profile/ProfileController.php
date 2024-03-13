<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
