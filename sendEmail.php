<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);		
}
$mail=new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->SMTPSecure='ssl';

$mail->Port=465;
$mail->Host='smtp.gmail.com';

$mail->Username='eng.muhammedkado@gmail.com';
$mail->Password='eqtinyxvmckejgyh';

$mail->setFrom(address:'eng.muhammedkado@gmail.com', name:'muhammed kado');// This is the email we will send through
$mail->addAddress(address:$invoiceValues['email'],name:'Ms.'.$invoiceValues['order_receiver_name']); //Here it will be sent to the email that was entered when creating the invoice 

$mail->isHTML(true);
//  Here is the content of the message
$mail->Subject='late Invoice ';
$mail->Body='<h1>Hi MS '.$invoiceValues['order_receiver_name'].' </h1><br>
 <p>invoice number:'.$invoiceValues['order_id'].'<br>
  Sir, you are late in paying this invoice.<br>
   Please pay it as soon as possiblee</p>';
$mail->addAttachment(path:'PHP-Take-Home.pdf'); //From here the invoice can be sent
if ($mail->send()) {
    echo" Mail have send Successfuly";
}else{
    echo'Mail dosint sended soryy!';
}





?>