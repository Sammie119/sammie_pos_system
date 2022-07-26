<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function index()
    {
        if(Auth()->user()->role == 1){
            $trans = Transaction::orderByDesc('id')->limit(100)->get();
            return view('transactions_list', ['trans' => $trans]);
        }
        else{
            $trans = Transaction::orderByDesc('id')->where('user_id', Auth()->user()->id)->limit(100)->get();
            return view('transactions_list', ['trans' => $trans]);
        }
        
    }

    public function create()
    {
        return view('transaction');
    }

    public function store(Request $request)
    {
        request()->validate([
            'total_amount' => 'required',
        ]);
        
        // dd($request->all());
        // transactions
        $trans = Transaction::create([
                'transac_amount' => $request->total_amount,
                'amount_paid' => $request->total_amount,
                'balance' => 0.00,
                'payment_method' => $request->payment_method,
                'payment_transac_no' => $request->payment_transac_no,
                'transac_date' => date('Y-m-d'), 
                'user_id' => Auth()->user()->id,
            ]);

        // transaction_details
        foreach ($request->product_id as $i => $product) {
            
            $prod = Product::find($product);

            TransactionDetail::create([
                'product_id' => $product,
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'amount' => $request->amount[$i],
                'receipt_no' => $trans->id, 
                
            ]);
            
            $prod->update([
                'stock_out' => $prod->stock_out + $request->quantity[$i],
            ]);
        }

        if(Auth()->user()->role == 1){
            return "<script>
                window.open('print_receipt/$trans->id','','left=0,top=0,width=700,height=477,toolbar=0,scrollbars=0,status =0');
                window.location = 'add_transaction';
            </script>";
            // return redirect('')->with('success', 'Transaction Entered Successfully!!');
        }
        else{
            return "<script>
                window.open('print_receipt_user/$trans->id','','left=0,top=0,width=700,height=477,toolbar=0,scrollbars=0,status =0');
                window.location = 'add_transaction_user';
            </script>";
            // return redirect('')->with('success', 'Transaction Entered Successfully!!');
        }
        
    }

    public function printReceipt($id){
        $trans = TransactionDetail::where('receipt_no', $id)->get();
        return view('print_receipt', ['transaction' => $trans]);
    }

    public function show($transaction)
    {
        $trans_detail = TransactionDetail::where('receipt_no', $transaction)->get();
        $trans = Transaction::find($transaction);
        return view('transaction_show', ['transaction' => $trans_detail, 'trans' => $trans]);
    }

    public function destroy($transaction)
    {
        $trans = Transaction::find($transaction);
        $trans->delete();
        $trans_detail = TransactionDetail::where('receipt_no', $transaction)->get();

        foreach ($trans_detail as $transaction) {
            
            $prod = Product::find($transaction->product_id);
            
            $prod->update([
                'stock_out' => $prod->stock_out - $transaction->quantity,
            ]);

            $transaction->delete();
        }  
        
        return redirect('transactions_list')->with('success', 'Transaction Deleted Successfully!!');
    }

}
