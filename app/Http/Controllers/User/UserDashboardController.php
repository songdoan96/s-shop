<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $totalCost = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->sum('total');
        $totalPurchase = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->count();
        $totalDelivered = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->count();
        $totalCanceled = Order::where('status', 'canceled')->where('user_id', Auth::user()->id)->count();


        $totalCostToday = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->whereDay('delivered_date', Carbon::now()->day)->sum('total');
        $totalPurchaseToday = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->whereDay('created_at', Carbon::now()->day)->count();
        $totalDeliveredToday = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->whereDay('delivered_date', Carbon::now()->day)->count();
        $totalCanceledToday = Order::where('status', 'canceled')->where('user_id', Auth::user()->id)->whereDay('canceled_date', Carbon::now()->day)->count();

        return view('pages.user.dashboard', compact(
            'totalCost',
            'totalPurchase',
            'totalDelivered',
            'totalCanceled',
            'totalCostToday',
            'totalPurchaseToday',
            'totalDeliveredToday',
            'totalCanceledToday',
        ));
    }
}
