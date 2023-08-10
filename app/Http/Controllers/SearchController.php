<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\Color;
use App\Models\ProductsModel;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //
    function search(Request $request){
       
        $data = $request->all();
        $min = 1;
        $sorting = 'created_at';
        $type= 'DESC';


        if(isset($data['sort'])){

       
        if($data['sort'] == 1){
            $sorting = 'product_name';
            $type='ASC';

        }elseif($data['sort'] == 2){
             $sorting = 'product_name';
             $type='DESC';
        }elseif($data['sort']==3){
            $sorting = 'after_discount';
            $type= 'ASC';

        }elseif($data['sort']==4){
            $sorting = 'after_discount';
            $type='DESC';
        }
        
        if (isset($data['min']) && $data['min'] !== '') {
            $min = $data['min'];
        }
    }
        
        $all_products = ProductsModel::when(!empty($data['q']) && $data['q'] !== 'undefined', function ($q) use ($data) {
            $q->where(function ($query) use ($data) {
                $query->where('product_name', 'like', '%' . $data['q'] . '%')
                    ->orWhere('short_description', 'like', '%' . $data['q'] . '%');
            });
        })->when((isset($data['min']) && $data['min'] !== 'undefined') || (isset($data['max']) && $data['max'] !== 'undefined'), function ($q) use ($data, $min) {
            $q->whereBetween('after_discount', [$min, $data['max']]);
        })->when((isset($data['category']) && $data['category'] !== 'undefined'), function ($q) use ($data) {
            $q->where('category_id', $data['category']); // Removed square brackets around $data['category']
        })->when((isset($data['brands']) && $data['brands'] !== 'undefined'), function ($q) use ($data) {
            $q->where('brand', $data['brands']); // Removed square brackets around $data['category']
        })->when(((isset($data['color_id']) && $data['color_id'] !== 'undefined') || (isset($data['size_id']) && $data['size_id'] !== 'undefined')), function ($q) use ($data) { // Fixed parentheses
            $q->whereHas('rel_to_inventories', function ($q) use ($data) {
                if ((isset($data['color_id']) && $data['color_id'] !== 'undefined')) {
                    $q->whereHas('rel_to_color', function ($q) use ($data) {
                        $q->where('colors.id', $data['color_id']);
                    });
                }
                if ((isset($data['size_id']) && $data['size_id'] !== 'undefined')) {
                    $q->whereHas('rel_to_size', function ($q) use ($data) {
                        $q->where('sizes.id', $data['size_id']);
                    });
                }
            });
        })->orderBy($sorting,$type)->get();
        

        
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        // $all_products = ProductsModel::all();
        $categories_all = CategoryModel::all();
        $colors = Color::all();
        $sizes = Size::all();
        $Brands = Brand::all();

        return view('Frontend.search.search',[
            'carts'=>$carts,
            'all_products'=>$all_products,
            'categories_all'=>$categories_all,
            'colors'=>$colors,
            'sizes'=>$sizes,
            'Brands'=>$Brands,
        ]);
    }
}
