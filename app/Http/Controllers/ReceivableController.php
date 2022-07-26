<?php

namespace App\Http\Controllers;

use App\Models\Receivable;
use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    public function index()
    {
        $receivables = Receivable::orderByDesc('received_date')->get();
        return view('receivables_list', ['receivables' => $receivables]);
    }

    public function create()
    {
        return view('receivables');
    }

    public function store(Request $request)
    {
        request()->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_no' => 'required',
            'total_amount' => 'required',
            'received_date' => 'required|date',
        ]);
        
        Receivable::create([
                'supplier_id' => $request->supplier_id,
                'product_id' => json_encode($request->product_id),
                'quantity' => json_encode($request->quantity),
                'amount' => json_encode($request->amount),
                'invoice_no' => $request->invoice_no,
                'total_amount' => $request->total_amount, 
                'received_date' => $request->received_date,
                'user_id' => Auth()->user()->id,
            ]);

        return redirect('receivables_list')->with('success', 'Receivables Entered Successfully!!');
    }

    public function show($receivable)
    {
        $rec = Receivable::find($receivable);
        return view('receivables_show', ['receivable' => $rec]);
    }

    public function destroy($receivable)
    {
        $rec = Receivable::find($receivable);
        $rec->delete();
        return back()->with('success', 'Receivable Deleted Successfully!!');
    }
}
