<?php
session_start();
require_once('./TCPDF/tcpdf.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);		
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);		
}
 
// create new PDF document
$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print

//$invoiceDate = date("Y/M/D", strtotime($invoiceValues['order_date']));
$html = '';
$html .= '<table width="100%" border="1" cellpadding="1" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
	 
	</tr>
	 
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="60%">
	To,<br />
	<b>RECEIVER (BILL TO)</b><br />
	Name : '.$invoiceValues['order_receiver_name'].'<br /> 
	Billing Address : '.$invoiceValues['order_receiver_address'].'<br />
	</td>
	<td width="50%">         
	Invoice No :'.$invoiceValues['order_id'].'<br /><br />
	Billing Date :'.$invoiceValues['billing_Date'].'<br /> 
	Due Date :'.$invoiceValues['due_date'].'<br /> <br />
	Status :'.$invoiceValues['status'].' <br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Sr No.</th>
	<th align="left">Product code</th>
	<th align="left">Product description</th>
	<th align="left">Quantity</th>
	<th align="left">Price</th>
	<th align="left">Actual Amt.</th> 
	</tr>';
$count = 0;   
foreach($invoiceItems as $invoiceItem){
	$count++;
	$html .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["item_code"].'</td>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].'</td>
	<td align="left">'.$invoiceItem["order_item_price"].'</td>
	<td align="left">'.$invoiceItem["order_item_final_amount"].'</td>   
	</tr>';
}
$html .= '
	<tr>
	<td align="right" colspan="5"><b>Sub Total</b></td>
	<td align="left"><b>'.$invoiceValues['order_total_before_tax'].'</b></td>
	</tr>';
	if ($invoiceValues['order_tax_per']>0) {
		$html .= 	'<tr>
	<td align="right" colspan="5"><b>Tax Rate :</b></td>
	<td align="left">'.$invoiceValues['order_tax_per'].'</td>
	</tr>';
	}
	
	if ($invoiceValues['order_total_tax']>0) {
		$html .= '<tr>
		<td align="right" colspan="5">Tax Amount: </td>
		<td align="left">'.$invoiceValues['order_total_tax'].'</td>
		</tr>';
	}
	$html .= '<tr>
	<td align="right" colspan="5">Total: </td>
	<td align="left">'.$invoiceValues['order_total_after_tax'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="5">Amount Paid:</td>
	<td align="left">'.$invoiceValues['order_amount_paid'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="5"><b>Amount Due:</b></td>
	<td align="left">'.$invoiceValues['order_total_amount_due'].'</td>
	</tr>';
$html .= '
	</table>
	</td>
	</tr>
	</table>';
	$html .= '
	 
	<h4>Costumer Notes</h4>
	<hr>
<p>'.$invoiceValues['customer_note'].'</p>
	 
	';
	$html .= '
	 
	<h4>Payment Information</h4>
	<hr>
	<p>Bank Name : 12345678912<br>
	Account Number : 12345678912<br>
	</p>
	 
	';

// Print text using writeHTMLCell()
$pdf->writeHTML($html);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('example_001.pdf', 'I');
//$pdf->Output($invoiceValues['order_receiver_name'].'.pdf', 'd');


	
 
?>