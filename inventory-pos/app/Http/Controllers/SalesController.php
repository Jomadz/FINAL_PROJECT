<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();
    
    // Fetch all users for the dropdown list
    $users = User::all();
    
        // Filter by product name if provided
        if ($request->has('product_name') && $request->product_name) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('product_name', 'like', '%' . $request->product_name . '%');
            });
        }
    // Filter by seller name if provided
    if ($request->has('seller_name') && $request->input('seller_name') !== '') {
        $query->where('seller_name', 'like', '%' . $request->input('seller_name') . '%');
    }
    
        // Filter by sale time if provided
        if ($request->has('sale_time') && $request->sale_time) {
            $query->whereDate('created_at', $request->sale_time);
        }
    
        // Paginate results (optional)
        $sales = $query->paginate(10);
    
        return view('sales.index', compact('sales', 'users'));
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
