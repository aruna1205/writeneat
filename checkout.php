<?php
	ini_set('display_errors', 1);
	session_start();
	require_once('includes/common.php');
	

	$common = new common();

	$productDetails = $common->getProductDetails();
	//print_r($productDetails);
	$mrp = $productDetails['product_mrp'];
	$sp = $productDetails['product_sp'];
	$codCharges = $productDetails['product_cod_charges'];
	$igstPercent = $productDetails['product_igst_percentage'];
	$sgstPercent = $productDetails['product_sgst_percentage'];
	$cgstPercent = $productDetails['product_cgst_percentage'];
	$igstAmount = round($sp*$igstPercent/100,2);
	$sgstAmount = round($sp*$sgstPercent/100,2);
	$cgstAmount = round($sp*$cgstPercent/100,2);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Writeneat - Handwriting Improvement Kit - Checkout</title>
    <link rel="stylesheet" href="css/style.css"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    
    <script>
    	var mrp = <?php echo $mrp; ?>;
    	var sp = <?php echo $sp; ?>;
    	var codCharges = <?php echo $codCharges; ?>;
    	var igstPercent = <?php echo $igstPercent; ?>;
    	var sgstPercent = <?php echo $sgstPercent; ?>;
    	var cgstPercent = <?php echo $cgstPercent; ?>;
    	var igstAmount = <?php echo $igstAmount; ?>;
    	var sgstAmount = <?php echo $sgstAmount; ?>;
    	var cgstAmount = <?php echo $cgstAmount; ?>;
    </script>

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
	fbq('track', 'AddToCart', {});
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
		<div class="container">
		  
		  <h2>Order Details</h2>
		  <form name="registration" method="post">
		    <div id="message" class='error'></div>

		    <label for="name">Name</label>
		    <input type="text" name="name" id="name" placeholder="" value="aaa"/>

		    <label for="address">Address</label>
		    <input type="text" name="address" id="address" placeholder="" value="aaa"/>
		    
		    <label for="city">City</label>
		    <input type="text" name="city" id="city" placeholder="" value="aaa"/>
		    
		    <label for="state">State</label>
		    <!--<input type="text" name="state" id="state" placeholder="" value="aaa"/>-->
		    
		    <select name="state" id="state" class="">
		    	<option value="">--Select--</option>
			<option value="Andhra Pradesh">Andhra Pradesh</option>
			<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
			<option value="Arunachal Pradesh">Arunachal Pradesh</option>
			<option value="Assam">Assam</option>
			<option value="Bihar">Bihar</option>
			<option value="Chandigarh">Chandigarh</option>
			<option value="Chhattisgarh">Chhattisgarh</option>
			<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
			<option value="Daman and Diu">Daman and Diu</option>
			<option value="Delhi">Delhi</option>
			<option value="Lakshadweep">Lakshadweep</option>
			<option value="Puducherry">Puducherry</option>
			<option value="Goa">Goa</option>
			<option value="Gujarat">Gujarat</option>
			<option value="Haryana">Haryana</option>
			<option value="Himachal Pradesh">Himachal Pradesh</option>
			<option value="Jammu and Kashmir">Jammu and Kashmir</option>
			<option value="Jharkhand">Jharkhand</option>
			<option value="Karnataka">Karnataka</option>
			<option value="Kerala">Kerala</option>
			<option value="Madhya Pradesh">Madhya Pradesh</option>
			<option value="Maharashtra">Maharashtra</option>
			<option value="Manipur">Manipur</option>
			<option value="Meghalaya">Meghalaya</option>
			<option value="Mizoram">Mizoram</option>
			<option value="Nagaland">Nagaland</option>
			<option value="Odisha">Odisha</option>
			<option value="Punjab">Punjab</option>
			<option value="Rajasthan">Rajasthan</option>
			<option value="Sikkim">Sikkim</option>
			<option value="Tamil Nadu">Tamil Nadu</option>
			<option value="Telangana">Telangana</option>
			<option value="Tripura">Tripura</option>
			<option value="Uttar Pradesh">Uttar Pradesh</option>
			<option value="Uttarakhand">Uttarakhand</option>
			<option value="West Bengal">West Bengal</option>
		    </select>
		    
		    <label for="pincode">Pincode</label>
		    <input type="text" name="pincode" id="pincode" placeholder="" value="123456"/>

		    <label for="email">Email</label>
		    <input type="text" name="email" id="email" placeholder="abc@xyz.com" value="abc@xyz.com"/>

		    <label for="phone">Phone</label>
		    <input type="text" name="phone" id="phone" placeholder="" value="1234567890"/>
		    <br />
		    
		    <div name="ordersummary" id="ordersummary" style="border: solid 5px #918f30; padding:5px; margin:5px;">
		    	<div style="font-size:20px; background-color:#555">Order Summary</div>
		    	<div id="orderamount"></div>
		    	
		    </div>
		    <br />
	            <label style="background-color:#0aa"><input type="radio" checked="checked" name="order_type" value="COD" style="height:16px; width:5%;" />Cash On Delivery</label> 
	            <br />
                    <label style="background-color:#0aa"><input type="radio" name="order_type" value="online" style="height:16px; width:5%;" />Online</label>

		    <button type="submit" value="Get Value">Place Order</button>

		    <!-- <button type="submit" value="COD">Cash On Delivery</button>
		    <button type="submit" value="online">Pay Online</button> -->

		  </form>
		</div>
  </div>

  <div class="right">
    <h2>About</h2>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
  </div>
</div>

<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">Š copyright w3schools.com</div>

</body>
</html>
