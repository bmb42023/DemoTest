<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;

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
    public function StoreCategory(Request $request){
        try{
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_name' => 'required|string|max:255',
            ]);

             if ($request->hasFile('image')) {
                $file = $request->file('image');
                //@unlink(public_path('upload/category',$data->photo));
                $filename = date('YmdHis') . $file->getClientOriginalName();
                
                $file->move(public_path('upload/category'), $filename);
            }

          // 2. $image = $request->file('image');
        
        //   $name_gen = hexdec((uniqid())).'.'.$image->getclientOriginalExtension();
        // //$name_gen = $image->getclientOriginalExtension();
        // Image::make($image)->resize(370,246)->save('Upload/category/'. $name_gen);
        // $save_url = 'Upload/category/'.$name_gen;

        
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(str_replace(' ', '-', $request->category_name));
       // $category->image = $save_url;
        $category->image = $file;
        $category->save();

        $notification = array(
            'message' => 'Category added successfully',
            'alert-type' => 'success'
        );
        
        dd([
            'Original Name' => $image->getClientOriginalName(),
            'Extension' => $image->getClientOriginalExtension(),
            'Size' => $image->getSize(),
            'MIME Type' => $image->getMimeType(),
        ]);

        //dd($request->all());

        

        // 1.  Category::insert([
            
        //  'category_name'=> $request->category_name,
        //  'category_slug'=>strtolower(str_replace('','-',$request->category_name)),
        //  'image'=> $save_url,
        // ]);
        return redirect()->route('all.category')->with($notification);

        }
    //     $notification = array(
    //         'message'=>'Category added successfully',
    //         'alert-type' => 'success');
    //    return redirect()->route('all.category')-> with($notification);
    
    catch (\Exception $e) {
        
        $notification = array(
            'message' => 'Error adding category: ' . $e->getMessage(),
            'alert-type' => 'error'
        );
  
        return redirect()->back()->with($notification);
    }

}
}

