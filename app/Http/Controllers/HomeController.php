<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$expense = Expense::get();

        // $expensesCountByCategory = Expense::selectRaw('expense_category_id, SUM(amount) as total_amount')
        //     ->groupBy('expense_category_id')
        //     ->get();

        $compute_amounts = Expense::selectRaw('
                    expenses.expense_category_id as id,
                    expense_categories.display_name as category_name,
                    SUM(expenses.amount) as total_amount
                ')
            ->join('expense_categories', 'expenses.expense_category_id', '=', 'expense_categories.id')
            ->groupBy('expenses.expense_category_id', 'expense_categories.display_name')
            ->get();

        return view('layouts.backend.dashboard')->with('compute_amounts', $compute_amounts);

        // return response()->json($expensesByCategory);

        //return view('layouts.backend.dashboard');
    }

    // public function logout(Request $request)
    // {

    //     Auth::logout();
    //     $request->session()->flush();

    //     return redirect('/');
    // }
}
