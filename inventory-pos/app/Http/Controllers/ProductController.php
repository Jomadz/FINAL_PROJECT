<?php

namespace App\Http\Controllers;

use App\Models\Product; // Make sure to import the Product model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SellerActivity; // Import the SellerActivity model

class ProductController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('products.create', compact('products')); // This will point to the view for adding a product
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'product_name' => 'required|string|max:255|unique:products,product_name',
            'product_description' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_category' => 'nullable|string|max:100',
            'product_brand' => 'nullable|string|max:100',
            'product_sku' => 'required|string|unique:products,product_sku|max:100',
            'barcode' => 'nullable|string|max:100',
            'unit_of_measure' => 'nullable|string|max:50',
            'stock_quantity' => 'nullable|integer|min:0',
            'minimum_stock_level' => 'nullable|integer|min:0',
            'reorder_quantity' => 'nullable|integer|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0',
            'product_status' => 'nullable|in:active,discontinued,out_of_stock',
            'expiry_date' => 'nullable|date',
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
        $product->added_by = Auth::id(); // Assuming you have user authentication
        $product->last_updated_by = Auth::id();

        // Handle file upload for product image
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $product->product_image = $imagePath;
        }

        // Save the product to the database
        $product->save();

        // Log the product creation activity
        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'product_added',
            'product_id' => $product->id, // Associate the product ID
        ]);

        // Redirect back with a success message
        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }

    public function index()
    {
        $products = Product::with(['creator', 'updater'])->get();
        return view('products.index', compact('products')); // Return the view with products
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Fetch the product by ID
        return view('products.edit', compact('product')); // Return the edit view with the product
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'product_name' => 'required|string|max:255|unique:products,product_name,' . $id,
            'product_description' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_category' => 'nullable|string|max:100',
            'product_brand' => 'nullable|string|max:100',
            'product_sku' => 'required|string|unique:products,product_sku,' . $id . '|max:100',
            'barcode' => 'nullable|string|max:100',
            'unit_of_measure' => 'nullable|string|max:50',
            'stock_quantity' => 'nullable|integer|min:0',
            'minimum_stock_level' => 'nullable|integer|min:0',
            'reorder_quantity' => 'nullable|integer|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0',
            'product_status' => 'nullable|in:active,discontinued,out_of_stock',
            'expiry_date' => 'nullable|date',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update the product with the new data
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
        $product->last_updated_by = Auth::id(); 

        // Handle file upload for product image
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $product->product_image = $imagePath;
        }

        // Save the updated product to the database
        $product->save();

        // Log the product update activity
        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'product_updated',
            'product_id' => $product->id, // Associate the product ID
        ]);

        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);
        
        // Log the product deletion activity
        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'product_deleted',
            'product_id' => $product->id, // Associate the product ID
        ]);

        // Delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}