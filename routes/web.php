<?php

use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminFeeController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserReviewController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', [HomeController::class, 'index']);
Route::post('/auto-search', [HomeController::class, 'autoSearch'])->name('home.autoSearch');



// Admin
Auth::routes();


Route::get('/product-details/{slug}', [ProductController::class, 'details'])->name('product.details');


// Checkout
Route::get('thanh-toan', [CheckoutController::class, 'checkout'])->name('checkout');

Route::post('apply-coupon-code', [CheckoutController::class, 'applyCouponCode'])->name('checkout.applyCouponCode');
Route::post('delete-coupon-code', [CheckoutController::class, 'deleteCoupon'])->name('checkout.deleteCouponCode');
Route::post('/get-address', [CheckoutController::class, 'getAddress'])->name('checkout.address.fee');
Route::post('/delete-address', [CheckoutController::class, 'deleteAddress'])->name('checkout.address.delete');
Route::post('/calculate-fee', [CheckoutController::class, 'calculateFee'])->name('checkout.calculate.fee');


// Cart
Route::get('gio-hang', [CartController::class, 'cart'])->name('cart');
Route::get('cart-count', [CartController::class, 'cartCount'])->name('cart.count');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');

Route::post('cart-increase', [CartController::class, 'increaseQty'])->name('cart.increaseQty');
Route::post('cart-decrease', [CartController::class, 'decreaseQty'])->name('cart.decreaseQty');
Route::post('cart-remove-item', [CartController::class, 'removeItem'])->name('cart.removeItem');




// Wishlist
Route::get('san-pham-yeu-thich', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('wishlist', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');
Route::post('wishlist-to-cart', [WishlistController::class, 'moveWishlistToCart'])->name('wishlist.move.cart');


// Shop

Route::post('/tim-kiem', [ShopController::class, 'shop_search'])->name('shop.search');
Route::get('/cua-hang', [ShopController::class, 'shop_view'])->name('shop');
// Route::get('/cua-hang/{view}/{id}', [ShopController::class, 'shop_view'])->name('shop.shop_view');
// Route::get('/shop-test', [ShopController::class, 'shop_test'])->name('shop.test');
// Route::get('/shop-test/{view}/{id}', [ShopController::class, 'shop_test'])->name('shop.test.view');



//Contact 
Route::get('/lien-he', [ContactController::class, 'contact'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'sendMessage'])->name('contact.message');


// Social
Route::get('/auth/redirect/{provider}', [SocialAuthController::class, 'socialRedirect'])->name('socialAuthRedirect');
Route::get('/auth/callback/{provider}', [SocialAuthController::class, 'socialCallback'])->name('socialAuthCallback');



// User
Route::middleware(['auth'])->group(function () {
    // Order
    Route::post('order', [OrderController::class, 'placeOrder'])->name('order');


    // UserOrder
    Route::get('/don-hang', [UserOrderController::class, 'orders'])->name('user.orders');
    Route::get('/chi-tiet-don-hang/{id}', [UserOrderController::class, 'orderDetails'])->name('user.order.details');
    Route::post('/huy-don-hang', [UserOrderController::class, 'cancelOrder'])->name('user.order.cancel');


    // Changer Password
    Route::get('/doi-mat-khau', [UserController::class, 'changePassword'])->name('user.change_password');
    Route::post('/doi-mat-khau', [UserController::class, 'storePassword'])->name('user.store.password');

    // Dashboard
    Route::get('/thong-ke', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');



    // Review
    Route::post('/danh-gia', [UserReviewController::class, 'reviews'])->name('user.reviews');
    Route::post('/them-danh-gia', [UserReviewController::class, 'addReview'])->name('user.review.add');
});

// Admin
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Category
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin_categories');
    Route::get('/add-category', [AdminCategoryController::class, 'create'])->name('admin_add_category');
    Route::post('/store-category', [AdminCategoryController::class, 'store'])->name('admin_store_category');
    Route::get('/delete-category/{id}', [AdminCategoryController::class, 'delete'])->name('admin_delete_category');

    Route::delete('/delete-category/{id}', [AdminCategoryController::class, 'destroy'])->name('admin_delete_category');
    Route::get('/edit-category/{id}', [AdminCategoryController::class, 'edit'])->name('admin_edit_category');
    Route::patch('/update-category/{id}', [AdminCategoryController::class, 'update'])->name('admin_update_category');

    Route::get('/categories-tab', [AdminCategoryController::class, 'showTab'])->name('admin_category_show_tab');
    Route::post('/categories-tab', [AdminCategoryController::class, 'addShowTab'])->name('admin_category_add_show_tab');


    // Brand
    Route::get('/brands', [AdminBrandController::class, 'index'])->name('admin_brands');
    Route::get('/add-brand', [AdminBrandController::class, 'create'])->name('admin_add_brand');
    Route::post('/store-brand', [AdminBrandController::class, 'store'])->name('admin_store_brand');
    Route::get('/delete-brand/{id}', [AdminBrandController::class, 'delete'])->name('admin_delete_brand');
    Route::delete('/delete-brand/{id}', [AdminBrandController::class, 'destroy'])->name('admin_destroy_brand');
    Route::get('/edit-brand/{id}', [AdminBrandController::class, 'edit'])->name('admin_edit_brand');
    Route::patch('/update-brand/{id}', [AdminBrandController::class, 'update'])->name('admin_update_brand');


    // Product
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin_products');


    Route::get('/add-product', [AdminProductController::class, 'create'])->name('admin_add_product');
    Route::post('/store-product', [AdminProductController::class, 'store'])->name('admin_store_product');

    Route::post('/delete-product/{id}', [AdminProductController::class, 'delete'])->name('admin_delete_product');
    Route::delete('/delete-product/{id}', [AdminProductController::class, 'destroy'])->name('admin_destroy_product');

    Route::post('/edit-product/{id}', [AdminProductController::class, 'edit'])->name('admin_edit_product');
    Route::patch('/update-product/{id}', [AdminProductController::class, 'update'])->name('admin_update_product');


    // Coupons
    Route::get('/coupons', [AdminCouponController::class, 'index'])->name('admin.coupons');
    Route::post('/store-coupon', [AdminCouponController::class, 'store'])->name('admin.store.coupon');

    Route::post('/delete-coupon/{id}', [AdminCouponController::class, 'delete'])->name('admin.delete.coupon');
    Route::delete('/delete-coupon/{id}', [AdminCouponController::class, 'destroy'])->name('admin.destroy.coupon');

    Route::post('/edit-coupon/{id}', [AdminCouponController::class, 'edit'])->name('admin.edit.coupon');
    Route::patch('/update-coupon/{id}', [AdminCouponController::class, 'update'])->name('admin.update.coupon');

    // Shipping Fee
    Route::get('/fees', [AdminFeeController::class, 'index'])->name('admin.ship.fees');
    Route::post('/store-fee', [AdminFeeController::class, 'store'])->name('admin.store.fee');
    Route::post('/get-address', [AdminFeeController::class, 'getAddress'])->name('admin.address.fee');


    // Order
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/order-sendmail', [AdminOrderController::class, 'sendMail'])->name('admin.orders.send.mail');
    Route::get('/order-details/{id}', [AdminOrderController::class, 'orderDetails'])->name('admin.order.details');
    Route::post('/order-edit-status', [AdminOrderController::class, 'editStatus'])->name('admin.order.edit.status');
    Route::get('/print-order/{id}', [AdminOrderController::class, 'printOrder'])->name('admin.order.print');


    // Contact
    Route::get('/contact', [AdminContactController::class, 'contact'])->name('admin.contact');

    // Slider
    Route::get('/slider', [AdminSliderController::class, 'slider'])->name('admin.slider');
    Route::post('/slider', [AdminSliderController::class, 'store'])->name('admin.store.slider');
    Route::post('/edit-slider', [AdminSliderController::class, 'edit'])->name('admin.edit.slider');
    Route::patch('/update-slider/{id}', [AdminSliderController::class, 'update'])->name('admin.update.slider');
    Route::post('/delete-slider', [AdminSliderController::class, 'delete'])->name('admin.delete.slider');
    Route::delete('/delete-slider/{id}', [AdminSliderController::class, 'destroy'])->name('admin.destroy.slider');


    // Info 
    Route::get('/info', [AdminSettingController::class, 'info'])->name('admin.setting');
    Route::post('/info', [AdminSettingController::class, 'saveSettings'])->name('admin.setting.save');


    // User
    Route::get('/users', [AdminUserController::class, 'users'])->name('admin.users');
    Route::get('/edit-role-user/{id}', [AdminUserController::class, 'userEditRole'])->name('admin.edit.role');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'isAdmin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
