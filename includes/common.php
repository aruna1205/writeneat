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
	
	public function sendOrderPlacementMail($orderDetails) {
		
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
		

		//$retval = mail ($to,$subject,$message,$header);
		try{
			$retval = mail ($to,$subject,$message,$header);
			return true;
		}
		catch (Exception $e){
			//echo $e-getMessage();
			return false;
		}

		
		
	}


}
?>

