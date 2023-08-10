@extends('Frontend.frontend_asset')
@section('content')
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Support</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Product Detail ======================== -->
<section class="middle">
    <div class="container">
    
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                <form action="{{route('update.cart')}}" method="POST">
                    @csrf
                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                    @php
                  $subtotal = 0;
                    @endphp
                    @php
                $total_v = 0;
                 @endphp
                        @forelse($carts as $cart)
                        @php
								$product = App\Models\ProductsModel::find($cart->product_id);
								 $subtotal += $product->after_discount;
                                
							@endphp
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <!-- Image -->
                                <a href="product.html"><img src="{{asset('Products/product_preview/'.$product->preview)}}" alt="..." class="img-fluid"></a>
                            </div>
                            <div class="col d-flex align-items-center justify-content-between">
                                <div class="cart_single_caption pl-2">
                                    <h4 class="product_title fs-md ft-medium mb-1 lh-1" name="product_name">{{$product->product_name}}[Original Price : {{$product->price}}, Discount: {{$product->discount}}%]</h4>
                                    
                                    <p class="mb-1 lh-1"><span class="text-dark">Size: {{ $cart->rel_to_size ? $cart->rel_to_size->size_name : 'N/S' }}</span></p>
                                    <p class="mb-3 lh-1"><span class="text-dark">Color: {{ $cart->rel_to_color ? $cart->rel_to_color->color_name : 'N/S' }}</span></p>
                                    <h4 class="fs-md ft-medium mb-3 lh-1">Tk {{ number_format($product->after_discount, 2, '.', ',')  }} * {{$cart->quantity}} = 
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
                                   
                                    <select class="mb-2 custom-select w-auto" name="quantity[{{$cart->id}}]">
                                        
                                        @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ $cart->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                      @endfor
                                    </select>
                                </div>
                                <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                            </div>
                        </div>
                    </li>
                    @empty
                    Deleted It
                    @endforelse
                   
                    
                   
                    
                </ul>
                
                <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                    
                    <div class="col-12 col-md-auto mfliud">
                        <button class="btn stretched-link borders" type="submit">Update Cart</button>
                    </div>
                </form>
                <div class="col-12 col-md-7">
                    <!-- Coupon -->
                    <form class="mb-7 mb-md-0">
                        @csrf
                        @if($message)
                        <div class="alert alert-danger">{{$message}}</div>
                        @endif
                        <label class="fs-sm ft-medium text-dark">Coupon code</label>
                        <div class="row form-row">
                            <div class="col">
                                <input class="form-control" @if(isset($coupon_code)) value="{{ $coupon_code }}" @else value="" @endif  type="text" name="coupon" placeholder="Enter coupon code*" id="inputField1">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-dark" type="submit" id="applyButton">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card mb-4 gray mfliud">
                  <div class="card-body">
                    <form action="{{route('checkout.page')}}" method="POST">
                        @csrf
                    
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                      {{-- <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">$98.12</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Discount</span> <span class="ml-auto text-dark ft-medium">$10.10</span>
                      </li> --}}
                    
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Total</span> <span class="ml-auto text-dark ft-medium">

                            @if(isset($cart))
                        
                               
                             
                               TK {{ number_format($total_v, 2, '.', ',') }}
                        
                            @endif
                        </span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Coupon Discount   @if(($type == 1))
                           [Percentage]
                           
                           @else
                           [Flat]
                           
                            @endif
                        
                        </span>
                        @if(($type == 1))
                         <span class="ml-auto text-dark ft-medium">

                          
                             
                               
                             
                               TK {{ number_format($discount, 2, '.', ',') }}%

                        
                           
                        </span>
                        @else
                        <span class="ml-auto text-dark ft-medium">

                          
                             
                               
                             
                            TK {{ number_format($discount, 2, '.', ',') }}

                     
                        
                     </span>
                        @endif
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>After Coupon Discount   
                          
                        @if($type == 1)

                        [Percentage]
                        </span> <span class="ml-auto text-dark ft-medium">

                          
                        
                                @php
                                $per_cal = ($discount/100)*$total_v;
                                $after_copoun_discount_price = $total_v-$per_cal;
                                @endphp
                                    
                               TK {{ number_format($after_copoun_discount_price, 2, '.', ',') }}
                        
                           
                        </span>
                        @else
                        [Flat]
                    </span> <span class="ml-auto text-dark ft-medium">

                      
                    
                            @php
                            
                            $after_copoun_discount_price = $total_v-$discount;
                            @endphp
                                
                           TK {{ number_format($after_copoun_discount_price, 2, '.', ',') }}
                    
                       
                    </span>
                       
                        
                          
                        @endif
                        </span>
                      </li>
                      <li class="list-group-item fs-sm text-center">
                        Shipping cost calculated at Checkout *
                      </li>
                    </ul>
                  </div>
                </div>
                <input type="hidden" name="coupon_name" @if(isset($coupon_code)) value="{{ $coupon_code }}" @endif id="inputField2">
                <input type="hidden" name="after_coupon_discount" value="{{$after_copoun_discount_price}}" id="">
                {{-- <a class="btn btn-block btn-dark mb-3" href="javascript:void(0);" onclick="redirectToCheckout('{{ $after_copoun_discount_price }}')">Proceed to Checkout</a> --}}
                <button class="btn btn-block btn-dark mb-3" type="submit"> Proceed to Checkout</button>
            </form>
                 
                <a class="btn-link text-dark ft-medium" href="shop.html">
                  <i class="ti-back-left mr-2"></i> Continue Shopping
                </a>
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


<!-- Cart -->


<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
@if(session('success'))
<script>
    const Toast = Swal.mixin({
     toast: true,
     position: 'bottom-start',
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
     title: '{{session('success')}}'
   })
   </script>
@endif
{{-- <script>
    function redirectToCheckout(price) {
        var form = document.createElement('form');
        form.method = 'GET';
        form.action = '{{ route('checkout.page') }}';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'after_copoun_discount_price';
        input.value = price;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
</script> --}}


@endsection