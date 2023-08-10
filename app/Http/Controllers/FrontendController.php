<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\brandModel;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\MiddleBanner;
use App\Models\OrderProdcut;
use App\Models\ProductsModel;
use App\Models\TopBannerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    //
        function kumo_homepage(){
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        $products =  ProductsModel::all();
        $top_view_product = ProductsModel::orderBy('views', 'desc')->take(3)->get();
        $featurd_products = ProductsModel::where('featured_product',1)->get();
        $top_banners = TopBannerModel::where('status',1)->get();
        $brands = brandModel::all();
        $middlebanner = MiddleBanner::first();
        
    //     $top_selling_products = OrderProdcut::select('product_id')
    // ->groupBy('product_id')
    // ->orderByRaw('COUNT(*) DESC')
    // ->take(3)->get();
      $top_selling_products = DB::table('order_prodcuts')
    ->select('product_id')
    ->whereExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('products_models')
            ->whereColumn('products_models.id', 'order_prodcuts.product_id');
    })
    ->groupBy('product_id')
    ->orderByRaw('COUNT(*) DESC')
    ->take(3)
    ->get();
   
   
    // foreach($top_selling_products as $top_sell)
    // {
    //     if(ProductsModel::where('id',$top_sell->product_id)->exists()){
    //         echo $top_sell->product_id;
    //     }elseif(ProductsModel::where('id','!=',$top_sell->product_id)){
    //         $non_existing_product_ids[] = $top_sell->product_id;
    //     }
    // }
    // echo count($non_existing_product_ids);
    
    
        $categories = CategoryModel::all();
        return view('Frontend.first_page',[
            'categories'=>$categories,
            'products'=>$products,
            'carts'=>$carts,
            'top_view_product'=>$top_view_product,
            'featurd_products'=>$featurd_products,
            'top_selling_products'=>$top_selling_products,
            'top_banners'=>$top_banners,
            'brands'=>$brands,
            'middlebanner'=>$middlebanner,
        ]);
    }
}
