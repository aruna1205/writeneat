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



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <!--
    Modified from the Debian original for Ubuntu
    Last updated: 2016-11-16
    See: https://launchpad.net/bugs/1288690
  -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Writeneat - Handwriting Improvement Kit - Order Confirmation</title>
    
    <?php echo $common->getFBTrackingScript();?>
  </head>
  <body>
  
  	<script>
		fbq('track', 'Purchase', {currency: "INR", value: <?php echo $orderDetails['order_amount']; ?>});
	</script>
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
  </body>
</html>

