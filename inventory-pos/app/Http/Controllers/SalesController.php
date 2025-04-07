<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    // Show the form for creating a sale
    public function create()
    {
        $products = Product::all(); // Retrieve all products to show in the dropdown
        return view('sales.create', compact('products'));
    }

    // Store a new sale
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        // Find the product
        $product = Product::findOrFail($request->product_id);

        // Check if there is enough stock
        if ($product->stock_quantity < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Not enough stock available.']);
        }

        // Calculate total price
        $totalPrice = $product->selling_price * $request->quantity;

        // Create a new sale record with the logged-in user's name
        Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'seller_name' => Auth::user()->name, // Automatically use the logged-in user's name
            'sale_time' => now(), // Store the current time
        ]);

        // Update product stock
        $product->stock_quantity -= $request->quantity;
        $product->save();

        // Redirect back with a success message
        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully!');
    }

    // Show all sales of the logged-in user
    public function index()
    {
        $sales = Sale::where('seller_name', Auth::user()->name)->get(); // Get sales for the logged-in user
        return view('sales.index', compact('sales'));
    }   
}