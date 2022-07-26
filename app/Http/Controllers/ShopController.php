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
        $shop = ShopSettings::find($id);
        $shop->update([
            'shop_name' => $request->shop_name,
            'address' => $request->address,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'text_logo' => $request->text_logo,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'created_at' =>  date('Y-m-d')." ".date('H:i:s'),
            'updated_at' =>  date('Y-m-d')." ".date('H:i:s'),
        ]);       

        return redirect('shop_setup')->with('success', 'Shop Information Updated Successfully!!!');
    }
}
