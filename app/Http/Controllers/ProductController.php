<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    function details($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $reviews = OrderItem::where('r_status', 1)->where('product_id', $product->id)->paginate(10);

        $count_rating = OrderItem::where('r_status', 1)->where('product_id', $product->id)->count();
        $arr = OrderItem::where('r_status', 1)->where('product_id', $product->id)->pluck('id');
        $sum_rating = Review::whereIn('order_item_id', $arr)->sum('rating');
        $avg_rating = $count_rating ? $sum_rating / $count_rating * 20 : 0;


        return view('pages.details', compact('product', 'reviews', 'avg_rating'));
    }
}
