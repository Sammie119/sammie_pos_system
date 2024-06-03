<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class GetAjaxDataController extends Controller
{
    public function autoSearchProduct(Request $request)
    {
        $product = Product::where("name", $request->product)->first();

        if($product){
            $results = [
                'code' => $product->code,
                'stock' => $product->stock_in - $product->stock_out,
                'product_name' => $product->name,
                'product_description' => $product->name,
                'cost' => $product->cost,
                'price' => $product->price,
                'product_id' => $product->id,
                'brand' => $product->brand,
            ];
        }
        else{
            $results = [
                'product_name' => 'No_data'
            ];
        }

        return response()->json($results);
    }

    public function autoSearchInvoice(Request $request)
    {
        $invoice = InvoiceDetail::with('product')->where("invoice_no", $request->invoice)->get();
        $sum = Invoice::where("id", $request->invoice)->first();
        $amount_paid = Transaction::where('invoice_no', $request->invoice)->sum('amount_paid');

        if($invoice->isNotEmpty()){
            $results = [
                'invoice' => "data",
                'data' => $invoice,
                'transac_amount' => $sum->transac_amount,
                'taxed_amount' => $sum->taxed_amount,
                'amount_paid' => $amount_paid,
                'tax' => $sum->taxed_amount - $sum->transac_amount
            ];
        }
        else{
            $results = [
                'invoice' => 'No_data'
            ];
        }

        return response()->json($results);
    }
}
