<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
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
        \Log::info("Products: ", $products->toArray()); // Log the product details
        // Pass the products to the view or return as JSON
        return view('pos.partials.product', compact('products'));
    }

    public function store(Request $request)
    {
        $cart = $request->input('cart');

        DB::beginTransaction();
        try {
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock_quantity < $item['qty']) {
                    return response()->json(['message' => "Insufficient stock for {$product->name}"], 400);
                }

                $product->stock_quantity -= $item['qty'];
                $product->save();

                // Optionally store sale details in a table (Sales, SaleItems, etc.)
            }

            DB::commit();
            return response()->json(['message' => 'Sale successful']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error processing sale'], 500);
        }
    }
}