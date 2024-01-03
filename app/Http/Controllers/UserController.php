<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view ('backend.modules.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_data = $request->except(['photo']);

        $file = " ";   
         
        if($file = $request->file('photo')){
            $name = $request->email.'.'.$file->getClientOriginalExtension();
            $user_data['photo'] = $file->move('upload/user/',$name);
        }

        User::create($user_data);

        session()->flash('msg','Create Successfully');    
        session()->flash('cls','success');
            
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view ('backend.modules.user.create',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user_data = $request->except(['photo']);

        $file = " ";
        $deleteOldImage = $user->photo;

        if($file = $request->file('photo')){
            if(file_exists($deleteOldImage)){
                unlink($deleteOldImage);
            }
            $imageName = $request->email.'.'.$file->getClientOriginalExtension();
            $user_data['photo'] = $file->move('upload/user/',$imageName);
        }
        else{
            $user_data['photo'] = $user->photo;
        }

        $user->update($user_data);

        session()->flash('msg','Update Successfully');    
        session()->flash('cls','warning');
            
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleteOldImage = $user->photo;
        if(file_exists($deleteOldImage)){
            unlink($deleteOldImage);
        }

        $user->delete();
        session()->flash('msg','Delete Successfully');
        session()->flash('cls','error');
        return redirect()->route('user.index');
    }
}
