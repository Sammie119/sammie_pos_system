<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function index()
    {
        if(Auth()->user()->role == 1){
            // $trans = Transaction::orderByDesc('id')->limit(100)->get();
            $trans = Invoice::orderByDesc('id')->limit(100)->get();
            return view('transactions_list', ['trans' => $trans]);
        }
        else{
            // $trans = Transaction::orderByDesc('id')->where('user_id', Auth()->user()->id)->limit(100)->get();
            $trans = Invoice::orderByDesc('id')->where('user_id', Auth()->user()->id)->limit(100)->get();
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
            'amount_paid' => 'nullable'
        ]);

        if($request->amount_paid === null && !$request->has('invoice_no')){
            // dd($request->all());
            if($request->customer === 'Add Customer'){
                $cus = Customer::create([
                    'name' => $request->name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'location' => $request->location,
                ]);
            } else {
                $cus = Customer::where('name', $request->customer)->first();
            }
            $trans = Invoice::create([
                'transac_amount' => array_sum($request->amount),
                'amount_paid' => 0.00,
                'balance' => 0.00,
                'payment_method' => $request->payment_method,
                'payment_transac_no' => $request->payment_transac_no,
                'taxed_amount' => $request->total_amount,
                'transac_date' => date('Y-m-d'),
                'customer_id' => $cus->id,
                'user_id' => Auth()->user()->id,
            ]);

            // transaction_details
            foreach ($request->product_id as $i => $product) {

                InvoiceDetail::create([
                    'product_id' => $product,
                    'quantity' => $request->quantity[$i],
                    'unit_price' => $request->unit_price[$i],
                    'amount' => $request->amount[$i],
                    'invoice_no' => $trans->id,

                ]);
            }

            if(Auth()->user()->role == 1){
                return "<script>
                    window.open('print_invoice/$trans->id','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                    window.location = 'add_transaction';
                </script>";
                // return redirect('')->with('success', 'Transaction Entered Successfully!!');
            }
            else{
                return "<script>
                    window.open('print_invoice/$trans->id','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                    window.location = 'add_transaction_user';
                </script>";
                // return redirect('')->with('success', 'Transaction Entered Successfully!!');
            }
        } else {
            // dd($request->all());
            // transactions
            $trans = Transaction::create([
                'invoice_no' => $request->invoice_no,
                'transac_amount' => $request->total_amount,
                'amount_paid' => $request->amount_paid,
                'balance' => intval($request->total_amount) - (intval($request->amount_paid) + intval($request->paid)),
                'payment_method' => $request->payment_method,
                'transac_date' => date('Y-m-d'),
                'user_id' => Auth()->user()->id,
            ]);

            // transaction_details
            foreach ($request->product_id as $i => $product) {

                // $prod = Product::find($product);

                TransactionDetail::create([
                    'product_id' => $product,
                    'quantity' => $request->quantity[$i],
                    'unit_price' => $request->rate[$i],
                    'amount' => $request->amount[$i],
                    'receipt_no' => $trans->id,

                ]);

                // $prod->update([
                //     'stock_out' => $prod->stock_out + $request->quantity[$i],
                // ]);
            }

            if(Auth()->user()->role == 1){
                return "<script>
                    window.open('print_receipt/$trans->id','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                    window.location = 'payments_list';
                </script>";
                // return redirect('')->with('success', 'Transaction Entered Successfully!!');
            }
            else{
                return "<script>
                    window.open('print_receipt/$trans->id','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                    window.location = 'payments_list';
                </script>";
                // return redirect('')->with('success', 'Transaction Entered Successfully!!');
            }
        }

    }

    public function printReceipt($id){
        $trans = TransactionDetail::where('receipt_no', $id)->get();
        $mainTrans = Transaction::find($id);
        return view('print_receipt', ['transaction' => $trans, 'mainTrans' => $mainTrans]);
    }

    public function printInvoice($id){
        $trans = InvoiceDetail::where('invoice_no', $id)->get();
        return view('print_invoice', ['invoice' => $trans]);
    }

    public function payments()
    {
        if(Auth()->user()->role == 1){
            $trans = Transaction::orderByDesc('id')->limit(100)->get();
            // $trans = Invoice::orderByDesc('id')->limit(100)->get();
            return view('payments_list', ['trans' => $trans]);
        }
        else{
            $trans = Transaction::orderByDesc('id')->where('user_id', Auth()->user()->id)->limit(100)->get();
            // $trans = Invoice::orderByDesc('id')->where('user_id', Auth()->user()->id)->limit(100)->get();
            return view('payments_list', ['trans' => $trans]);
        }
    }

    public function addPayment()
    {
        return view('payments');
    }

    // public function makePayment(Request $request)
    // {
    //     dd($request->all());
    // }

    public function show($transaction)
    {
        $trans_detail = InvoiceDetail::where('invoice_no', $transaction)->get();
        $trans = Invoice::find($transaction);
        return view('transaction_show', ['transaction' => $trans_detail, 'trans' => $trans]);
    }

    public function destroy($transaction)
    {
        $trans = Invoice::find($transaction);
        $trans->delete();

        return redirect('transactions_list')->with('success', 'Invoice Deleted Successfully!!');
    }

    public function destroyTransaction($transaction)
    {
        $trans = Transaction::find($transaction);
        $trans->delete();
        $trans_detail = TransactionDetail::where('receipt_no', $transaction)->get();

        foreach ($trans_detail as $transaction) {

            // $prod = Product::find($transaction->product_id);

            // $prod->update([
            //     'stock_out' => $prod->stock_out - $transaction->quantity,
            // ]);

            $transaction->delete();
        }

        return redirect('payments_list')->with('success', 'Transaction Deleted Successfully!!');
    }

}
