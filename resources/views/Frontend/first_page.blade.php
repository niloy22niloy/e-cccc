@extends('Frontend.frontend_asset')
@section('content')
<section class="p-0">
    
    <div class="container">
        
        <div class="row">

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                <div class="killore-new-block-link border mb-3 mt-3">
                    <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>

                    <div class="killore--block-link-content">
                        <ul>
                            @forelse($categories as $category)
                            {{-- <li><a href="javascript:void(0);"><i class="fas fa-tshirt"></i>{{$category->category_name}}</a></li> --}}
                            <li><a href="javascript:void(0);"><img src="{{asset('category_images/'.$category->category_image)}}" style="width:50px;" class="img-fluid" alt="">{{$category->category_name}}</a></li>
                            @empty
                            <div class="alert alert-primary mt-4" role="alert">
                                No Top category Added yet
                              </div>
                            @endforelse
                            
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <div class="home-slider auto-slider mb-3 mt-3">

                    <!-- Slide -->
                    @forelse($top_banners as $top_banner)

                                            <div data-background-image="{{asset('Banner/Top_banner/'.$top_banner->top_banner_img)}}" style="" class="item">
                       
                    </div>
                    @empty

                    <div class="alert alert-primary" role="alert">
                        No Top Banner Added Yet! Add The Top Banner
                      </div>
                  
                    @endforelse

                    <!-- Slide -->
                   

                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======================= Category & Slider ======================== -->

<!-- ======================= Product List ======================== -->
<section class="middle">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Trendy Products</h2>
                    <h3 class="ft-bold pt-3">Our Trending Products</h3>
                </div>
            </div>
        </div>

        <div class="row align-items-center rows-products">
            <!-- Single -->
            @foreach($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                <div class="product_grid card b-0">
                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                    <div class="card-body p-0">
                        <div class="shop_thumb position-relative">
                            <a class="card-img-top d-block overflow-hidden" href="{{route('single_product.details',$product->slug)}}"><img class="card-img-top" src="{{asset('Products/product_preview/'.$product->preview)}}" alt="..."></a>
                            
                        </div>
                    </div>
                    <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                        <div class="text-left">
                            <div class="text-left">
                                <div class="elso_titl"><span class="small">{{$product->rel_to_category->category_name}}</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1"><a href="">{{$product->product_name}}</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">Tk {{number_format($product->after_discount,2,'.')}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Single -->
            

            <!-- Single -->
            

        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="position-relative text-center">
                    <a href="{{route('search')}}" class="btn stretched-link borders">Explore More<i class="lni lni-arrow-right ml-2"></i></a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ======================= Product List ======================== -->

<!-- ======================= Brand Start ============================ -->
<section class="py-3 br-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="smart-brand">
                     @forelse($brands as $brand)
                    <div class="single-brnads">
                        <img src="{{asset('Brand_name/'.$brand->brand_images)}}" class="img-fluid" alt="" />
                    </div>
                    @empty
                    @endforelse

                   


                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Brand Start ============================ -->

<!-- ======================= Tag Wrap Start ============================ -->
@if(isset($middlebanner))
<section class="bg-cover" style="background:url('{{ asset('Banner/Middle_Banner/' . $middlebanner->middle_banner) }}') no-repeat">
    <div class="ht-60"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="tags_explore text-center">
                    <h2 class="mb-0 text-white ft-bold">Big Sale Up To 70% Off</h2>
                    <p class="text-light fs-lg mb-4">Exclussive Offers For Limited Time</p><p>
                    <a href="#" class="btn btn-lg bg-white px-5 text-dark ft-medium">Explore Your Order</a>
                </p></div>
            </div>
        </div>
    </div>
    <div class="ht-60"></div>
</section>
@else
<div class="alert alert-primary text-center" role="alert">
    No Middle Banner
  </div>

@endif
<!-- ======================= Tag Wrap Start ============================ -->

<!-- ======================= All Category ======================== -->
<section class="middle">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Popular Categories</h2>
                    <h3 class="ft-bold pt-3">Trending Categories</h3>
                </div>
            </div>
        </div>

        <div class="row align-items-center justify-content-center">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/headphones.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Headphones</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/watch.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Watches</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/washing-machine.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Washing Machine</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/cell-phone.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">iPhones</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/safety-goggles.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Goggles</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/camera.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Video Camera</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/fashion.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Men's Wear</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/tshirt.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Kid's Wear</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/accessories.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Accessories</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/sneakers.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Men's Shoes</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/television.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Television</a></h6></div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="assets/img/pant.png" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Men's Pants</a></h6></div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ======================= All Category ======================== -->

<!-- ======================= Customer Review ======================== -->
<section class="gray">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Testimonials</h2>
                    <h3 class="ft-bold pt-3">Client Reviews</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                <div class="reviews-slide px-3">

                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="assets/img/team-1.jpg" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">Mark Jevenue</h4>
                                <span class="fs-sm">CEO of Addle</span>
                            </div>
                        </div>
                    </div>

                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="assets/img/team-2.jpg" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">Henna Bajaj</h4>
                                <span class="fs-sm">Aqua Founder</span>
                            </div>
                        </div>
                    </div>

                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="assets/img/team-3.jpg" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">John Cenna</h4>
                                <span class="fs-sm">CEO of Plike</span>
                            </div>
                        </div>
                    </div>

                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="assets/img/team-4.jpg" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">Madhu Sharma</h4>
                                <span class="fs-sm">Team Manager</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Customer Review ======================== -->

<!-- ======================= Top Seller Start ============================ -->
<section class="space min">
    <div class="container">

        <div class="row">

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="top-seller-title"><h4 class="ft-medium">Top Seller</h4></div>
                <div class="ftr-content">

                    <!-- Single Item -->
                    @forelse($top_selling_products as $top_selling)
                    <?php
                    $product = App\Models\ProductsModel::find($top_selling->product_id);
                    
                    ?>
                   
                   <div class="product_grid row">
                    <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                        <div class="shop_thumb position-relative">
                            <a class="card-img-top d-block overflow-hidden" href="{{route('single_product.details',$product->slug)}}"><img class="card-img-top" src="{{asset('Products/product_preview/'.$product->preview)}}" alt="..."></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                        <div class="text-left mfliud">
                            <div class="elso_titl"><span class="small">{{$product->rel_to_category->category_name}}</span></div>
                            <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('single_product.details',$product->slug)}}">{{$product->product_name}}</a></h5>
                            <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                <?php
                                 $asd = App\Models\OrderProdcut::where('product_id',$product->id)->where('star','!=',null)->get();
                                 $totalOrders =  $asd->count();
                                 $total_star = 0;
                                 $people = 0;
                                
                                ?>
                                @foreach($asd as $as)
                                
                                
                                
                                <?php
                                $strr = $as->star;
                                  
                                
                                $total_star +=$as->star;
                                $people += $as->id;

                                
                                ?>
                              
                                @endforeach
                                @if($total_star>0)
                                <?php

                                 $ratings = round($total_star/$totalOrders);
                                ?>
                                @endif
                               
                                
                                @if($totalOrders > 0)
                                <?php $ratings = round($total_star / $totalOrders); ?>
                                @for($i = 1; $i <= $ratings; $i++) 
                                    <i class="fas fa-star filled"></i>
                                @endfor
                            @else
                                {{-- Display something when there are no ratings --}}
                                No Rating
                            @endif
                               
                            </div>
                            <div class="elis_rty"><span class="ft-bold text-dark fs-sm">TK{{number_format($product->after_discount,'2','.',',')}}</span></div>
                        </div>
                    </div>
                </div>
                    
                    @empty
                    @endforelse
                    

                    <!-- Single Item -->
                

                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="ftr-title"><h4 class="ft-medium">Featured Products</h4></div>
                <div class="ftr-content">
                    <!-- Single Item -->
                    @forelse($featurd_products as $featured_product)
                    <div class="product_grid row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="{{route('single_product.details',$featured_product->slug)}}"><img class="card-img-top" src="{{asset('Products/product_preview/'.$featured_product->preview)}}" alt="..."></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                            <div class="text-left mfliud">
                                <div class="elso_titl"><span class="small">{{$featured_product->rel_to_category->category_name}}</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('single_product.details',$featured_product->slug)}}">{{$featured_product->product_name}}</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    <?php
                                     $asd = App\Models\OrderProdcut::where('product_id',$featured_product->id)->where('star','!=',null)->get();
                                     $totalOrders =  $asd->count();
                                     $total_star = 0;
                                     $people = 0;
                                    
                                    ?>
                                    @foreach($asd as $as)
                                    
                                    
                                    
                                    <?php
                                    $strr = $as->star;
                                      
                                    
                                    $total_star +=$as->star;
                                    $people += $as->id;

                                    
                                    ?>
                                  
                                    @endforeach
                                    @if($total_star>0)
                                    <?php

                                     $ratings = round($total_star/$totalOrders);
                                    ?>
                                    @endif
                                   
                                    
                                    @if($totalOrders > 0)
                                    <?php $ratings = round($total_star / $totalOrders); ?>
                                    @for($i = 1; $i <= $ratings; $i++) 
                                        <i class="fas fa-star filled"></i>
                                    @endfor
                                @else
                                    {{-- Display something when there are no ratings --}}
                                    No Rating
                                @endif
                                   
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">TK{{number_format($featured_product->after_discount,'2','.',',')}}</span></div>
                            </div>
                        </div>
                    </div>
                    @empty
                    No Featured Product Added Yet
                    @endforelse

                    
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="ftr-title"><h4 class="ft-medium">Top View Products</h4></div>
                <div class="ftr-content">
                    
                        
                    @forelse ($top_view_product as $top_viewed)
                        
                    
                        
                    
                    <!-- Single Item -->
                    <div class="product_grid row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="{{route('single_product.details',$top_viewed->slug)}}"><img class="card-img-top" src="{{asset('Products/product_preview/'.$top_viewed->preview)}}" alt="..."></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                            <div class="text-left mfliud">
                                <div class="elso_titl"><span class="small">{{$top_viewed->rel_to_category->category_name}}</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('single_product.details',$top_viewed->slug)}}">{{$top_viewed->product_name}}</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                   <?php
                                     $asd = App\Models\OrderProdcut::where('product_id',$top_viewed->id)->where('star','!=',null)->get();
                                     $totalOrders =  $asd->count();
                                     $total_star = 0;
                                     $people = 0;
                                    
                                    ?>
                                    @foreach($asd as $as)
                                    
                                    
                                    
                                    <?php
                                    $strr = $as->star;
                                      
                                    
                                    $total_star +=$as->star;
                                    $people += $as->id;

                                    
                                    ?>
                                  
                                    @endforeach
                                    @if($total_star>0)
                                    <?php

                                     $ratings = round($total_star/$totalOrders);
                                    ?>
                                    @endif
                                   
                                    
                                    @if($totalOrders > 0)
                                    <?php $ratings = round($total_star / $totalOrders); ?>
                                    @for($i = 1; $i <= $ratings; $i++) 
                                        <i class="fas fa-star filled"></i>
                                    @endfor
                                @else
                                    {{-- Display something when there are no ratings --}}
                                    No Rating
                                @endif
                                    
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">TK {{ number_format($top_viewed->after_discount, 2, '.', ',') }}
                                </span></div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                   
                    

                    
                </div>
            </div>

        </div>

    </div>
</section>
<!-- ======================= Top Seller Start ============================ -->

<!-- ======================= Customer Features ======================== -->
<section class="px-0 py-3 br-top">
    <div class="container">
        <div class="row">

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Free Shipping</h5>
                        <span class="text-muted">Capped at $10 per order</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="far fa-credit-card"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Secure Payments</h5>
                        <span class="text-muted">Up to 6 months installments</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">15-Days Returns</h5>
                        <span class="text-muted">Shop with fully confidence</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-headphones-alt"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">24x7 Fully Support</h5>
                        <span class="text-muted">Get friendly support</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======================= Customer Features ======================== -->

<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget">
                        <img src="assets/img/logo-light.png" class="img-footer small mb-2" alt="" />

                        <div class="address mt-3">
                            3298 Grant Street Longview, TX<br>United Kingdom 75601
                        </div>
                        <div class="address mt-3">
                            1-202-555-0106<br>help@shopper.com
                        </div>
                        <div class="address mt-3">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="lni lni-youtube"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="lni lni-instagram-filled"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Supports</h4>
                        <ul class="footer-menu">
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">About Page</a></li>
                            <li><a href="#">Size Guide</a></li>
                            <li><a href="#">FAQ's Page</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Shop</h4>
                        <ul class="footer-menu">
                            <li><a href="#">Men's Shopping</a></li>
                            <li><a href="#">Women's Shopping</a></li>
                            <li><a href="#">Kids's Shopping</a></li>
                            <li><a href="#">Furniture</a></li>
                            <li><a href="#">Discounts</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Company</h4>
                        <ul class="footer-menu">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Affiliate</a></li>
                            <li><a href="#">Login</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Subscribe</h4>
                        <p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
                        <div class="foot-news-last">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Email Address">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text b-0 text-light"><i class="lni lni-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="address mt-3">
                            <h5 class="fs-sm text-light">Secure Payments</h5>
                            <div class="scr_payment"><img src="assets/img/card.png" class="img-fluid" alt="" /></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">© 2021 Kumo. Designd By <a href="https://themezhub.com/">ThemezHub</a>.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->




<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


</div>
@if(session('success'))
<script>
    $(document).ready(function () {

        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('success')}}',
  showConfirmButton: false,
  timer: 1500
})

    });
</script>
@endif


@endsection
