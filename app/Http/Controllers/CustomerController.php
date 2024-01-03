<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view ('backend.modules.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|min:3|max:255',
            'phone'=>'required',
            'email'=>'required|email',
            'street_address'=>'required',
            'shopname'=>'required',
            'city'=>'required',
            'postal_code'=>'required',
            'photo'=>'required',
        ]);

        $customer_data = $request->except(['photo']);

        $file = " ";   
         
        if($file = $request->file('photo')){
            $name = $request->name.'-'.$request->phone.'.'.$file->getClientOriginalExtension();
            $customer_data['photo'] = $file->move('upload/customer/',$name);
        }

        Customer::create($customer_data);

        session()->flash('msg','Create Successfully');    
        session()->flash('cls','success');
            
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view ('backend.modules.customer.create',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $customer_data = $request->except(['photo']);

        $file = " ";
        $deleteOldImage = $customer->photo;

        if($file = $request->file('photo')){
            if(file_exists($deleteOldImage)){
                unlink($deleteOldImage);
            }
            $imageName =  $request->name.'-'.$request->phone.'.'.$file->getClientOriginalExtension();
            $customer_data['photo'] = $file->move('upload/customer/',$imageName);
        }
        else{
            $customer_data['photo'] = $customer->photo;
        }

        $customer->update($customer_data);

        session()->flash('msg','Update Successfully');    
        session()->flash('cls','warning');
            
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $deleteOldImage = $customer->photo;
        if(file_exists($deleteOldImage)){
            unlink($deleteOldImage);
        }

        $customer->delete();
        session()->flash('msg','Delete Successfully');
        session()->flash('cls','error');
        return redirect()->route('customer.index');
    }
}
