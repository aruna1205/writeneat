<?php

require_once('db.php');
class common {

	protected $db;
	
	public function __construct() {
		require_once('dbconfig.php');
		$this->db = new db($dbhost, $dbuser, $dbpass, $dbname, 'utf8');
	}

	public function getOrderDetails() {
		$query = 'SELECT * FROM wn_user_order WHERE order_id="'.$_SESSION['order_id'].'"';
		$orderDetails = $this->db->query($query)->fetchArray();
		if(!empty($orderDetails)){
			return $orderDetails;
		}
		else{
			return array();
		}
	}
	
	public function insertOrderDetails($keys, $values) {
		$query = "INSERT INTO wn_user_order ($keys) VALUES ($values)";
		$insertId = $this->db->query($query)->lastInsertID();
		if(!empty($insertId)){
			return $insertId;
		}
		else{
			return '';
		}
	}
	
	public function updateOrderStatus($orderStatus) {
		$query = 'UPDATE wn_user_order SET order_status="'.$orderStatus.'" where order_id="'.$_SESSION['order_id'].'"';
		$count = $this->db->query($query)->affectedRows();
		
		if(!empty($count)){
			return $count;
		}
		else{
			return 0;
		}
	}
	
	public function getProductDetails() {
		$query = 'SELECT * FROM wn_product_price WHERE product_name="handwritingkit"';
		$prodDetails = $this->db->query($query)->fetchArray();
		if(!empty($prodDetails)){
			return $prodDetails;
		}
		else{
			return array();
		}
	}


}
?>
