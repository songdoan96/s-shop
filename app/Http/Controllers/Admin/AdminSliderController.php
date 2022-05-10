<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminSliderController extends Controller
{
    function slider()
    {
        $sliders = HomeSlider::paginate(15);
        return view('pages.admin.slider.all', compact('sliders'));
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpg,bmp,png',
        ]);
        if ($validator->fails()) {
            toast('Vui lòng chọn ảnh đúng định dạnh', 'warning');
            return back();
        }
        $slider = new HomeSlider();

        if ($request->image) {
            $name = $request->image->hashName();
            $slider->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->link = $request->link;
        $slider->desc = $request->desc;
        $slider->status = $request->status;
        $slider->price = $request->price;

        $slider->save();

        toast('Thêm thành công', 'success');

        return back();
    }

    public function edit(Request $request)
    {
        $slider = HomeSlider::find($request->id);
        return view('pages.admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = HomeSlider::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path('images/' . $slider->image));
            $name = $request->image->hashName();
            $slider->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->link = $request->link;
        $slider->desc = $request->desc;
        $slider->status = $request->status;
        $slider->price = $request->price;
        $slider->update();

        toast('Cập nhật thành công', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $slider = HomeSlider::find($request->id);
        return view('pages.admin.slider.delete', compact('slider'));
    }

    function destroy($id)
    {
        $slider = HomeSlider::findOrFail($id);
        if ($slider->image) {
            File::delete(public_path('images/' . $slider->image));
            File::delete(public_path('images/' . $slider->image));
        }
        $slider->delete();
        toast('Xóa thành công', 'success');

        return back();
    }
}
