<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\Subcategory;
use App\Models\ProductsModel;
use App\Models\Inventory;
use App\Models\Color;
use App\Models\Size;
Use Str;


class AddProductController extends Controller
{
    //
    function add_product(){
        $brands = Brand::all();
       $categories =  CategoryModel::all();
      $subcategories =  Subcategory::all();
        return view('admin.products.add_product',[
                  'categories'=>$categories,
                  'subcategories'=>$subcategories,
                  'brands'=>$brands,
        ]);
    }
    function getsubcategory(Request $request){
        $str = '<option value="">---Select Sub-Category---</option>';

          $subcategories =  Subcategory::where('category_id',$request->category_id)->get();
          foreach($subcategories as $sub){
              $str .='<option value="'.$sub->id.'">' .$sub->subcategory_name. '</option>';
          }
          echo $str;
    }

    function add(Request $request){
         
        $request->validate([


            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'product_preview'=>'required',
            'product_thumbnail'=>'required',

        ],[
           'category_id.required'=>'Select The Category Please',
           'subcategory_id.required'=>'Select The Sub-Category Please',
        ]

        );

        $product_price = $request->product_price;
        $discount =  $request->discount;
        $actual_discount = ($request->discount/100);
        $abc = $product_price*$actual_discount;
        $after_discount_price = $product_price-$abc;
        // Product preview image
        $random_numbers = rand(100000, 9999999);
        $product_preview = $request->product_name.'_' .$random_numbers. '.' .$request->product_preview->extension();
        // Public Folder
         $request->product_preview->move(public_path('Products/product_preview'), $product_preview);

        //Thumbnail Image
        $random_number = rand(1000, 9999);
        $thumbnail = $request->product_name . '_' . $random_number . '.' . $request->product_thumbnail->extension(); // add the random number to the filename

        // Public Folder
        $request->product_thumbnail->move(public_path('Products/product_thumbnail'), $thumbnail);

        ProductsModel::create([
             'category_id'=>$request->category_id,
             'subcategory_id'=>$request->subcategory_id,
             'product_name'=>$request->product_name,
             'price'=>$request->product_price,
             'discount'=>$request->discount,
             'after_discount'=>$after_discount_price,
             'brand'=>$request->product_brand,
             'short_description'=>$request->short_description,
             'long_description'=>$request->long_description,
             'preview'=>$product_preview,
             'thumbnail'=>$thumbnail,
             'slug'=>str_replace(' ','-',Str::lower($request->product_name)).'-'.rand(100000,999999),
        ]);
        return back()->with('success',"Product Added Successfully");
    }
    function show_products(){
        $categories = CategoryModel::all();
        return view('admin.products.show_categoriewise',[
            'categories'=>$categories,
        ]);
    }
    function add_brand(){
       $brands =  Brand::all();
        return view('admin.products.add_brand',[
            'brands'=>$brands,
        ]);
    }
    function brand_add(Request $request){

        $request->validate([


            'brand_name' => 'required|unique:brands,brand_name',
          

        ]);
        if($request->brand_image){
            
            $imageName = $request->brand_name.'.'.$request->brand_image->extension();

            // Public Folder
            $request->brand_image->move(public_path('Brand'), $imageName);
            Brand::create([
                'brand_name'=>$request->brand_name,
                'brand_image'=>$imageName,
            ]);
            return back()->with('success',"successfully Brand Added");
        }
       
    }
    function categorywise_products($id){

        $show_product_list= ProductsModel::where('category_id',$id)->get();
        return view('admin.products.show_product_list',[
        'show_product_list'=>$show_product_list,
        'id'=>$id,
        ]);

    }
    function show_the_product($name,$id){
        
       $product_details =  ProductsModel::find($id);
        return view('admin.products.product_detais',[
            'product_details'=>$product_details,
        ]);
    }
    function add_inventory($name,$id){
        $inventories = Inventory::where('product_id',$id)->get();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.add_inventory',[
         'name'=>$name,
         'id'=>$id,
         'colors'=>$colors,
         'sizes'=>$sizes,
         'inventories'=>$inventories,
        ]);
    }
    function add_variation(){
        $color = Color::all();
        $sizes = Size::all();
        return view('admin.products.add_variation',[
           'color'=>$color,
           'sizes'=>$sizes,
        ]);
    }
    function add_color(Request $request){
         Color::create([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
         ]);
         return back();
    }
    function add_sizes(Request $request){

        Size::create([
          'size_name'=>$request->sizes,
        ]);
        return back();
    }
    //adding Inventory
    function add_inventory_store(Request $request){
        Inventory::create([
                 'product_id'=>$request->product_id,
                 'color_id'=>$request->color_id,
                 'size_id'=>$request->size_id,
                 'quantity'=>$request->quantity,
        ]);
        return back();
    }
    function all_inventories(){
        $categories = CategoryModel::all();
        return view('admin.products.all_inventory_list',[
            'categories'=>$categories,
        ]);
    }
    function inventorybase_productshow($id){
        $ca = ProductsModel::where('category_id', $id)->get();
        $inventoriesArr = [];
        foreach ($ca as $c) {
            $inventories = Inventory::where('product_id', $c->id)->get();
            foreach ($inventories as $in) {
                $inventoriesArr[] = $in;

            }
        }
        return view('admin.products.inventories', [
            'inventories' => $inventoriesArr,
            'id'=>$id,
        ]);


}
function deleted_selected(Request $request){


    $ids = $request->ids;
    CategoryModel::whereIn('id',explode(",",$ids))->delete();
    return response()->json(['success'=>"Products Deleted successfully."]);

}
function deleted_selected_subcategory(Request $request){

    $ids = $request->ids;
    $nameArray = explode(",", $ids);

// Retrieve subcategory names
    $subcategories = Subcategory::whereIn('id', $nameArray)->get();
    $subNames = $subcategories->pluck('subcategory_name')->toArray();

// Delete subcategories based on IDs
    Subcategory::whereIn('id', $nameArray)->delete();

// Generate success message
    $successMessage = "Subcategories ('" . implode("', '", $subNames) . "') deleted successfully.";

    return response()->json(['success' => $successMessage]);

}
function add_featured($id){
   $featured_product =  ProductsModel::find($id);
   if($featured_product){
    $featured_product->featured_product = 1;

    // Save the changes to the database
    $featured_product->save();
    return back()->with('success',$featured_product->product_name."add to the featured Product");
   }
  
   
}
function remove_featured($id){
    $featured_product =  ProductsModel::find($id);
   if($featured_product){
    $featured_product->featured_product = 0;

    // Save the changes to the database
    $featured_product->save();
    return back()->with('success',$featured_product->product_name." remove from the featured Product");
   }
}


}
