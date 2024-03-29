<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxs = Tax::get();
        return view ('backend.modules.tax.index', compact('taxs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.tax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tax'=>'required',
        ]);
        $tax = Tax::pluck('id')->count();

        if ( $tax < 1) {
            Tax::create($request->all());
        }        

        session()->flash('msg','Create Successfully');    
        session()->flash('cls','success');
            
        return redirect()->route('tax.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tax $tax)
    {
        return view ('backend.modules.tax.create',compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tax $tax)
    {
        $tax->update($request->all());

        session()->flash('msg','Update Successfully');    
        session()->flash('cls','warning');
            
        return redirect()->route('tax.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        session()->flash('msg','Delete Successfully');
        session()->flash('cls','error');
        return redirect()->route('tax.index');
    }
}
