<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function showReceipt($id)
    {
        $sale = Sale::findOrFail($id);
        return view('pos.receipt', compact('sale'));
    }

    public function index()
    {
        $categories = Category::all();
        return view('pos.index', compact('categories'));
    }

    public function showProductsByCategory($categoryId)
    {
        \Log::info("Fetching products for category ID: {$categoryId}");
        $category = Category::findOrFail($categoryId);
        $products = $category->products;

        \Log::info("Number of products found: " . $products->count());
        \Log::info("Products: ", $products->toArray());

        return view('pos.partials.product', compact('products'));
    }
    
    public function submitSale(Request $request)
{
    // validate and store
    return response()->json(['success' => true]);
}


    public function store(Request $request)
    {
        \Log::info('Store method called'); // Added this line to see my sales store
        \Log::info('Cart data:', $request->input('cart'));



        // Validate the incoming request
        $request->validate([
            'cart' => 'required|array',
            'payment_method' => 'required|string|in:cash,bank,mobile money',
        ]);


        $cart = $request->input('cart');
        $sales = []; // Initialize the array for sales
        $totalAmount = 0;

        DB::beginTransaction();
        try {
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['product_id']);
    
                if ($product->stock_quantity < $item['qty']) {
                    return response()->json(['message' => "Insufficient stock for {$product->name}"], 400);
                }
                // Reduce stock
                $product->stock_quantity -= $item['qty'];
                $product->save();

               // Calculate total price
            $total_price = $product->selling_price * $item['qty'];
            $totalAmount += $total_price;

                // Create a sale record for each item
                $sale = Sale::create([
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'total_price' => $total_price,
                    'payment_method' => $request->input('payment_method'),
                    'seller_name' => Auth::user()->name,
                    'sale_time' => now(),
                ]);

                $sales[] = $sale; // Store each sale record
            }

           

            DB::commit();

            // Return a view to show all sales on the receipt
            return view('pos.receipt-multiple', ['sales' => $sales]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error processing sale: ' . $e->getMessage()], 500);
        }
       
    }
}