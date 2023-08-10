<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SubcategoryController extends Controller
{
    //
    function subcategory(){
        $Categories = CategoryModel::all();
        $subcategory = subcategory::all();
        return view('admin.Categories.subcategory',[
             'categories'=>$Categories,
             'subcategory'=>$subcategory,
        ]);
    }
    function subcategory_insert(Request $request){

        if($request->category_id == 'Select Category'){
          $request->validate([

            'category_name'=>'required',
            'subcategory_name' => 'required',
            'subcategory_image' => 'required',

          ],
          [
            'category_name.required'=>'Select The Category List From The Dropdown',
            'subcategory_name.required'=>'Give The Subcategory Name',
            'subcategory_image.required'=>'Please!!Upload a Subcategory Image',

        ]);
        }else{
            $request->validate([


                'subcategory_name' => 'required',
                'subcategory_image' => 'required',

            ],[
                'subcategory_name.required'=>'Give The Subcategory Name',
                'subcategory_image.required'=>'Please!!Upload a Subcategory Image',
            ]);
        }

         $category_name =  CategoryModel::find($request->category_id);


         $category_id = $request->category_id;
         $parts = explode('|',$category_id);
         $cat_id=$parts[0];

        $imageName = $request->subcategory_name.'_'.uniqid().'.'.$request->subcategory_image->extension();

        // Public Folder
        $request->subcategory_image->move(public_path('subcategory_images'), $imageName);

             Subcategory::create([
                  'subcategory_name'=>$request->subcategory_name,
                  'category_id'=>$cat_id,
                  'category_name'=>$category_name->category_name,
                  'subcategory_image'=>$imageName,
                  'added_by_name'=>Auth::user()->name,
                  'added_by'=>Auth::id(),
             ]);
             return back()->with('success','Category Inserted Successfully');
    }
}
