<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class UserController extends Controller
{
     public function index()
    {
        $data = Product::get();
        // dd($data,$p);
        return view('user.index',compact('data'));
    }
}
