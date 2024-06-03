<?php

namespace App\Http\Controllers;

use App\Models\ShopSettings;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopSetupView()
    {
        $shop = ShopSettings::find(1);
        return view('shop_setup', ['shop' => $shop ]);
    }

    public function shopSetup(Request $request, $id)
    {
        $request->validate([
            'text_logo' => 'required|mimes:jpg,png,jpeg,gif|max:2048',//|dimensions:min_width=400,min_height=400'
        ]);

        $shop = ShopSettings::find($id);

        $destinationPath = 'storage/uploads/';
        $file = date('YmdHis') . "." . $request->text_logo->getClientOriginalExtension();
        $request->text_logo->move($destinationPath, $file);

        $shop->update([
            'shop_name' => $request->shop_name,
            'address' => $request->address,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'text_logo' => 'uploads/'.$file,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'nhil' => $request->nhil,
            'gehl' => $request->gehl,
            'covid19' => $request->covid19,
            'vat' => $request->vat,
            'created_at' =>  date('Y-m-d')." ".date('H:i:s'),
            'updated_at' =>  date('Y-m-d')." ".date('H:i:s'),
        ]);

        return redirect('shop_setup')->with('success', 'Shop Information Updated Successfully!!!');
    }
}
