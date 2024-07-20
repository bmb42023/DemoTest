<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function AllCategory(){
    $category =  Category::latest()->get();
   return view('admin.backend.category.all_category',compact('category'));
    }
   
    public function AddCategory(Request $request){
    return view('admin.backend.category.add_category');

    }
}
