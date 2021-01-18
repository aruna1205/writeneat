<!--  The entire list of Checkout fields is available at
 https://docs.razorpay.com/docs/checkout-form#checkout-fields -->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Writeneat - Handwriting Improvement Kit- Payment</title>
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
	fbq('track', 'InitiateCheckout', {currency: "INR", value: <?php echo $order_amount; ?>});
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
  	<h2>Lorum Ipsum</h2>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
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
  </div>

  <div class="right">
    <h2>About</h2>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
  </div>
</div>

<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">Š copyright w3schools.com</div>

</body>
</html>
