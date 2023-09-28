<?php

include "./config.php";
session_start();



// require("./stripe-php-master/init.php");
// \Stripe\Stripe::setVerifySslCerts(false);
// $token=$_POST['stripeToken'];

// $data=\Stripe\Charge::create(array(

//     "description"=>"No Descr",
//     "currency"=>"USD",
//     "amount"=>2000*100,
//     "source"=>$token,
// ))




// checkout

if(isset($_POST['buy'])){
    extract($_POST);


    $response=array();
   try{
    $data = \Stripe\Checkout\Session::create(array(
        "success_url" => "http://localhost/HireApp/Hire/paymentGateway/payment_success.php?session_id={CHECKOUT_SESSION_ID}&projectID=".$projectID."",
        "cancel_url" => "http://localhost/HireApp/Hire/PaymentGateway/cancel.html?state=cancelled",
        "mode" => "payment",
        "submit_type" => "pay",
        "payment_method_types" => [
            "card"
        ],
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "USD",
                    "unit_amount" => doubleval($amount)*100,
                    "product_data" => [
                        "name" => $project_name,
                        "description" => $description
                    ]
                ]
            ],
            
        ]
    ));

    $response=array("error"=>"","id"=>$data->id,"data"=>$data);
   }catch (Exception $e) {
     $response=array("error"=>$e->getMessage());
   }
    
    echo json_encode($response);
    
}

