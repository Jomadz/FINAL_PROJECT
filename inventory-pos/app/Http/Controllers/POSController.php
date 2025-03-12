<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pos.index', compact('products'));
    }
}
