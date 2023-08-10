<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    function wishlist(){
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        $wishlists = Wishlist::where('customer_id',Auth::guard('guestlogin')->user()->id)->get();
        return view('frontend.wishlist.wishlist',[
            'carts'=>$carts,
            'wishlists'=>$wishlists,
        ]);
    }
    function wishlist_cancel($id){
        Wishlist::find($id)->delete();
        return back()->with('success',"wishlist's Item Deleted successfully");
    }
}
