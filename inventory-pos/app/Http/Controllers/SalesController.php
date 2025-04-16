<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
{
    // Fetch all sales records from the database
  
$sales = Sale::with('product')->get();

$sales = Sale::with('product')->paginate(20);


    // Pass sales data to the view
    return view('sales.index', compact('sales')); 
    
}

    public function processPayment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' =>  'required|string|in:cash,bank,mobile money',
        ]);

        $product = Product::find($request->product_id);

        if ($product->stock_quantity < $request->quantity) {
            return response()->json(['error' => 'Not enough stock available'], 400);
        }

        $total_price = $product->price * $request->quantity;

        // Reduce stock
        $product->stock_quantity -= $request->quantity;
        $product->save();

        // Create the sale
        $sale = Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
           'total_price' => $total_price,
            'payment_method' => $request->payment_method ?? 'Cash',
            'seller_name' => Auth::user()->name,
            'sale_time' => now(),
        ]);

        // Optional: receipt details
        return view('pos.receipt', [
            'sale' => $sale,
            'price_per_unit' => $product->selling_price,
        ]);
    }

    public function recordSale(Request $request)
    {
        $validatedData = $request->validate([
            'cart' => 'required|array',
            'paymentMethod' => 'required|string|in:cash,bank,mobile money',
        ]);

        // Loop through the cart and save each sale as its own record
        foreach ($validatedData['cart'] as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                continue; // Skip if product not found
            }
            if ($product->stock_quantity < $item['qty']) {
                return response()->json(['error' => "Insufficient stock for {$product->name}"], 400);
            }

            // Reduce stock
            $product->stock_quantity -= $item['qty'];
            $product->save();

            // Calculate total price
            $total_price = $item['totalIncl']; // Ensure this is calculated correctly in the cart


            // Save each item as a separate sale
            Sale::create([
                'product_id' => $product->id,
                'quantity' => $item['qty'],
                'total_price' => $item['totalIncl'],
                'payment_method' => $validatedData['paymentMethod'],
                'seller_name' => Auth::user()->name,
                'sale_time' => now(),
            ]);
        }

        return response()->json(['success' => true]);
    }
}
