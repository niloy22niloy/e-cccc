<!DOCTYPE html>
<html lang="zxx">
<head>
		<meta charset="utf-8" />
		<meta name="author" content="Themezhub" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Kumo- Fashion eCommerce HTML Template</title>

          
		


		  <!-- Jquery -->
		<script src=
        "https://code.jquery.com/jquery-3.6.0.min.js"
        integrity=
"sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
        crossorigin="anonymous">
    </script>
	
	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- End OF SweetAlert -->
	
        <!-- Custom CSS -->
          <!---Select2--->
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<!---Select2--->

        <link href="{{asset('Frontend_assets/css/plugins/animation.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/flaticon.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/iconfont.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/ion.rangeSlider.min.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/light-box.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/line-icons.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/slick-theme.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/slick.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/snackbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/plugins/themify.css')}}" rel="stylesheet">
        <link href="{{asset('Frontend_assets/css/styles.css')}}" rel="stylesheet">

    </head>

    <body>

		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
       <div class="preloader"></div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">

            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
			<!-- Top Header -->
			<div class="py-2 br-bottom">
				<div class="container">
					<div class="row">

						<div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 hide-ipad">
							<div class="top_second"><p class="medium text-muted m-0 p-0"><i class="lni lni-phone fs-sm"></i></i> Hotlinee <a href="#" class="medium text-dark text-underline">0(800) 123-456</a></p></div>
						</div>

						<!-- Right Menu -->
						<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
							<!-- Choose Language -->
							<div class="language-selector-wrapper dropdown js-dropdown float-right mr-3">
								<a class="popup-title" href="javascript:void(0)" data-toggle="dropdown" title="Language" aria-label="Language dropdown">
									<span class="hidden-xl-down medium text-muted">Language:</span>
									<span class="iso_code medium text-muted">English</span>
									<i class="fa fa-angle-down medium text-muted"></i>
								</a>
								<ul class="dropdown-menu popup-content link">
									<li class="current"><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img src="assets/img/1.jpg" alt="en" width="16" height="11" /><span>English</span></a></li>
									<li><a href="javascript:void(0);" class="dropdown-item medium text-muted"><img src="assets/img/2.jpg" alt="fr" width="16" height="11" /><span>Français</span></a></li>
								</ul>
							</div>
							

							<div class="currency-selector dropdown js-dropdown float-right mr-3">
								@if(Auth::guard('guestlogin')->check())
								<div class="language-selector-wrapper dropdown js-dropdown float-right mr-3">
									<a class="popup-title" href="javascript:void(0)" data-toggle="dropdown" title="Language" aria-label="Language dropdown">
										<span class="hidden-xl-down medium text-muted">Language:</span>
										<span class="iso_code medium text-muted">{{Auth::guard('guestlogin')->user()->name}}</span>
										<i class="fa fa-angle-down medium text-muted"></i>
									</a>
									<ul class="dropdown-menu popup-content link">
										<li class="current"><a href="{{route('guest.logout')}}" class="dropdown-item medium text-muted"><span>Logout</span></a></li>
										<li class="current"><a href="{{route('user.profile_page')}}" class="dropdown-item medium text-muted"><span>Profile</span></a></li>

									</ul>
								</div>
								@else
							  <a href="{{route('register.login')}}" class="text-muted medium"><i class="lni lni-user mr-1"></i>Sign In/Register</a>
								@endif
								
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="headd-sty header">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12">
							<div class="headd-sty-wrap d-flex align-items-center justify-content-between py-3">
								<div class="headd-sty-left d-flex align-items-center">
									<div class="headd-sty-01">
										<a class="nav-brand py-0" href="#">
											<img src="assets/img/logo.png" class="logo" alt="" />
										</a>
									</div>
									<div class="headd-sty-02 ml-3">
										<form class="bg-white rounded-md border-bold">
											<div class="input-group">
												<input type="text" id="search_input" @if(isset($_GET['q'])) value="{{ htmlspecialchars($_GET['q']) }}" @else value="" @endif class="form-control custom-height b-0" placeholder="Search for products..." />

												<div class="input-group-append">
													<div class="input-group-text">
														<button id="search_btn" class="btn bg-white text-danger custom-height rounded px-3" type="button">
															<i class="fas fa-search"></i></button></div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="headd-sty-last">
									<ul class="nav-menu nav-menu-social align-to-right align-items-center d-flex">
										<li>
											<div class="call d-flex align-items-center text-left">
												<i class="lni lni-phone fs-xl"></i>
												<span class="text-muted small ml-3">Call Us Now:<strong class="d-block text-dark fs-md">0(800) 123-456</strong></span>
											</div>
										</li>
										<li>
											<a href="#" onclick="openWishlist()">
												<i class="far fa-heart fs-lg"></i><span class="dn-counter bg-success">2</span>
											</a>
										</li>
										<li>
											<a href="#" onclick="openCart()">
												<div class="d-flex align-items-center justify-content-between">
													<i class="fas fa-shopping-basket fs-lg"></i><span class="dn-counter theme-bg">{{count($carts)}}</span>
												</div>
											</a>
										</li>
									</ul>
								</div>
								<div class="mobile_nav">
									<ul>
										<li>
										<a href="#" onclick="openSearch()">
											<i class="lni lni-search-alt"></i>
										</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#login">
											<i class="lni lni-user"></i>
										</a>
									</li>
									<li>
										<a href="#" onclick="openWishlist()">
											<i class="lni lni-heart"></i><span class="dn-counter">2</span>
										</a>
									</li>
									<li>
										<a href="#" onclick="openCart()">
											<i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
										</a>
									</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <!-- Start Navigation -->
			<div class="headerd header-dark head-style-2">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<div class="nav-toggle"></div>
							<div class="nav-menus-wrapper">
								<ul class="nav-menu">
									<li><a href="{{url('/')}}" class="pl-0">Home</a></li>
									<li><a href="#">Shop</a></li>
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
            @yield('content')



			<!-- Wishlist -->

			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Wishlist">
				<div class="rightMenu-scroll">
					<div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
						<h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
						<button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
					</div>
					<div class="right-ch-sideBar">
						@if(Auth::guard('guestlogin')->check())
						<div class="cart_select_items py-2">
							
							<?php
								$wishlist = App\Models\Wishlist::where('customer_id',Auth::guard('guestlogin')->user()->id)->get();
								?>
								@forelse($wishlist as $wishlists)
							<!-- Single Item -->
							<div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
								<div class="cart_single d-flex align-items-center">
									<div class="cart_selected_single_thumb">
										<a href="#"><img src="assets/img/product/4.jpg" width="60" class="img-fluid" alt="" /></a>
									</div>
									<div class="cart_single_caption pl-2">
										<h4 class="product_title fs-sm ft-medium mb-0 lh-1">
											
											<?php
												$product_name = App\Models\ProductsModel::find($wishlists->product_id);

												
												echo $product_name->product_name;
												
												
												?>
										</h4>
										<p class="mb-2"><span class="text-dark ft-medium small">Size :
											@if($wishlists->size_id == null)
											No Size
											@else
											<?php
                                              $size_name = App\Models\Size::find($wishlists->size_id);
											  echo $size_name->size_name;

												
												?>
											@endif

											
											
										</span>, <span class="text-dark small">Color: 
											@if($wishlists->color_id == null)
											No Color
											@else
											<?php
												$color_name = App\Models\Color::find($wishlists->color_id);
												echo $color_name->color_name;
												?>
											
										</span></p>
										@endif
										<h4 class="fs-md ft-medium mb-0 lh-1">TK {{$product_name->after_discount}}</h4>
									</div>
								</div>
								<div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
							</div>
							@empty
							No wishlist Added Yet
							@endforelse
							
							<!-- Single Item -->
							
							
						</div>
						
						
						
						
						<div class="cart_action px-3 py-3">
							<form action="{{route('wishlist')}}" method="GET">
								@csrf
							<div class="form-group">
								<button type="submit" class="btn d-block full-width btn-dark-light">View Whishlist</button>
							</div>
						</form>
						</div>
						
					</div>
					@else
					Please login to add wishlist
					@endif
				</div>
			</div>
			
<!-- Cart -->
			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
				<div class="rightMenu-scroll">
					<div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
						<h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
						
						<button onclick="closeCart()" href = "" class="close_slide"><i class="ti-close"></i></button>
					
					</div>
					<div class="right-ch-sideBar">
						{{-- <div class="d-flex align-items-center">
							<button style="background-color: black;" class="btn btn-primary delete_all" data-url="{{url('/delete_selected_carts')}}" onmouseover="this.style.backgroundColor='white'; this.style.color='black';"
							onmouseout="this.style.backgroundColor='black'; this.style.color='white';">Delete All Selected</button>
							<div>
								<p class="mb-0 ml-2">Select all</p>
							</div>
							<div>
								<label class="">
									<input type="checkbox"  style="margin-top: 13px;margin-left:5px;" id="master">
								</label>
							</div>
						</div> --}}
						@if(isset($carts))
						<button style="" class="btn btn-primary delete_all" data-url="{{url('/delete_selected_cart')}}" onmouseover="this.style.backgroundColor='white'; this.style.color='black';"
						onmouseout="this.style.backgroundColor='black'; this.style.color='white';">Delete All Selected</button>
						<div class="mb-3 d-flex">
							<div>
								check all
							</div>
						   <input type="checkbox" id="master" style="margin-left:10px;">
						</div>
						@endif
						<div class="cart_select_items py-2">
							<!-- Single Item -->
							@php
							$total_v = 0;
							@endphp
							@php
							$subtotal = 0;
						@endphp
						
						@forelse($carts as $cart)
							@php
								$product = App\Models\ProductsModel::find($cart->product_id);
								$subtotal += (int) $product->after_discount;
							@endphp
							<div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
								<div class="cart_single d-flex align-items-center">
									<div class="form-check">
										<input type="checkbox" class="sub_chk" data-id="{{$cart->id}}">
									</div>
									<div class="cart_selected_single_thumb">
										<a href="#"><img src="{{asset('Products/product_preview/'.$product->preview)}}" width="60" class="img-fluid" alt="" /></a>
									</div>
									<div class="cart_single_caption pl-2">
										<h4 class="product_title fs-sm ft-medium mb-0 lh-1">
											{{ $product->product_name }}
										</h4>
										<p class="mb-2">
											
											<span class="text-dark ft-medium small">{{ $cart->rel_to_size ? $cart->rel_to_size->size_name : 'N/A' }}</span>,
											<span class="text-dark small">{{ $cart->rel_to_color ? $cart->rel_to_color->color_name : 'N/A' }}</span>,

											<span class="text-dark small">Quantity: {{ $cart->quantity }}</span>
										</p>
										<h4 class="fs-md ft-medium mb-0 lh-1">Tk {{ number_format($product->after_discount, 2, '.', ',')  }} * {{ $cart->quantity }} = 
										<?php
										$numberString = number_format($product->after_discount, 2, '.', ',');
                                        $numberString = str_replace(',', '', $numberString); // Remove commas
                                       
                                         $integerValue = (float)($numberString);
										 $car = $cart->quantity;
										echo $total = $integerValue * $car;
										$total_v += $total ; 
										//  echo 'Tk '. $integerValue * $car;
											

											?>
										</h4>
									</div>
								</div>
								<div class="fls_last">
			
									<a class="close_slide gray" href="{{route('cart_item.delete',$cart->id)}}"><i class="ti-close"></i></a>
								</div>
							</div>
						@empty
						
						<h4 class="product_title fs-sm ft-medium mb-0 lh-1" style="margin-left:15px;">
							Sorry No Product Added Yet
						</h4>
					
						@endforelse
					
						<!-- HTML code to display subtotal -->
					  
							
							<!-- Single Item -->
							
							
						</div>
						@if(isset($cart))
						<div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
							<h6 class="mb-0">Subtotal</h6>
						 
							<h3 class="mb-0 ft-medium">TK {{ number_format($total_v, 2, '.', ',') }}</h3>
						</div>
						
						<div class="cart_action px-3 py-3">
							<div class="form-group">
								
								<a  class="btn d-block full-width btn-dark-light" href="{{route('view.cart')}}">View Cart</a>
							@endif
							</div>
						</div>
						
					</div>
				</div>
			</div>

			<!-- ======================= Category & Slider ======================== -->

		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{asset('frontend_assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('frontend_assets/js/popper.min.js')}}"></script>
		<script src="{{asset('frontend_assets/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('frontend_assets/js/ion.rangeSlider.min.js')}}"></script>
		<script src="{{asset('frontend_assets/js/slick.js')}}"></script>
		<script src="{{asset('frontend_assets/js/slider-bg.js')}}"></script>
		<script src="{{asset('frontend_assets/js/lightbox.js')}}"></script>
		<script src="{{asset('frontend_assets/js/smoothproducts.js')}}"></script>
		<script src="{{asset('frontend_assets/js/snackbar.min.js')}}"></script>
		<script src="{{asset('frontend_assets/js/jQuery.style.switcher.js')}}"></script>
		<script src="{{asset('frontend_assets/js/custom.js')}}"></script>
		<!-- SweetAlert -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<!--select2--->
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->


		<!-- ======================Search Option======================================== -->
		<script>
			$('#search_btn').click(function(){
			   var search_input= $('#search_input').val();
			   var link = '{{route('search')}}?q='+search_input;
			   window.location.href = link;
				
			});
			</script>
			<!-- ======================Search Option======================================== -->
		<script>
			function openWishlist() {
				document.getElementById("Wishlist").style.display = "block";
			}
			function closeWishlist() {
				document.getElementById("Wishlist").style.display = "none";
			}
		</script>

		<script>
			function openCart() {
				document.getElementById("Cart").style.display = "block";
			}
			function closeCart() {
				document.getElementById("Cart").style.display = "none";
			}
		</script>

		<script>
			function openSearch() {
				document.getElementById("Search").style.display = "block";
			}
			function closeSearch() {
				document.getElementById("Search").style.display = "none";
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#master').on('click', function(e) {
				 if($(this).is(':checked',true))
				 {
					$(".sub_chk").prop('checked', true);
				 } else {
					$(".sub_chk").prop('checked',false);
				 }
				});
				$('.delete_all').on('click', function(e) {
					var allVals = [];
			$(".sub_chk:checked").each(function() {
				allVals.push($(this).attr('data-id'));
		  
			});
		  
		  if(allVals.length <=0)
			{
				alert("Please select row.");
			}
		  
			else {
				var check = confirm("Are you sure you want to delete this row?");
			   
		 
				if(check == true){
					var join_selected_values = allVals.join(",");
					$.ajax({
						url: $(this).data('url'),
						type: 'get',
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						data: 'ids='+join_selected_values,
						success: function (data) {
							if (data['success']) {
								$(".sub_chk:checked").each(function() {
									location.reload();
		
		
								});
								alert(data['success']);
							} else if (data['error']) {
								alert(data['error']);
							} else {
								alert('Whoops Something went wrong!!');
							}
						},
						error: function (data) {
							alert(data.responseText);
						}
					});
		  
				}
			}
			});
		  });
			</script>

		@if(session('cart_item_delete'))
		<script>
			const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: '{{session('cart_item_delete')}}'
})
		</script>
		@endif

	</body>

</html>
