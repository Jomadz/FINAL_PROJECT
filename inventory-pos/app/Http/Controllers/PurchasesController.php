<?php

namespace App\Http\Controllers;
use App\Models\Purchases;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    public function index()
{
    $purchases = Purchases::with('product')->latest()->get();
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

    Purchases::create($request->all());

    return redirect()->route('purchases.index')->with('success', 'Purchase recorded successfully.');
}

}
