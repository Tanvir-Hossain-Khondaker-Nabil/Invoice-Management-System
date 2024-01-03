<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view ('backend.modules.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'code'=>'required',
            'quantity'=>'numeric',
            'price'=>'numeric',
            'details'=>'required',
            'photo'=>'required',
        ]);
        $product_data = $request->except(['photo']);

        $file = " ";   
         
        if($file = $request->file('photo')){
            $name = $request->name.'-'.$request->code.'.'.$file->getClientOriginalExtension();
            $product_data['photo'] = $file->move('upload/product/',$name);
        }

        Product::create($product_data);

        session()->flash('msg','Create Successfully');    
        session()->flash('cls','success');
            
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view ('backend.modules.product.create',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product_data = $request->except(['photo']);

        $file = " ";
        $deleteOldImage = $product->photo;

        if($file = $request->file('photo')){
            if(file_exists($deleteOldImage)){
                unlink($deleteOldImage);
            }
            $imageName = $request->name.'-'.$request->code.'.'.$file->getClientOriginalExtension();
            $product_data['photo'] = $file->move('upload/product/',$imageName);
        }
        else{
            $product_data['photo'] = $product->photo;
        }

        $product->update($product_data);

        session()->flash('msg','Update Successfully');    
        session()->flash('cls','warning');
            
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $deleteOldImage = $product->photo;
        if(file_exists($deleteOldImage)){
            unlink($deleteOldImage);
        }

        $product->delete();
        session()->flash('msg','Delete Successfully');
        session()->flash('cls','error');
        return redirect()->route('product.index');
    }
}
