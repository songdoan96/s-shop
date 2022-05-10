<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('pages.admin.brand.all', compact('brands'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'unique:brands',
        ]);
        if ($validator->fails()) {
            toast('Vui lòng nhập tên khác', 'warning');
            return back();
        }
        $brand = new Brand();
        if ($request->hasFile('image')) {
            $name = $request->image->hashName();
            $brand->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        $brand->name = $request->name;
        $brand->desc = $request->desc;
        $brand->status = $request->status;
        $brand->save();

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
        $brand = Brand::find($id);
        return view('pages.admin.brand.edit', compact('brand'));
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        return view('pages.admin.brand.delete', compact('brand'));
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
        $brand = Brand::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path('images/' . $brand->image));
            $name = $request->image->hashName();
            $brand->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        $brand->name = $request->name;
        $brand->desc = $request->desc;
        $brand->status = $request->status;
        $brand->update();

        toast('Cập nhật thành công', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->image) {
            File::delete(public_path('images/' . $brand->image));
        }
        $brand->delete();
        toast('Xóa thành công', 'success');

        return back();
    }
}
