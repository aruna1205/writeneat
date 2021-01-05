<?php
	ini_set('display_errors', 1);
	//echo 'hhh';die;
	require_once('includes/db.php');

	
	/*$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'rittal';
	$dbname = 'write_neat';*/
	//echo 'aaa';die;
	$db = new db();
	//echo 'bbb';die;
	$account = $db->query('SELECT * FROM wn_user_order')->fetchArray();
	//print_r($account);





?>



<?php
ini_set('display_errors', 1);
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,//order id for our reference
    'amount'          => 2000 * 100, // 2000 rupees in paise
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
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",//company logo
    "prefill"           => [
    "name"              => "Arun",//user name
    "email"             => "arun@merchant.com",//user email
    "contact"           => "9900139294",//user contact number
    ],
    "notes"             => [
    "address"           => "NS Halli, Bangalore 94",
    "merchant_order_id" => "writeneat_id-",
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
