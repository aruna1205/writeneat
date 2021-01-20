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
	if(!empty($_GET['searchby'])){
		$searchBy = $_GET['searchby'];
	}
	$searchKey = '';
	if(!empty($_GET['searchkey'])){
		$searchKey = $_GET['searchkey'];
	}
	$orderStatus = '';
	if(!empty($_GET['orderstatus'])){
		$orderStatus = $_GET['orderstatus'];
	}
	$fromDate = '';
	if(!empty($_GET['fromdate'])){
		$fromDate = $_GET['fromdate'];
	}
	$toDate = '';
	if(!empty($_GET['todate'])){
		$toDate = $_GET['todate'];
	}
	$numRowsForReport='';
	$pageNum = '';
	$orderBy = '';
	$orderType = '';


	$reportDetailsArr = $common->getReportingOrderDetails($searchBy, $searchKey, $orderStatus, $fromDate, $toDate, $numRowsForReport, $pageNum, $orderBy, $orderType);

	$fname="orderdetails_".date("YmdHis").".csv";
	array2csv($reportDetailsArr);
	download_file($fname);
	
	function array2csv(array &$array){
		if (count($array) == 0) {
			return null;
		}
		//$fname="orderdetails_".date("YmdHis").".csv";
		global $fname;
		ob_start();
		$df = fopen("export/$fname", 'w');
		fputcsv($df, array_keys(reset($array)));
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
		fclose($df);
		return ob_get_clean();
	}
	
	function download_file($filename) {
		global $baseURL;
		$file = "export/$filename"; 
		ob_get_clean();
		header("Content-Description: File Transfer"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Disposition: attachment; filename=\"". basename($file) ."\""); 

		readfile ($file);
		exit(); 
	}
	
?>

