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
         // Retrieve all sellers
    $sellers = User::where('role', 'seller')->get();


        // Proceed to the seller creation form
        return view('admin.create-seller', compact('sellers') );
    }

    // Store a new seller
    public function store(Request $request)
    {
        // Validate the seller creation form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'seller',  // Assign role as 'seller'

        ]);

        // Create the new seller
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'seller',  // Assign role as 'seller'
        ]);

        // Redirect to the admin dashboard after creating the seller
        return redirect()->route('admin.dashboard')->with('success', 'Seller created successfully.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $seller = User::findOrFail($id);
    $seller->name = $request->name;
    $seller->email = $request->email;

    if ($request->filled('password')) {
        $seller->password = bcrypt($request->password);
    }

    $seller->save();

    return redirect()->route('admin.sellers')->with('success', 'Seller updated successfully.');
}

    // Show the admin dashboard (same view for admin and seller)
    public function dashboard()
    {
        $authenticatedUser = Auth::user();

        // Check if the user is authenticated (optional, but good for validation)
        if (!$authenticatedUser) {
            return redirect()->route('login')->withErrors('You must be logged in to access the dashboard.');
        }

        // You can pass other data like user role or any other details you need
        $userRole = $authenticatedUser->role;

        // Return the view and pass the authenticated user and userRole data
        return view('admin.dashboard', compact('authenticatedUser', 'userRole'));
    }
}
