<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request , User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'profile' => 'nullable|image|max:2048', // Max size for the image is 2MB
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile')) {
            $user->clearMediaCollection('media/users');

            $user->addMediaFromRequest('profile')->toMediaCollection('media/users', 'media_users');
        }

        $user->save();

        return redirect()->back()->with('status', 'Profile updated successfully.');
    }
}
