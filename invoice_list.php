<?php 
session_start();
include('inc/header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
?>
<title> Incoice Liste</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('inc/container.php');?>
	<div class="container">		
	  <h2 class="title">Invoice System</h2>
	  <?php include('menu.php');?>			  
      <table id="data-table" class="table table-condensed table-striped">
        <thead>
          <tr>
            <th>Invoice No.</th>
            <th>Create Date</th>
            <th>Customer Name</th>
            <th>Invoice Total</th>
            <th>Invoice Status</th>
            <th>Send via Email</th>
            <th>Print</th>
            <th>Edit</th>
            <th>Delete</th>
            
          </tr>
        </thead>
        <?php		
		$invoiceList = $invoice->getInvoiceList();
        foreach($invoiceList as $invoiceDetails){
			$invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["order_date"]));
            echo '
              <tr>
                <td>'.$invoiceDetails["order_id"].'</td>
                
                <td>'.$invoiceDate.'</td>
                <td>'.$invoiceDetails["order_receiver_name"].'</td>
                <td>'.$invoiceDetails["order_total_after_tax"].'</td>
                <td>'.$invoiceDetails["status"].'</td>
                <td><a href="sendEmail.php?invoice_id='.$invoiceDetails["order_id"].'" target="_blank" title="send Invoice"><span class="glyphicon glyphicon-send"></span></a></td>
                <td><a href="print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" target="_blank" title="Print Invoice"><span class="glyphicon glyphicon-print"></span></a></td>
               
                <td><a href="edit_invoice.php?update_id='.$invoiceDetails["order_id"].'"  title="Edit Invoice"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a href="delete_invoice.php?delete='.$invoiceDetails["order_id"].'"name="deleteInvoice"   title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
            ';
        }       
        ?>
      </table>	
</div>	
<?php include('inc/footer.php');?>