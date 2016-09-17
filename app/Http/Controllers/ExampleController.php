<?php

namespace App\Http\Controllers;

use App\Http\Models\Order;
use App\Http\Models\User;
use App\Helpers\ResponseHelpers;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function testEloquent()
    {
        $order = new Order();
        $order->order_id = Uuid::uuid4();
        $order->user_id = '123123';
        $order->total = 20000000;
        $order->save();
        return response()->json(ResponseHelpers::returnJson(Response::HTTP_OK, 'Created'));

        // Order::destroy(['313']);
        // return response()->json(ResponseHelpers::returnJson(200, 'Deleted.'));

        // $user = new User();
        // $user->user_id = '313'.time();
        // $user->user_type = '1';
        // $user->name = 'Fajri';
        // $user->username = 'clasense4';
        // $user->email = 'clasense4@gmail.com';
        // $user->password = 'asdqwyetqiwgeh';
        // $user->phone_number = '081224507359';
        // $user->address = 'Bandung 313354';
        // $user->save();
    }
}
