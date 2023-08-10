<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use App\Models\CartModel;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProdcut;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    function checkout_page(Request $request){
        
      
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        $countries = Country::all();
        $after_copoun_discount_price = $request->after_coupon_discount;
        $coupon_name = $request->coupon_name;
        
        return view('Frontend.checkout.checkout',[
            'carts'=>$carts,
            'after_copoun_discount_price'=>$after_copoun_discount_price,
            'countries'=>$countries,
            'coupon_name'=>$coupon_name,
        ]);
    }
    function getCity(Request $request){
         $str = '<option value="">-- Select City --</option>';
         $cities =  City::where('country_id',$request->country_id)->get();
         foreach($cities as $city){
            $str .='<option value="'.$city->id.'">'.$city->name.'</option>';
         }
         echo $str;
    }
    function order_store(Request $request){
        //  return $request->coupon_namee;
// return $request->all();
        $string = $request->name;

        $first_string = strtok($string,  ' ');

       
        if($request->payment_method == 1){
           $sub = $request->subtotal;
           $after_coupon_dis = $request->after_coupon_dis;
           $dis = $sub-$after_coupon_dis;
             $order_id = '#'.$first_string.'-'.rand(999999,111111);
             Order::create([
                  'order_id'=>$order_id,
                  'customer_id'=>Auth::guard('guestlogin')->user()->id,
                  'subtotal'=>$request->subtotal,
                  'discount'=>$dis,
                  'charge'=>$request->charge,
                  'coupon_name'=>$request->coupon_namee,
                  'Total'=>$request->total,
                  'payment_method'=>$request->payment_method,


             ]);
             BillingDetails::create([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('guestlogin')->user()->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'company'=>$request->company,
                'phone'=>$request->mobile_number,
                'address'=>$request->address,
                'zip'=>$request->zip_id,
                'country_id'=>$request->country,
                'city_id'=>$request->city,
                'notes'=>$request->notes,

             ]);
             $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->user()->id)->get();
             foreach($carts as $cart){
                OrderProdcut::create([
                    'order_id'=>$order_id,
                    'customer_id'=>Auth::guard('guestlogin')->user()->id,
                    'product_id'=>$cart->product_id,
                    'price'=>$cart->rel_to_product->after_discount,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'quantity'=>$cart->quantity,

                ]);

                Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)
                ->decrement('quantity',$cart->quantity);
                CartModel::where('customer_id',Auth::guard('guestlogin')->user()->id)->delete();
             }
             Mail::to($request->email)->send(new InvoiceMail($order_id));
             return redirect()->route('order.complete')->with('order_id',$order_id);
        }else if($request->payment_method ==2){
             $data = $request->all();
             return redirect()->route('pay')->with('data',$data);
        }else{
            echo "stripe";
        }
    }
    function order_complete(){
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        if(session('order_id')){
            return view('Frontend.order_complete.order_complete',[
                'carts'=>$carts,
            ]);
        }else{
            return view('errors.404');
        }
        
    }
    function pdf_download($orde){
        return "hello";
        return view('Invoice.invoice');
    }
}
