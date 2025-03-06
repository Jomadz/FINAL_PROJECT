<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    // Show the form to create a new seller (only accessible by admin)
    public function create()
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            // Redirect to admin dashboard if not an admin
            return redirect()->route('dashboard')->withErrors('You are not authorized to create sellers.');
        }

        // Check if there are already 4 sellers
        $sellerCount = User::where('role', 'seller')->count();

        if ($sellerCount >= 4) {
            // Redirect to admin dashboard if there are already 4 sellers
            return redirect()->route('dashboard')->withErrors('You can only create up to 4 sellers.');
        }

        // Proceed to the seller creation form
        return view('admin.create-seller');
    }

    // Store a new seller
    public function store(Request $request)
    {
        // Validate the seller creation form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new seller
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'seller',  // Assign role as 'seller'
        ]);

        // Redirect to the admin dashboard after creating the seller
        return redirect()->route('dashboard')->with('success', 'Seller created successfully.');
    }

    // Show the admin dashboard (same view for admin and seller)
    public function dashboard()
    {
        // Get the authenticated user's role
        $userRole = Auth::user()->role;

        // Return the admin.dashboard view with the user's role
        return view('admin.dashboard', compact('user','userRole'));
    }
}
