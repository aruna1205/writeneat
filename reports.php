<?php
require_once('includes/dbconfig.php');
	if( ( isset($_SERVER['PHP_AUTH_USER'] ) && ( $_SERVER['PHP_AUTH_USER'] == "$admninUser" ) ) AND
      ( isset($_SERVER['PHP_AUTH_PW'] ) && ( $_SERVER['PHP_AUTH_PW'] == "$adminSecretKey" )) )
    {
        //startPage();

        //print("You have logged in successfully!<br>\n");

        //endPage();
    }
    else
    {
        //Send headers to cause a browser to request
        //username and password from user
        header("WWW-Authenticate: " .
            "Basic realm=\"Admin's Protected Area\"");
        header("HTTP/1.0 401 Unauthorized");

        //Show failure text, which browsers usually
        //show only after several failed attempts
        print("This page is protected by HTTP Authentication.");
        exit;
    }
?>
<?php
	ini_set('display_errors', 1);
	session_start();
	
	require_once('includes/common.php');
	$common = new common();

	$searchBy = '';
	if(!empty($_POST['searchby'])){
		$searchBy = $_POST['searchby'];
	}
	$searchKey = '';
	if(!empty($_POST['searchkey'])){
		$searchKey = $_POST['searchkey'];
	}
	$orderStatus = '';
	if(!empty($_POST['orderstatus'])){
		$orderStatus = $_POST['orderstatus'];
	}
	$fromDate = '';
	if(!empty($_POST['fromdate'])){
		$fromDate = $_POST['fromdate'];
	}
	$toDate = '';
	if(!empty($_POST['todate'])){
		$toDate = $_POST['todate'];
	}
	$numRowsForReport='';
	$pageNum = '';
	$orderBy = '';
	$orderType = '';

	
	$reportDetailsArr = $common->getReportingOrderDetails($searchBy, $searchKey, $orderStatus, $fromDate, $toDate, $numRowsForReport, $pageNum, $orderBy, $orderType);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Writeneat - Handwriting Improvement Kit</title>
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

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
	  $( function() {
		  var dateFormat = "yy-mm-dd",
		  from = $( "#fromdate" )
		    .datepicker({
		      defaultDate: "+1w",
		      changeMonth: true,
		      numberOfMonths: 2,
		      dateFormat: "yy-mm-dd"
		    })
		    .on( "change", function() {
		      to.datepicker( "option", "minDate", getDate( this ) );
		    }),
		  to = $( "#todate" ).datepicker({
		    defaultDate: "+1w",
		    changeMonth: true,
		    numberOfMonths: 2,
		    dateFormat: "yy-mm-dd"
		  })
		  .on( "change", function() {
		    from.datepicker( "option", "maxDate", getDate( this ) );
		  });
	 
		function getDate( element ) {
		  var date;
		  try {
		    date = $.datepicker.parseDate( dateFormat, element.value );
		  } catch( error ) {
		    date = null;
		  }
	 
		  return date;
		}
	} );
  </script>

<?php echo $common->getFBTrackingScript();?>

</head>
<body style="font-family:Verdana;color:#aaaaaa;">

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
    <h2>Orders:</h2>
    <!--
    <div style="padding:5px;">
    
    	<div style="padding:5px;float:left;">
			<div style="float:left;padding:5px;">
				Search: <input type="text" name="searchkey"/>
				Search Field: <select name="searchby"><option>Name</option><option>City</option><option>State</option></select>
			</div>
			<div style="float:left;padding:5px;">
				Order Status: <select name="orderstatus"><option value="">All</option><option value="PENDING">Pending</option><option value="SUCCESS">Success</option><option value="FAILED">Failed</option></select>
				Date:<input type="text" name="date" id="date"/></div>
			</div>
    		<div style="padding:5px;float:left;">
    			<input type="button" value="Go" />
    		</div>
    	</div>
    
    	<div style="">
			<table style="border:solid 2px;" border>
			<tr><th>Name</th><th>Address</th><th>City</th><th>State</th><th>Pincode</th><th>Phone</th><th>Email</th><th>Order Status</th></tr>
			<?php
				/*foreach($reportDetailsArr as $repDtls){
					echo '<tr><td>'.$repDtls['name'].'</td><td>'..$repDtls['address'].'</td><td>'..$repDtls['city'].'</td><td>'..$repDtls['state'].'</td><td>'..$repDtls['pincode'].'</td><td>'..$repDtls['phone'].'</td><td>'..$repDtls['email'].'</td><td>'..$repDtls['order_status'].'</td><td></tr>';
				}*/
			?>
			</table>
    	</div>
    </div>
    -->
    
    <div style="float:left;padding:5px;">
    	<form action="reports.php" method="post">
    	<div>
				Search: <input type="text" name="searchkey"/>
				Search Field: <select name="searchby"><option>Name</option><option>City</option><option>State</option></select>
			</div>
			<div style="float:left;padding:5px;">
				Order Status: <select name="orderstatus"><option value="">All</option><option value="PENDING">Pending</option><option value="SUCCESS">Success</option><option value="FAILED">Failed</option></select>
				From: <input type="text" name="fromdate" id="fromdate"/> To: <input type="text" name="todate" id="todate"/>
			</div>
    		<div style="padding:5px;float:left;">
    			<input type="Submit" value="Go" />
    		</div>
    	</div>
    	</form>
    	<a href="exporttocsv.php?<?php echo "searchkey=$searchKey"; ?>&<?php echo "searchby=$searchBy"; ?>&<?php echo "orderstatus=$orderStatus"; ?>&<?php echo "fromdate=$fromDate"; ?>&<?php echo "todate=$toDate"; ?>"><img src="images/export_csv.png" style="width:40px;height=40px;"></a>
    <div style="width:100%; overflow:scroll;">
    <table style="" border>
			<tr><th>Name</th><th>Address</th><th>City</th><th>State</th><th>Pincode</th><th>Phone</th><th>Email</th><th>Order Date</th><th>Order Status</th></tr>
			<?php
				foreach($reportDetailsArr as $repDtls){
					echo '<tr><td>'.$repDtls['name'].'</td><td>'.$repDtls['address'].'</td><td>'.$repDtls['city'].'</td><td>'.$repDtls['state'].'</td><td>'.$repDtls['pincode'].'</td><td>'.$repDtls['phone'].'</td><td>'.$repDtls['email'].'</td><td>'.$repDtls['date_time'].'</td><td>'.$repDtls['order_status'].'</td></tr>';
				}
			?>
			</table>
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
