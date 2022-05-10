<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserOrderController extends Controller
{
    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(12);
        return view('pages.user.order.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);
        return view('pages.user.order.detail', compact('order'));
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->status = "canceled";
        $order->canceled_date = DB::raw('CURRENT_TIMESTAMP');
        $order->save();
        toast('Đã hủy đơn hàng', 'success', 'top-end');
    }
}
