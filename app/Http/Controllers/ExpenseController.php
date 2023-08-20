<?php

namespace App\Http\Controllers;

use App\Expense;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 40) {

            $userId = Auth::user()->id;

            $user_expense = DB::table('expenses')
                ->join('expense_categories', 'expenses.expense_category_id', '=', 'expense_categories.id')
                ->select('expenses.*', 'expense_categories.display_name as expense_category_name')
                ->where('expenses.user_id', $userId)
                ->get();

            return response()->json($user_expense);
        } else {
            $expense_category_name = Expense::join('expense_categories', 'expenses.expense_category_id', '=', 'expense_categories.id')
                ->select('expenses.*', 'expense_categories.display_name as expense_category_name')
                ->get();

            return response()->json($expense_category_name);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_category_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'required'
        ]);

        $role = new Expense();
        $role->expense_category_id = $request['expense_category_id'];
        $role->amount = $request['amount'];
        $role->entry_date = $request['entry_date'];
        $role->user_id = Auth::user()->id;
        $role->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Expense $expense)
    {
        $request->validate([
            'expense_category_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'required'
        ]);

        $expense->where('id', $id)->update([
            'expense_category_id' => $request->input('expense_category_id'),
            'amount' => $request->input('amount'),
            'entry_date' => $request->input('entry_date')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Expense $expense)
    {
        $expense->where('id', $id)->delete();
    }
}
