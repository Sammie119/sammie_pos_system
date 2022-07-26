<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrices;
use App\Models\RestockProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('products_list', ['products' => $products]);
    }

    public function create()
    {
        return view('product');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'description' => 'required',
            'brand' => 'required',
            'code' => 'nullable|alpha_num|unique:products',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        
        Product::updateOrCreate(
            [
                'name' => $request->name,
                'brand' => $request->brand,
            ],
            [
                'description' => $request->description, 
                'code' => $request->code,
                'cost' => $request->cost, 
                'price' => $request->price,
            ]
        );

        return redirect('products_list')->with('success', 'Product Registered Successfully!!');
    }

    public function edit($id)
    {
        $prod = Product::find($id);
        return view('edit_product', ['product' => $prod]);
    }

    public function update(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'description' => 'required',
            'brand' => 'required',
            'code' => 'nullable|alpha_num|unique:products,code,'.$request->id.',id',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        
        $product = Product::find($request->id);

        $product->update(
            [
                'name' => $request->name,
                'description' => $request->description, 
                'code' => $request->code,
                'brand' => $request->brand,
                'cost' => $request->cost, 
                'price' => $request->price,
            ]
        );

        return redirect('products_list')->with('success', 'Product Updated Successfully!!');
    }

    public function distroy($id)
    {
        $prod = Product::find($id);
        $prod->delete();

        return back()->with('success', 'Product Deleted Successfully!!');
    }

    public function restockProduct()
    {
        return view('product_restock');
    }

    public function saveRestockProduct(Request $request)
    {
        // dd($request->all());
        foreach ($request->product_id as $i => $product) {

            $prod = Product::find($product);

            RestockProduct::create([
                'product_id' => $product,
                'old_quantity' => $prod->stock_in, 
                'old_sold' => $prod->stock_out,
                'old_stock' => $request->stock[$i], 
                'new_quantity' => $request->quantity[$i],
            ]);

            $prod->update([
                'stock_in' => $prod->stock_in + $request->quantity[$i],
                'stock_out' => 0, 
            ]);
            
        }

        return redirect('products_list')->with('success', 'Product Restocked Successfully!!');
    }

    public function productRestockHistory()
    {
        $products = RestockProduct::orderByDesc('id')->get();
        return view('products_restock_history', ['products' => $products]);
    }

    public function editRestockHistory($id)
    {
        $product = RestockProduct::find($id);
        return view('edit_product_restock', ['product' => $product]);
    }

    public function updateRestockHistory(Request $request)
    {
        $product = RestockProduct::find($request->id);

        $prod = Product::find($product->product_id);

        $prod->update([
            'stock_in' => $product->old_stock + $request->quantity,
        ]);

        $product->update([
                'new_quantity' => $request->quantity,
            ]);

        return redirect('products_list')->with('success', 'Product Restock Update Successfully!!');            
    }

    public function priceProduct()
    {
        return view('product_reprice');
    }

    public function savePricingProduct(Request $request)
    {
        foreach ($request->product_id as $i => $product) {

            $prod = Product::find($product);

            ProductPrices::create([
                'product_id' => $product,
                'old_cost' => $prod->cost, 
                'old_price' => $prod->price,
                'new_cost' => $request->cost[$i], 
                'new_price' => $request->price[$i],
            ]);

            $prod->update([
                'cost' => $request->cost[$i],
                'price' => $request->price[$i], 
            ]);
            
        }

        return redirect('products_list')->with('success', 'Product Prices Changed Successfully!!');
    }

    public function productPriceHistory()
    {
        $products = ProductPrices::orderByDesc('id')->get();
        return view('products_price_history', ['products' => $products]);
    }

    public function editPriceHistory($id)
    {
        $product = ProductPrices::find($id);
        return view('edit_product_price', ['product' => $product]);
    }

    public function updatePriceHistory(Request $request)
    {
        $product = ProductPrices::find($request->id);

        $prod = Product::find($product->product_id);

        $product->update([
                'new_cost' => $request->cost, 
                'new_price' => $request->price,
            ]);

            $prod->update([
                'cost' => $request->cost,
                'price' => $request->price, 
            ]);

        return redirect('products_list')->with('success', 'Product Price Update Successfully!!');
    }

}
