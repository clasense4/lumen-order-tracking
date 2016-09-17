<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    /**
     * A basic functional Order List.
     *
     * @return void
     */
    public function testOrderAll()
    {
        $this->json('GET', '/order/all')
             ->seeJson([
                'status' => 200,
             ]);
    }

    /**
     * A basic functional Order Create with coupon type Amount of discount.
     *
     * @return void
     */
    public function testOrderCouponAmountCreate()
    {
        $this->json('POST', '/order/create',
                [
                    "customer" => [
                        "name" => "Fajri Abdillah",
                        "phone_number" => "081224507359",
                        "email" => "clasense4@gmail.com",
                        "address" => "Jln. Sarimanis 1 XV / 26, Bandung 40151"
                    ],
                    "products" => [
                        [
                            "sku_code" => "XMR1S",
                            "quantity" => 1
                        ],
                        [
                            "sku_code" => "XMR2",
                            "quantity" => 1
                        ]
                    ],
                    "coupon_code" => "ss75"
                ]
            )
             ->seeJson([
                'status' => 200,
             ]);
    }

    /**
     * A basic functional Order Create with coupon type Percentage of discount.
     *
     * @return void
     */
    public function testOrderCouponPercentageCreate()
    {
        $this->json('POST', '/order/create',
                [
                    "customer" => [
                        "name" => "Fajri Abdillah",
                        "phone_number" => "081224507359",
                        "email" => "clasense4@gmail.com",
                        "address" => "Jln. Sarimanis 1 XV / 26, Bandung 40151"
                    ],
                    "products" => [
                        [
                            "sku_code" => "XMR1S",
                            "quantity" => 1
                        ],
                        [
                            "sku_code" => "XMR2",
                            "quantity" => 1
                        ]
                    ],
                    "coupon_code" => "ss50"
                ]
            )
             ->seeJson([
                'status' => 200,
             ]);
    }

    /**
     * A basic functional Order Create without Coupon.
     *
     * @return void
     */
    public function testOrderWithoutCoupon()
    {
        $this->json('POST', '/order/create',
                [
                    "customer" => [
                        "name" => "Fajri Abdillah",
                        "phone_number" => "081224507359",
                        "email" => "clasense4@gmail.com",
                        "address" => "Jln. Sarimanis 1 XV / 26, Bandung 40151"
                    ],
                    "products" => [
                        [
                            "sku_code" => "XMR1S",
                            "quantity" => 1
                        ],
                        [
                            "sku_code" => "XMR2",
                            "quantity" => 1
                        ]
                    ],
                ]
            )
             ->seeJson([
                'status' => 200,
             ]);
    }

    /**
     * A basic functional Order Failed Create Coupon Expired.
     *
     * @return void
     */
    public function testOrderExpiredCoupon()
    {
        $this->json('POST', '/order/create',
                [
                    "customer" => [
                        "name" => "Fajri Abdillah",
                        "phone_number" => "081224507359",
                        "email" => "clasense4@gmail.com",
                        "address" => "Jln. Sarimanis 1 XV / 26, Bandung 40151"
                    ],
                    "products" => [
                        [
                            "sku_code" => "XMR1S",
                            "quantity" => 1
                        ],
                        [
                            "sku_code" => "XMR2",
                            "quantity" => 1
                        ]
                    ],
                    "coupon_code" => "ss95"
                ]
            )
             ->seeJson([
                'status' => 400,
             ]);
    }

    /**
     * A basic functional Order Failed Create False Coupon.
     *
     * @return void
     */
    public function testOrderFalseCoupon()
    {
        $this->json('POST', '/order/create',
                [
                    "customer" => [
                        "name" => "Fajri Abdillah",
                        "phone_number" => "081224507359",
                        "email" => "clasense4@gmail.com",
                        "address" => "Jln. Sarimanis 1 XV / 26, Bandung 40151"
                    ],
                    "products" => [
                        [
                            "sku_code" => "XMR1S",
                            "quantity" => 1
                        ],
                        [
                            "sku_code" => "XMR2",
                            "quantity" => 1
                        ]
                    ],
                    "coupon_code" => "ssxs"
                ]
            )
             ->seeJson([
                'status' => 400,
             ]);
    }

    /**
     * A basic functional Order Create Failed, missing 1 param.
     *
     * @return void
     */
    public function testOrderCreateFailed()
    {
        $this->json('POST', '/product/create',
                [
                    "products" => [
                        [
                            "sku_code" => "XMR1S",
                            "quantity" => 1
                        ],
                        [
                            "sku_code" => "XMR2",
                            "quantity" => 1
                        ]
                    ],
                ]
            )
             ->seeJson([
                'status' => 400,
             ]);
    }
}
