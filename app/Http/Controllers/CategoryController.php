<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    //
    function categories(){
        $category_list = CategoryModel::all();
        return view('admin.Categories.category',[
            'category_list'=>$category_list,

        ]);
    }
    function category_insert(Request $request){
        $request->validate([


            'category_name' => 'required',
            'category_image' => 'required',

        ],
        [
            'category_name.required'=> 'Category Name Requireds',
            'category_image.required'=> 'Category Image Requireds',

           ]
        );

        if($request->category_image){

            $imageName = $request->category_name.'.'.$request->category_image->extension();

        // Public Folder
        $request->category_image->move(public_path('category_images'), $imageName);
            CategoryModel::create([
                'category_name'=>$request->category_name,
                'category_image'=>$imageName,
                'added_by'=>Auth::user()->id,
                'added_by_name'=>Auth::user()->name,

            ]);
            return back()->with('success','Category Inserted Successfully');
        }
    }
    function category_delete(Request $request){
        CategoryModel::find($request->up_id)->delete();
        return response()->json([
            'status'=>'success',
          ]);

    }

    function update_category(Request $request){

    //     $request->validate([
    //         'up_name'=>'required',
    //         'up_email'=>'required|unique:users,email,'.$request->up_id,
    //   ],[
    //       'up_name.required'=>'name is required',
    //       'up_email.required'=>'email is required',
    //       'email.unique'=>'Email should Be Unique',
    //   ]);


    $imageName = '';
    if ($request->hasFile('up_image')) {
        $imageName = $request->up_name.'.'.$request->up_image->extension();
        // $imageName = $request->up_name . '.' . $request->up_image->getClientOriginalExtension();
        $request->up_image->move(public_path('category_images'), $imageName);
        // $request->up_image->storeAs('category_images', $imageName);
        if($request->up_name){
            CategoryModel::where('id', $request->up_id)->update([
                'category_name' => $request->up_name,
                'category_image' => $imageName,
            ]);
            return response()->json([
                'status' => 'success',
            ]);
        }

    }elseif($request->up_name){
        CategoryModel::where('id', $request->up_id)->update([
            'category_name' => $request->up_name,

        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }elseif($request->hasFile('up_image')){
        $imageName = $request->up_name.'.'.$request->up_image->extension();
        // $imageName = $request->up_name . '.' . $request->up_image->getClientOriginalExtension();
        $request->up_image->move(public_path('category_images'), $imageName);
        CategoryModel::where('id', $request->up_id)->update([

            'category_image' => $imageName,
        ]);
        $imageUrl = asset('category_images/' . $imageName);
        return response()->json([
            'status' => 'success',
            'image_url' => $imageUrl,
        ]);
    }

    }
    function trashed_categories(){
        $data = CategoryModel::onlyTrashed()->get();
        return view('admin.Categories.trashed_categories',[
            'data'=>$data,
        ]);
    }
    function category_restore($id){
        CategoryModel::withTrashed()->find($id)->restore();

        return back()->with('success','Restored Data  Successfully');
    }
    function kumo_homepage(){
        return view('Frontend.first_page');
    }
}
