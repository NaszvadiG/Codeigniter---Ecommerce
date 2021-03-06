<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seller{
	private $ci;
	private $api_path = array(
		'master' => 'http://buyer.staging.onenow.com/master/',
		'cms' => 'http://tcms.staging.onenow.com/buythai/apis/',
		'checkout' => 'http://tpayment.staging.onenow.com/checkout/');

	private $api = array(
		// 'sellerproductlist' => 'api.sellerproductlist.php'
		'translations'			=>	'common/APIWebTranslations.php',
		'sellerproductlist' 	=>	'seller/APISellerProductsList.php',
		'productdetails'		=>	'common/APIProductDetails.php',
		'productlist'			=>	'service/seller/list',
		'product-add'			=>	'seller/APISellerAddProduct_Site.php',
		'product-delete'		=>	'seller/APISellerDeleteProduct_Site.php',
		'product-unpublish'		=>	'seller/APISellerUnpublishProduct_Site.php',
		'product-update'		=>	'seller/APISellerEditProduct_Site.php',
		'product-image'			=>	'seller/APISellerUploadImage_Site.php',
		'product-image-delete'	=>	'seller/APISellerDeleteImage.php',
		'product-producer'		=>	'common/APIProductProducer_Site.php',
		'merchantlist'			=>	'service/seller/get_merchants/',
		'categorylist'			=>	'service/category/list', //service/seller/get_categories
		'seller-login'			=>	'sellerlogin.do',
		'seller-register'		=>	'sellerregistered.do',
		'seller-createstore'	=>	'seller/APISellerCreateStore.php',
		'seller-info'			=>	'seller/APISellerGetInfo.php',
		'seller-updatePhoto'	=>	'seller/APISellerUploadSellerPhoto.php',
		'seller-forgetPassword'	=>	'sellerresetpassword.do',
		'merchant-updatePhoto'	=>	'seller/APISellerUploadStorePhoto.php',
		'getuserprofile'		=>	'getuserprofile.do',
		'updateuserprofile' 	=>	'sellerprofileupdate.do',
		'order-search'			=>	'sellerordersearch.do',
		'buyer-login'			=>	'securitylogin.do'

	);
	// Added new variable for testing purporses - CGW-Renz - 10/12/2016 13:35
	private $apiDemo = array(
		'orders' 			=> 'sellerorderlist.do',
		'orders-update' 	=> 'selleritemstatusupdate.do',
		'seller-login' 		=> 'sellerlogin.do',
		'seller-register' 	=> 'sellerregistered.do',
		'order-search'		=>	'sellerordersearch.do'
	);
	public $icon_dir	= 'seller/assets/ico/seller/';
	public $css_dir 	= 'seller/assets/css/seller/';
	public $js_dir		= 'seller/assets/js/seller/';
	public $vendor_dir	= 'seller/assets/vendor/';
	public $img_dir 	= 'seller/assets/images/';
	private $icon 		= 'favicon.png?v=2';
	private $link 		= array( //size,name
							array('144x144','apple-touch-icon-144-precomposed.png?v=2'),
							array('114x114','apple-touch-icon-114-precomposed.png?v=2'),
							array('72x72','apple-touch-icon-72-precomposed.png?v=2'),
							array('57x57','apple-touch-icon-57-precomposed.png?v=2'),
						);
	private $css = array(
		'font-awesome.css',
		'btn.css',
		'skin-0.css',
		'smoothproducts.css',
		'bootstrap-rating.css',
		'bootstrap-datetimepicker.min.css',
		'../../vendor/bootstrap-daterangepicker/daterangepicker.css',
		'cropper.min.css',
		'style.css'
	);
	private $js = array(
		'action.js',
		'jquery.cycle2.min.js',
		'jquery.easing.1.3.js',
		'jquery-migrate-1.2.1.js',
		'jquery.parallax-1.1.js',
		'jquery.validate.js',
		'helper-plugins/jquery.mousewheel.min.js',
		'jquery.mCustomScrollbar.js',
		'icheck.min.js',
		'grids.js',
		'owl.carousel.min.js',
		'bootstrap.touchspin.js',
		'bootstrap-datetimepicker.min.js',
		'home.js',
		'select2.min.js',
		'pace.min.js',
		'smoothproducts.min.js',
		'../../vendor/pushy/pushy.js',
		'../../vendor/jquery/plugins/cookie/jquery.cookie.js',
		'script.js',
		'bootstrap-rating.min.js',
		'seller.js',
		'account.js',
		'cropper.min.js',
		'image-upload.js'
	);
	public function __construct($param = array()){
		$document = isset($param[0]) ? $param[0] : NULL;
		$set = isset($param[1]) ? $param[1] : NULL;
		$addcss = isset($param[2]) ? $param[2] : NULL;
		$addjs = isset($param[3]) ? $param[3] : NULL;
		$this->ci =& get_instance();
		$this->ci->load->helper('form');
		$this->ci->load->helper('seller_helper');
		if($document != NULL){
			$this->initView($document,$set,$addcss,$addjs);
		}
	}
	public function getAPI($api_path, $api_name, $getParams = array(), $params = array()){
		$api = FALSE;
		if(array_key_exists($api_name,$this->api)){
			/*$json = file_get_contents($this->api_path.$this->api[$api_name]);
			$api = json_decode($json,1);*/
			$curl = curl_init();
			$options = array(
				CURLOPT_URL => $this->api_path[$api_path].$this->api[$api_name].'?'.urldecode(http_build_query($getParams)),
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_AUTOREFERER => TRUE,
				CURLOPT_POST => TRUE,
				CURLOPT_SSL_VERIFYPEER => FALSE,
				CURLOPT_POSTFIELDS => $params,
			);
			curl_setopt_array($curl,$options);
			$api = curl_exec($curl);
			if($api === FALSE){
				echo curl_error($curl);
				curl_close($curl);
				exit(1);
			}
			else{
				$api = json_decode($api,1);
			}
			curl_close($curl);
		}
		return $api;
	}

	// Created new function for testing purposes - CGW-Renz - 10/12/2016 13:30
	public function getDemoAPI($api_name,$getParams = '',$params = array()){
		$api = FALSE;
		if(array_key_exists($api_name,$this->apiDemo)){
			/*$json = file_get_contents($this->api_path.$this->api[$api_name]);
			$api = json_decode($json,1);*/
			$curl = curl_init('http://tpayment.staging.onenow.com/checkout/'.$this->apiDemo[$api_name].'?'.$getParams);
			
			$options = array(
				// CURLOPT_URL => ,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_AUTOREFERER => TRUE,
				CURLOPT_POST => TRUE,
				CURLOPT_SSL_VERIFYPEER => FALSE,
				CURLOPT_POSTFIELDS => $params,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13",
				CURLOPT_TIMEOUT => 10
			);
			curl_setopt_array($curl,$options);
			$api = curl_exec($curl);
			if($api === FALSE){
				echo curl_error($curl);
				curl_close($curl);
				exit(1);
			}
			else{
				$api = str_replace('&quot;', '"', $api);
				$api = json_decode($api,1);

			}
			curl_close($curl);
		}
		return $api;
	}

	//Create function to combined orders with different itemstatus - CGW-Renz 10142016 - 1650

	public function orders_combineCancelled($itemstatus, $page){
		$a_orders = $this->getDemoAPI('orders','sellersuite='.$this->ci->authuser->suite.'&itemstatus='.$itemstatus.'&limit=10&pageoffset='.$page);
		$cancelled_orders = $this->getDemoAPI('orders','sellersuite='.$this->ci->authuser->suite.'&itemstatus=C');
		$cancelled_orders_all = array();
		if (isset($cancelled_orders['totalpages'])){
			for($i=1; $i <= $cancelled_orders['totalpages']; $i++){
				$pageOrder = $this->getDemoAPI('orders','sellersuite='.$this->ci->authuser->suite.'&itemstatus=C&limit=10&pageoffset='.$i);
				foreach($pageOrder['orderlist'] as $ind => $val){
					array_push($cancelled_orders_all, $val);
				}
			}
		}
		$combined_orderlist = array();
		$combined_orders = $a_orders['orderlist'] == false ? array() : array('sellersuite'=> $this->ci->authuser->suite, 'orderlist' => array(), 'totalpages' => $a_orders['totalpages']);
		if (empty($cancelled_orders_all)){
			$combined_orderlist = $a_orders['orderlist'];
		}
		else {
			foreach ($cancelled_orders_all as $cancelledKey => $cancelledValue) {
				if (empty($a_orders['orderlist'])){
					array_push($combined_orderlist, $cancelledValue);
				}
				else{
					foreach ($a_orders['orderlist'] as $aKey => $aValue) {
						if($cancelledValue['txnRef'] == $aValue['txnRef']){
							// var_dump('got match'); die();
							foreach ($cancelledValue['itmelist'] as $CNITKey => $CNITValue) {
								array_push($aValue['itmelist'], $CNITValue);
							}
							$aValue['orderStatus'] = $itemstatus;
							array_push($combined_orderlist, $aValue);
							break;
						}
						else if(($cancelledValue['txnRef'] != $aValue['txnRef']) && ($aValue == end($a_orders['orderlist']))){
							array_push($combined_orderlist, $cancelledValue);
							// $cancelledValue['orderStatus'] = 'C';
							// array_push($combined_orderlist, $cancelledValue);
						}
					}
				}
			}
		}
		if (!empty($a_orders['orderlist'])){
			foreach ($a_orders['orderlist'] as $aKey => $aValue) {
				foreach ($combined_orderlist as $PRKey => $PRValue) {
					$tempStatArr = array();
					foreach($PRValue['itmelist'] as $cmitK => $cmitV){
						array_push($tempStatArr, $cmitV['status']);
					}
					if ($aValue['txnRef'] == $PRValue['txnRef']){
						break;
					}
					if(($aValue['txnRef'] != $PRValue['txnRef']) && ($PRValue == end($combined_orderlist))){
						$aValue['orderStatus'] = $itemstatus;
						array_push($combined_orderlist, $aValue);
					}
				}
			}
		}
		foreach ($combined_orderlist as $key => $value) {
			$tempStatArr = array();
			foreach($value['itmelist'] as $ik=>$iv){
				array_push($tempStatArr, $iv['status']);
			}
			$combined_orderlist[$key]['orderStatus'] = checkIfSame($tempStatArr, $itemstatus); 
		}
		$combined_orders['orderlist'] = sort_orderlist($combined_orderlist, $itemstatus);
		// var_dump(sort_orderlist($combined_orderlist, $itemstatus)); die();
		return $combined_orders;
	}

	public function initView($document,$set = array(),$addcss = NULL,$addjs = NULL){
		$this->getCssJs($css,$js);
		$css .= $addcss;
		$js .= $addjs;
		$this->ci->load->view('layout',array('document'=>$document,'parameters'=>$set,'css'=>$css,'js'=>$js));
	}
	private function getCssJs(&$css,&$js){
		$css .= '<link rel="shortcut icon" href="'.base_url($this->icon_dir.$this->icon).'">';
		foreach($this->link AS $link){
			$css .= '<link rel="apple-touch-icon-precomposed" sizes="'.$link[0].'" href="'.base_url($this->icon_dir.$link[1]).'" />';
		}
		foreach($this->css AS $csstmp){
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->css_dir.$csstmp).'" />';
		}
		$js .= '<script src="http://www.w3schools.com/lib/w3data.js"></script>';
		foreach($this->js AS $jstmp){
			$js .= '<script type="application/javascript" src="'.base_url($this->js_dir.$jstmp).'" ></script>';
		}
	}

	// Added functions for easier data retrieval - CGW-Renz 10152016 - 1040

	public function getItems($array, $type){
		$tempStr = "";
		$tempArr = array();
		foreach ($array as $orderKey => $orderValue) {
			foreach ($orderValue['itmelist'] as $itemKey => $itemValue) {
				array_push($tempArr, $itemValue[$type]);
				$tempStr = implode('|', $tempArr);
			}
		}
		return $tempStr;
	}
	public function getOrderItem($order, $type){
		$tempStr = "";
		$tempArr = array();
		foreach ($order['itmelist'] as $itemKey => $itemValue) {
			array_push($tempArr, $itemValue[$type]);
			foreach ($tempArr as $key => $value) {
				if($type == 'fulfilledqty' && !$value){
					$tempArr[$key] = 0;
				}
			}
			$tempStr = implode('|', $tempArr);
			// $tempStr .= (($itemKey >= 0) && ($itemValue[$type] == end($order['itmelist'])[$type])) ? $itemValue[$type] : $itemValue[$type].'|';
		}
		return $tempStr;
	}
}
?>