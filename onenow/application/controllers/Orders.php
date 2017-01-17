<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('seller');
	}

	public function index(){
		redirect('seller/orders/pending_orders/1', 'refresh');
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
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
		$this->seller->initView('seller/confirmation.php',array('product'=>$confirm),$css);
	}

	public function processed(){
		$product = $this->seller->getAPI('sellerproductlist');
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
		$this->seller->initView('seller/processed.php',array('processed'=>$product),$css);
	}

	// CGWRenz
	// October 16 2016 - 1330

	public function salesconfirmation(){
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
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

	public function debug_orderlist(){
		if (isset($_POST['suite']) && isset($_POST['itemstatus'])){
		}
		$orders = $this->seller->getDemoAPI('orders','sellersuite='.$_POST['suite'].'&itemstatus='.$_POST['itemstatus'].'&limit=10&pageoffset=1');
		header('Content-type:application/json');
		echo json_encode($orders);
	}

	public function debug_updateorderlist(){
		if (isset($_POST['itemid']) && isset($_POST['itemstatus'])){
		}
		$orders = $this->seller->getDemoAPI('orders-update','itemid='.$_POST['itemid'].'&itemstatus='.$_POST['itemstatus']);
		header('Content-type:application/json');
		echo json_encode($orders);
	}

	public function search_order($page = 0){
		if (isset($_SESSION['authuser'])){
			if($page == 0){
				if (!is_null(get_cookie('seller_order_search_query'))){
					delete_cookie('seller_order_search_query');
				}
				if (isset($_POST['item_name']) || isset($_POST['sku'])){
					$timeFrom = strtotime(str_replace(' ', '', $_POST['date_ordered']));
					$timeTo = strtotime(str_replace(' ', '', $_POST['date_ordered']).' +1 day');
					$date = array('','');
					foreach(array($timeFrom, $timeTo) as $k=>$v){
						if($v != ''){
							$newformat = date('Y-m-d', $v);
							$date[$k] = $newformat.'%2000:00:00.0';
						}
					};
					$cookieData = array('name'	=>	'order_search_query',
								'value'	=>	json_encode(array(
									'sku'		=>	$_POST['sku'],
									'prodname'	=>	rawurlencode($_POST['item_name']),
									'dateFrom'=>	$date[0],
									'dateTo'	=>	$date[1]
									)),
								'expire'=>	60 * 60 * 24 * 30,
								'prefix'=>	'seller_',
								);
					if (isset($_POST['created_date_sort'])) $cookieData['sort_by'] = isset($_POST['created_date_sort']) ? ($_POST['created_date_sort'] == 'created_date_asc' ? 'desc' : 'asc') : 'desc';
					set_cookie($cookieData);
				}
				redirect('seller/orders/search_order/1', 'refresh');
			}
			if (!is_null(get_cookie('seller_order_search_query'))){
				$session_query = (array) json_decode(get_cookie('seller_order_search_query'));
			}
			else{
				redirect('/seller/orders/pending_orders/1', 'refresh');
			}
			$data = array(
						'sellersuite'	=> $this->authuser->suite,
						'itemstatus'	=> 'P',
						'limit'		=> 10,
						'pageoffset'	=> $page,
						'sort_by'		=> isset($session_query['sort_by']) ? $session_query['sort_by'] : 'desc',
						'sku'			=> str_replace(' ', '%20', $session_query['sku']),
						'orderno'		=> '',
						'prodname'		=> str_replace(' ', '%20', $session_query['prodname']),
						'dateFrom'		=> str_replace(' ', '%20', $session_query['dateFrom']),
						'dateTo'		=> str_replace(' ', '%20', $session_query['dateTo'])
					);
			$orders = $this->seller->getAPI('checkout','order-search',$data);
			$orders['orderlist'] = $this->seller_model->getOrderSla($orders['orderlist']);
			$orders['newOrders'] = 0;
			foreach ($orders['orderlist'] as $orderlistK => $orderlistV) {
				if ($orderlistV['boxnumber'] == 0){
					$orders['newOrders']++;
				}
			}
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
			$js = '<script src="'.base_url('seller/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('seller/assets/js/seller/jspdf.min.js').'"></script>
			<script src="'.base_url('seller/assets/js/seller/orderlabel.js').'"></script>
			<script type="application/javascript" src="'.base_url($this->seller->vendor_dir.'bootstrap-daterangepicker/moment.min.js').'" ></script>
			<script type="application/javascript" src="'.base_url($this->seller->vendor_dir.'bootstrap-daterangepicker/daterangepicker.js').'" ></script>';
			$js .= '
				<script>
					orderlabel.suite = "'.$this->authuser->suite.'";
				</script>';
			if (isset($orders['totalpages'])){
				$js .= '<script>paginator('.$orders['totalpages'].','.$page.')</script>';
			}
			// usort($orders['orderlist'], "sort_dates");
			// $orders['orderlist'] = sort_orderlist($orders['orderlist'], 'P');
			$this->seller->initView('seller/sales/orderspending.php', array('orders'=>$orders),$css, $js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function pending_orders($page = 0){
		if (!is_null(get_cookie('seller_order_search_query'))){
			delete_cookie('seller_order_search_query');
		}
		if($page == 0){
			redirect('seller/orders/pending_orders/1', 'refresh');
		}
		if (isset($_SESSION['authuser'])){
			$account = $this->seller_model->getAccount();
			$orders = $this->seller->getDemoAPI('orders','sellersuite='.$this->authuser->suite.'&itemstatus=P&limit=10&pageoffset='.$page);
			$orders['orderlist'] = $this->seller_model->getOrderSla($orders['orderlist']);
			$orders['newOrders'] = 0;
			foreach ($orders['orderlist'] as $orderlistK => $orderlistV) {
				if ($orderlistV['boxnumber'] == 0){
					$orders['newOrders']++;
				}
			}
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
				$js = '<script src="'.base_url('seller/assets/js/seller/qrcode.min.js').'"></script>
				<script src="'.base_url('seller/assets/js/seller/jspdf.min.js').'"></script>
				<script src="'.base_url('seller/assets/js/seller/orderlabel.js').'"></script>
				<script type="application/javascript" src="'.base_url($this->seller->vendor_dir.'bootstrap-daterangepicker/moment.min.js').'" ></script>
				<script type="application/javascript" src="'.base_url($this->seller->vendor_dir.'bootstrap-daterangepicker/daterangepicker.js').'" ></script>';
			$js .= '
				<script>
					orderlabel.suite = "'.$this->authuser->suite.'";
				</script>';
			if (isset($orders['totalpages'])){
				$js .= '<script>paginator('.$orders['totalpages'].','.$page.')</script>';
			}
			// usort($orders['orderlist'], "sort_dates");
			$orders['orderlist'] = sort_orderlist($orders['orderlist'], 'P');
			$pickup_address = array();
			if (isset($account['address'])){
				array_push($pickup_address, array('address'=>$account['address'],'address_line_2'=>isset($account['address_line_2']) ? $account['address_line_2'] : '','city'=>$account['city'],'province'=>$account['province'],'postal_code'=>$account['postal_code'],'contact'=>$account['contact_number']));
			}
			if (isset($account['address_2'])){
				array_push($pickup_address, array('address'=>$account['address_2'],'address_line_2'=>isset($account['address_line_2_2']) ? $account['address_line_2_2'] : '','city'=>$account['city_2'],'province'=>$account['province_2'],'postal_code'=>$account['postal_code_2'],'contact'=>$account['contact_number']));
			}
			$this->seller->initView('seller/sales/orderspending.php', array('orders'=>$orders,'pickup_address'=>$pickup_address),$css, $js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function order_label_pdf(){
		$this->load->library('Pdf');
		$this->pdf->generateLabel('BTH-N', 1, 'BTH-11222016-9805');
	}

	public function debug_print_dialog(){
		echo '<form action="/seller/orders/order_print_packing_labels" method="POST">
	<input type="text" name="orderlist" placeholder="Orderlist">
	<input type="text" name="boxnumber" placeholder="Number of boxes">
	<button type="submit">Print</button>
</form>';
	}

	public function packinglist_preview(){
		if (isset($_POST['order_id']) && isset($_POST['boxnumber']) && isset($_POST['itemstatus']) && isset($_SESSION['authuser'])){
			$ret['suite'] = $this->authuser->suite;
			$ret['orderlist_details'] = $this->seller_model->search_orderlist($_POST['order_id'], $_POST['itemstatus']);
			$ret['orderlist_details']['boxnumber'] = $_POST['boxnumber'];
			if (!(isset($ret['orderlist_details']['status']) && $ret['orderlist_details']['status'] == false)){
			}
			else{
				$ret['status'] = false;
				$ret['msg'] = 'Order not found';
			}		
		}
		else{
			$ret['status'] = false;
			$ret['msg'] = 'Missing/Invalid Parameters';
		}
		header('Content-type: application/json');
		echo json_encode($ret);
	}

	public function order_print_packing_labels(){
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/packinglist.css').'">';
		$js = '<script src="'.base_url('seller/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('seller/assets/js/seller/jspdf.min.js').'"></script>
			<script src="'.base_url('seller/assets/js/seller/orderlabel.js').'"></script>';
		$ret = array('status'=>true);
		if (isset($_GET['order_id']) && isset($_GET['boxnumber']) && isset($_SESSION['authuser']) && isset($_GET['itemstatus'])){
			$ret['suite'] = $this->authuser->suite;

			$ret['orderlist_details'] = $this->seller_model->search_orderlist($_GET['order_id'], $_GET['itemstatus']);
			$ret['orderlist_details']['boxnumber'] = $_GET['boxnumber'];
			if (!(isset($ret['orderlist_details']['status']) && $ret['orderlist_details']['status'] == false)){
				$orderlist = $ret['orderlist_details'];
				$js .= '
				<script>
				orderlabel.suite = "'.$this->authuser->suite.'";
				orderlabel.order = "'.$orderlist['txnRef'].'";
				$(\'.barcodeImg\').each(function(i,v){
					new QRCode(v,{
						text: \''.$orderlist['txnRef'].'-'.$ret['suite'].'-\'+($(v).data(\'id\') < 10 ? \'0\' : \'\') + $(v).data(\'id\'),
						width: \'250\',
						height: \'250\'
					});
					if(i + 1 == $(\'.barcode\').length){
						window.setTimeout(function(){
							window.print();
						}, 500);
					}
				});			
				orderlabel.initOrderLabel();	
				</script>';

				$this->seller->initView('seller/sales/order_packinglabels.php', array('order'=>$ret['orderlist_details']), $css,$js);
			}
			else{
				var_dump('Order not found');
			}		
		}
		else{
			$ret['status'] = false;
			$ret['msg'] = 'Missing/Invalid Parameters';
		}
	}

	public function order_print_labels(){
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
		$js = '<script src="'.base_url('seller/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('seller/assets/js/seller/jspdf.min.js').'"></script>';
		if (isset($_GET)){
			if (!empty($_GET['order_id']) && !empty($_GET['merchant']) && !empty($_GET['boxnumber']) && is_numeric($_GET['boxnumber'])){
					$order = array('sellersuite'=>$this->authuser->suite,'order_id'=>$_GET['order_id'],'boxnumber'=>intval($_GET['boxnumber']),'merchant'=>$_GET['merchant']);
					$js .= '<script>';
							for($i = 0 ; $i < $order['boxnumber']; $i++){
							$text = $order['order_id'].'-'.$order['sellersuite'].'-'.str_pad($i+1,2,"0", STR_PAD_LEFT);
								$js .=	'$(\'#mtn'.($i+1).'\').text(\''.$text.'\');';
								$js .=	'new QRCode(document.getElementById(\'barcode'.($i+1).'\'),{
											text: \''.$text.'\',
											width: \'250\',
											height: \'250\'
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
			redirect('seller/orders/confirmed_orders/1', 'refresh');
		}
		$orders = $this->seller->orders_combineCancelled('2', $page);
		$orders['orderlist'] = $this->seller_model->getOrderSla($orders['orderlist']);
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
		$js = '';
		if (isset($orders['totalpages'])){
			$js .= '<script>paginator('.$orders['totalpages'].','.$page.')</script>';
		}

		if (isset($_SESSION['authuser'])){
			$this->seller->initView('seller/sales/ordersconfirmed.php', array('orders_processed'=>$orders),$css);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function arrange_pickup($page = 0){
		if($page == 0){
			redirect('seller/orders/arrange_pickup/1', 'refresh');
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
		$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
		$js = '';
		if (isset($combined_orders['totalpages'])){
			$js .= '<script>paginator('.$combined_orders['totalpages'].','.$page.')</script>';
		}
		if (isset($_SESSION['authuser'])){
			$this->seller->initView('seller/sales/pickup.php', array('processed_orders' => $processed_orders),$css,$js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}
	
	public function awb_confirmation($page = 0){
		if($page == 0){
			redirect('seller/orders/awb_confirmation/1', 'refresh');
		}
		if (isset($_SESSION['authuser'])){
			$combined_orders = $this->seller->orders_combineCancelled('3', $page);
			$processed_orders = $combined_orders;
			$processed_orders['orderlist'] = array();
			foreach ($combined_orders['orderlist'] as $key => $value) {
				if($value['orderStatus'] != 2 && (!$value['itmelist'][0]['airwaybill'])){
					array_push($processed_orders['orderlist'], $value);
				}
			}
			$processed_orders['orderlist'] = $this->seller_model->getOrderSla($processed_orders['orderlist']);
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
			$js = '<script src="'.base_url('seller/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('seller/assets/js/seller/orderlabel.js').'"></script>
			<script type="text/javascript">orderlabel.suite = "'.$this->authuser->suite.'";</script>';
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
			redirect('seller/orders/order_history/1', 'refresh');
		}
		if (isset($_SESSION['authuser'])){
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
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url('seller/assets/css/seller/salescss.css').'">';
			$js = '<script src="'.base_url('seller/assets/js/seller/qrcode.min.js').'"></script>
			<script src="'.base_url('seller/assets/js/seller/orderlabel.js').'"></script>
			<script type="text/javascript">orderlabel.suite = "'.$this->authuser->suite.'";</script>';
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