<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function dashboard()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
        $totalSales = Order::where('status', 'delivered')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total');
        $todaySales = Order::where('status', 'delivered')->whereDate('delivered_date', Carbon::today())->count();
        $todayRevenue = Order::where('status', 'delivered')->whereDate('delivered_date', Carbon::today())->sum('total');

        return view('pages.admin.dashboard', compact(
            'orders',
            'totalSales',
            'totalRevenue',
            'todaySales',
            'todayRevenue',
        ));
    }
}
