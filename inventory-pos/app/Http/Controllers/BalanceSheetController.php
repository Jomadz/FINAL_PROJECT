<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceSheetController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $queryDate = $request->input('date');       // e.g. 2025-05-20
        $queryMonth = $request->input('month');     // e.g. 2025-05
        $from = $request->input('from');
        $to = $request->input('to');

        // --- Build Queries ---
        $saleQuery = Sale::query();
        $purchaseQuery = Purchase::query();
        $expenseQuery = Expense::query();

        if ($user->role === 'seller') {
            $saleQuery->where('seller_name', $user->name);
            $expenseQuery->where('user_id', $user->id);
            // Optional: If sellers can create purchases
            $purchaseQuery->where('user_id', $user->id);
        }

        // --- Date Filters ---
        if ($queryDate) {
            $saleQuery->whereDate('created_at', $queryDate);
            $expenseQuery->whereDate('created_at', $queryDate);
            $purchaseQuery->whereDate('created_at', $queryDate);
        } elseif ($queryMonth) {
            $month = date('m', strtotime($queryMonth));
            $year = date('Y', strtotime($queryMonth));
            $saleQuery->whereMonth('created_at', $month)->whereYear('created_at', $year);
            $expenseQuery->whereMonth('created_at', $month)->whereYear('created_at', $year);
            $purchaseQuery->whereMonth('created_at', $month)->whereYear('created_at', $year);
        } elseif ($from && $to) {
            $saleQuery->whereBetween('created_at', [$from, $to]);
            $expenseQuery->whereBetween('created_at', [$from, $to]);
            $purchaseQuery->whereBetween('created_at', [$from, $to]);
        }

        // --- Total Sales (quantity × total_price) ---
        $totalSales = $saleQuery->sum(DB::raw(' total_price'));

        // --- Total Purchases (quantity × cost_price) ---
        $totalPurchases = $user->role === 'admin' ? $purchaseQuery->sum(DB::raw('quantity * cost_price')) : 0;

        // --- Total Expenses ---
        $totalExpenses = $expenseQuery->sum('amount');

        // --- Inventory Value (Assets) ---
        $inventoryValue = Product::sum(DB::raw('stock_quantity * cost_price'));
        $assets = $inventoryValue;

        // --- Liabilities & Equity ---
        $liabilities = $totalPurchases + $totalExpenses;
        $equity = $assets - $liabilities;

        return view('balance_sheet.index', compact(
            'inventoryValue',
            'totalSales',
            'assets',
            'totalPurchases',
            'totalExpenses',
            'liabilities',
            'equity',
            'queryDate',
            'queryMonth',
            'from',
            'to'
        ));
    }
}
