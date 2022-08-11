<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('pages.admin.product.all', compact('products', 'categories', 'brands'));
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
            'name' => 'unique:products',
        ]);
        if ($validator->fails()) {
            toast('Vui lòng nhập tên khác', 'warning');
            return back();
        }
        $product = new Product();
        if ($request->hasFile('image')) {
            $name = $request->image->hashName();
            $product->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        if ($request->images) {
            $imagesName = [];
            foreach ($request->images as $img) {
                $hasNameImages = $img->hashName();
                $img->move(public_path('images'), $hasNameImages);
                $imagesName[] = $hasNameImages;
            }
            $product->images = implode("|", $imagesName);
        }
        $product->name = $request->name;
        $product->slug = Str::slug($product->name);
        $product->desc = $request->desc;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->save();

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
        $product = Product::find($id);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('pages.admin.product.edit', compact('product', 'categories', 'brands'));
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
        $product = Product::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path('images/' . $product->image));
            $name = $request->image->hashName();
            $product->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        if ($request->hasFile('images')) {
            // Delete old images
            $oldImages = explode('|', $product->images);
            foreach ($oldImages as $oldImg) {
                File::delete(public_path('images/' . $oldImg));
            }
            // Add new images FtEHD13hYumyyXJaQRsps0AdJNKWnNxuYLBmzJqw.jpg
            $imagesName = [];
            foreach ($request->images as $img) {
                $hasNameImages = $img->hashName();
                $img->move(public_path('images'), $hasNameImages);
                $imagesName[] = $hasNameImages;
            }
            $product->images = implode("|", $imagesName);
        }
        $product->name = $request->name;
        $product->slug = Str::slug($product->name);
        $product->desc = $request->desc;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->save();

        toast('Chỉnh sửa thành công', 'success');

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
        // dd($id);
        $product = Product::find($id);
        return view('pages.admin.product.delete', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            File::delete(public_path('images/' . $product->image));
        }

        if ($product->images) {
            // Delete old images
            $oldImages = explode('|', $product->images);
            foreach ($oldImages as $oldImg) {
                File::delete(public_path('images/' . $oldImg));
            }
        }
        $product->delete();
        toast('Xóa thành công', 'success');

        return back();
    }
}
