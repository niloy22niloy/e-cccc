<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\GuestLogin;
use App\Models\Inventory;
use App\Models\OrderProdcut;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    function single_product_details($slug){
          
        $single_product = ProductsModel::where('slug',$slug)->first();
        if ($single_product) {
            // Increment the views count by 1
            $single_product->views++;
            $single_product->save();
        }
        $matching_product = ProductsModel::where('category_id',$single_product->category_id)->where('id','!=',$single_product->id)->get();
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
         $reviews = OrderProdcut::where('product_id',$single_product->id)->where('review','!=',null)->get();
         
         $totalFound = 0;

         foreach ($reviews as $review) {
             $ggg = GuestLogin::find($review->customer_id);
             if ($ggg) {
                 // Increment the count for each found record in GuestLogin
                 $totalFound++;
             }
         }
         
         $totalFound;
        $total_reviews = OrderProdcut::where('product_id',$single_product->id)->where('review','!=',null)->count();
        $total_star = OrderProdcut::where('product_id',$single_product->id)->where('review','!=',null)->sum('star');
        
        return view('Frontend.Products.single_product',[
            'single_product'=>$single_product,
            'matching_product'=>$matching_product,
            'carts'=>$carts,
            'reviews'=>$reviews,
            'total_reviews'=>$total_reviews,
            'total_star'=>$total_star,
            'totalFound'=>$totalFound,
            
        ]);
    }
    function getSize(Request $request){
         $request->product_id;
        $sizes =  Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str = '';
        foreach($sizes as $size){
         
            $str .= '<div class="form-check size-option form-option form-check-inline mb-2">
            <input class="form-check-input" type="radio" name="size_id" id=" '.$size->size_id.' "  value=" '. $size->size_id .'">
            <label class="form-option-label" for=" '.$size->size_id.' ">'.$size->rel_to_size->size_name.'</label>
        </div>';
        }
        echo $str;

       
    }
}
