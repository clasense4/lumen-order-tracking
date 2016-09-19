# Api Docs

## 1. Product

### 1.1. All

#### *Description*

Get all products

#### *Example Success Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/product/all
```

#### *Success Response*
```
{
    "status": 200,
    "message": [
        {
            "product_id": "77e42794-5816-47ea-a8df-95f4fbc3158c",
            "product_type_id": "1",
            "name": "Xiaomi Redmi 1s",
            "description": "First entry level xiaomi",
            "price": 1500000,
            "quantity": 15,
            "created_at": "2016-09-17 08:40:17",
            "updated_at": "2016-09-17 08:40:17",
            "deleted_at": null,
            "sku_code": "XMR1S"
        },
        {
            "product_id": "43825c86-945c-46c5-b4b1-3544bf8b16bf",
            "product_type_id": "1",
            "name": "Xiaomi Redmi 2",
            "description": "Second entry level xiaomi",
            "price": 1600000,
            "quantity": 13,
            "created_at": "2016-09-17 08:40:17",
            "updated_at": "2016-09-17 08:40:17",
            "deleted_at": null,
            "sku_code": "XMR2"
        }
    ]
}
```

#### *Example Error Request*

None

#### *Error Response*

None

### 1.2. Create

#### *Description*

Create a new product.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/product/create \
  --header 'content-type: application/json' \
  --data '{
    "product_type_id" : "1",
    "name" : "Xiaomi Redmi 1S",
    "sku_code" : "XMR1S",
    "description" : "Entry level xiaomi",
    "price" : 1500000,
    "quantity":1
}'
```

#### *Success Response*
```
{
    "status": 200,
    "message": "Created"
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/product/create \
  --header 'content-type: application/json' \
  --data '{
    "product_type_id" : "1",
    "name" : "Xiaomi Redmi 1S",
    "sku_code" : "XMR1S",
    "description" : "Entry level xiaomi",
    "price" : 1500000
}'
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The quantity field is required."
    ]
}
```

---

## 2. Coupon

### 2.1. All

#### *Description*

Get all available coupon

#### *Example Success Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/coupon/all
```

#### *Success Response*
```
{
    "status": 200,
    "data": [
        {
            "coupon_id": "f2461ad4-f656-4719-9ff4-01bbcf8c2b27",
            "coupon_type_id": "1",
            "code": "ss50",
            "description": "50% Discount",
            "value": 50,
            "quantity": 20,
            "created_at": "2016-09-17 08:40:17",
            "updated_at": "2016-09-17 08:40:17",
            "deleted_at": null,
            "start_date": "2016-09-16 00:00:00",
            "end_date": "2016-09-26 00:00:00"
        },
        {
            "coupon_id": "66c07e3d-d4f3-4f7d-abb0-8b3c0d312c0f",
            "coupon_type_id": "2",
            "code": "ss75",
            "description": "75K Discount",
            "value": 75000,
            "quantity": 20,
            "created_at": "2016-09-17 08:40:17",
            "updated_at": "2016-09-17 08:40:17",
            "deleted_at": null,
            "start_date": "2016-09-16 00:00:00",
            "end_date": "2016-09-26 00:00:00"
        },
        {
            "coupon_id": "f62497db-74f1-4038-b1ca-1f28142992da",
            "coupon_type_id": "2",
            "code": "ss95",
            "description": "95K Discount",
            "value": 95000,
            "quantity": 20,
            "created_at": "2016-09-16 08:40:17",
            "updated_at": "2016-09-16 08:40:17",
            "deleted_at": null,
            "start_date": "2016-09-06 00:00:00",
            "end_date": "2016-09-16 00:00:00"
        }
    ]
}
```

#### *Example Error Request*

None

#### *Error Response*

None


### 2.2. Create

#### *Description*

Create coupon

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/coupon/create \
  --header 'content-type: application/json' \
  --data '{
    "coupon_type_id" : "1",
    "code" : "zxcasd123",
    "description" : "Sample Coupon",
    "value" : 10,
    "quantity" : 10,
    "start_date" : "2016-09-17 00:00:00",
    "end_date" : "2016-09-19 00:00:00"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "message": "Created"
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/coupon/create \
  --header 'content-type: application/json' \
  --data '{
    "coupon_type_id" : "1",
    "code" : "zxcasd123",
    "description" : "Sample Coupon",
    "value" : 10,
    "quantity" : 10
}'
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The start date field is required.",
        "The end date field is required."
    ]
}
```

---

## 3. Order

### 3.1. All

#### *Description*

Get all order data

#### *Example Success Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/order/all
```

#### *Success Response*
```
{
    "status": 200,
    "data": [
        {
            "order_id": "c2340f67-cb98-4ce2-a8cd-4fd2d5ddf8a6",
            "user_id": "901243fb-ad47-45fe-8235-bb743357403e",
            "coupon_code": "ss75",
            "coupon_value": 75000,
            "total": 3025000,
            "total_before_coupon": 3100000,
            "valid_by": null,
            "valid_at": null,
            "shipping_code": null,
            "created_at": "2016-09-19 13:54:36",
            "updated_at": "2016-09-19 13:54:36",
            "deleted_at": null,
            "order_code": "DIkNZ3",
            "payment_file": null,
            "shipped": null
        },
        {
            "order_id": "bde68768-ebaa-43bd-b3d9-b624b6e2c787",
            "user_id": "901243fb-ad47-45fe-8235-bb743357403e",
            "coupon_code": "ss50",
            "coupon_value": 1550000,
            "total": 1550000,
            "total_before_coupon": 3100000,
            "valid_by": null,
            "valid_at": null,
            "shipping_code": null,
            "created_at": "2016-09-19 13:54:36",
            "updated_at": "2016-09-19 13:54:36",
            "deleted_at": null,
            "order_code": "JQnWbz",
            "payment_file": null,
            "shipped": null
        },
        {
            "order_id": "ab837b3a-b780-4340-be3e-6801af798034",
            "user_id": "901243fb-ad47-45fe-8235-bb743357403e",
            "coupon_code": null,
            "coupon_value": null,
            "total": 3100000,
            "total_before_coupon": 3100000,
            "valid_by": null,
            "valid_at": null,
            "shipping_code": null,
            "created_at": "2016-09-19 13:54:37",
            "updated_at": "2016-09-19 13:54:37",
            "deleted_at": null,
            "order_code": "VsIR76",
            "payment_file": null,
            "shipped": null
        }
    ]
}
```

#### *Example Error Request*

None

#### *Error Response*

None


### 3.2. Calculate without Coupon

#### *Description*

Customer can test to calculate the products.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/calculate \
  --header 'content-type: application/json' \
  --data '{
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 2
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 2
        }
    ]
}'
```

#### *Success Response*
```
{
    "status": 200,
    "data": {
        "products": [
            {
                "name": "Xiaomi Redmi 1s",
                "price": 1500000,
                "quantity": 2,
                "sub_total": 3000000
            },
            {
                "name": "Xiaomi Redmi 2",
                "price": 1600000,
                "quantity": 2,
                "sub_total": 3200000
            }
        ],
        "total": 6200000
    },
    "message": "Everything fine? then continue to order/create with same json input."
}
```

#### *Example Error Request*
```
{
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 2
        },
        {
            "sku_code" : "XMR2"
        }
    ]
}
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The products.1.quantity field is required."
    ]
}
```


### 3.3. Calculate with Coupon (Amount)

#### *Description*

Customer can test to calculate the product, using coupon, with type Amount Discount

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/calculate \
  --header 'content-type: application/json' \
  --data '{
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 2
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 2
        }
    ],
    "coupon_code" : "ss75"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "data": {
        "products": [
            {
                "name": "Xiaomi Redmi 1s",
                "price": 1500000,
                "quantity": 2,
                "sub_total": 3000000
            },
            {
                "name": "Xiaomi Redmi 2",
                "price": 1600000,
                "quantity": 2,
                "sub_total": 3200000
            }
        ],
        "sub_total": 6200000,
        "total": 6125000,
        "coupon_code": "ss75",
        "coupon_value": 75000
    },
    "message": "Everything fine? then continue to order/create with same json input."
}
```

#### *Example Error Request*
```
{
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 2
        },
        {
            "quantity" : 2
        }
    ],
    "coupon_code" : "ss75"
}
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The products.1.sku_code field is required."
    ]
}
```


### 3.4. Calculate with Coupon (Percentage)

#### *Description*

Customer can test to calculate the product, using coupon, with type Percentage Discount

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/calculate \
  --header 'content-type: application/json' \
  --data '{
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ],
    "coupon_code" : "ss50"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "data": {
        "products": [
            {
                "name": "Xiaomi Redmi 1s",
                "price": 1500000,
                "quantity": 1,
                "sub_total": 1500000
            },
            {
                "name": "Xiaomi Redmi 2",
                "price": 1600000,
                "quantity": 1,
                "sub_total": 1600000
            }
        ],
        "sub_total": 3100000,
        "total": 1550000,
        "coupon_code": "ss50",
        "coupon_value": 1550000
    },
    "message": "Everything fine? then continue to order/create with same json input."
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/calculate \
  --header 'content-type: application/json' \
  --data '{
    "products" : [
        {
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ],
    "coupon_code" : "ss50"
}'
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The products.0.sku_code field is required."
    ]
}
```


### 3.5. Order without Coupon

#### *Description*

After Customer sure about the products and the coupon, they can start Order

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/create \
  --header 'content-type: application/json' \
  --data '{
    "customer" : {
        "name" : "Fajri Abdillah",
        "phone_number" : "081224507359",
        "email" : "clasense4@gmail.com",
        "address" : "Jln. Sarimanis 1 XV / 26, Bandung 40151"
    },
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ]
}'
```

#### *Success Response*
```
{
    "status": 200,
    "data": "Order success. Please paid 3100000 and upload payment proof to this URL http://127.0.0.1:8080/payment/proof/bWr5gm",
    "message": {
        "products": [
            {
                "name": "Xiaomi Redmi 1s",
                "price": 1500000,
                "quantity": 1,
                "sub_total": 1500000
            },
            {
                "name": "Xiaomi Redmi 2",
                "price": 1600000,
                "quantity": 1,
                "sub_total": 1600000
            }
        ],
        "total": 3100000,
        "order_code": "bWr5gm"
    }
}
```

#### *Example Error Request*
```
{
    "customer" : {
        "name" : "Fajri Abdillah",
        "phone_number" : "081224507359",
        "address" : "Jln. Sarimanis 1 XV / 26, Bandung 40151"
    },
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ]
}
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The customer.email field is required."
    ]
}
```


### 3.6. Order with Coupon (Amount)

#### *Description*

After Customer sure about the products and the coupon, they can start Order.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/create \
  --header 'content-type: application/json' \
  --data '{
    "customer" : {
        "name" : "Fajri Abdillah",
        "phone_number" : "081224507359",
        "email" : "clasense4@gmail.com",
        "address" : "Jln. Sarimanis 1 XV / 26, Bandung 40151"
    },
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ],
    "coupon_code" : "ss75"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "data": "Order success. Please paid 3025000 and upload payment proof to this URL http://188.166.188.17:8080/payment/proof/ZdCpLn",
    "message": {
        "products": [
            {
                "name": "Xiaomi Redmi 1s",
                "price": 1500000,
                "quantity": 1,
                "sub_total": 1500000
            },
            {
                "name": "Xiaomi Redmi 2",
                "price": 1600000,
                "quantity": 1,
                "sub_total": 1600000
            }
        ],
        "sub_total": 3100000,
        "total": 3025000,
        "coupon_code": "ss75",
        "coupon_value": 75000,
        "order_code": "ZdCpLn"
    }
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/create \
  --header 'content-type: application/json' \
  --data '{
    "customer" : {
        "name" : "Fajri Abdillah",
        "phone_number" : "081224507359",
        "address" : "Jln. Sarimanis 1 XV / 26, Bandung 40151"
    },
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ],
    "coupon_code" : "ss75"
}'
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The customer.email field is required."
    ]
}
```


### 3.7. Order with Coupon (Percentage)

#### *Description*

After Customer sure about the products and the coupon, they can start Order.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/create \
  --header ': ' \
  --header 'content-type: application/json' \
  --data '{
    "customer" : {
        "name" : "Fajri Abdillah",
        "phone_number" : "081224507359",
        "email" : "clasense4@gmail.com",
        "address" : "Jln. Sarimanis 1 XV / 26, Bandung 40151"
    },
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ],
    "coupon_code" : "ss50"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "data": "Order success. Please paid 1550000 and upload payment proof to this URL http://127.0.0.1:8080/payment/proof/qUdO3i",
    "message": {
        "products": [
            {
                "name": "Xiaomi Redmi 1s",
                "price": 1500000,
                "quantity": 1,
                "sub_total": 1500000
            },
            {
                "name": "Xiaomi Redmi 2",
                "price": 1600000,
                "quantity": 1,
                "sub_total": 1600000
            }
        ],
        "sub_total": 3100000,
        "total": 1550000,
        "coupon_code": "ss50",
        "coupon_value": 1550000,
        "order_code": "qUdO3i"
    }
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/create \
  --header ': ' \
  --header 'content-type: application/json' \
  --data '{
    "customer" : {
        "name" : "Fajri Abdillah",
        "email" : "clasense4@gmail.com",
        "address" : "Jln. Sarimanis 1 XV / 26, Bandung 40151"
    },
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ],
    "coupon_code" : "ss50"
}'
```

#### *Error Response*
```
{
    "status": 400,
    "message": [
        "The customer.phone number field is required."
    ]
}
```


### 3.8. Order with Coupon (Expired)

#### *Description*

Sometimes the coupon is expired, or out of stock. Order process cannot continue.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/order/create \
  --header 'content-type: application/json' \
  --data '{
    "customer" : {
        "name" : "Fajri Abdillah",
        "phone_number" : "081224507359",
        "email" : "clasense4@gmail.com",
        "address" : "Jln. Sarimanis 1 XV / 26, Bandung 40151"
    },
    "products" : [
        {
            "sku_code" : "XMR1S",
            "quantity" : 1
        },
        {
            "sku_code" : "XMR2",
            "quantity" : 1
        }
    ],
    "coupon_code" : "ss95"
}'
```

#### *Success Response*
```
{
    "status": 400,
    "message": [
        "Coupon is out of stock, not exist, or expired."
    ]
}
```

#### *Example Error Request*

None

#### *Error Response*

None

---

## 4. Payment

### 4.1. Customer Upload Payment Proof

#### *Description*

Customer need to upload the payment proof, including valid order_code. If valid code not found, it will give not found. Note : this request is not include in Insomnia.

#### *Example Success Request*
```
curl -X POST -H "Content-Type: multipart/form-data" \
  -F "photo=@/D:\Projects\localhost\private\lumen52\PbPYzVD.jpg" \
  "http://127.0.0.1:8080/payment/proof/hKL8Mq"
```

#### *Success Response*
```
{
  "status": 200,
  "message": "Payment Uploaded, please follow URL http://127.0.0.1:8080/payment/detail/hKL8Mq to get shipping code and another updates."
}
```

#### *Example Error Request*
```
curl -X POST -H "Content-Type: multipart/form-data" \
  -F "photo=@/D:\Projects\localhost\private\lumen52\PbPYzVD.jpg" \
  "http://127.0.0.1:8080/payment/proof/hKL8M"
```

#### *Error Response*
```
{
  "status": 200,
  "message": "Order code not found"
}
```


### 4.2. Customer Detail Order

#### *Description*

Customer can check the status of their order_code.

#### *Example Success Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/payment/detail/hKL8Mq
```

#### *Success Response*
```
{
    "status": 200,
    "data": {
        "total": 3100000,
        "order_code": "hKL8Mq",
        "shipping_code": null,
        "last_update": "2016-09-19 14:38:42",
        "status": "Payment Uploaded, waiting confirmation from administrator"
    }
}
```

#### *Example Error Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/payment/detail/hKL8M
```

#### *Error Response*
```
{
    "status": 200,
    "message": "Order code not found"
}
```


### 4.3. Admin View All Order

#### *Description*

Admin can view all order, including order status, and customer detail. This route is protected with `token`. The `token` is still hardcode, related with `.env` file.

#### *Example Success Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/payment/admin/all_order \
  --header 'token: 313354'
```

#### *Success Response*
```
{
    "status": 200,
    "data": [
        {
            "order_code": "L1bQhd",
            "total": 3100000,
            "valid_at": null,
            "valid_by": null,
            "shipping_code": null,
            "payment_file": null,
            "shipped": null,
            "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
            "order_id": "07d8473d-d232-4b2c-91f2-8b4001ebcea4",
            "user": {
                "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
                "name": "Fajri Abdillah",
                "email": "clasense4@gmail.com",
                "phone_number": "081224507359",
                "address": "Jln. Sarimanis 1 XV / 26, Bandung 40151"
            },
            "status": [
                {
                    "order_id": "07d8473d-d232-4b2c-91f2-8b4001ebcea4",
                    "description": "Waiting for payment"
                }
            ]
        },
        {
            "order_code": "qUdO3i",
            "total": 1550000,
            "valid_at": null,
            "valid_by": null,
            "shipping_code": null,
            "payment_file": null,
            "shipped": null,
            "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
            "order_id": "bd9207ab-5309-406c-a6cb-8a61332458c5",
            "user": {
                "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
                "name": "Fajri Abdillah",
                "email": "clasense4@gmail.com",
                "phone_number": "081224507359",
                "address": "Jln. Sarimanis 1 XV / 26, Bandung 40151"
            },
            "status": [
                {
                    "order_id": "bd9207ab-5309-406c-a6cb-8a61332458c5",
                    "description": "Waiting for payment"
                }
            ]
        },
        {
            "order_code": "JPKhZ0",
            "total": 1550000,
            "valid_at": null,
            "valid_by": null,
            "shipping_code": null,
            "payment_file": null,
            "shipped": null,
            "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
            "order_id": "ec650937-c6dc-4983-99f8-62c89adcbc4c",
            "user": {
                "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
                "name": "Fajri Abdillah",
                "email": "clasense4@gmail.com",
                "phone_number": "081224507359",
                "address": "Jln. Sarimanis 1 XV / 26, Bandung 40151"
            },
            "status": [
                {
                    "order_id": "ec650937-c6dc-4983-99f8-62c89adcbc4c",
                    "description": "Waiting for payment"
                }
            ]
        },
        {
            "order_code": "hKL8Mq",
            "total": 3100000,
            "valid_at": null,
            "valid_by": null,
            "shipping_code": null,
            "payment_file": "524c47a9-6dae-4d71-8991-66d76c46e426_hKL8Mq.jpg",
            "shipped": null,
            "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
            "order_id": "524c47a9-6dae-4d71-8991-66d76c46e426",
            "user": {
                "user_id": "3d15fc34-b99a-4592-a782-b36aace7b646",
                "name": "Fajri Abdillah",
                "email": "clasense4@gmail.com",
                "phone_number": "081224507359",
                "address": "Jln. Sarimanis 1 XV / 26, Bandung 40151"
            },
            "status": [
                {
                    "order_id": "524c47a9-6dae-4d71-8991-66d76c46e426",
                    "description": "Waiting for payment"
                },
                {
                    "order_id": "524c47a9-6dae-4d71-8991-66d76c46e426",
                    "description": "Payment Uploaded, waiting confirmation from administrator"
                }
            ]
        }
    ]
}
```

#### *Example Error Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/payment/admin/all_order \
  --header 'token: 3133543'
```

#### *Error Response*
```
{
    "status": 400,
    "message": "Wrong Token."
}
```


### 4.4. Admin View List Payment Proof

#### *Description*

Admin can view uploaded payment proof. This related with correct `order_code` given by Customer when upload payment proof. Only valid uploaded payment file will appear here. The `token` is still hardcode, related with `.env` file.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/view_proof \
  --header 'content-type: application/json' \
  --header 'token: 313354'
```

#### *Success Response*
```
{
    "status": 200,
    "data": [
        {
            "order_code": "hKL8Mq",
            "coupon_code": null,
            "coupon_value": null,
            "payment_proof": "http://127.0.0.1:8080/payment/view/code/hKL8Mq",
            "description": "Payment Uploaded, waiting confirmation from administrator",
            "last_update": "2016-09-19 14:38:42"
        },
        {
            "order_code": "hKL8Mq",
            "coupon_code": null,
            "coupon_value": null,
            "payment_proof": "http://127.0.0.1:8080/payment/view/code/hKL8Mq",
            "description": "Payment Uploaded, waiting confirmation from administrator",
            "last_update": "2016-09-19 14:38:42"
        }
    ]
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/view_proof \
  --header 'content-type: application/json' \
  --header 'token: 3133543'
```

#### *Error Response*
```
{
    "status": 400,
    "message": "Wrong Token."
}
```


### 4.5. Admin View Individual Uploaded Payment Proof

#### *Description*

Admin can view upload payment proof that provide by Customer. Using Postman, it has a feature to show the image. The `token` is still hardcode, related with `.env` file.

#### *Example Success Request*
```
curl -X GET -H "token: 313354" -H "Content-Type: application/json" \
"http://127.0.0.1:8080/payment/view/code/hKL8Mq"
```

#### *Success Response*

SHOW THE IMAGE

#### *Example Error Request*
```
curl -X GET -H "token: 313354" -H "Content-Type: application/json" \
"http://127.0.0.1:8080/payment/view/code/hKL8M"
```

#### *Error Response*
```
{
  "status": 200,
  "message": "Order code not found"
}
```


### 4.6. Admin Confirm Order

#### *Description*

After check uploaded payment proof, Admin can confirm the order. The `token` is still hardcode, related with `.env` file.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/confirmation \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "order_code":"Ocs3Bc"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "message": "Payment confirmed, waiting for Shipping Code"
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/confirmation \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "order_code":"Ocs3Bcs"
}'
```

```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/confirmation \
  --header 'content-type: application/json' \
  --header 'token: 3133543' \
  --data '{
    "order_code":"Ocs3Bc"
}'
```

#### *Error Response*
```
{
    "status": 200,
    "message": "Order code not found"
}
```

```
{
    "status": 400,
    "message": "Wrong Token."
}
```


### 4.7. Admin Cancel Order

#### *Description*

Sometimes, Admin need to cancel the order.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/cancel \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "order_code":"hKL8Mq"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "message": "Order is not valid, cancel transaction."
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/cancel \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "order_code":"hKL8M"
}'
```

```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/cancel \
  --header 'content-type: application/json' \
  --header 'token: 3133543' \
  --data '{
    "order_code":"hKL8Mq"
}'
```

#### *Error Response*
```
{
    "status": 200,
    "message": "Order code not found"
}
```

```
{
    "status": 400,
    "message": "Wrong Token."
}
```


### 4.8. Admin Add Shipping Code

#### *Description*

So, everything looks good, and Admin need to input shipping code.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/shipping_code \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "order_code":"hKL8Mq",
    "shipping_code" : "354313"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "data": {
        "shipping_code": "354313"
    },
    "message": "Shipping Code 354313, Thank You."
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/shipping_code \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "order_code":"hKL8q",
    "shipping_code" : "354313"
}'
```

```
curl --request POST \
  --url http://127.0.0.1:8080/payment/admin/shipping_code \
  --header 'content-type: application/json' \
  --header 'token: 3133543' \
  --data '{
    "order_code":"hKL8Mq",
    "shipping_code" : "354313"
}'
```
#### *Error Response*
```
{
    "status": 200,
    "message": "Order code not found"
}
```

```
{
    "status": 400,
    "message": "Wrong Token."
}
```

---


## 5. Shipping

### 5.1. Customer Detail Shipping

#### *Description*

Customer need to check `shipping_code` given by system.

#### *Example Success Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/shipping/detail/354313
```

#### *Success Response*
```
{
    "status": 200,
    "data": [
        {
            "datetime": "2016-09-19 15:04:37",
            "order_code": "hKL8Mq",
            "shipping_code": "354313",
            "description": "Your items already sent to Logistic Partner."
        }
    ]
}
```

#### *Example Error Request*
```
curl --request GET \
  --url http://127.0.0.1:8080/shipping/detail/3543133
```

#### *Error Response*
```
{
    "status": 200,
    "message": "Shipping code not found"
}
```


### 5.2. Admin Update Detail Shipping

#### *Description*

Admin can update the order shipping status. But, this is actually can be done automatically.

#### *Example Success Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/shipping/update \
  --header ': ' \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "shipping_code":"354313",
    "description":"Arrive at destination"
}'
```

#### *Success Response*
```
{
    "status": 200,
    "message": "Shipping detail added."
}
```

#### *Example Error Request*
```
curl --request POST \
  --url http://127.0.0.1:8080/shipping/update \
  --header ': ' \
  --header 'content-type: application/json' \
  --header 'token: 313354' \
  --data '{
    "shipping_code":"3543133",
    "description":"Arrive at destination"
}'
```

#### *Error Response*
```
{
    "status": 200,
    "message": "Shipping code not found"
}
```