<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\GuestLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilePageController extends Controller
{
    //
    function user_profile_page(){
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        return view('Frontend.Profile.profile',[
            'carts'=>$carts,
        ]);
    }
    function profile_update(Request $request){
           GuestLogin::find(Auth::guard('guestlogin')->user()->id)->update([
             'name'=>$request->name,
             'email'=>$request->email,
             'password'=>bcrypt($request->new_password),
             'country'=>$request->country,
             'address'=>$request->address,
           ]);
           return back()->with('success',"Successfully Updated Data");
    }
}
