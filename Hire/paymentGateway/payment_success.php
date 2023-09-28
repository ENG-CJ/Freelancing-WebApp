<?php
session_start();
require './config.php';
include '../connections/conn.php';
$checkout_session = "";

$customerDetails = "";
$paymentIntent = "";
$error = array();
if (isset($_GET['session_id'])) {
    if (!empty($_GET['session_id'])) {
        // $error=array();
        $id = $_GET['session_id'];
        $projectID = $_GET['projectID'];
        require_once './stripe-php-master/init.php';
        $stripe = new \Stripe\StripeClient($secretKey);
        try {
            $test = "hello";
            $checkout_session = $stripe->checkout->sessions->retrieve($id);
            $customerDetails = $checkout_session->customer_details;
            $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);

            //  insertions

            // $project_id=$_GET['project_id'];
            $clientID = $_SESSION['profile_id'];
            $paymentID = "PCODE" . rand(1000, 9999);
            $amount = ($paymentIntent->amount / 100);
            $cardType = $paymentIntent->payment_method_types[0];
            $date = date('Y-m-d');
            // $c_name=$customerDetails-

            // REGISTER
            $sql = "CALL proceedPayment('$paymentID','$id','$amount','USD','card','Success','$clientID',
        '$projectID','$customerDetails->name','$customerDetails->email','$customerDetails->phone','card','$date');";

        $con= new Connections();
        $result=$con->connect()->query($sql);
        
            // echo ($checkout_session);
        } catch (Exception $e) {
            $error = array("error" => $e->getMessage());
        }
    } else {
    }
} else {
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Proceeded</title>
    <!-- <link href="./style.css"/> -->
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: rgb(222, 234, 245)
    }

    .container {
        padding: 60px 100px;
        /* max-width: 600px; */
        /* width: 450px; */
        /* position: absolute;
    top: 50%;
    left: 50%;
    overflow: hidden;
    transform: translate(-50%,-50%); */
    }

    .payment-card-section {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image img {
        width: 85%;
    }

    .card {
        background-color: whitesmoke;
        padding: 20px;
        box-shadow: -1px -1px 22px -6px rgba(0, 0, 0, 0.7);
        -webkit-box-shadow: -1px -1px 22px -6px rgba(0, 0, 0, 0.7);
        -moz-box-shadow: -1px -1px 22px -6px rgba(0, 0, 0, 0.7);
        border-radius: 10px 10px 10px 10px;
        -webkit-border-radius: 10px 10px 10px 10px;
        -moz-border-radius: 10px 10px 10px
    }

    .icon-vector {
        text-align: center;
        padding: 20px;
        font-weight: bold;
        font-family: sans-serif;
    }

    .icon-vector p {
        color: #539165;
    }

    .icon-vector span {
        font-weight: normal;
        opacity: 0.5;
        font-size: 15px;
        margin: 7px 0px;

    }

    .icon-vector span.code {
        font-weight: bold;
        opacity: 0.7;
    }

    .details {
        padding: 6px 0px;

    }

    .details .amount-details {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .amount-details span {
        font-weight: normal;
        opacity: 0.5;
        font-size: 20px;
        margin: 7px 0px;
    }

    .amount-details h6 {
        font-size: 19px;
        color: #539165;
        font-weight: bolder;
    }

    .actions {
        padding: 5px 0px;
    }

    .actions button {
        border: 1px solid #539165;
        padding: 8px;
        width: 90px;
        text-decoration: none;
        background-color: transparent;
        border-radius: 4px;
        cursor: pointer;
    }

    button {
        text-decoration: none;
        color: #539165;
        background-color: transparent;
        font-weight: bolder;

    }

    .actions button:hover {
        background-color: #539165;
        color: white;
    }

    button.transactions {
        width: 200px;
        background-color: #539165;
        color: white;
    }

    .other-details p {
        font-weight: bold;
        font-size: 14px;
        opacity: 0.7;
        color: #394867;

    }

    .header p.cancel {
        color: #E06469;
    }
</style>

<body>

    <div class="container">
    
        <div class="payment-card-section">
            <div class="card">
                <div class="icon-vector">
                    <div class="header">
                        <img src="pay.gif" width="30%" alt="">
                        <p>Payment Successful!</p>
                        <span>Transaction Code: <span class="code"><?php echo $_GET['session_id'] ?></span> </span>
                    </div>
                </div>
                <hr>
                <div class="details">
                    <div class="amount-details">
                        <span>Amount Paid</span>
                        <h6>$<?php echo ($paymentIntent->amount / 100) . ".00" ?></h6>
                    </div>
                    <div class="amount-details">
                        <span>State</span>
                        <h6><i class="fa-sharp fa-solid fa-check"></i> Succeed</h6>
                    </div>
                    <div class="actions">
                        <a href="../Contents/" class="transaction-page"><button>Home</button></a>
                        <a href="../Contents/dashboard.php" class="transactions"><button class="transactions">view transactions</button></a>
                    </div>
                    <div class="other-details">
                        <p>NOTE: We Provide Transaction Code or Invoice Code, Incase Some Fault Occur Plz Send us The Invoice ID</p>
                    </div>
                </div>

            </div>
            <div class="image">
                <img src="./success.png" alt="">
            </div>
        </div>
    </div>

</body>

</html>