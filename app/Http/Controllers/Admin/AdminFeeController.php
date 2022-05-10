<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fees = Fee::orderBy('fee_matp', 'desc')->get();
        $cities = DB::table('devvn_tinhthanhpho')->get();
        return view('pages.admin.fee.all', compact('fees', 'cities'));
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

    public function getAddress(Request $request)
    {

        $html = '<option>=== Chọn ===</option>';
        if ($request->name == 'city') {
            $provinces = DB::table('devvn_quanhuyen')->where('matp', $request->valueId)->orderBy('maqh', 'asc')->get();
            foreach ($provinces as $province) {
                $html .= '<option value=' . "$province->maqh" . '>' . $province->qh_name . '</option>';
            }
            return $html;
        } else {
            $wards = DB::table('devvn_xaphuongthitran')->where('maqh', $request->valueId)->orderBy('xaid', 'asc')->get();
            foreach ($wards as $ward) {
                $html .= '<option value=' . "$ward->xaid" . '>' . $ward->xa_name . '</option>';
            }
            return $html;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $fee = Fee::where('fee_matp', $request->fee_matp)->where('fee_maqh', $request->fee_maqh)->where('fee_xaid', $request->fee_xaid)->first();

        if ($fee) {
            $fee->fee_maqh = $data['fee_maqh'];
            $fee->fee_xaid = $data['fee_xaid'];
            $fee->fee_matp = $data['fee_matp'];
            $fee->price = $data['price'];
            $fee->save();
        } else {
            $fee = new Fee();
            $fee->fee_maqh = $data['fee_maqh'];
            $fee->fee_xaid = $data['fee_xaid'];
            $fee->fee_matp = $data['fee_matp'];
            $fee->price = $data['price'];
            $fee->save();
        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
