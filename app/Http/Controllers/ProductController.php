<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use App\Helpers\ResponseHelpers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::all();
        return response()->json(ResponseHelpers::returnJsonData(Response::HTTP_OK, $products, ''));
    }

    public function create(Request $request)
    {
        // check if input valid or invalid
        $postJSON = $request->json()->all();
        $v = \Validator::make($postJSON, Product::$rules);

        if ($v->fails()) {
            return response()->json(ResponseHelpers::returnJson(Response::HTTP_BAD_REQUEST, $v->errors()->all()));
        }

        Product::newProduct($postJSON);
        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Created'));
    }
}
