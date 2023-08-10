<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SslCommerzPaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//frontend
Route::get('/', [App\Http\Controllers\FrontendController::class, 'kumo_homepage'])->name('kumo.homepage');
//search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

Route::get('register/login', [App\Http\Controllers\RegisterLoginController::class, 'register_login'])->name('register.login');
Route::post('guest/register', [App\Http\Controllers\RegisterLoginController::class, 'guest_register'])->name('guest.register');
Route::post('guest/login', [App\Http\Controllers\RegisterLoginController::class, 'guest_login'])->name('guest.login');
Route::get('guest/logout', [App\Http\Controllers\RegisterLoginController::class, 'guest_logout'])->name('guest.logout');


//email verified
Route::get('customer/email/verify/{token}', [App\Http\Controllers\RegisterLoginController::class, 'customer_email_verify']);


// Single Product Details 
Route::get('single/product/details/{slug}', [App\Http\Controllers\ProductController::class, 'single_product_details'])->name('single_product.details');
Route::post('/getSize', [App\Http\Controllers\ProductController::class, 'getSize']);

//cart
Route::post('/cart/store', [App\Http\Controllers\CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart_item/delete/{id}', [App\Http\Controllers\CartController::class, 'cart_item_delete'])->name('cart_item.delete');
Route::get('/delete_selected_cart', [App\Http\Controllers\CartController::class, 'delete_selected_cart'])->name('delete_selected_cart');
Route::get('/view_cart', [App\Http\Controllers\CartController::class, 'view_cart'])->name('view.cart');
Route::post('/update_cart', [App\Http\Controllers\CartController::class, 'update_cart'])->name('update.cart');


//checkout
Route::post('/checkout_page', [App\Http\Controllers\CheckoutController::class, 'checkout_page'])->name('checkout.page');
Route::post('/getCity', [App\Http\Controllers\CheckoutController::class, 'getCity']);

//Order Store
Route::post('/order/store', [App\Http\Controllers\CheckoutController::class, 'order_store'])->name('order.store');

//order Complete

Route::get('/order/complete', [App\Http\Controllers\CheckoutController::class, 'order_complete'])->name('order.complete');

//pdf download
Route::get('/pdf/download/', [App\Http\Controllers\PDFcontroller::class, 'download'])->name('pdf.download');

//user_profile
Route::get('/user/profile_page/', [App\Http\Controllers\ProfilePageController::class, 'user_profile_page'])->name('user.profile_page');
Route::post('/user/profile_page/update', [App\Http\Controllers\ProfilePageController::class, 'profile_update'])->name('profile.update');

//customer_order_list
Route::get('/customer/order_list/', [App\Http\Controllers\OrderListController::class, 'customer_order_list'])->name('customer.order_list');


//customer wishlist
Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'wishlist'])->name('wishlist');
Route::get('/wishlist/cancel/{id}', [App\Http\Controllers\WishlistController::class, 'wishlist_cancel'])->name('wishlist.cancel');



Auth::routes();
//admin logout
Route::get('/admin/logout', [App\Http\Controllers\HomeController::class, 'admin_logout'])->name('admin.logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//pass change Admin
Route::post('forget-password', [App\Http\Controllers\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('/pass/reset/form/{id}', [App\Http\Controllers\ForgotPasswordController::class, 'pass_reset_form'])->name('pass.reset.form');
Route::post('/pass/change/{id}', [App\Http\Controllers\ForgotPasswordController::class, 'pass_change'])->name('pass.change');



//Top Banner 
Route::get('/top/banners_add', [App\Http\Controllers\BannerController::class, 'top_banners_add'])->name('top.banners_add');
Route::post('/add/top_banner', [App\Http\Controllers\BannerController::class, 'add_top_banner'])->name('add.top_banner');
Route::get('top_banner/turn_off/{id}', [App\Http\Controllers\BannerController::class, 'top_banner_turn_off'])->name('top_banner_turn_off');
Route::get('top_banner/turn_on/{id}', [App\Http\Controllers\BannerController::class, 'top_banner_turn_onn'])->name('top_banner_turn_onn');

//Admin Brand Add
Route::get('/brand/add', [App\Http\Controllers\BannerController::class, 'brand_add'])->name('brand_add');
Route::post('/add/brand', [App\Http\Controllers\BannerController::class, 'add_brand'])->name('add.brand');
//Admin Middle Banner
Route::get('/middle/banner', [App\Http\Controllers\BannerController::class, 'middle_banner'])->name('middle.banner');
Route::post('/add/middle_banner', [App\Http\Controllers\BannerController::class, 'add_middle_banner'])->name('add.middle_banner');



//admin list
Route::get('/admins/info', [App\Http\Controllers\AdminController::class, 'admins_info'])->name('admins.info');
//admin delete
Route::post('/delete/user', [App\Http\Controllers\AdminController::class, 'delete_user'])->name('delete.user');
//admin edit
Route::get('/admins/edit/{id}', [App\Http\Controllers\AdminController::class, 'admin_edit'])->name('admin.edit');
Route::post('/admins/edit/confirm/{id}', [App\Http\Controllers\AdminController::class, 'admin_edit_confirm'])->name('admin.edit.confirm');
//admin categories
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'categories'])->name('categories');
Route::post('/category/insert', [App\Http\Controllers\CategoryController::class, 'category_insert'])->name('category.insert');
Route::post('/categories/delete', [App\Http\Controllers\CategoryController::class, 'category_delete'])->name('category.delete');
Route::post('/update/category', [App\Http\Controllers\CategoryController::class, 'update_category'])->name('update.user');

//Admin subcategory

Route::get('/subcategory', [App\Http\Controllers\SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/insert', [App\Http\Controllers\SubcategoryController::class, 'subcategory_insert'])->name('subcategory.insert');

//Admin Add Product

Route::get('/add/product', [App\Http\Controllers\AddProductController::class, 'add_product'])->name('add.product');
Route::post('/getSubcategory', [App\Http\Controllers\AddProductController::class, 'getsubcategory'])->name('getsubcategory');
Route::post('/add/productconfirm', [App\Http\Controllers\AddProductController::class, 'add_productconfirm'])->name('add.productconfirm');
Route::post('/adds', [App\Http\Controllers\AddProductController::class, 'add'])->name('add');
Route::get('/show/products', [App\Http\Controllers\AddProductController::class, 'show_products'])->name('show.products');
Route::get('/categorywise/products/{id}', [App\Http\Controllers\AddProductController::class, 'categorywise_products'])->name('categorywise.products');
Route::get('show/{name}/{id}', [App\Http\Controllers\AddProductController::class, 'show_the_product'])->name('show.the.product');
//Admin product brand
Route::get('add/brand', [App\Http\Controllers\AddProductController::class, 'add_brand'])->name('add.brand');
Route::post('brand/add', [App\Http\Controllers\AddProductController::class, 'brand_add'])->name('brand.add');

//Admin add Featured Product
Route::get('add/featured/{id}', [App\Http\Controllers\AddProductController::class, 'add_featured'])->name('add.featured');
Route::get('remove/featured/{id}', [App\Http\Controllers\AddProductController::class, 'remove_featured'])->name('remove.featured');


//Admin add inventory
Route::get('/add/inventory/{name}/{id}', [App\Http\Controllers\AddProductController::class, 'add_inventory'])->name('add.inventory');
Route::post('/add/inventory_store', [App\Http\Controllers\AddProductController::class, 'add_inventory_store'])->name('add.inventory_store');
Route::get('/all/inventories', [App\Http\Controllers\AddProductController::class, 'all_inventories'])->name('all.inventories');
Route::get('/inventorybase/productshow/{id}', [App\Http\Controllers\AddProductController::class, 'inventorybase_productshow'])->name('inventorybase.productshow');
Route::get('/add/variation', [App\Http\Controllers\AddProductController::class, 'add_variation'])->name('add.variation');
//admin Color Add(Inventory)
Route::post('/add/color', [App\Http\Controllers\AddProductController::class, 'add_color'])->name('add.color');
Route::post('/add/sizes', [App\Http\Controllers\AddProductController::class, 'add_sizes'])->name('add.sizes');
Route::get('/deleted/selected', [App\Http\Controllers\AddProductController::class, 'deleted_selected'])->name('deleted.selected');
Route::get('/deleted/selected/subcategory', [App\Http\Controllers\AddProductController::class, 'deleted_selected_subcategory']);
Route::get('/trashed/categories', [App\Http\Controllers\CategoryController::class, 'trashed_categories'])->name('trashed.categories');
Route::get('/category/restore/{id}', [CategoryController::class, 'category_restore'])->name('category.restore');

//admin coupon
Route::get('/add/coupon', [App\Http\Controllers\CouponController::class, 'add_coupon'])->name('add.coupon');
Route::post('/coupon/store', [App\Http\Controllers\CouponController::class, 'coupon_store'])->name('coupon.store');

//admin Order List
Route::get('/orders/list', [App\Http\Controllers\AdminOrderController::class, 'orders_lists'])->name('orders.list');

//Admin Order status
Route::get('/order/status', [App\Http\Controllers\AdminOrderController::class, 'order_status'])->name('order.status');




//Frontend
// Route::get('/kumo/homepage', [CategoryController::class, 'kumo_homepage'])->name('kumo.homepage');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


//review
Route::post('/review/store', [App\Http\Controllers\ReviewController::class, 'review_store'])->name('review.store');






