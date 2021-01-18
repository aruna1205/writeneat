<?php

	ini_set('display_errors', 1);

	require_once('../includes/common.php');
	session_start();

	$common = new common();
	$orderDetails = $common->getOrderDetails();
	//print_r($orderDetails);


	$name = $orderDetails['name'];
	$email = $orderDetails['email'];
	$phone = $orderDetails['phone'];
	$state = $orderDetails['state'];
	$order_id = $orderDetails['order_id'];
	$order_amount = $orderDetails['order_amount'];

?>



<?php
//ini_set('display_errors', 1);
require('config.php');
require('razorpay-php/Razorpay.php');


// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => $order_id,//order id for our reference
    'amount'          => $order_amount * 100, // converting to paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}


$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Writeneat",//company name
    "description"       => "Handwriting Improvement Kit",//company description
    "image"             => "$baseUrl/images/icon_1.png",//company logo
    "prefill"           => [
    "name"              => "$name",//user name
    "email"             => "$email",//user email
    "contact"           => "$phone",//user contact number
    ],
    "notes"             => [
    "address"           => "$state",
    "merchant_order_id" => "writeneat_id-$order_id",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");
