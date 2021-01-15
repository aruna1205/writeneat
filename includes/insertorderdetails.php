<?php 
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	session_start();
	
	try {
		require_once('common.php');
		$keys= implode(",",array_keys($_POST));
		$values= implode("','",array_values($_POST));
		$values="'".$values."'";

		
		$common = new common();
		$insertId = $common->insertOrderDetails($keys, $values);
		$_SESSION['order_id'] = $insertId;
		echo 'success:'.$insertId;
	}
	catch(Exception $e) {
		//echo 'Message: ' .$e->getMessage();
		echo 'error:'.$e->getMessage();
	}
	




?>
