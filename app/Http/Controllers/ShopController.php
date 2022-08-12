<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function shop_view(Request $request, $view = null, $id = null)
    {

        if ($request->brand) {
            $products = Product::where('status', '1')->where('brand_id', $request->brand);
            $name = Brand::find($request->brand)->name;
        } else if ($request->category) {
            $products = Product::where('status', '1')->where('category_id', $request->category);
            $name = Category::find($request->category)->name;
        } else {
            $products = Product::where('status', '1');
            $name = "Sản phẩm";
        }


        if ($request->sort) {
            switch ($request->sort) {
                case 'price_asc':
                    $products = $products->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $products = $products->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $products = $products->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $products = $products->orderBy('name', 'desc');
                    break;
                case 'newest':
                    $products = $products->orderBy('created_at', 'desc');
                    break;
                default:
                    $products = $products;
                    break;
            }
        }
        if ($request->min_price && $request->max_price) {
            $products = $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        $products = $products->paginate(12);

        return view('pages.shop', compact('products', 'name'));
    }

    function shop_search(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->where('status', '1')->paginate(9);
        $name = "Kết quả tìm kiếm: $request->search";
        return view('pages.shop', compact('products', 'name'));
    }
}
