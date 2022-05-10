<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        if (!session('address')) {

            Alert::warning('', 'Vui lòng chọn địa chỉ thanh toán');
            return back();
        }


        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'phone' => 'required',
            'street' => 'required',
            'email' => 'email',
        ]);

        if ($validator->fails()) {
            Alert::warning('', 'Vui lòng điền đầy đủ thông tin thanh toán');
            return back()->withInput();
        }

        $shipping = new Shipping();
        $shipping->full_name = $request->full_name;
        $shipping->phone = $request->phone;
        $shipping->email = $request->email;
        $shipping->street = $request->street;
        $shipping->ward = session('address')['xa_name'];
        $shipping->province = session('address')['qh_name'];
        $shipping->city = session('address')['tp_name'];
        $shipping->note = $request->note;
        $shipping->save();

        $shipping_id = $shipping->id;
        $user_id = Auth::user()->id;


        $order = new Order();
        $order->user_id = $user_id;
        $order->shipping_id = $shipping_id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->fee_ship = session()->get('address')['price'];
        $order->status = "ordered";
        $order->coupon_code = session()->get('coupon') ? session()->get('coupon')['code'] : "";
        $order->cart_subtotal = session()->get('checkout')['cart_subtotal'];
        $order->save();


        foreach (Cart::instance('cart')->content() as $key => $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;

            $orderItem->save();
        }
        session()->remove('address');
        session()->remove('coupon');
        session()->remove('checkout');

        Cart::instance('cart')->destroy();

        Alert::success('', 'Đặt hàng thành công');
        return redirect()->route('shop');
    }
}
