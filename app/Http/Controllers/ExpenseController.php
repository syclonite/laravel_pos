<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseRecord;
use App\Models\ExpenseRecordDetail;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('backend.expense.index',compact('expenses'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.expense.create');
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
        $expense = new Expense([
            'expense_category_name' => $request->get('expense_category_name'),
            'remarks' => $request->get('expense_remarks'),
            'status' => $request->get('status')
        ]);
        $expense->save();
        return redirect()->route('expenses.index')->with('success','Expense Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('backend.expense.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $expense->expense_category_name = $request->get('expense_category_name');
        $expense->remarks = $request->get('expense_remarks');
        $expense->status = $request->get('status');
        $expense->save();
        return redirect()->route('expenses.index')->with('success','Expense has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete(); // Easy right?

        return redirect()->route('expenses.index')->with('success','Expense Category Deleted.');

    }

    public function expense_record_index()
    {
        $expense_records = ExpenseRecord::all();
        return view('backend.expense.index_expense_record',compact('expense_records'))->with('i');
    }

    public function expense_record_create()
    {
        $expense_category = Expense::all();
        return view('backend.expense.create_expense_record',compact('expense_category'));

    }

    public function expense_record_store(Request $request)
    {
//        dd($request->all());

        $expense_record = new ExpenseRecord([
            'type' => $request['expense_record']['type'],
            'status' => '1',
            'amount' => $request['expense_record']['billing_amount'],
            'remarks' => $request['expense_record']['remarks'],
        ]);
        $expense_record->save();
        $expense_record_details = $request['expense_record_details'];
        foreach( $expense_record_details as $expense_record_detail){
//            dd($sale_order_detail);
            ExpenseRecordDetail::create([
                'expense_id' => $expense_record_detail['expense_category_id'],
                'expense_record_id' => $expense_record->id,
                'amount' => $expense_record_detail['amount'],
                'status' => $expense_record_detail['status'],
            ]);
        }
    }
    public function expense_record_edit($id){
        $expense_categories = Expense::all();
        $expense_record = ExpenseRecord::find($id)->first();
        $expense_record_details = ExpenseRecordDetail::get()->where('expense_record_id',$id);
        return view('backend.expense.edit_expense_record', compact('expense_record','expense_record_details','expense_categories'))->with('i');
    }


    public function expense_record_update(Request $request, $id)
    {
        $expense_record = ExpenseRecord::find($id);
        $expense_record->type = $request['expense_record']['type'];
        $expense_record->amount = $request['expense_record']['billing_amount'];
        $expense_record->remarks = $request['expense_record']['remarks'];
        $expense_record->status = $request['expense_record']['status'];
        $expense_record->save();
        $expense_record_details = $request['expense_record_details'];
//        dd($sale_order_details);
        ExpenseRecordDetail::where('expense_record_id',$id)->delete();
        foreach ($expense_record_details as $expense_record_detail) {
//            dd($purchase_order_detail['quantity']);
            ExpenseRecordDetail::create([
                'expense_id' => $expense_record_detail['expense_category_id'],
                'expense_record_id' => $id,
                'amount' => $expense_record_detail['amount'],
                'status' => $expense_record_detail['status'],
            ]);
        }
    }


    public function expanse_record_destroy($id){
        $expense_record = ExpenseRecord::find($id);
        $expense_record->delete(); // Easy right?
        return redirect()->route('expense_record.index')->with('success','Bill Deleted.');
    }
}
