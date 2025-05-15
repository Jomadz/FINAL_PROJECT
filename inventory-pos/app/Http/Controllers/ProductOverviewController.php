<?php 

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;

class ProductOverviewController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $categoryId = $request->input('category');

        // Base query for sales
        $salesQuery = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('categories', 'products.product_category', '=', 'categories.id');

        // Apply date filters if provided
        if ($startDate) {
            $salesQuery->whereDate('sales.created_at', '>=', $startDate);
        }

        if ($endDate) {
            $salesQuery->whereDate('sales.created_at', '<=', $endDate);
        }

        // Apply category filter if provided
        if ($categoryId) {
            $salesQuery->where('products.product_category', $categoryId);
        }

        // Top 3 Most Sold Products
        $topProducts = (clone $salesQuery)
            ->select('products.product_name', DB::raw('SUM(sales.quantity) as total_sold'))
            ->groupBy('products.id', 'products.product_name')
            ->orderByDesc('total_sold')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                // Ensure product name is a string and total_sold is an integer
                return (object) [
                    'product_name' => (string) $item->product_name,
                    'total_sold' => (int) $item->total_sold,
                ];
            });

        // Least Sold Products
        $leastProducts = (clone $salesQuery)
            ->select('products.product_name', DB::raw('SUM(sales.quantity) as total_sold'))
            ->groupBy('products.id', 'products.product_name')
            ->orderBy('total_sold')
            ->limit(3)
            ->get();

        // Sales Trends Over Time
        $salesTrends = (clone $salesQuery)
            ->select(DB::raw('DATE(sales.created_at) as date'), DB::raw('SUM(sales.quantity) as total_sales'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Sales by Category
        $salesByCategory = (clone $salesQuery)
            ->select('categories.name as category_name', DB::raw('SUM(sales.quantity) as total_sales'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_sales')
            ->get();

        // Stock Levels by Category
        $stockByCategory = Product::with('category')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('product_category', $categoryId);
            })
            ->get()
            ->groupBy('category.name')
            ->map(function ($products) {
                return $products->map(function ($product) {
                    return [
                        'product_name' => $product->product_name,
                        'stock_quantity' => $product->stock_quantity,
                    ];
                });
            });

        // Reorder Points
        $reorderData = Product::with('category')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('product_category', $categoryId);
            })
            ->whereColumn('stock_quantity', '<', 'minimum_stock_level')
            ->get();

        // Expiring Products Within a Month
        $expiringProducts = Product::with('category')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('product_category', $categoryId);
            })
            ->whereDate('expiry_date', '<=', now()->addDays(30))
            ->get();

        // All Categories for the filter dropdown
        $categories = Category::pluck('name', 'id');

        return view('products.product-overview', compact(
            'topProducts',
            'leastProducts',
            'salesTrends',
            'salesByCategory',
            'stockByCategory',
            'reorderData',
            'expiringProducts',
            'categories'
        ));
    }
}
