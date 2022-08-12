<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.admin.category.all', compact('categories'));
    }

    function showTab()
    {
        $categories = Category::where('status', '1')->get();
        $tabs = explode("|", DB::table("tab_category_home")->first()->select_categories);
        return view('pages.admin.category.tab', compact('categories', 'tabs'));
    }

    public function addShowTab(Request $request)
    {
        if ($request->tab_show) {
            $tabs = implode("|", $request->tab_show);
            DB::table("tab_category_home")->update(['select_categories' => $tabs]);
        }
        toast('Cập nhật thành công', 'success');

        return back();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.admin.category.add');
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
            'name' => 'unique:categories',
        ]);
        if ($validator->fails()) {
            toast('Vui lòng nhập tên khác', 'warning');
            return back();
        }
        $category = new Category();
        if ($request->hasFile('image')) {
            $name = $request->image->hashName();
            $category->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->status = $request->status;
        $category->save();

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
        $category = Category::find($id);
        return view('pages.admin.category.edit', compact('category'));
    }

    public function delete($id)
    {
        $category = Category::find($id);
        return view('pages.admin.category.delete', compact('category'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            toast('Vui lòng nhập tên', 'warning');
            return back();
        }
        $category = Category::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path('images/' . $category->image));
            $name = $request->image->hashName();
            $category->image = $name;
            $request->file('image')->move(public_path('images'), $name);
        }
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->status = $request->status;
        $category->update();
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

        $category = Category::find($id);
        if ($category->image) {
            File::delete(public_path('images/' . $category->image));
        }
        $category->delete();
        toast('Xóa thành công', 'success');

        return back();
    }
}
