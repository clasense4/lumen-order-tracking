## **Backend Technical Assessment: Order Transaction**

### **Objective**

Design and implement Service(s) for handling Order Transaction with domain driven approach using any framework in your favorite language. Please use the following requirement and rule when working on the assessment. Your assessment will be scored based on the key indicators stated in Assessment 

### **Aspects section**

The service will be serving as backend API for a client app in a RESTful manner with JSON as data format. It's best to focus on the main domain here: **Order Transaction**. You are free to add your assumption to ease your work, for any additional assumption please include in your readme file. Should have any concern or need any clarification, please reach out.

Develop the task with the mindset that it must be ready for production. A great plus if the app is deployed to hosting (heroku/aws/azure/digital ocean). Please push the source code into your github/bitbucket repository and we will review the codes. 

### **Requirement**

The situation in an online store are stated below. This scenario we would like to focus on basic transaction that happens in general online store in Indonesia. 

1. Order transaction involves the following actors: customer and admin.
2. Product dictionary → free to define product metadata and values as necessary, can be hardcoded
> - Product has quantity; product with quantity 0 can not be ordered

3. Coupon dictionary → free to define coupon metadata and values as necessary, can be hardcoded
> 1. Coupon has certain date range validity and quantity
> 2. Coupon has certain amount of discount, can be percentage or nominal
> 3. Coupon can be applied to order before submission

4. Order transaction process flow and verification; single transaction has the following steps:
> 1. Customer can add product to an order
> 2. Customer can apply one coupon to order, only one coupon can be applied to order
> 3. Customer can submit an order and the order is finalized
> 4. Customer can only pay via bank transfer
> 5. When placing order the following data is required: name, phone number, email, address
> 6. When an order is submitted, the quantity for ordered product will be reduced based on the quantity.
> 7. When an order is submitted, the quantity of the coupon will be reduced based on the applied coupon
> 8. An order is successfully submitted if fulfills all of the following condition:
>> - Applied coupon is valid
>> - All ordered products is available.
>
> 9. After an order is submitted, customer will be required to submit payment proof
> 10. After an order is submitted, the order is accessible to admin and ready to be processed
> 11. Admin can view order detail
> 12. Admin can verify the validity of order data: customer name, phone, email, address, payment proof
> 13. Given an order is valid, then Admin will prepare the ordered items for shipment
>> - Given and order is invalid, then Admin can cancel the order
>> - After an order ready for shipment, Admin ship process ordered items via logistic partner
>
> 14. After shipping the ordered items via logistic partner, Admin will mark the order as shipped and update the order with Shipping ID
> 15. Customer can check the order status for the submitted order
> 16. Customer can check the shipment status for the submitted order using Shipping ID

### **Rule**

- You can use any language, library and framework
- Please use first commit to initialise framework/libraries only, and the subsequent commits with proper commit logs
- You must submit your solution in public git repository
- Your application must be able to run locally or deployed to cloud infra that compatible with *NIX/Linux environment
- If your application must be run locally, please have reasonable step (no more than 5 steps) and provide necessary readme
- If decided to deploy your solution in cloud infra, please make sure it's still up and accessible until the next 2 weeks after your submission
- Submission deadline is 3 days (72 hours) from the time this assessment is given.

### **Assessment Aspects**

- Code cleanliness
- Feature completeness
- Application design and abstraction layer
- Quality assessment with unit test and or functional API test
- Runnable locally in other local development machine and or deployed to cloud infrastructure
