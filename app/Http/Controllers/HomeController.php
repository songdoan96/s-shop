<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Setting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        if (Auth::user()) {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }
        $products = Product::where('status', 1)->orderBy('updated_at', 'desc')->take(12)->get();
        $tabs = explode("|", DB::table("tab_category_home")->first()->select_categories);
        $categories_tab = Category::find($tabs);
        $wishlists = Cart::instance('wishlist')->content()->pluck('id');
        $sliders = HomeSlider::where('status', 1)->get();

        $settings = Setting::findOrFail(1);
        return view('pages.home', compact('products', 'categories_tab', 'wishlists', 'sliders', 'settings'));
    }

    public function autoSearch(Request $request)
    {
        // Mysql
        // $products = Product::where('status', 1)->where("name", 'LIKE', '%' . $request->keywords . '%')->get();
        // PostgreSQL 
        $products = Product::where('status', 1)->where("name", 'LIKE', '%' . $request->keywords . '%')->get();
        $html = '';
        if ($products) {
            foreach ($products as $product) {
                $html .= '<li><a href="' . route('product.details', $product->slug) . '"><img src="' . asset("images/" . $product->image) . '" alt=""><span class="search-name">' . $product->name . '</span></a></li>';
            }
            return $html;
        } else {
            return "Không tìm thấy sản phẩm";
        }
    }
}
