<?php

namespace App\Http\Controllers;

use App\Models\Product; // Make sure to import the Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
      $products = Product::all();
  
      return view('products.create' , compact('products')); // This will point to the view for adding a product
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_category' => 'nullable|string|max:100',
            'product_brand' => 'nullable|string|max:100',
            'product_sku' => 'required|string|unique:products,product_sku|max:100',
            'barcode' => 'nullable|string|max:100',
            'unit_of_measure' => 'nullable|string|max:50',
            'stock_quantity' => 'nullable|integer',
            'minimum_stock_level' => 'nullable|integer',
            'reorder_quantity' => 'nullable|integer',
            'cost_price' => 'nullable|numeric',
            'selling_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
            'product_status' => 'nullable|in:active,discontinued,out_of_stock',
            'expiry_date' => 'nullable|date',
            'added_by' => 'nullable|string|max:255',
        ]);

        // Create a new product instance
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_category = $request->product_category;
        $product->product_brand = $request->product_brand;
        $product->product_sku = $request->product_sku;
        $product->barcode = $request->barcode;
        $product->unit_of_measure = $request->unit_of_measure;
        $product->stock_quantity = $request->stock_quantity;
        $product->minimum_stock_level = $request->minimum_stock_level;
        $product->reorder_quantity = $request->reorder_quantity;
        $product->cost_price = $request->cost_price;
        $product->selling_price = $request->selling_price;
        $product->discount = $request->discount;
        $product->tax_rate = $request->tax_rate;
        $product->product_status = $request->product_status;
        $product->expiry_date = $request->expiry_date;
        $product->added_by = auth()->user()->username; // Assuming you have user authentication

        // Handle file upload for product image
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $product->product_image = $imagePath;
        }

        // Save the product to the database
        $product->save();

        // Redirect back with a success message
        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }

    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.create')->with('success', 'Product deleted successfully!');
}
}