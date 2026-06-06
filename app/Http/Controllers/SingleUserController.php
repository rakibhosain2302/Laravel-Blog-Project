<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SingleUserController extends Controller
{
    public function showUser()
    {
        $userInfo = Auth::user();
        return view('admin.pages.profile.profile', compact('userInfo'));
    }

    public function infoupdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = User::findOrFail($user->id);

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('uploads/profile', $fileName, 'public');
            $user->image = $imagePath;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $user->image,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function editProfile()
    {
        return view('admin.pages.profile.edit');
    }

    public function changePass(){
         return view('admin.pages.profile.changpassword');
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
