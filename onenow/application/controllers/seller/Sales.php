<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('seller');
	}

	public function index(){
		$product = $this->seller->getAPI('sellerproductlist');
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
		$this->seller->initView('seller/sales.php',array('sales'=>$product),$css);
	}

	public function confirmation($productid = NULL){
		$product = $this->seller->getAPI('sellerproductlist');
		$confirm = array();
		foreach($product['products_list'] AS $k => $v){
			if($v['id'] == $productid){
				$confirm = $v;
				break;
			}
		}
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
		$this->seller->initView('seller/confirmation.php',array('product'=>$confirm),$css);
	}

	public function processed(){
		$product = $this->seller->getAPI('sellerproductlist');
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
		$this->seller->initView('seller/processed.php',array('processed'=>$product),$css);
	}

	// CGWRenz
	// October 16 2016 - 1330

	public function salesconfirmation(){
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
		$this->seller->initView('seller/salesconfirmation.php', array(),$css);
	}

	public function itemsStatus($action=null){
		if(! is_null($action)){
			if ($action == 'update'){
				if (!empty($_POST)){
					if (isset($_POST['itemid']) && isset($_POST['itemstatus'])){
						$query = $this->seller->getDemoAPI('orders-update',urldecode(http_build_query($_POST)));

						if($query['status'] == 'SUCCESS'){
							return true;
						}
						else{
							show_error('One of the parameters are incorrect or missing.',400,'Something is wrong :C');
						}
					}
					else{
						show_error('One of the parameters are incorrect or missing.',400,'Incorrect/Missing parameters');
					}
				}
				else {
					show_error('Please try again.',400,'No parameters specified');
				}
			}
			else if($action == 'pickup' || $action == 'cancelItems' || $action == 'awb'){
				if (!empty($_POST)){
					if (isset($_POST['itemid']) && isset($_POST['itemstatus'])){
						$query = $this->seller->getDemoAPI('orders-update',urldecode(http_build_query($_POST)));
						if($query['status'] == 'SUCCESS'){
							return true;
						}
						else{
							show_error('One of the parameters are incorrect or missing.',400,'Something is wrong :C');
						}
					}
					else{
						show_error('One of the parameters are incorrect or missing.',400,'Incorrect/Missing parameters');
					}
				}
				else {
					show_error('Please try again.',400,'No parameters specified');
				}
			}
			else{
				show_404();
			}
		}
		else {
			show_404();
		}
	}

	public function test_order($page = 1){
			$this->output->enable_profiler(TRUE);
			$orders = $this->seller->getDemoAPI('orders','sellersuite=BTH-P&itemstatus=P&limit=10&pageoffset='.$page);
			$orders['orderlist'] = $this->seller_model->getOrderSla($orders['orderlist']);
			
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
			$js = '<script src="'.base_url('onenow/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('onenow/assets/js/seller/jspdf.min.js').'"></script>';
			if (isset($orders['totalpages'])){
				$js .= '<script>paginator('.$orders['totalpages'].','.$page.')</script>';
			}
			$orders['orderlist'] = sort_orderlist($orders['orderlist'], 'P');
			$this->seller->initView('seller/sales/orderspending_test.php', array('orders'=>$orders),$css, $js);

	}

	public function pending_orders($page = 0){
		if($page == 0){
			redirect('seller/sales/pending_orders/1', 'refresh');
		}
		if (isset($_SESSION['suite'])){
			$orders = $this->seller->getDemoAPI('orders','sellersuite='.$_SESSION['suite'].'&itemstatus=P&limit=10&pageoffset='.$page);
			$orders['orderlist'] = $this->seller_model->getOrderSla($orders['orderlist']);
			
			// var_dump($orders['orderlist'][2]['itmelist']); die();
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
			$js = '<script src="'.base_url('onenow/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('onenow/assets/js/seller/jspdf.min.js').'"></script>';
			if (isset($orders['totalpages'])){
				$js .= '<script>paginator('.$orders['totalpages'].','.$page.')</script>';
			}
			// usort($orders['orderlist'], "sort_dates");
			$orders['orderlist'] = sort_orderlist($orders['orderlist'], 'P');
			$this->seller->initView('seller/sales/orderspending.php', array('orders'=>$orders),$css, $js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function order_label_pdf(){
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'pt', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Onenow');
		$pdf->SetTitle('Onenow - Order Label: ');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		
		$pdf->SetMargins(10, 20, 10);
		$pdf->SetHeaderMargin(30);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);

		$pdf->AddPage();
		// set style for barcode
		$style = array(
			'border' => true,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
		);
		$pdf->write2DBarcode('BTH-10282016-9456-BTH-N-01', 'QRCODE,H', 10, 30, 50, 50, $style, 'N');
		$pdf->Text(80, 205, 'QRCODE H - COLORED');

		$pdf->Output('pdfexample.pdf', 'I');
	}

	public function order_print_labels(){
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
		$js = '<script src="'.base_url('onenow/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('onenow/assets/js/seller/jspdf.min.js').'"></script>';
		if (isset($_GET)){
			if (!empty($_GET['order_id']) && !empty($_GET['merchant']) && !empty($_GET['boxnumber']) && is_numeric($_GET['boxnumber'])){
					$order = array('sellersuite'=>$_SESSION['suite'],'order_id'=>$_GET['order_id'],'boxnumber'=>intval($_GET['boxnumber']),'merchant'=>$_GET['merchant']);
					$js .= '<script>';
							for($i = 0 ; $i < $order['boxnumber']; $i++){
							$text = $order['order_id'].'-'.$order['sellersuite'].'-'.str_pad($i+1,2,"0", STR_PAD_LEFT);
								$js .=	'$(\'#mtn'.($i+1).'\').text(\''.$text.'\');';
								$js .=	'new QRCode(document.getElementById(\'barcode'.($i+1).'\'),{
											text: \''.$text.'\',
											width: \'100\',
											height: \'100\'
										});';
							}
					$js .=	'</script>';

					$this->seller->initView('seller/sales/orderlabels.php', array('order'=>$order), $css,$js);
			}
			else{
				echo 'Order number does not exist, please <a href="javascript:window.close();">close</a> this page.';
			}
		}
		else{
			show_404();
		}
	}

	public function confirmed_orders($page = 0){
		if($page == 0){
			redirect('seller/sales/confirmed_orders/1', 'refresh');
		}
		$orders = $this->seller->orders_combineCancelled('2', $page);
		$orders['orderlist'] = $this->seller_model->getOrderSla($orders['orderlist']);
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
		$js = '';
		if (isset($orders['totalpages'])){
			$js .= '<script>paginator('.$orders['totalpages'].','.$page.')</script>';
		}

		if (isset($_SESSION['suite'])){
			$this->seller->initView('seller/sales/ordersconfirmed.php', array('orders_processed'=>$orders),$css);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function arrange_pickup($page = 0){
		if($page == 0){
			redirect('seller/sales/arrange_pickup/1', 'refresh');
		}
		$combined_orders = $this->seller->orders_combineCancelled('2', $page);
		$processed_orders = $combined_orders;
		$processed_orders['orderlist'] = array();
		foreach ($combined_orders['orderlist'] as $key => $value) {
			if($value['orderStatus'] != 2){
				array_push($processed_orders['orderlist'], $value);
			}
		}
		$processed_orders['orderlist'] = $this->seller_model->getOrderSla($processed_orders['orderlist']);
		// var_dump($processed_orders); die();
		// $js = '<script>paginator('.$products["pages"].','.$page.')</script>';
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
		$js = '';
		if (isset($combined_orders['totalpages'])){
			$js .= '<script>paginator('.$combined_orders['totalpages'].','.$page.')</script>';
		}
		if (isset($_SESSION['suite'])){
			$this->seller->initView('seller/sales/pickup.php', array('processed_orders' => $processed_orders),$css,$js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}
	
	public function awb_confirmation($page = 0){
		if($page == 0){
			redirect('seller/sales/awb_confirmation/1', 'refresh');
		}
		if (isset($_SESSION['suite'])){
			$combined_orders = $this->seller->orders_combineCancelled('3', $page);
			$processed_orders = $combined_orders;
			$processed_orders['orderlist'] = array();
			foreach ($combined_orders['orderlist'] as $key => $value) {
				if($value['orderStatus'] != 2 && (!$value['itmelist'][0]['airwaybill'])){
					array_push($processed_orders['orderlist'], $value);
				}
			}
			$processed_orders['orderlist'] = $this->seller_model->getOrderSla($processed_orders['orderlist']);
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
			$js = '<script src="'.base_url('onenow/assets/js/seller/qrcode.min.js').'"></script>';
			if (isset($combined_orders['totalpages'])){
				$js .= '<script>paginator('.$combined_orders['totalpages'].','.$page.')</script>';
			}
			$this->seller->initView('seller/sales/awbconfirmation.php',array('processed_orders' => $processed_orders),$css,$js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function order_history($page = 0){
		if($page == 0){
			redirect('seller/sales/order_history/1', 'refresh');
		}
		if (isset($_SESSION['suite'])){
			$combined_orders = $this->seller->orders_combineCancelled('4', $page);
			$processed_orders = $combined_orders;
			$processed_orders['orderlist'] = array();
			// var_dump($combined_orders); die();
			foreach ($combined_orders['orderlist'] as $key => $value) {
				if($value['orderStatus'] != 2 && ($value['itmelist'][0]['airwaybill'])){
					array_push($processed_orders['orderlist'], $value);
				}
			}
			$processed_orders['orderlist'] = $this->seller_model->getOrderSla($processed_orders['orderlist']);
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('onenow/assets/css/seller/salescss.css').'">';
			$js = '<script src="'.base_url('onenow/assets/js/seller/qrcode.min.js').'"></script>';
			if (isset($combined_orders['totalpages'])){
				$js .= '<script>paginator('.$combined_orders['totalpages'].','.$page.')</script>';
			}
			$this->seller->initView('seller/sales/awbconfirmation.php',array('processed_orders' => $processed_orders),$css, $js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}
	
}
?>