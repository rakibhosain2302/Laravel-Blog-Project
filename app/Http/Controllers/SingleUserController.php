<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SingleUserController extends Controller
{
    public function showUser()
    {
        $userInfo = Auth::user();
        return view('admin.pages.profile', compact('userInfo'));
    }

    public function infoupdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user = User::findOrFail($user->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function changePass(){
         return view('admin.pages.changpassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]); 

        return back()->with('success', 'Password changed successfully.');
    }

}
