<?php

use App\Models\Product;

function formatCurrent($number, $suffix = 'đ')
{
    if (isset($number)) {
        return number_format($number, 0, ',', '.') . " {$suffix}";
    }
}
function productMaxPrice()
{
    return Product::where('status', '1')->max('price');
}
function productMinPrice()
{
    return Product::where('status', '1')->min('price');
}
