<?php

namespace App\Http\Controllers;

use App\Models\OrderProdcut;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    function review_store(Request $request){
         $request->image;
         
        
        
        if($request->image == ''){
            OrderProdcut::where('customer_id',$request->customer_id)->where('product_id',$request->product_id)->update([
                'review'=>$request->review,
                'star'=>$request->rating,
            ]);
            return back();
       }else{
        $imageName = $request->customer_id.'.'.$request->image->extension();

            
        $request->image->move(public_path('Review_images'), $imageName);
        OrderProdcut::where('customer_id',$request->customer_id)->where('product_id',$request->product_id)->update([
            'review'=>$request->review,
            'star'=>$request->rating,
            'image'=> $imageName,
        ]);
        return back();

        }
        

    }
}
