<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Gloudemans\Shoppingcart\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    /**
     * Show the form for creating a new resource.
     */
    public function addToCart(Request $request)
    {
        // $data = array();
        // $data['id'] = $request->id;
        // $data['name'] = $request->name;
        // $data['qty'] = $request->qty;
        // $data['price'] = $request->price;

        // Cart::add($data);
        $product = Product::find($request->id);
        Cart::add($product->id,$product->name,$product->quantity,$product->price)->associate('App\Models\Product');
        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function cartUpdate(Request $request, $rowId)
    {
        $qty = $request->quantity;
        Cart::update($rowId,$qty);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cartRemove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }
}
