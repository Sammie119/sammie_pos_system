<?php

namespace App\Http\Controllers;

use App\Models\OtherTransaction;
use Illuminate\Http\Request;

class OtherTransactionController extends Controller
{
    public function index()
    {
        $tran = OtherTransaction::orderByDesc('transaction_date')->get();
        return view('income_exp_list', ['tran' => $tran]);
    }

    public function create()
    {
        return view('income_exp');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'transaction_name' => 'required',
            'transaction_amount' => 'required',
            'transaction_type' => 'required',
            'transaction_date' => 'required'
        ]);

        foreach ($request->transaction_name as $i => $transaction) {
            OtherTransaction::create([
                'transaction_name' => $transaction,
                'transaction_amount' => $request->transaction_amount[$i],
                'transaction_type' => $request->transaction_type[$i],
                'transaction_date' => $request->transaction_date[$i],
                'created_by' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id
            ]);
        }

        return redirect('income_exp_list')->with('success', 'Other Transactions Entered Successfully!!');
    }

    public function destroy($id)
    {
        $rec = OtherTransaction::find($id);
        $rec->delete();
        return back()->with('success', 'Other Transaction Deleted Successfully!!');
    }
}
