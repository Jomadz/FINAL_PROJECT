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
            return redirect()->route('admin.dashboard')->withErrors('You are not authorized to create sellers.');
        }

        // Check if there are already 4 sellers
        $sellerCount = User::where('role', 'seller')->count();

        if ($sellerCount >= 4) {
            // Redirect to admin dashboard if there are already 4 sellers
            return redirect()->route('admin.dashboard')->withErrors('You can only create up to 4 sellers.');
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
        return redirect()->route('admin.sellers')->with('success', 'Seller created successfully.');
    }

    // Show the list of sellers
    public function index()
    {
        // Retrieve all sellers
        $sellers = User::where('role', 'seller')->get();

        // Return the view with the list of sellers
        return view('admin.sellers.index', compact('sellers'));
    }

    // Show the form to edit a seller
    public function edit($id)
    {
        // Find the seller by ID
        $seller = User::findOrFail($id);

        // Return the edit view with the seller data
        return view('admin.sellers.edit', compact('seller'));
    }

    // Update a seller's information
    public function update(Request $request, $id)
    {
        // Validate the seller update form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the seller by ID
        $seller = User::findOrFail($id);
        $seller->name = $request->name;
        $seller->email = $request->email;

        // Update password if provided
        if ($request->filled('password')) {
            $seller->password = bcrypt($request->password);
        }

        // Save the updated seller
        $seller->save();

        return redirect()->route('admin.sellers')->with('success', 'Seller updated successfully.');
    }

    // Delete a seller
    public function destroy($id)
    {
        // Find the seller by ID and delete
        $seller = User::findOrFail($id);
        $seller->delete();

        return redirect()->route('admin.sellers')->with('success', 'Seller deleted successfully.');
    }

    // Show the admin dashboard
    public function dashboard()
    {
        $authenticatedUser  = Auth::user();

        // Check if the user is authenticated
        if (!$authenticatedUser ) {
            return redirect()->route('login')->withErrors('You must be logged in to access the dashboard.');
        }

        // Return the view and pass the authenticated user data
        return view('admin.dashboard', compact('authenticatedUser'));
    }
}