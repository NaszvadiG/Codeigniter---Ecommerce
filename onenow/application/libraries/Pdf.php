<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
    public function generateLabel($suite = '', $boxnumber = 0, $order = ''){
    	$pdf = new Pdf('P', 'pt', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('OneNow - '.$suite);
		$pdf->SetTitle('OneNow - Order Label: '.$order);
		$pdf->SetSubject('OneNow Order Labels - '.$order);
		$pdf->SetKeywords('OneNow, Order Labels,'.$suite.','.$order);

		$pdf->SetMargins(10, 10, 10);
		$pdf->SetHeaderMargin(30);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);

		$pdf->AddPage();

$tbl = '
<table cellspacing="0" cellpadding="1" border="1">
		    <tr>
		        <td><img src="'.base_url("onenow/assets/images/seller/orderlabel.png").'" style="position: absolute;"></td>
		    </tr>

		</table>
';

$pdf->writeHTML($tbl, true, false, false, false, '');

		// $pdf->setJPEGQuality(75);
		// $pdf->Image(base_url('onenow/assets/images/seller/orderlabel.png'), 10, 30,95,60, 'PNG', false, '', true, 150, '', false, false, 0, false, false, false);
		// // set style for barcode
		// $style = array(
		// 	'border' => false,
		// 	'vpadding' => 'auto',
		// 	'hpadding' => 'auto',
		// 	'fgcolor' => array(0,0,0),
		// 	'bgcolor' => false, //array(255,255,255)
		// 	'module_width' => 1, // width of a single module in points
		// 	'module_height' => 1 // height of a single module in points
		// );
		// $pdf->write2DBarcode($order.'-'.$suite.'-'.$boxnumber, 'QRCODE,H', 35, 40, 40, 40, $style, 'N');
		// $pdf->Text(20, 80, $order.'-'.$suite.'-'.$boxnumber, false, false, true, 1, 0, 'C', false, '', 0, false, 'T', 'C', 'false');

		$pdf->Output('pdfexample.pdf', 'I');
    }
}
/*Author:CGW-ITPH - Renz */  
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */