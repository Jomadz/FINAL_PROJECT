<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        // Load related product and user data
        $expenses = Expense::with(['product', 'user'])->get();

        // Calculate total expenses
        $totalExpenses = $expenses->sum('amount');

        return view('expenses.index', compact('expenses', 'totalExpenses'));
    }
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'amount' => 'required|numeric',
        'source' => 'required|string|max:50',
    ]);

    Expense::create([
        'product_id' => $request->product_id,
        'amount' => $request->amount,
        'source' => $request->source,
        'user_id' => auth()->id(), // ← Automatically set logged-in user
    ]);

    return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
}

}
