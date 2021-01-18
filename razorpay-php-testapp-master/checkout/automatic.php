<!--  The entire list of Checkout fields is available at
 https://docs.razorpay.com/docs/checkout-form#checkout-fields -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Payment Page</title>

	<?php echo $common->getFBTrackingScript();?>
</head>

<body>
	
	<script>
		fbq('track', 'InitiateCheckout', {currency: "INR", value: <?php echo $order_amount; ?>});
	</script>
	<div>Header</div>
	<form action="verify.php" method="POST">
	  <script
	    src="https://checkout.razorpay.com/v1/checkout.js"
	    data-key="<?php echo $data['key']?>"
	    data-amount="<?php echo $data['amount']?>"
	    data-currency="INR"
	    data-name="<?php echo $data['name']?>"
	    data-image="<?php echo $data['image']?>"
	    data-description="<?php echo $data['description']?>"
	    data-prefill.name="<?php echo $data['prefill']['name']?>"
	    data-prefill.email="<?php echo $data['prefill']['email']?>"
	    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
	    data-notes.shopping_order_id="<?php echo $data['notes']['merchant_order_id']?>"
	    data-order_id="<?php echo $data['order_id']?>"
	    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
	    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
	  >
	  </script>
	  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
	  <input type="hidden" name="shopping_order_id" value="<?php echo $data['notes']['merchant_order_id']?>">
	</form>

	<div>Footer</div>
</body>

</html>
