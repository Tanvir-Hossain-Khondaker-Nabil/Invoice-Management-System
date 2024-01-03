<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;

class BackendController extends Controller
{
    public function index(){
        return view('backend.index');
    }
}
