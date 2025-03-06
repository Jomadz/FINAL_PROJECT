<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard
    public function dashboard()
    {
        // Retrieve the authenticated user
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
