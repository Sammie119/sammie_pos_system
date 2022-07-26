<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('suppliers_list', ['suppliers' => $suppliers]);
    }

    public function addSupplier()
    {
        return view('supplier');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'contact' => 'required|unique:suppliers',
            'address' => 'required',
        ]);
        
        Supplier::updateOrCreate(
            [
                'name' => $request->name,
                'contact' => $request->contact,
            ],
            [
                'address' => $request->address, 
                'description' => $request->description,
            ]
        );

        return redirect('suppliers_list')->with('success', 'Supplier Registered Successfully!!');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('edit_supplier', ['supplier' => $supplier]);
    }

    public function update(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'contact' => 'required|unique:suppliers,contact,'.$request->id.',id',
            'address' => 'required',
        ]);

        $supp = Supplier::find($request->id);

        $supp->update([
            'name' => $request['name'],
            'contact' => $request['contact'],
            'address' => $request['address'],
            'description' => $request['description'],
        ]);

        return redirect('suppliers_list')->with('success', 'Supplier Updated Successfully!!');
    }

    public function distroy($id)
    {
        $supp = Supplier::find($id);
        $supp->delete();

        return back()->with('success', 'Supplier Deleted Successfully!!');
    }

}
