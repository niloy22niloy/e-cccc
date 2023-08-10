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
<section class="middle">
    <div class="container">
   
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                <form action="{{route('order.store')}}" method="POST">
                    @csrf
                    <h5 class="mb-4 ft-medium">Billing Details</h5>
                    <div class="row mb-2">
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Full Name *</label>
                                <input type="text" class="form-control" placeholder="First Name" name="name" value="{{Auth::guard('guestlogin')->user()->name}}"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Email *</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{Auth::guard('guestlogin')->user()->email}}" />
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Company</label>
                                <input type="text" class="form-control" name="company" placeholder="Company Name (optional)" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Mobile Number *</label>
                                <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" />
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Address *</label>
                                <input type="text" class="form-control" name="address" placeholder="Address" />
                            </div>
                        </div>
                       
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Country *</label>
                                <select class="custom-select country" id="country_id" name="country">
                                  <option value="">-- Select Country --</option>
                                 @foreach($countries as $country)
                                 <option value="{{$country->id}}">{{$country->name}}</option>
                                 @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">City *</label>
                                <select class="custom-select" name="city" id="city_id">
                                  <option value="">-- Select City --</option>
                                 
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">ZIP / Postcode *</label>
                                <input type="text" name="zip_id" class="form-control" placeholder="Zip / Postcode" />
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Additional Information</label>
                                <textarea class="form-control ht-50" name="notes"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    
               
            </div>
            
            <!-- Sidebar -->
            <div class="col-12 col-lg-4 col-md-12">
                <div class="d-block mb-3">
                    <h5 class="mb-4">Order Items ({{count($carts)}})</h5>
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                        @php
                         $subtotal = 0;
                        $total_v = 0;
                        @endphp
                        @foreach($carts as $cart)

                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="product.html"><img src="{{asset('Products/product_preview/'.$cart->rel_to_product->preview)}}" alt="..." class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$cart->rel_to_product->product_name}}</h4>
                                        <p class="mb-1 lh-1"><span class="text-dark">Size: {{ $cart->rel_to_size ? $cart->rel_to_size->size_name : 'N/S' }}</span></p>
                                        <p class="mb-3 lh-1"><span class="text-dark">Color: {{ $cart->rel_to_color ? $cart->rel_to_color->color_name : 'N/S' }}</span></p>
                                        <h4 class="fs-md ft-medium mb-3 lh-1">Tk {{ number_format($cart->rel_to_product->after_discount, 2, '.', ',')  }}* {{$cart->quantity}} =
                                            <?php
                                            
                                        
                
                                            $numberString = number_format($cart->rel_to_product->after_discount, 2, '.', ',');
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
                            </div>
                        </li>
                        @endforeach
                      
                        
                        
                     
                        
                    </ul>
                </div>
                
                <div class="mb-4">
                    <div class="form-group">
                        <h6>Delivery Location</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c1" class="radio-custom charge" name="charge" type="radio" value="70">
                                <label for="c1" class="radio-custom-label">Inside City</label>
                            </li>
                            <li>
                                <input id="c2" class="radio-custom charge" name="charge" type="radio" value="100">
                                <label for="c2" class="radio-custom-label">Outside City</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-group">
                        <h6>Select Payment Method</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c3" class="radio-custom" name="payment_method" type="radio" value="1">
                                <label for="c3" class="radio-custom-label">Cash on Delivery</label>
                            </li>
                            <li>
                                <input id="c4" class="radio-custom" name="payment_method" type="radio" value="2">
                                <label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
                            </li>
                            <li>
                                <input id="c5" class="radio-custom" name="payment_method" type="radio" value="3">
                                <label for="c5" class="radio-custom-label">Pay With Stripe</label>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="card mb-4 gray">
                  <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">
                            @php
                            $subtotal = 0;
                              @endphp
                             
                           @forelse($carts as $cart)
                        
                           @php
                                   $product = App\Models\ProductsModel::find($cart->product_id);
                                     $subtotal += $product->after_discount;
                                    // echo  $product->after_discount;
                                   
                               @endphp
                               @empty
                               no
                               @endforelse
                              
                           
                                  
                                TK {{ number_format($total_v, 2, '.', ',') }}
                                <input type="hidden" value="{{$total_v}}" name="subtotal">

                                <input type="hidden" class="total_after_discount"  name="after_coupon_dis" value="{{$after_copoun_discount_price}}">
                        </span>
                      </li>
                     
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <input type="hidden" id="after_coupon_dis"  name="after_coupon_dis" value="{{$after_copoun_discount_price}}">
                        <span>After Coupon Discount Price @if($coupon_name)[{{$coupon_name}}]@endif</span> <span class="ml-auto text-dark ft-medium after_coupon">TK {{ number_format($after_copoun_discount_price, 2, '.', ',') }}</span>
                      </li>
                      @if($coupon_name)
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                       
                        <span>Coupon Type</span> <span class="ml-auto text-dark ft-medium after_coupon">
                            <?php
                           $coupons = App\Models\Coupon::where('coupon_code',$coupon_name)->first();
                           
                           
                           ?>
                           @if( $coupons->type == 1)
                           Percentage(%)
                           @elseif($coupons->type == 1)
                           Flat
                           @endif
                        </span>
                      </li>
                      @endif
                    @if($coupon_name)
                    @if( $coupons->type == 1)
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Discount_Price</span> <span class="ml-auto text-dark ft-medium"> {{$coupons->discount_amount}}%</span>
                      </li>
                      @elseif($coupons->type == 1)
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Discount_Price</span> <span class="ml-auto text-dark ft-medium"> {{$coupons->discount_amount}}TK</span>
                      </li>
                      @endif
                      @endif
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Charge</span> <span class="ml-auto text-dark ft-medium charge" id="charge"> </span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <input type="hidden" value="" id="total" name="total">
                        <span>Total</span> <span class="ml-auto text-dark ft-medium total" id="total"></span>
                      </li>
                    </ul>
                  </div>
                </div>
                 <input type="hidden" value="{{$coupon_name}}" name="coupon_namee" readonly>
                <button class="btn btn-block btn-dark mb-3" type="submit">Place Your Order</button>
                
            </div>
            
        </div>
    </form>
        
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
    $(document).ready(function() {
$('#country_id').select2();
});

</script>
<script>
    $(document).ready(function() {
$('#city_id').select2();
});

</script>
<script>
    
  
  $(document).ready(function () {
           $('.charge').click(function(){
              var charge = $(this).val();
              var after_discount = $('#after_coupon_dis').val();
              var total_with_charge = parseInt(after_discount) +  parseInt(charge)
             $('.charge').html('Tk ' + charge);
             $('.total').html('Tk ' + total_with_charge);
             $('#total').val(total_with_charge);
             $('.total_after_discount').val(total_with_charge);
             
           });

        });



        $(document).ready(function () { 
              $('#country_id').change(function(){
                var country_id = $(this).val();
                $.ajaxSetup({
                headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
      });
      $.ajax({
            type:'POST',
            url:'getCity',
            data:{'country_id':country_id},
            success:function(data){
                $('#city_id').html(data);
            }

      });


              });
              
        });
     
</script>

@endsection