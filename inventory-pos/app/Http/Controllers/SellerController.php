<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Models\SellerActivity;


class SellerController extends Controller
{
    // Show the form to create a new seller (only accessible by admin)
    public function create()
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->withErrors('You are not authorized to create sellers.');
        }

        // Check if there are already 4 sellers
        $sellerCount = User::where('role', 'seller')->count();

        if ($sellerCount >= 4) {
            return redirect()->route('admin.dashboard')->withErrors('You can only create up to 4 sellers.');
        }

        return view('admin.create-seller');
    }

    // Store a new seller
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $seller = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'seller',
        ]);

        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'seller_created',
            'product_id' => null,
        ]);

        return redirect()->route('admin.sellers')->with('success', 'Seller created successfully.');
    }

    // Show the list of sellers
    public function index()
    {
        $sellers = User::where('role', 'seller')->get();
        return view('admin.all_sellers', compact('sellers'));
    }

    // Show the form to edit a seller
    public function edit($id)
    {
        $seller = User::findOrFail($id);
        return view('admin.edit-seller', compact('seller'));
    }

    // Update a seller's information
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $seller = User::findOrFail($id);
        $seller->name = $request->name;
        $seller->email = $request->email;

        if ($request->filled('password')) {
            $seller->password = bcrypt($request->password);
        }

        $seller->save();

        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'seller_updated',
            'product_id' => null,
        ]);

        return redirect()->route('admin.sellers')->with('success', 'Seller updated successfully.');
    }

    // Delete a seller
    public function destroy($id)
    {
        $seller = User::findOrFail($id);
        $seller->delete();

        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => 'seller_deleted',
            'product_id' => null,
        ]);

        return redirect()->route('admin.sellers')->with('success', 'Seller deleted successfully.');
    }

    // Show all sellers
    public function allSellers()
    {
        $sellers = User::where('role', 'seller')->get(); 
        return view('admin.all_sellers', compact('sellers'));
    }

    // Show the admin dashboard
    public function dashboard()
    {
        $authenticatedUser   = Auth::user();

       // if (!$authenticatedUser ) {
         //   return redirect()->route('login')->withErrors('You must be logged in to access the dashboard.');
        //}

      // Only get this seller's total sales
    $usersSales = Sale::select('seller_name', DB::raw('SUM(total_price) as total_sales'))
        ->where('seller_name', $authenticatedUser->name)
        ->groupBy('seller_name')
        ->get();

    // Date range for revenue
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
        $startDate = Carbon::today()->startOfMonth();
    }

    $endDate = Carbon::today()->endOfMonth();

    // Revenue: total sales and purchases per month
    $salesData = Sale::select(
        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
        DB::raw('SUM(total_price) as total_sales')
    )
    ->where('seller_name', $authenticatedUser->name)
    ->whereDate('created_at', '>=', $startDate)
    ->groupBy('month')
    ->orderBy('month')
    ->get()
    ->keyBy('month');

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

    // Expenses
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
        'expiringProducts' => $expiringProducts,
    ]);
}
    }

   

    
