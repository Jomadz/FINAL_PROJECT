<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user(); // Get the currently authenticated user

        // Pass the user data to the view
        return view('admin.dashboard', compact('user')); // Ensure this view exists
    } 
}