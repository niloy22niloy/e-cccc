<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Coupon;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    
    function cart_store(Request $request){
     
        if($request->abcd == 2)
        {
            if(Auth::guard('guestlogin')->check()){
                Wishlist::create([
                    'customer_id'=>Auth::guard('guestlogin')->user()->id,
                    'product_id'=>$request->product_id,
                    'color_id'=>$request->color,
                    'size_id'=>$request->size_id,
                    'quantity'=>$request->quantity,
                ]);
                return back()->with('success',"Wisht list Added Successfully");
            }else{
                return back()->with('login','Please Login To Add The Wishlist!!');
            }
            
           
        }
        else{
   if(Auth::guard('guestlogin')->check()){
        CartModel::create([
            'customer_id'=>Auth::guard('guestlogin')->id(),
            'product_id'=>$request->product_id,
            'color_id'=>$request->color,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
        ]);
        return back()->with('success',"cart Added Successfully");
       }else{
        return back()->with('login','Please Login To Add The Cart!!');
       }
    }

}

function cart_item_delete($id){
    CartModel::find($id)->delete();
    return back()->with('cart_item_delete','Cart Item Deleted Successfully');
}
// function delete_selected_carts(Request $request){
//     echo "hello";
// }
function delete_selected_cart(Request $request){
    $ids = $request->ids;

    // Convert the string of IDs to an array
    $idArray = explode(",", $ids);
    
    // Soft delete the records
    CartModel::whereIn('id', $idArray)->delete();
   
    
    return response()->json(['success' => "successfully Deleted."]);
}

function view_cart(Request $request)
{
     $date = date('Y-m-d');
    $carts = CartModel::where('customer_id', Auth::guard('guestlogin')->id())->get();

    $coupon_code = $request->coupon;
     $discount = 0;
     $message = '';
     $type = '';
    if($coupon_code == ''){
        $discount = 0;
    }else{
        if(Coupon::where('coupon_code',$coupon_code )->exists()){
            if($date>Coupon::where('coupon_code',$coupon_code )->first()->validity){
                $discount = 0;
                $message = 'Validity is over';
            }else{
                $discount = Coupon::where('coupon_code',$coupon_code )->first()->discount_amount;
                
               $type =  Coupon::where('coupon_code',$coupon_code )->first()->type;
            }
            
        }else{
            $discount = 0;
            $message = 'Invalid Coupon Code';
        }
    }

    return view('Frontend.cart.cart', [
        'carts' => $carts,
        'coupon_code' => $coupon_code,
        'discount'=>$discount,
        'message'=>$message,
        'type'=>$type,
    ]);
}
function update_cart(Request $request){
    foreach($request->quantity as $cart_id=>$quantity){
       
        CartModel::find($cart_id)->update([
            'quantity'=>$quantity,
        ]);
        
    }
    return back()->with('success',"Cart Updated Successfully");
}
}
