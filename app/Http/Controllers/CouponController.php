<?php

namespace App\Http\Controllers;

use App\Http\Models\Coupon;
use App\Helpers\ResponseHelpers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function all(Request $request)
    {
        $coupons = Coupon::all();
        return response()->json(ResponseHelpers::returnJsonData(Response::HTTP_OK, $coupons, ''));
    }

    public function create(Request $request)
    {
        // check if input valid or invalid
        $postJSON = $request->json()->all();
        $v = \Validator::make($postJSON, Coupon::$rules);

        if ($v->fails()) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, $v->errors()->all()));
        }

        Coupon::newCoupon($postJSON);
        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Created'));
    }
}
