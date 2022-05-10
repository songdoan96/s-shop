<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function __destruct()
    {

        // if (Auth::user()) {
        //     Cart::instance('cart')->store(Auth::user()->email);
        // }
    }

    public function cart()
    {

        return view('pages.cart');
    }

    function addToCart(Request $request)
    {
        Cart::instance('cart')->add(
            $request->id,
            $request->name,
            $request->qty,
            (int)($request->price)
        )->associate('App\Models\Product');
        if (Auth::user()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }

        return Cart::instance('cart')->content()->count();
    }

    function cartCount()
    {
        return view('cart_count');
    }

    function increaseQty(Request $request)
    {
        $qty = Cart::instance('cart')->get($request->rowId)->qty + 1;
        Cart::instance('cart')->update($request->rowId, $qty);
        toast('Cập nhật thành công', 'success');

        return Cart::instance('cart')->get($request->rowId);
    }

    function decreaseQty(Request $request)
    {
        $qty = Cart::instance('cart')->get($request->rowId)->qty - 1;
        if ($qty > 0) {
            Cart::instance('cart')->update($request->rowId, $qty);
            toast('Cập nhật thành công', 'success');
        }

        return Cart::instance('cart')->get($request->rowId);
    }

    function removeItem(Request $request)
    {
        Cart::instance('cart')->remove($request->rowId);
        toast('Đã xóa sản phẩm', 'success');
        if (Auth::user()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        return 1;
    }
}
