<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Coupon;
use App\Models\Fee;
use App\Models\Province;
use App\Models\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public $discount, $subtotalAfterDiscount, $taxAfterDiscount, $totalAfterDiscount, $fee_ship;

    public function checkout()
    {
        if (Auth::user()) {
            if (session()->has('coupon')) {
                $this->calculateDiscounts();
            }

            $cities = DB::table('devvn_tinhthanhpho')->get();
            $this->setCheckout();
            return view('pages.checkout', compact('cities'));
        } else {
            session()->forget('coupon');
            return redirect('/login');
        }


        // return view('pages.checkout');
    }

    public function applyCouponCode(Request $request)
    {
        // session()->forget('coupon');
        // session()->forget('checkout');
        if ($request->code) {
            $coupon = Coupon::where('code', $request->code)->where('quantity', '>', '0')->where('exp_date', '>=', Carbon::now())->first();
            if ($coupon) {
                // Mã ok
                session()->put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'max_value' => $coupon->max_value,
                    'exp_date' => $coupon->exp_date,
                ]);
            } else {
                Alert::warning('', 'Không tìm thấy mã hoặc mã đã hết hạn');
                return back();
            }
        }
        toast('Áp mã thành công', 'success', 'top-right');
        return back();
    }

    public function deleteCoupon()
    {
        session()->forget('coupon');
        return back();
    }

    public function calculateDiscounts()
    {

        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] === 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = ceil((Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100);
            }
            $this->discount = $this->discount <= session('coupon')['max_value'] ? $this->discount : session('coupon')['max_value'];
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount = ceil($this->subtotalAfterDiscount * config('cart.tax') / 100);
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function setCheckout()
    {
        $this->getFeeShip();

        if (!Cart::instance('cart')->count() > 0) {
            session()->forget('checkout');
            return;
        }
        $fee_ship = $this->getFeeShip();
        if (session()->has('coupon')) {
            session()->put('checkout', [
                'cart_subtotal' => Cart::instance('cart')->subtotal(),
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount + $fee_ship,
            ]);
        } else {
            session()->put('checkout', [
                'cart_subtotal' => Cart::instance('cart')->subtotal(),
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total() + $fee_ship,
            ]);
        }
    }

    public function getAddress(Request $request)
    {
        // $selected=selected="{{ $city->matp == session('address')['fee_matp'] ? 'true' : 'false' }}"

        if ($request->name == 'city') {
            $provinces = DB::table('devvn_quanhuyen')->where('matp', $request->valueId)->orderBy('maqh', 'asc')->get();
            $html = '<option>Huyện *</option>';
            foreach ($provinces as $province) {
                $html .= '<option value=' . "$province->maqh" . '>' . $province->qh_name . '</option>';
            }
            return $html;
        } else {
            $wards = DB::table('devvn_xaphuongthitran')->where('maqh', $request->valueId)->orderBy('xaid', 'asc')->get();
            $html = '<option>Xã * </option>';
            foreach ($wards as $ward) {
                $html .= '<option value=' . "$ward->xaid" . '>' . $ward->xa_name . '</option>';
            }
            return $html;
        }
    }

    public function calculateFee(Request $request)
    {
        $address = Fee::where(['fee_matp' => $request->matp, 'fee_maqh' => $request->maqh, 'fee_xaid' => $request->xaid])->first();
        $price = $address ? $address->price : 0;
        session()->put('address', [
            'price' => $price,
            'tp_name' => City::where(['matp' => $request->matp])->first()->tp_name,
            'qh_name' => Province::where(['maqh' => $request->maqh])->first()->qh_name,
            'xa_name' => Ward::where(['xaid' => $request->xaid])->first()->xa_name,
        ]);
    }

    public function getFeeShip()
    {
        return $this->fee_ship = session('address') ? session('address')['price'] : 0;
    }

    public function deleteAddress()
    {
        session()->remove('address');
        return back();
    }
}
