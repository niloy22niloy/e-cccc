<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderListController extends Controller
{
    //
    function customer_order_list(){
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        $orders = Order::where('customer_id',Auth::guard('guestlogin')->user()->id)->get();
        return view('Frontend.customer_order_list.order_list',[
            'carts'=>$carts,
            'orders'=>$orders,
        ]);
    }
}
