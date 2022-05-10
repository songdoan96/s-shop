<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function __destruct()
    {
        // if (Auth::user()) {
        //     Cart::instance('wishlist')->store(Auth::user()->email);
        // }
    }

    function wishlist()
    {
        return view('pages.wishlist');
    }

    function addToWishlist(Request $request)
    {
        Cart::instance('wishlist')->add(
            $request->id,
            $request->name,
            $request->qty,
            (int)($request->price)
        )->associate('App\Models\Product');
        if (Auth::user()) {
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        return Cart::instance('wishlist')->content()->count();
    }

    public function moveWishlistToCart(Request $request)
    {
        $product = Cart::instance('wishlist')->get($request->rowId);
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->price)->associate('App\Models\Product');
        Cart::instance('wishlist')->remove($request->rowId);

        // return back();
    }
}
