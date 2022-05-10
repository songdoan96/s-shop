<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('pages.admin.coupon.all', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();

        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->max_value = $request->max_value;
        $coupon->status = $request->status;
        $coupon->exp_date = $request->exp_date;
        $coupon->quantity = $request->quantity;

        $coupon->save();

        toast('Thêm thành công', 'success');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('pages.admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->max_value = $request->max_value;
        $coupon->status = $request->status;
        $coupon->exp_date = $request->exp_date;
        $coupon->quantity = $request->quantity;
        $coupon->update();

        toast('Cập nhật thành công', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {

        $coupon = Coupon::find($id);
        return view('pages.admin.coupon.delete', compact('coupon'));
    }

    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();
        return back();
    }
}
