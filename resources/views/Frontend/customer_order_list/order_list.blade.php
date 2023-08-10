

@extends('Frontend.frontend_asset')
@section('content')

<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
			<!-- ======================= Top Breadcrubms ======================== -->
			<div class="gray py-3">
				<div class="container">
					<div class="row">
						<div class="colxl-12 col-lg-12 col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">My Order</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= Dashboard Detail ======================== -->
			<section class="middle">
				<div class="container">
					<div class="row align-items-start justify-content-between">
					
						<div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
							<div class="d-block border rounded">
								<div class="dashboard_author px-2 py-5">
									<div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
										<img src="{{ Avatar::create(Auth::guard('guestlogin')->user()->name)->toBase64() }}" class="img-fluid circle" width="100" alt="" />
									</div>
									<div class="dash_caption">
										<h4 class="fs-md ft-medium mb-0 lh-1">Adam Wishnoi</h4>
										<span class="text-muted smalls">Australia</span>
									</div>
								</div>
								
								<div class="dashboard_author">
									<h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
									<ul class="dahs_navbar">
										<li><a href="{{url('customer/order_list')}}" class="active"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
										<li><a href="{{route('wishlist')}}"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
										<li><a href="{{route('user.profile_page')}}"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
										<li><a href="login.html"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
									</ul>
								</div>
								
							</div>
						</div>
						
						<div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
							<!-- Single Order List -->
                           
                            @forelse($orders as $order)
							<div class="ord_list_wrap border mb-4">
								<div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
									<div class="olh_flex">
										<p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
										<h6 class="mb-0 ft-medium">{{$order->order_id}}

											@if($order->payment_method == 1)
											[Cash On Delivary]
											@elseif($order->payment_method == 2)
											[Ssl Commerze]
											@elseif($order->payment_method == 3)
											[Stripe]
											@endif
										</h6>
									</div>	
									<div class="col-xl-2 col-lg-2 col-md-2 col-12 ml-auto">
										<p class="mb-1 p-0"><span class="text-center">Status</span></p>
										<div class="delv_status">
											@if($order->status == null)
											<span class="badge bg-dark">
										
										 placed
										@elseif($order->status == 1)
										<span class="badge bg-success">
										Packaging

										@elseif($order->status == 2)
										<span class="badge bg-warning">
										Shipped

										@elseif($order->status == 3)
										<span class="badge bg-primary">
										Ready To Delivar
										@elseif($order->status == 4)
										<span class="badge bg-danger">
										Delivar 

										@endif	
										</span></div>
									</div>	
								</div>
                                <?php
                                $pro = App\Models\OrderProdcut::where('order_id',$order->order_id)->get();
                              ?>
                              <?php
                             $totalPrice = 0;
                              ?>
                              @foreach($pro as $pr)
								<div class="ord_list_body text-left">
                                    
									<!-- First Product -->
									<div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
										<div class="col-xl-5 col-lg-5 col-md-5 col-12">
											<div class="cart_single d-flex align-items-start mfliud-bot">
												<div class="cart_selected_single_thumb">
													<?php
													$product_name = App\Models\ProductsModel::find($pr->product_id);
													 $product_name->product_name ;
													  
													 $totalPrice += $pr->price;
											  ?>
													<a href="#"><img src="{{asset('Products/product_preview/'.$product_name->preview)}}" width="75" class="img-fluid rounded" alt=""></a>
												</div>
                                               
                                                 
												<div class="cart_single_caption pl-3">
													<p class="mb-0"><span class="text-muted small">
													{{$product_name->rel_to_category->category_name}}	
													</span></p>
													<h4 class="product_title fs-sm ft-medium mb-1 lh-1">

                                                       
                                                        {{$product_name->product_name }} X {{$pr->quantity}}
                                                    </h4>
													<p class="mb-2"><span class="text-dark medium">Size: @if($product_name->size_id == null)
                                                    No Size @else 
                                                   <?php
                                                   $size = App\Models\Size::find($product_name->size_id);
                                                   echo $size->size_name;
                                                   ?>
                                                    @endif
                                                    </span>, <span class="text-dark medium">Color: 
                                                    @if($product_name->color_id == null)
                                                    No Color

                                                    @else
                                                    <?php
                                                   $color = App\Models\Color::find($product_name->color_id);
                                                   echo $color->color_name;
                                                   ?>
                                                    @endif    
                                                    </span></p>
													<h4 class="fs-sm ft-bold mb-0 lh-1">Tk {{ number_format($pr->price, 2, '.', ',')  }}</h4>
												</div>
											</div>
										</div>
										<div class="col-xl-2 col-lg-2 col-md-2 col-12 ml-auto">
											{{-- <p class="mb-1 p-0"><span class="text-center">Status</span></p>
											<div class="delv_status"><span class="ft-medium small text-warning bg-light-warning rounded px-3 py-1">Completed</span></div> --}}
										</div>
                                       
										
									</div>
                                   
									
								
									
								</div>
                                @endforeach
								<div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
									<div class="col-xl-12 col-lg-12 col-md-12 pl-0 py-2 olf_flex d-flex align-items-center justify-content-between">
										<div class="olf_flex_inner"><p class="m-0 p-0"><span class="text-muted medium text-left">Order Date: <?php
                                          
                                           $date = App\Models\Order::where('order_id',$order->order_id)->first(); 
                                           echo $date->created_at->format('d-M-Y');
                                            ?>
                                            </span></p></div>
										<div class="olf_inner">
                                            <h5 class="mb-0 fs-sm ft-bold"><?php echo " Price: TK " .   number_format($totalPrice, 2, '.', ',')?></h5>
                                           
											@if($date->coupon_name)
											<h5 class="mb-0 fs-sm ft-bold"><?php echo " Coupon Name: " .  $date->coupon_name ?></h5>
											<h5 class="mb-0 fs-sm ft-bold"><?php echo " Coupon Discount: "    ?>
											<?php
												$coupon_type = App\Models\Coupon::where('coupon_code', $date->coupon_name)->first();
												
												?>
												@if($coupon_type->type == 1)
												{{$coupon_type->discount_amount}}%
												@elseif($coupon_type->type == 2)
												{{$coupon_type->discount_amount}}TK
												@endif
											</h5>
											<h5 class="mb-0 fs-sm ft-bold">After Coupon price is : TK {{$date->subtotal - $date->discount}}</h5>
											<h5 class="mb-0 fs-sm ft-bold"><?php echo " Charge: TK " .  $date->charge ?></h5>
											<h5 class="mb-0 fs-sm ft-bold"><?php echo " Grand Total: TK " .  $date->Total ?></h5>
											@else
											<h5 class="mb-0 fs-sm ft-bold">No Coupon Added Yet</h5>
											@endif
                                        </div>

                                    

                                        
                                    </div>
								</div>
							</div>
                            @empty
                            No Order Has noot been placed yet
                            @endforelse
							<!-- End Order List -->
							
						</div>
						
					</div>
				</div>
			</section>
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

            @endsection