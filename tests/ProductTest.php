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
                    "name" => "Xiaomi Redmi 1S",
                    "description" => "Entry level xiaomi",
                    "price" => 1500000,
                    "quantity" => 1
                ]
            )
             ->seeJson([
                'status' => 200,
             ]);
    }
}
