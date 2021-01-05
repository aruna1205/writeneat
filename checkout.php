<?php
	ini_set('display_errors', 1);
	//ini_set('session.auto_start', 1);
	//echo 'hhh';die;
	require_once('includes/db.php');
	session_start();
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'rittal';
	$dbname = 'write_neat';
	//echo 'aaa';die;
	$db = new db($dbhost, $dbuser, $dbpass, $dbname);
	//echo 'bbb';die;
	$productDetails = $db->query('SELECT * FROM wn_product_price WHERE product_name="handwritingkit"')->fetchArray();
	print_r($productDetails);
	$mrp = $productDetails['product_mrp'];
	$sp = $productDetails['product_sp'];
	$codCharges = $productDetails['product_cod_charges'];
	$gstPrecent = $productDetails['product_gst_percentage'];
	$sgstPercent = $productDetails['product_sgst_percentage'];
	$cgstPrecent = $productDetails['product_cgst_percentage'];
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Writeneat - Handwriting Improvement Kit</title>
    <link rel="stylesheet" href="css/style.css"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    
    <script>
    	var mrp = <?php echo $mrp; ?>;
    	var sp = <?php echo $sp; ?>;
    	var codCharges = <?php echo $codCharges; ?>;
    	var gstPrecent = <?php echo $gstPrecent; ?>;
    	var sgstPercent = <?php echo $sgstPercent; ?>;
    	var cgstPrecent = <?php echo $cgstPrecent; ?>;
    </script>

        
  </head>
  <body>
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
	            <label style="background-color:#0aa"><input type="radio" checked="checked" name="paymenttype" value="COD" style="height:16px; width:5%;" />Cash On Delivery</label> 
	            <br />
                    <label style="background-color:#0aa"><input type="radio" name="paymenttype" value="online" style="height:16px; width:5%;" />Online</label>

		    <button type="submit" value="Get Value">Place Order</button>

		    <!-- <button type="submit" value="COD">Cash On Delivery</button>
		    <button type="submit" value="online">Pay Online</button> -->

		  </form>
		</div>
		
		
		
  </body>
</html>

