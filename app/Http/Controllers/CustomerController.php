<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customer = Customer::orderBy('name')->get();
        return view('customers_list', ['customers' => $customer]);
    }

    public function destroy($customer)
    {
        $rec = Customer::find($customer);
        $rec->delete();
        return back()->with('success', 'Customer Deleted Successfully!!');
    }
}
