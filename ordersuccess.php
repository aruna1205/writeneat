<?php
	ini_set('display_errors', 1);
	session_start();

	require_once('includes/common.php');
	$common = new common();
	$orderDetails = $common->getOrderDetails();
	
	$count = $common->updateOrderStatus($orderStatus="SUCCESS");
	
	
	//$common->sendOrderPlacementMail($orderDetails);
	
	//mail( 'email4arun@gmail.com', 'Writeneat Demo', 'Your Order has been placed. Thank you' );

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Writeneat - Handwriting Improvement Kit - Order Confirmation</title>
<style>
* {
  box-sizing: border-box;
}
.menu {
  float:left;
  width:20%;
  text-align:center;
}
.menu a {
  background-color:#e5e5e5;
  padding:8px;
  margin-top:7px;
  display:block;
  width:100%;
  color:black;
}
.main {
  float:left;
  width:60%;
  padding:0 20px;
}
.right {
  background-color:#e5e5e5;
  float:left;
  width:20%;
  padding:15px;
  margin-top:7px;
  text-align:center;
}

@media only screen and (max-width:620px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width:100%;
  }
}
</style>

<?php echo $common->getFBTrackingScript();?>

</head>
<body style="font-family:Verdana;color:#aaaaaa;">
<script>
	fbq('track', 'Purchase', {currency: "INR", value: <?php echo $orderDetails['order_amount']; ?>});
</script>
<div style="background-color:#e5e5e5;padding:15px;text-align:center;">
  <h1>Hello World</h1>
</div>

<div style="overflow:auto">
  <div class="menu">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
    <a href="#">Link 4</a>
  </div>

  <div class="main">
    Thank you for your order. Your order number is <b><?php echo $_SESSION['order_id'];?></b>.
	<br/>
	<div style="text-align:left;" >
	Your order will be sent to:<br/>
	<b><?php echo $orderDetails['name']; ?><br/>
	<b><?php echo $orderDetails['address']; ?><br/>
	<b><?php echo $orderDetails['city']; ?><br/>
	<b><?php echo $orderDetails['state'].'-'.$orderDetails['pincode']; ?><br/>
	<b>Ph:<?php echo $orderDetails['phone']; ?><br/>
	</div>
	<br/>
	<br/>
	<table>
		<tr><th>Order Summary</th></tr>
		<tr>
			<td>Item Subtotal:</td> <td><?php echo $orderDetails['order_amount']; ?></td>
		</tr>
		<tr>
			<td>Shipping & Handling:</td> <td>Free</td>
		</tr>
		<tr>
			<td>Order Total:</td> <td><?php echo $orderDetails['order_amount']; ?></td>
		</tr>
	</table>
	<br/>
	<a href='index.php'>Home</a>

  </div>

  <div class="right">
    <h2>About</h2>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
  </div>
</div>

<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">Š copyright w3schools.com</div>

</body>
</html>
