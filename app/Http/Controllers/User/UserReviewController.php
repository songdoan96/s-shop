<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    function reviews(Request $request)
    {
        $orderItem = OrderItem::find($request->order_item_id);
        return view('pages.user.review', compact('orderItem'));
    }

    function addReview(Request $request)
    {
        $review = new Review();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->order_item_id = $request->order_item_id;
        OrderItem::where('id', $request->order_item_id)->update(['r_status' => true]);
        $review->save();
        toast('Xin cảm ơn bạn đã đánh giá', 'success');
        return redirect()->route('user.orders');
    }
}
