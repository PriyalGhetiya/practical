<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;

class AdminController extends Controller
{
     public function index()
    {
        $category = new Category();
        $category = $category->with(['subcategories']);
        $categorys = $category->get();
        return view('admin.index',compact('categorys'));
    }
}
