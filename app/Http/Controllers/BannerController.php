<?php

namespace App\Http\Controllers;

use App\Models\brandModel;
use App\Models\MiddleBanner;
use App\Models\TopBannerModel;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    function top_banners_add(){
        $top_banners = TopBannerModel::all();
        return view('admin.Banner.top_banner',[
            'top_banners'=>$top_banners,
        ]);
    }
    function add_top_banner(Request $request){
      
        $timestamp = time();
        if($request->top_banner){

            $imageName = $timestamp .'.'.$request->top_banner->extension();

        // Public Folder
        $request->top_banner->move(public_path('Banner/Top_banner'), $imageName);
            TopBannerModel::create([
                'top_banner_img'=>$imageName,
                'status'=>$request->status,


            ]);
            return back()->with('success','Banner Inserted Successfully');
        }
    }
    function top_banner_turn_off($id){
        TopBannerModel::find($id)->update([
            'status'=>0,
        ]);
        return back()->with('success','Successfully Turn Of');

    }
    function top_banner_turn_onn($id){
        TopBannerModel::find($id)->update([
            'status'=>1,
        ]);
        return back()->with('success','Successfully Turn ON');
    }
    function brand_add(){
        $brands = brandModel::all();
        return view('admin.Brand.brand',[
            'brands'=>$brands,
        ]);
    }
    function add_brand(Request $request){
   
        $timestamp = time();
        if($request->brand_name){

            $imageName = $timestamp .'.'.$request->brand_name->extension();

        // Public Folder
        $request->brand_name->move(public_path('Brand_name'), $imageName);
            brandModel::create([
                'brand_images'=>$imageName,
                'status'=>$request->status,


            ]);
            return back()->with('success','Brand Inserted Successfully');
    }
}
function middle_banner(){
           $middlebanner =  MiddleBanner::first();
    return view('admin.Banner.middle_banner',[
        'middlebanner'=>$middlebanner,
    ]);
}
function add_middle_banner(Request $request){
   $count =  MiddleBanner::count();
     $midd = MiddleBanner::first();
     
    $timestamp = time();
    if($request->middle_banner){
        if($count<1){
            $imageName = $timestamp .'.'.$request->middle_banner->extension();

            // Public Folder
            $request->middle_banner->move(public_path('Banner/Middle_Banner'), $imageName);
                MiddleBanner::create([
                    'middle_banner'=>$imageName,
                    
        
        
                ]);
                return back()->with('success','Banner Inserted Successfully');
        }elseif($count==1){
            $imageName = $timestamp .'.'.$request->middle_banner->extension();

            // Public Folder
            $request->middle_banner->move(public_path('Banner/Middle_Banner'), $imageName);
                MiddleBanner::find($midd->id)->update([
                    'middle_banner'=>$imageName,
                    
        
        
                ]);
                return back()->with('success','Banner Updated Successfully');
        }

        
    }
}
}
