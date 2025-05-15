<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\SellerActivity;


class SellerController extends Controller
{
    // Show the form to create a new seller (only accessible by admin)
    public function create()
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->withErrors('You are not authorized to create sellers.');
        }

        // Check if there are already 4 sellers
        $sellerCount = User::where('role', 'seller')->count();

        if ($sellerCount >= 4) {
            return redirect()->route('admin.dashboard')->withErrors('You can only create up to 4 sellers.');
        }

        return view('admin.create-seller');
    }

    // Store a new seller
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $seller = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'seller',
        ]);

        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'seller_created',
            'product_id' => null,
        ]);

        return redirect()->route('admin.sellers')->with('success', 'Seller created successfully.');
    }

    // Show the list of sellers
    public function index()
    {
        $sellers = User::where('role', 'seller')->get();
        return view('admin.all_sellers', compact('sellers'));
    }

    // Show the form to edit a seller
    public function edit($id)
    {
        $seller = User::findOrFail($id);
        return view('admin.edit-seller', compact('seller'));
    }

    // Update a seller's information
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

        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'seller_updated',
            'product_id' => null,
        ]);

        return redirect()->route('admin.sellers')->with('success', 'Seller updated successfully.');
    }

    // Delete a seller
    public function destroy($id)
    {
        $seller = User::findOrFail($id);
        $seller->delete();

        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'seller_deleted',
            'product_id' => null,
        ]);

        return redirect()->route('admin.sellers')->with('success', 'Seller deleted successfully.');
    }

    // Show all sellers
    public function allSellers()
    {
        $sellers = User::where('role', 'seller')->get(); 
        return view('admin.all_sellers', compact('sellers'));
    }

    // Show the admin dashboard
    public function dashboard()
    {
        $authenticatedUser   = Auth::user();

        if (!$authenticatedUser ) {
            return redirect()->route('login')->withErrors('You must be logged in to access the dashboard.');
        }

        return view('admin.dashboard', compact('authenticatedUser'));
    }

   

    
}