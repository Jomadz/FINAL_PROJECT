<?php

namespace App\Http\Controllers;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Expense;

class PurchasesController extends Controller
{
    public function index()
{
    $purchases = Purchase::with('product')
    ->orderBy('created_at', 'desc')
        ->paginate(20); 
    return view('purchases.index', compact('purchases'));
}

public function create()
{
    $products = Product::all();
    return view('purchases.create', compact('products'));
}

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'cost_price' => 'required|numeric|min:0'
    ]);

    // Update the product stock
    $product = Product::find($request->product_id);
    $product->stock_quantity += $request->quantity;
    $product->cost_price = $request->cost_price; // Optional
    $product->save();

    $purchase = Purchase::create([
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'cost_price' => $request->cost_price,
    ]);

    Expense::create([
        'product_id' => $purchase->product_id,
        'amount' => $purchase->cost_price * $purchase->quantity, // expense based on price * quantity
        'source' => 'purchase',        // Indicating this expense is related to a purchase
        'user_id' => auth()->id(),     // Logged-in user
    ]);

    return redirect()->route('purchases.index')->with('success', 'Purchase recorded successfully.');
}

}
