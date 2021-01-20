<?php

require_once('db.php');
class common {

	protected $db;
	protected $FBTrackingID;
	
	public function __construct() {
		require('dbconfig.php');
		$this->db = new db($dbhost, $dbuser, $dbpass, $dbname, 'utf8');
		$this->FBTrackingID = $FBTrackingID;
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
	
	public function sendOrderPlacementMail($orderDetails) {
		try{
    		$header = "From:support@chethanshenoy.in \r\n";
    		$header .= "Cc:anil.gl.gl@gmail.com \r\n";
    		$header .= "MIME-Version: 1.0\r\n";
    		$header .= "Content-type: text/html\r\n"; 
    		
    		$to = $orderDetails['email'];
    		$subject = "Order Confirmation- Order Id: ".$orderDetails['order_id'];
    
    		$message = "<h1>Thank you for your order.</h1>";
    		$message .= "<b>Your order <".$orderDetails['order_id']."> has been placed successfully.</b>";
    		
    		$message .= "<div>";
    		$message .= "Your order will be sent to:<br/>";
    		$message .= "<b>".$orderDetails['name']."<br/>";
    		$message .= "<b>".$orderDetails['address']."<br/>";
    		$message .= "<b>".$orderDetails['city']."<br/>";
    		$message .= "<b>".$orderDetails['state']."<br/>";
    		$message .= "<b>".$orderDetails['pincode']."<br/>";
    		$message .= "<b>Ph:".$orderDetails['phone']."<br/>";
    
    		$message .= "</div>";
    		$message .= "<br/><br/>";
    		$message .= "<table>
    				<tr><th>Order Summary</th></tr>
    				<tr>
    					<td>Item Subtotal:</td> <td>".$orderDetails['order_amount']."</td>
    				</tr>
    				<tr>
    					<td>Shipping & Handling:</td> <td>Free</td>
    				</tr>
    				<tr>
    					<td>Order Total:</td> <td>".$orderDetails['order_amount']."</td>
    				</tr>
    			</table>
    			<br/>";
		
			$retval = mail ($to,$subject,$message,$header);
			return true;
		}
		catch (Exception $e){
			//echo $e-getMessage();
			return false;
		}

		
		
	}
	
	public function getFBTrackingScript() {
		
		return "<script>
			!function(f,b,e,v,n,t,s)
			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '".$this->FBTrackingID."');
			fbq('track', 'PageView');
			</script>";
	}
	
	public function getReportingOrderDetails($searchBy, $searchKey, $orderStatus, $fromDate, $toDate, $numRowsForReport, $pageNum, $orderBy, $orderType) {
		$query = "SELECT * FROM wn_user_order ";
		$searchSQL =" ";
		$statusSQL =" ";
		$fromDateSQL =" ";
		$toDateSQL =" ";
		$and =" ";
		$where =" WHERE ";
		if( !empty($searchBy) && !empty($searchKey) ){
			$searchSQL = " $and $where $searchBy LIKE '%$searchKey%' ";
			$where = " ";
			$and = " AND ";
		}
		if( !empty($orderStatus) ){
			$statusSQL = " $and $where order_status = '$orderStatus' ";
			$where = " ";
			$and = " AND ";
		}
		if( !empty($fromDate) ){
			$fromDateSQL = " $and $where date(date_time) >= '$fromDate' ";
			$where = " ";
			$and = " AND ";
		}
		if( !empty($toDate) ){
			$toDateSQL = " $and $where date(date_time) <= '$toDate' ";
			$where = " ";
			$and = " AND ";
		}
		$query .= $searchSQL.$statusSQL.$fromDateSQL.$toDateSQL;
		//echo "<pre>$query</pre>";
		
		$orderDetails = $this->db->query($query)->fetchAll();
		if(!empty($orderDetails)){
			return $orderDetails;
		}
		else{
			return array();
		}
	}


}
?>
