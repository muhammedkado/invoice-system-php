<?php
class Invoice{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "invoice_system";   
	private $invoiceUserTable = 'invoice_user';	
    private $invoiceOrderTable = 'invoice_order';
	private $invoiceOrderItemTable = 'invoice_order_item';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	//This function of running SQL Query
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: ');
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
 
	public function loginUsers($email, $password){
		$sqlQuery = "
			SELECT id, email, first_name, last_name, address, mobile 
			FROM ".$this->invoiceUserTable." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:index.php");
		}
	}		
	public function saveInvoice($POST) {	
		$userID=$POST['userId'];
		$orderReceiverName=$POST['companyName'];
		$address=$POST['address'];
		$subTotal=$POST['subTotal'];
		$taxAmount=$POST['taxAmount'];
		$taxRate=$POST['taxRate'];
		$totalAftertax=$POST['totalAftertax'];
		$amountPaid=$POST['amountPaid'];
		$orderAmountPaid=$POST['amountDue'];
		$notes=$POST['notes'];
		$billing_Date=date('y-m-d',strtotime($POST['billing_Date']));
		$due_Date=$POST['due_date'];
		$email=$POST['email'];
		$status=$POST['status'];
		$sqlInsert = "
			INSERT INTO ".$this->invoiceOrderTable."(
				user_id,
				order_receiver_name,
				order_receiver_address,
				order_total_before_tax,
				order_total_tax,
				order_tax_per,
				order_total_after_tax,
				order_amount_paid,
				order_total_amount_due,
				customer_note,
				billing_Date,
			    due_date,
				email,
				status
				   ) 
			VALUES (
			'$userID',
			 '$orderReceiverName',
			 '$address',
			 '$subTotal',
			 '$taxAmount',
			 '$taxRate',
			 '$totalAftertax',
			 '$amountPaid',
			 '$orderAmountPaid',
			 '$notes',
			 '$billing_Date',
			 '$due_Date',
			 '$email',
			 '$status'
			 )";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount) 
			VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}  
		header("Location:invoice_list.php");
	    	
	}	
	public function updateInvoice($POST) {
		if($POST['invoiceId']) {	
		$userID=$POST['userId'];
		$orderReceiverName=$POST['companyName'];
		$address=$POST['address'];
		$subTotal=$POST['subTotal'];
		$taxAmount=$POST['taxAmount'];
		$taxRate=$POST['taxRate'];
		$totalAftertax=$POST['totalAftertax'];
		$amountPaid=$POST['amountPaid'];
		$orderAmountPaid=$POST['amountDue'];
		$notes=$POST['notes'];
		$billing_Date=date('y-m-d',strtotime($POST['billing_Date']));
		$due_Date=$POST['due_date'];
		$email=$POST['email'];
		$status=$POST['status'];
			$sqlInsert = "
				UPDATE ".$this->invoiceOrderTable." 
				SET order_receiver_name = '$orderReceiverName',
				order_receiver_address= '$address',
				order_total_before_tax = '$subTotal',
				order_total_tax = '$taxAmount',
				order_tax_per = '$taxRate',
				order_total_after_tax = '$totalAftertax',
				order_amount_paid = '$amountPaid',
				order_total_amount_due = '$orderAmountPaid',
				customer_note = '$notes',
				billing_Date='$billing_Date',
				`due_date`='$due_Date',
				email='	$email',
				status='$status'
		
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		}		
		$this->deleteInvoiceItems($POST['invoiceId']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount) 
				VALUES ('".$POST['invoiceId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}    
		header("Location:invoice_list.php");   	
	}	
	public function getInvoiceList(){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}	
	
	public function getInvoice($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."' AND order_id = '$invoiceId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getInvoiceItems($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}
	public function deleteInvoiceItems($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deleteInvoice($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->invoiceOrderTable." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deleteInvoiceItems($invoiceId);	
		return 1;
	}
	

	}

 

 
 
?>