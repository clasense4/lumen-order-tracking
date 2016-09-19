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

### 4.1. All

#### *Description*

#### *Example Success Request*

#### *Success Response*

#### *Example Error Request*

#### *Error Response*
