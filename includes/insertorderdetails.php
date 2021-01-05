<?php 
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	session_start();
	//echo 'hhh';die;
	try {
		//print_r($_POST); die;
		require_once('db.php');
		$keys= implode(",",array_keys($_POST));
		$values= implode("','",array_values($_POST));
		$values="'".$values."'";
		$insertQuery = "INSERT INTO wn_user_order ($keys) VALUES ($values)";
		//echo $insertQuery; die;
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = 'rittal';
		$dbname = 'write_neat';
		$db = new db($dbhost, $dbuser, $dbpass, $dbname);
		$insertId = $db->query($insertQuery)->lastInsertID();
		$_SESSION['order_id'] = $insertId;
		//print_r($_SESSION); die;
		echo 'success:'.$insertId;
	}
	catch(Exception $e) {
		//echo 'Message: ' .$e->getMessage();
		echo 'error:'.$e->getMessage();
	}
	




?>
