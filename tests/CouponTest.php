<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class CouponTest extends TestCase
{
    /**
     * A basic functional Coupon List.
     *
     * @return void
     */
    public function testCouponAll()
    {
        $this->json('GET', '/coupon/all')
             ->seeJson([
                'status' => 200,
             ]);
    }

    /**
     * A basic functional Coupon Create.
     *
     * @return void
     */
    public function testCouponCreate()
    {
        $this->json('POST', '/coupon/create',
                [
                    "coupon_type_id" => "1", // percentage
                    "code" => "zxcasd",
                    "description" => "Sample Coupon",
                    "value" => 10,
                    "quantity" => 10,
                    "start_date" => '2016-09-17 00:00:00',
                    "end_date" => '2016-09-19 00:00:00',
                ]
            )
             ->seeJson([
                'status' => 200,
             ]);
    }

}
