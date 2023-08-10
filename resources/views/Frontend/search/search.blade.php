@extends('Frontend.frontend_asset')
@section('content')
<section class="bg-cover" style="background: url('{{asset('Frontend_assets/img/banner-2.png')}}') no-repeat;">
    
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-left py-5 mt-3 mb-3">
                    <h1 class="ft-medium mb-3">Shop</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Shop Style 1 ======================== -->


<!-- ======================= Filter Wrap Style 1 ======================== -->
<section class="py-3 br-bottom br-top">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Women's</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ============================= Filter Wrap ============================== -->


<!-- ======================= All Product List ======================== -->
<section class="middle">
    <div class="container">
        <div class="row">
            
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
                <div class="search-sidebar sm-sidebar border">
                    <div class="search-sidebar-body">
                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false" role="button">Pricing</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
                                <div class="row">
                                    <div class="col-lg-6 pr-1">
                                        <div class="form-group pl-3">
                                            <input type="number" id="min" class="form-control" placeholder="Min">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pl-1">
                                        <div class="form-group pr-3">
                                            <input type="number" id="max" class="form-control" placeholder="Max">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group px-3">
                                            <a id="price_btn"  type="submit" class="btn form-control">Submit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#Categories" data-toggle="collapse" aria-expanded="false" role="button">Categories</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="Categories" data-parent="#Categories">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    @forelse($categories_all as $categories)
                                                    <li>
                                                        <input id="category{{$categories->id}}" class="category_id" value="{{$categories->id}}" name="category" type="radio">
                                                        <label for="category{{$categories->id}}" class="checkbox-custom-label">{{$categories->category_name}}<span>{{App\Models\ProductsModel::where('category_id',$categories->id)->count()}}</span></label>
                                                    </li>
                                                    @empty
                                                    No Category Found
                                                    @endforelse
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#brands" data-toggle="collapse" aria-expanded="false" role="button">Brands</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="brands" data-parent="#brands">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    @forelse($Brands as $Brand)
                                                    <li>
                                                        <input id="brands{{$Brand->id}}" class="brand" name="brands" type="radio" value="{{$Brand->id}}" 
                                                        >
                                                        {{-- {{$Brand->id == @$_GET['brands']? 'checked' : '' }} --}}
                                                        <label for="brands{{$Brand->id}}" class="checkbox-custom-label">{{$Brand->brand_name}}<span>
                                                          {{App\Models\ProductsModel::where('brand',$Brand->id)->count()}}  
                                                        </span></label>
                                                    </li>
                                                    @empty
                                                    No Brand 
                                                    @endforelse
                                                    
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#colors" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Colors</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="colors" data-parent="#colors">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="text-left">
                                                @forelse($colors as $color)
                                                <div class="form-check form-option form-check-inline mb-1">
                                                    
                                                    <input class="color_id" type="radio" name="color" id="white{{$color->id}}" value="{{$color->id}}">
                                                    <label class="form-option-label rounded-circle" for="white{{$color->id}}"><span class="form-option-color rounded-circle blc{{$color->color_code}}" style="background-color:{{$color->color_code}};"></span></label>
                                                </div>
                                                @empty
                                                No Color
                                                @endforelse
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#size" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Size</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse" id="size" data-parent="#size">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="text-left pb-0 pt-2">
                                                @forelse($sizes as $size)
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input class="size_id" type="radio" name="sizes" id="{{$size->id}}" value="{{$size->id}}">
                                                    <label class="form-option-label" for="{{$size->id}}">{{$size->size_name}}</label>
                                                </div>
                                                @empty

                                                @endforelse
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="border mb-3 mfliud">
                            <div class="row align-items-center py-2 m-0">
                                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                                    <h6 class="mb-0">Searched Products Found:
                                        
                                    
                                  
                                        
                                    </h6>
                                </div>
                                
                                <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                    <div class="filter_wraps d-flex align-items-center justify-content-end m-start">
                                        <div class="single_fitres mr-2 br-right">
                                            <select class="custom-select simple" id="sort">
                                              <option value="" selected="">Default Sorting</option>
                                              <option value="1">Sort by A-Z</option>
                                              <option value="2">Sort by Z-A</option>
                                              <option value="3">Sort by Low Price</option>
                                              <option value="4">Sort by high price</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- row -->
                <div class="row align-items-center rows-products">

                    @forelse($all_products as $all_product)
                    
                    <!-- Single -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">
                            <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">{{$all_product->rel_to_category->category_name}}</div>
                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="{{asset('Products/product_preview/'.$all_product->preview)}}" alt="..."></a>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-0 pt-2 bg-white">
                                   
                                <div class="text-left">
                             
                                    <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">{{$all_product->product_name}}</a></h5>
                                    <div class="elis_rty"><span class="ft-bold text-dark fs-sm">TK {{number_format($all_product->after_discount)}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    
                    @empty

                    No Product Found
                    @endforelse
                    
                
                    
                </div>
                <!-- row -->
            </div>
        </div>
    </div>
</section>
<!-- ======================= All Product List ======================== -->

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
<script>
    $(document).ready(function () {
        $('#search_btn').click(function () {
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[class="color_id"]:checked').val();
            var size_id = $('input[class="size_id"]:checked').val();
            var sort = $('#sort').val();
            var brand = $('input[class="brand"]:checked').val();
            
           
            
            
            var link = '{{ route('search') }}?q=' + search_input + '&min=' + min + '&max=' + max + '&category=' + category_id + '&color_id=' + color_id + '&size_id=' + size_id + '&sort=' + sort + '&brands=' + brand;
            window.location.href = link;
        });

        $('.category_id').click(function () {
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[class="color_id"]:checked').val();
            var size_id = $('input[class="size_id"]:checked').val();
            var sort = $('#sort').val();
            var brand = $('input[class="brand"]:checked').val();
            
           
            
            
            var link = '{{ route('search') }}?q=' + search_input + '&min=' + min + '&max=' + max + '&category=' + category_id + '&color_id=' + color_id + '&size_id=' + size_id + '&sort=' + sort + '&brands=' + brand;
            window.location.href = link;
        });
        $('#price_btn').click(function () {
            
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            
            
            var link = '{{ route('search') }}?q=' + search_input + '&min=' + min + '&max=' + max;
            window.location.href = link;
        });
    });
    </script>
    
@endsection