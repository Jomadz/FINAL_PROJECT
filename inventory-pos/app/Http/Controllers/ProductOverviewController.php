<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductOverviewController extends Controller
{
    public function index(Request $request)
    {
        // ✅ Validate inputs
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'category' => 'nullable|string'
        ]);

        // ✅ Parse dates for consistency
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : null;
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : null;
        $category = $request->input('category');

        $salesQuery = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id');

        if ($startDate && $endDate) {
            $salesQuery->whereBetween('sales.created_at', [$startDate, $endDate]);
        }

        if ($category) {
            $salesQuery->where('products.product_category', $category);
        }

        $currentDate = Carbon::now();
        $expiryThreshold = Carbon::now()->addMonth()->toDateString();

        $expiringProducts = DB::table('products')
            ->whereBetween('expiry_date', [$currentDate->toDateString(), $expiryThreshold])
            ->get();

        // Top Products
        $topProducts = (clone $salesQuery)
            ->select('products.product_name', DB::raw('SUM(sales.quantity) as total_sold'))
            ->groupBy('products.product_name')
            ->orderByDesc('total_sold')
            ->limit(3)
            ->get();

        // Least Products
        $leastProducts = (clone $salesQuery)
            ->select('products.product_name', DB::raw('SUM(sales.quantity) as total_sold'))
            ->groupBy('products.product_name')
            ->orderBy('total_sold')
            ->limit(3)
            ->get();

        // Sales Trends
        $salesTrends = (clone $salesQuery)
            ->select(DB::raw('DATE(sales.created_at) as date'), DB::raw('SUM(sales.quantity) as total_sales'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Stock by Category
        $stockByCategory = DB::table('products')
        ->join('categories', 'products.product_category', '=', 'categories.id')
        ->when($category, function ($query) use ($category) {
            return $query->where('categories.name', $category); // filter by name instead of ID
        })
        ->select('categories.name as category_name', 'products.product_name', 'products.stock_quantity')
        ->get()
        ->groupBy('category_name');

        // Reorder Data
        $reorderData = DB::table('products')
        ->when($category, function ($query) use ($category) {
            return $query->where('product_category', $category);
        })
        ->whereColumn('stock_quantity', '<=', 'minimum_stock_level') // ✅ Only products at/below reorder level
        ->select('product_name', 'stock_quantity', 'minimum_stock_level')
        ->get();
    

        // Sales by Category
        $salesByCategory = (clone $salesQuery)
        ->join('categories', 'products.product_category', '=', 'categories.id')
        ->select('categories.name as category_name', DB::raw('SUM(sales.quantity) as total_sales'))
        ->groupBy('categories.name')
        ->get();
    

        // Get all categories for filter dropdown and remove null/empty values
        $categories = DB::table('categories') // Fetching categories from the 'categories' table
            ->pluck('name', 'id') // Plucking category names and ids
            ->filter()
            ->values();

        // Get the products along with their categories
        $products = Product::with('category')->get();

        return view('products.product-overview', compact(
            'topProducts',
            'leastProducts',
            'salesTrends',
            'stockByCategory',
            'reorderData',
            'salesByCategory',
            'categories',
            'startDate',
            'endDate',
            'category',
            'expiringProducts',
            'products' 
        ));
    }
}
