@extends('Frontend.frontend_asset')
@section('content')
<section class="middle">
    <div class="container">
        <div class="row justify-content-between">
        
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                <div class="quick_view_slide">
                  
                    <div class="single_view_slide"><a href="{{asset('Products/product_preview/'.$single_product->preview)}}" data-lightbox="roadtrip" class="d-block mb-4"><img src="{{asset('Products/product_preview/'.$single_product->preview)}}" class="img-fluid rounded" alt="" /></a></div>
                    <div class="single_view_slide"><a href="{{asset('Products/product_thumbnail/'.$single_product->thumbnail)}}" data-lightbox="roadtrip" class="d-block mb-4"><img src="{{asset('Products/product_thumbnail/'.$single_product->thumbnail)}}" class="img-fluid rounded" alt="" /></a></div>

                </div>
            </div>
            
            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                <div class="prd_details pl-3">
                   
                   
                    <form action="{{route('cart.store')}}" method="POST">
                        @csrf
                    
                    
                    <div class="prt_01 mb-1"><span class="text-light bg-info rounded px-2 py-1">{{$single_product->rel_to_category->category_name}}</span></div>
                    <div class="prt_02 mb-3">
                        <h2 class="ft-bold mb-1">{{$single_product->product_name}}</h2>
                        <input type="hidden" name="product_id" value="{{$single_product->id}}">
                        @if($total_reviews)
                        <?php
                        $ratings = round($total_star/$total_reviews);
                       
                        ?>
                     
                     
                       
                        <div class="text-left">
                            <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                <?php
                                $total = 5;
                                $total_star;
                                $remaning_star = $total - $total_star
                               
                                ?>
                               @for($i=1 ; $i<=$total ; $i++)
                               @if($i<= $ratings)
                               <i class="fas fa-star filled"></i>
                               
                               @else
                               <i class="fas fa-star"></i>
                               @endif
                            @endfor
                               
                                <span class="small">
                                    {{-- @if($total_reviews>1)
                                    ({{$total_reviews}} reviews)
                                    @elseif($total_reviews==1)
                                    ({{$total_reviews}} review)
                                    @else
                                    (No review)
                                    @endif --}}
                                    ({{$totalFound}} Reviews)

                                
                                </span>
                            </div>
                            <div class="elis_rty"><span class="ft-medium text-muted line-through fs-md mr-2">{{$single_product->price}}TK</span><span class="ft-bold theme-cl fs-lg mr-2">{{$single_product->after_discount}}TK</span></div>
                        </div>
                        @else
                        (No review Yet)
                        @endif
                    </div>
                    
                    <div class="prt_03 mb-4">
                        <p>{{$single_product->short_description}}</p>
                    </div>
                    
                    <div class="prt_04 mb-2">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
                        <div class="text-left">
                           <?php
                            use App\Models\Inventory;
                            use App\Models\Color;
                            use App\Models\Size;

                             $product =  Inventory::where('product_id',$single_product->id)->get();

                            foreach ($product as $value) {
                                $colors = Color::find($value->color_id);
                                $sizes = Size::find($value->size_id);
                              
                            }
                       
                       ?>
                       
                            @forelse($product as $value)
                            <?php $colors = Color::find($value->color_id); ?>
                            
                                     
                                      
                            @if($colors->id == 1)
                            <div class="form-check form-option form-check-inline mb-1">
                                
                                <input class="form-check-input color_id" type="radio" name="color" id="white{{$colors->id}}" value="{{$colors->id}}">
                                <label class="form-option-label rounded-circle" for="white{{$colors->id}}"><span class="form-option-color rounded-circle blc{{$colors->color_code}}" style="background-color:{{$colors->color_code}};">A/C</span></label>
                            </div>
                           
                            @else
                            <div class="form-check form-option form-check-inline mb-1">
                                
                                <input class="form-check-input color_id" type="radio" name="color" id="white{{$colors->id}}" value="{{$colors->id}}">
                                <label class="form-option-label rounded-circle" for="white{{$colors->id}}"><span class="form-option-color rounded-circle blc{{$colors->id}}" style="background-color:{{$colors->color_code}};"></span></label>
                            </div>
                            @endif
                           
                           
                            @empty
                            <p class="text-danger">Sorry No Color Available</p>
                            @endforelse
                            
                            
                        </div>
                    </div>
                    
                    <div class="prt_04 mb-4">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
                        <div class="text-left pb-0 pt-2 size_id">
                            @php
                            $uniqueSizeIds = $product->pluck('size_id')->unique();
                            $sizes = Size::whereIn('id', $uniqueSizeIds)->get();
                            $uniqueSizeIds = $product->pluck('size_id')->unique();
                            $sizes = Size::whereIn('id',$uniqueSizeIds)->get();
                        @endphp
                        
                        @forelse($sizes as $size)
                            <div class="form-check size-option form-option form-check-inline mb-2">
                                <input class="form-check-input" type="radio" name="size_id" id="{{$size->id}}" value="">
                                <label class="form-option-label" for="{{$size->id}}">{{$size->size_name}}</label>
                            </div>
                            @empty
                            <p class="text-danger">No Size Available</p>
                        @endforelse
                            
                        </div>
                    </div>
                    
                    <div class="prt_05 mb-4">
                        <div class="form-row mb-7">
                            <div class="col-12 col-lg-auto">
                                <!-- Quantity -->
                                <select class="mb-2 custom-select" name="quantity">
                                  <option value="1" selected="">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg">
                                <!-- Submit -->
                                <button type="submit" name="abcd" value="1" class="btn btn-block custom-height bg-dark mb-2">
                                    <i class="lni lni-shopping-basket mr-2"></i>Add to Cart 
                                </button>
                            </div>
                        
                            <div class="col-12 col-lg-auto">
                                <!-- Wishlist -->
                                <button type="submit" class="btn custom-height btn-default btn-block mb-2 text-dark" name="abcd" value="2">
                                    <i class="lni lni-heart mr-2"></i>Wishlist
                                </button>
                            </div>
                      </div>
                    </form>
                    </div>
               
                    
                    <div class="prt_06">
                        <p class="mb-0 d-flex align-items-center">
                          <span class="mr-4">Share:</span>
                          <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="#!">
                            <i class="fab fa-twitter position-absolute"></i>
                          </a>
                          <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="#!">
                            <i class="fab fa-facebook-f position-absolute"></i>
                          </a>
                          <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted" href="#!">
                            <i class="fab fa-pinterest-p position-absolute"></i>
                          </a>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Product Detail End ======================== -->

<!-- ======================= Product Description ======================= -->
<section class="middle">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12">
                <ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="description-tab" href="#description" data-toggle="tab" role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#information" id="information-tab" data-toggle="tab" role="tab" aria-controls="information" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#reviews" id="reviews-tab" data-toggle="tab" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                
                <div class="tab-content" id="myTabContent">
                    
                    <!-- Description Content -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <div class="description_info">
                            <p class="p-0 mb-2">{{$single_product->short_description}}</p>
                           
                        </div>
                    </div>
                    
                    <!-- Additional Content -->
                    <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                        <div class="additionals">
                            <table class="table">
                                <tbody>
                                    {{-- {!! $single_product->long_description !!} --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Reviews Content -->
                    
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="reviews_info">
                            @forelse($reviews as $review)
                            <?php
                           $user =  App\Models\GuestLogin::find($review->customer_id);
                            ?>
                            @if($user)
                            <div class="single_rev d-flex align-items-start br-bottom py-3">
                                <div class="single_rev_thumb">
                                    
                                    @if($user->photo == null)
  
                                    <img src="{{Avatar::create($user->name)->toBase64()}}" 
                                    class="img-fluid circle" width="90" alt="" />
                                    
                                    
                                    @endif
                                  
                                </div>
                                <div class="single_rev_caption d-flex align-items-start pl-3">
                                    <div class="single_capt_left">
                                        <h5 class="mb-0 fs-md ft-medium lh-1">
                                           
                                            {{App\Models\GuestLogin::find($review->customer_id)->name}}
                                        </h5>
                                        <span class="small">30 jul 2021</span>
                                        <p>{{$review->review}}</p>
                                        @if($review->image)
                                        <img src="{{asset('Review_images/'.$review->image)}}" style="width:50px;" alt="">
                                        @endif
                                    </div>
                                    <div class="single_capt_right">
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                            <?php
                                                $total = 5;
                                                $remaning_star = $total - $review->star
                                               
                                                ?>
                                               @for($i=1 ; $i<=$total ; $i++)
                                               @if($i<=$review->star)
                                               <i class="fas fa-star filled"></i>
                                               @else
                                               <i class="fas fa-star"></i>
                                               @endif
                                            @endfor
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @empty

                            @endforelse
                          
                        </div>
                        @auth('guestlogin')
                        @if(App\Models\OrderProdcut::where('customer_id',Auth::guard('guestlogin')->user()->id)->where('product_id',$single_product->id)->exists())
                        @if(App\Models\OrderProdcut::where('customer_id',Auth::guard('guestlogin')->user()->id)->where('product_id',$single_product->id)->whereNotNull('review')->first()==false)
                        
                        <div class="reviews_rate">
                            <form class="row" action="{{route("review.store")}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <h4>Submit Rating</h4>
                                </div>
                                <input type="file" name="image">
                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded mb-2 mt-1">
                                        <div class="srt_013">
                                            <div class="submit-rating">
                                              <input id="star-5" type="radio" name="rating" value="5" />
                                              <label for="star-5" title="5 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                              </label>
                                              <input id="star-4" type="radio" name="rating" value="4" />
                                              <label for="star-4" title="4 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                              </label>
                                              <input id="star-3" type="radio" name="rating" value="3" />
                                              <label for="star-3" title="3 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                              </label>
                                              <input id="star-2" type="radio" name="rating" value="2" />
                                              <label for="star-2" title="2 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                              </label>
                                              <input id="star-1" type="radio" name="rating" value="1" />
                                              <label for="star-1" title="1 star">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                              </label>
                                            </div>
                                        </div>
                                        
                                        <div class="srt_014">
                                            <h6 class="mb-0">4 Star</h6>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="medium text-dark ft-medium">Full Name</label>
                                        <input type="text" value="{{Auth::guard('guestlogin')->user()->name}}" class="form-control" />
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="medium text-dark ft-medium">Email Address</label>
                                        <input type="email" value="{{Auth::guard('guestlogin')->user()->email}}" class="form-control" />
                                    </div>
                                </div>

                                <input type="hidden" name="customer_id" value="{{Auth::guard('guestlogin')->id()}}" class="form-control">
                                <input type="hidden" name="product_id" value="{{$single_product->id}}" class="form-control">
                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="medium text-dark ft-medium">Description</label>
                                        <textarea class="form-control" name="review"></textarea>
                                    </div>
                                </div>
                                 
                                
                                

                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group m-0">
                                        <button class="btn btn-white stretched-link hover-black" type="submit">Submit Review <i class="lni lni-arrow-right"></i></button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        @else
                        <div class="alert alert-info">
                            <h3>You Have Already Reviewd This Product</h3>
                            </div>
                        @endif
                        @else
                        <div class="alert alert-info">
                        <h3>Please Purchase This Product to review</h3>
                        </div>
                        @endif
                      
                        @else
                       <div class="alert alert-info">
                        <h3>Please Login To Add A Review <a href="{{url("register/login")}}" class="float-right btn btn-success">Login/Register</a></h3>
                       </div>
                        @endauth
                    </div>
                 
                
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Product Description End ==================== -->

<!-- ======================= Similar Products Start ============================ -->
<section class="middle pt-0">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Similar Products</h2>
                    <h3 class="ft-bold pt-3">Matching Products</h3>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="slide_items">
                    @forelse($matching_product as $matching)
                    
                    <!-- single Item -->
                    <div class="single_itesm">
                        <div class="product_grid card b-0 mb-0">
                            <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="{{route('single_product.details',$matching->slug)}}"><img class="card-img-top" src="{{asset('Products/product_preview/'.$matching->preview)}}" alt="..."></a>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                <div class="text-left">
                                    <div class="text-center">
                                        <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="{{route('single_product.details',$matching->slug)}}">{{$matching->product_name}}</a></h5>
                                        <div class="elis_rty"><span class="ft-bold fs-md text-dark">Tk{{$matching->after_discount}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    There Are No Matching Product
                    @endforelse
                    <!-- single Item -->
                  
                    
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- ======================= Similar Products Start ============================ -->


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

  
{{-- <script>
    $(document).ready(function () {
        $(".color_id").click(function () {
            alert("This is an alert message!");
        });
    });
</script> --}}

</div>

    
</section>

<script>
    $(document).ready(function () {
   $('.color_id').click(function(){
       var color_id = $(this).val();
       var product_id = '{{$single_product->id}}';
      
       $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
     url:'/getSize',
     type:'POST',
     data:{'color_id':color_id, 'product_id':product_id},
     success:function(data){
        $('.size_id').html(data);
     }
});
   });
});
</script>

@if(session('login'))
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
  icon: 'error',
  title: '{{session('login')}}'
})
</script>
@endif
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


@endsection