<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(20);
        return view('pages.admin.order.all', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);
        return view('pages.admin.order.detail', compact('order'));
    }

    public function editStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        if ($request->status == "delivered") {
            $order->delivered_date = DB::raw('CURRENT_TIMESTAMP');
            $this->afterOrder($order);
        } else {
            $order->canceled_date = DB::raw('CURRENT_TIMESTAMP');
        }
        $order->update();
        return redirect()->route('admin.orders');
    }

    public function sendEmailOrderShipped($order)
    {
        Mail::to($order->shipping->email)->send(new OrderShipped($order));
    }

    public function afterOrder($order)
    {
        // coupon
        $coupon = Coupon::where('code', $order->coupon_code)->first();
        if ($coupon) {
            $coupon->quantity = max($coupon->quantity - 1, 0);
            $coupon->save();
        }

        // Product qty
        foreach ($order->orderItems as $orderItem) {
            $product = Product::find($orderItem->product_id);
            $product->quantity = max($product->quantity - $orderItem->quantity, 0);
            $product->save();
        }
        // $this->sendEmailOrderShipped($order);

    }

    function printOrder($id)
    {

        $order = Order::findOrFail($id);
        $pdf = Pdf::loadView('pdf.order', ['order' => $order]);
        return $pdf->stream('download.pdf');
    }
}
