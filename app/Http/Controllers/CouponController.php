<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    function add_coupon(){
       $coupons =  Coupon::all();
        return view('admin.Coupon.add_coupon',[
            'coupons'=>$coupons,
        ]);
    }
    function coupon_store(Request $request){
              

        $request->validate([
            'coupon_code' => 'required|unique:coupons',
            'type' => 'required',
            'validity' => 'required',
        ]);
       
       if($request->discount_amount){
        Coupon::create([
            'coupon_code'=>$request->coupon_code,
            'type'=>$request->type,
            'discount_amount'=>$request->discount_amount,
            'validity'=>$request->validity,

        ]);
        return back()->with('success',"Successfully Coupon Added");
       }else{
        Coupon::create([
            'coupon_code'=>$request->coupon_code,
            'type'=>$request->type,
            'discount_amount'=>$request->discount_amount_per,
            'validity'=>$request->validity,

        ]);
        return back()->with('success',"Successfully Coupon Added");
       }
      
    }
}
