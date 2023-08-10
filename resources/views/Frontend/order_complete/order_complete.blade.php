@extends('Frontend.frontend_asset')
@section('content')
<section class="middle">
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                <!-- Icon -->
                <div class="p-4 d-inline-flex align-items-center justify-content-center circle bg-light-success text-success mx-auto mb-4"><i class="lni lni-heart-filled fs-lg"></i></div>
                <!-- Heading -->
                <h2 class="mb-2 ft-bold">Your Order is Completed!</h2>
                <!-- Text -->
                <p class="ft-regular fs-md mb-5">Your order <span class="text-body text-dark">
                    @if(session('order_id'))
                    {{session('order_id')}}
                    @endif
                
                </span> has been completed. Your order details are shown for your personal accont.</p>
                <!-- Button -->
                <a class="btn btn-dark" href="{{url('/')}}">Shop Again</a>
            </div>
        </div>
        
    </div>
</section>
<!-- ======================= Product Detail End ======================== -->

<!-- ============================= Customer Features =============================== -->
<section class="px-0 py-3 br-top">
    <div class="container">
        <div class="row">
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shopping-basket theme-cl"></i>
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
                        <i class="far fa-credit-card theme-cl"></i>
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
                        <i class="fas fa-shield-alt theme-cl"></i>
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
                        <i class="fas fa-headphones-alt theme-cl"></i>
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

<!-- Wishlist -->
<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Wishlist">
    <div class="rightMenu-scroll">
        <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
            <h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
            <button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
        </div>
        <div class="right-ch-sideBar">
            
            <div class="cart_select_items py-2">
                <!-- Single Item -->
                <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                    <div class="cart_single d-flex align-items-center">
                        <div class="cart_selected_single_thumb">
                            <a href="#"><img src="assets/img/product/4.jpg" width="60" class="img-fluid" alt="" /></a>
                        </div>
                        <div class="cart_single_caption pl-2">
                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Women Striped Shirt Dress</h4>
                            <p class="mb-2"><span class="text-dark ft-medium small">36</span>, <span class="text-dark small">Red</span></p>
                            <h4 class="fs-md ft-medium mb-0 lh-1">$129</h4>
                        </div>
                    </div>
                    <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                </div>
                
                <!-- Single Item -->
                <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                    <div class="cart_single d-flex align-items-center">
                        <div class="cart_selected_single_thumb">
                            <a href="#"><img src="assets/img/product/7.jpg" width="60" class="img-fluid" alt="" /></a>
                        </div>
                        <div class="cart_single_caption pl-2">
                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Girls Floral Print Jumpsuit</h4>
                            <p class="mb-2"><span class="text-dark ft-medium small">36</span>, <span class="text-dark small">Red</span></p>
                            <h4 class="fs-md ft-medium mb-0 lh-1">$129</h4>
                        </div>
                    </div>
                    <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                </div>
                
                <!-- Single Item -->
                <div class="d-flex align-items-center justify-content-between px-3 py-3">
                    <div class="cart_single d-flex align-items-center">
                        <div class="cart_selected_single_thumb">
                            <a href="#"><img src="assets/img/product/8.jpg" width="60" class="img-fluid" alt="" /></a>
                        </div>
                        <div class="cart_single_caption pl-2">
                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Girls Solid A-Line Dress</h4>
                            <p class="mb-2"><span class="text-dark ft-medium small">30</span>, <span class="text-dark small">Blue</span></p>
                            <h4 class="fs-md ft-medium mb-0 lh-1">$100</h4>
                        </div>
                    </div>
                    <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                </div>
                
            </div>
            
            <div class="cart_action px-3 py-3">
                <div class="form-group">
                    <button type="button" class="btn d-block full-width btn-dark-light">View Whishlist</button>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection