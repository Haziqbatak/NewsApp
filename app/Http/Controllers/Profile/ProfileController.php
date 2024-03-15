<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        $currentPasswordStatus = Hash::check(
            $request->current_password,
            auth()->user()->password
        );

        if ($currentPasswordStatus) {
            if ($request->password == $request->confirm_password) {
                $user = auth()->user();

                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('succes', 'update berhasil');
            }
        } else {
            return redirect()->back()->with('errors', 'Current Password is Cannot');
        }
    }

    public function allUser()
    {
        $title = 'all User';
        $user = User::where('role', 'user')->get();
        return view('home.user.index', compact(
            'title',
            'user'
        ));
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password = Hash::make('12345');
        $user->save();

        return redirect()->back()->with(
            'succes',
            'Password has been reset'
        );
    }

    public function createProfile()
    {
        $title = 'Create Profile';

        return view('home.profile.create', compact(
            'title'
        ));
    }

    public function storeProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $image = $request->file('image');
        $image->storeAs(
            'public/profile',
            $image->getClientOriginalName()
        );

        $user = auth()->user();

        $user->profile()->create([
            'first_name' => $request->first_name,
            'image' => $image->getClientOriginalName()
        ]);

        return redirect()->route('profile.index')->with('succes', 'Profile has been created');
    }

    public function editProfile()
    {
        $title = 'Edit Profile';
        $user = auth()->user();

        return view('home.profile.edit', compact(
            'title',
            'user'
        ));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:208000'
        ]);

        $user = auth()->user();

        if ($request->file('image') == '') {
            $user->profile->update([
                'first_name' => $request->first_name
            ]);

            return redirect()->route('profile.index')->with('success', 'Profile Has Been Updated');
        } else {
            Storage::delete('public/profile/' . basename($user->profile->image));

            $image = $request->file('image');
            $image->storeAs('public/profile', $image->getClientOriginalName());

            $user->profile->update([
                'first_name' => $request->first_name,
                'image' => $image->getClientOriginalName()
            ]);

            return redirect()->route('profile.index')->with('success', 'Profile Has benn Updated');
        }
    }
}
