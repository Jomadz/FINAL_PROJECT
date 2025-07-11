<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller {

// Show the admin dashboard
public function dashboard()
{
    // Retrieve the authenticated user
    $authenticatedUser = Auth::user();

    // Check if the user is authenticated (optional, but good for validation)
    if (!$authenticatedUser) {
        return redirect()->route('login')->withErrors('You must be logged in to access the dashboard.');
    }

    // You can pass other data like user role or any other details you need
    //$userRole = $authenticatedUser->role;

    // Return the view and pass the authenticated user and userRole data
  //  return view('admin.dashboard', compact('authenticatedUser', 'userRole'));

   // Get today's date
 //  $startOfMonth = Carbon::now()->startOfMonth();
 //  $endOfMonth = Carbon::now()->endOfMonth();

   // Get sales per user  (user_id, user name, total sales amount)
   $usersSales = Sale::select('seller_name', DB::raw('SUM(total_price) as total_sales'))
   ->groupBy('seller_name')
   ->get();

 // Get the earliest sale or purchase date
$firstSaleDate = Sale::orderBy('created_at')->value('created_at'); 
$firstPurchaseDate = Purchase::orderBy('created_at')->value('created_at');

$startDate = null;
if ($firstSaleDate && $firstPurchaseDate) {
    $startDate = Carbon::parse($firstSaleDate)->lt(Carbon::parse($firstPurchaseDate)) 
        ? Carbon::parse($firstSaleDate)->startOfMonth() 
        : Carbon::parse($firstPurchaseDate)->startOfMonth();
} elseif ($firstSaleDate) {
    $startDate = Carbon::parse($firstSaleDate)->startOfMonth();
} elseif ($firstPurchaseDate) {
    $startDate = Carbon::parse($firstPurchaseDate)->startOfMonth();
} else {
    $startDate = Carbon::today()->startOfMonth(); // fallback
}

$endDate = Carbon::today()->endOfMonth();

// Get total sales per month
$salesData = Sale::select(
        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
        DB::raw('SUM(total_price) as total_sales')
    )
    ->whereDate('created_at', '>=', $startDate)
    ->groupBy('month')
    ->orderBy('month')
    ->get()
    ->keyBy('month');

// Get total purchases per month
$purchasesData = Purchase::select(
        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
        DB::raw('SUM(cost_price * quantity) as total_purchases')
    )
    ->whereDate('created_at', '>=', $startDate)
    ->groupBy('month')
    ->orderBy('month')
    ->get()
    ->keyBy('month');

$months = [];
$revenues = [];

$current = $startDate->copy();
while ($current->lte($endDate)) {
    $monthKey = $current->format('Y-m');
    $label = $current->format('M Y');

    $totalSales = $salesData[$monthKey]->total_sales ?? 0;
    $totalPurchases = $purchasesData[$monthKey]->total_purchases ?? 0;

    $months[] = $label;
    $revenues[] = $totalSales - $totalPurchases;

    $current->addMonth();
}
$expensesData = Expense::select(
    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
    DB::raw('SUM(amount) as total_expenses')
)
->groupBy('month')
->orderBy('month')
->get()
->mapWithKeys(function ($item) {
    return [Carbon::parse($item->month . '-01')->format('M Y') => $item->total_expenses];
});

$expenseLabels = $expensesData->keys()->toArray();
$expenseValues = $expensesData->values()->toArray(); 
   // Get low stock products
   $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'minimum_stock_level')->get();

   // Get products expiring within 30 days
   $expiringProducts = Product::whereDate('expiry_date', '<=', Carbon::now()->addDays(30))->get();

   return view('admin.dashboard', [
    'authenticatedUser' => $authenticatedUser,
       'usersSales' => $usersSales,
       'chartLabels' => $months,
       'chartValues' => $revenues,
       'expenseLabels' => $expenseLabels,
       'expenseValues' => $expenseValues,
       'lowStockProducts' => $lowStockProducts,
       'expiringProducts' => $expiringProducts
   ]);
}
}