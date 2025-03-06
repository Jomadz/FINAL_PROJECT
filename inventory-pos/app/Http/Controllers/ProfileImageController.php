<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
    public function updateProfile(Request $request)
{
    $request->validate([
        'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();

    if ($request->hasFile('profile_image')) {
        $imageName = time().'.'.$request->profile_image->extension();
        $request->profile_image->move(public_path('images'), $imageName);
        
        // Save the image path in the database
        $user->profile_image = '/images/' . $imageName;
        $user->save();
    }

    return redirect()->back()->with('success', 'Profile image updated successfully.');
}
}
