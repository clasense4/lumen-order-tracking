<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHello()
    {
        $this->get('/');

        $this->assertEquals(
            $this->response->getContent(), 'Hello Lumen'
        );
    }

    /**
     * A basic functional Product List.
     *
     * @return void
     */
    public function testProductAll()
    {
        $this->json('GET', '/product/all')
             ->seeJson([
                'status' => 200,
             ]);
    }

    /**
     * A basic functional Product Create.
     *
     * @return void
     */
    public function testProductCreate()
    {
        $this->json('POST', '/product/create',
                [
                    "product_type_id" => "1",
                    "name" => "Xiaomi Redmi Note",
                    "description" => "Mid level xiaomi",
                    "price" => 2000000,
                    "quantity" => 5,
                    "sku_code" => "XMRN1",
                ]
            )
             ->seeJson([
                'status' => 200,
             ]);
    }

    /**
     * A basic functional Product Create Failed, missing 1 param (product_type_id)
     *
     * @return void
     */
    public function testProductCreateFailed()
    {
        $this->json('POST', '/product/create',
                [
                    "name" => "Xiaomi Redmi Note 2",
                    "description" => "Mid level xiaomi",
                    "price" => 2100000,
                    "quantity" => 5,
                    "sku_code" => "XMRN2",
                ]
            )
             ->seeJson([
                'status' => 400,
             ]);
    }
}
