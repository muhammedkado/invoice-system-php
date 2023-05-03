<?php
include 'Invoice.php';
$invoice = new Invoice();
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $invoice->deleteInvoice($_GET['delete']);	
    header("Location:invoice_list.php");


}
  ?>