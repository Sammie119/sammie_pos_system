<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GetAjaxDataController extends Controller
{
    public function autoSearchProduct(Request $request)
    {
        $product = Product::where("code", 'LIKE', $request->product)->first();

        if($product){
            $results = [
                'code' => $product->code,
                'stock' => $product->stock_in - $product->stock_out,
                'product_name' => $product->name,
                'product_description' => $product->name." (".$product->description.")",
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
}
