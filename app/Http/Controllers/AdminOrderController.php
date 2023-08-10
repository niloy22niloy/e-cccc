<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    function orders_lists(){
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.Orders.order_list',[
            'orders'=>$orders,
        ]);
    }
    function order_status(Request $request){
        if($request->query('value') ==0 ){
            $order_id = $request->query('order_id');
            Order::where('order_id',$order_id)->first()->update([
                'status'=>null,
            ]);
            return back();
        }
        elseif($request->query('value') ==1 ){
            $order_id = $request->query('order_id');
            Order::where('order_id',$order_id)->first()->update([
                'status'=>1,
            ]);
            return back();
        }
        elseif($request->query('value') ==2 ){
            $order_id = $request->query('order_id');
            Order::where('order_id',$order_id)->first()->update([
                'status'=>2,
            ]);
            return back();
        }
        elseif($request->query('value') ==3 ){
            $order_id = $request->query('order_id');
            Order::where('order_id',$order_id)->first()->update([
                'status'=>3,
            ]);
            return back();
        }
        elseif($request->query('value') ==4){
            $order_id = $request->query('order_id');
            Order::where('order_id',$order_id)->first()->update([
                'status'=>4,
            ]);
            return back();
        }
      
     
    }
    
}
