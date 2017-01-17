<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seller_Model extends CI_Model{
	private $item_table_name = '';
	private $account_table_name = 'seller_accounts';
	private $salt = '$1$now$';
	private $item_per_page = 16;
	private $min_image_width = 300;
	private $min_image_height = 300;
	private $max_image_width = 1000;
	private $max_image_height = 1000;

	public function session_cookie($method, $cookie = array()){
		switch ($method){
			case 'set':
				if (!empty($cookie)){
					$valueStr = "";
					
					$cookieData = array('name'	=>	'session_data',
									'value'	=>	json_encode($cookie),
									'expire'=>	60 * 60 * 24 * 30,
									'prefix'=>	'seller_',
									);
					set_cookie($cookieData);
				}
			break;
			case 'get':
				return get_cookie('seller_session_data');
			break;
			case 'delete':
				if (!is_null(get_cookie('seller_session_data'))){
					delete_cookie('seller_session_data');
				}
			break;
			default:
			break;
		}
	}

	public function getCategoryNames($o){
		$return = array();
		foreach($o AS $obj){
			if(count($obj['children']) > 1){
				$return[$obj['id']] = array('name' => $obj['name']) + self::getCategoryNames($obj['children']);
			}
			else{
				$return[$obj['id']] = array('name' => $obj['name']);
			}
		}
		return empty($return) ? NULL : $return;
	}
	public function renderCategoryList($o, $lvl = 1, $parent = ''){
		$list = '<ul class="dropdown-menu">';
		$suff = '</ul>';
		$content_list = '';
		$mainParent = $parent;
		foreach($o AS $obj){
			$parent = $mainParent;
			$parent.= empty($parent) ? $obj['id'] : ','.$obj['id'];
			if(count($obj['children']) > 1){
				$content_list .= '<li class="dropdown-submenu">
				<a class="category test" tabindex="-1" data-num="'.$lvl.'" data-id="'.$parent.'">'.form_label($obj["name"]).'<i class="fa fa-caret-right"></i></a>'.self::renderCategoryList($obj['children'], $lvl+1, $parent).'
				</li>';
			}
			else{
				$content_list .= '<li class="dropdown-submenu">
				<a class="category" tabindex="-1" data-num="'.$lvl.'" data-id="'.$parent.'">'.form_label($obj["name"]).'</a>
				</li>';
			}
		}
		return $content_list != '' ? $list.$content_list.$suff : '';
	}
	// (11012016) Get merchant producer ids
	public function getMerchants(){
			$query = $this->seller->getAPI('cms','merchantlist',array(),array('api_hash' => API_HASH, 'suite' => $this->authuser->suite));
			return $query['list'];
	}
	public function createAccount($data){
		$query = $this->seller->getAPI('checkout','seller-register',array(),$data);
		
		if($query){
			$query = reset($query);
		}
		else{
			return FALSE;
		}
		if($query['status'] == 'SUCCESS'){
			$this->authuser->make($query);
			return $query;
		} 
		else{
			return FALSE;
		}
	}
	public function createStore($data){
		$query = $this->seller->getAPI('cms','seller-createstore',array(),$data);
		if($query['status'] == 'SUCCESS'){
			return $query;
		} 
		else{
			return FALSE;
		}
	}
	public function getAccount(){
		$query = $this->seller->getAPI('checkout','getuserprofile', array(), array('suite'=>$this->authuser->suite));
		$query2 = $this->seller->getAPI('cms', 'seller-info', array(), array('api_hash'=>API_HASH,'suite'=>$this->authuser->suite));
		$var = array();
		if ($query2['status'] == 'SUCCESS'){
			$var = array_merge(reset($query), $query2['producer']);
		}
		return $var;
	}
	public function updateAccount($data){
		$query = $this->seller->getApi('checkout','updateuserprofile', array(), $data);
		return $query;
	}

	public function login($data){
		$query = $this->seller->getAPI('checkout','seller-login',array(),$data);
		$query = reset($query);
		if($query['status'] == 'SUCCESS'){
			$this->authuser->make($query);
			$query2 = $this->seller->getAPI('cms', 'seller-info', array(),array('api_hash'=>API_HASH,'suite'=>$query['suite']));
			if($query2['status'] == 'SUCCESS'){
				$query['producer'] = $query2['producer'];
				$this->session->set_userdata('seller_addr', $query2['producer']['address'].' '.$query2['producer']['postal_code'].' '.$query2['producer']['city']);
			}
			$session_cookie = array('suite'=>$query['suite']);
			if(isset($data['rememberme'])){
				if ($data['rememberme'] == true){
					$this->session_cookie('set', $session_cookie);
				}
			}
		}
		return $query;
	}
	public function getItems($userid){
		$offset = ($page - 1) * self::item_per_page;
		$this->db->where('item_column',$userid);
		$this->db->order_by('order_by_column','DESC');
		$this->db->limit(self::item_per_page,$offset);
		$query = $this->db->get(self::item_table_name);
		return $query;
	}
	public function saveItem($data,$where = array()){
		$ret = FALSE;
		if(empty($where)){
			$ret = $this->db->insert(self::item_table_name,$data);
		}
		else{
			$this->db->where($where);
			$ret = $this->db->update(self::item_table_name,$data);
		}
		return $ret;
	}
	public function checkImageSize($img){
		list($x,$y) = getimagesize($img);
		if($x > self::max_image_width || $y > self::max_image_height){
			return FALSE;
		}
		elseif($x < self::min_image_width || $y < self::min_image_height){
			return FALSE;
		}
		return TRUE;
	}
	public function resizeImage($img,$imgname){
		$size = getimagesize($img);
		$ratio = $size[0] / $size[1];
		if($ratio > 1){
			$width = self::max_image_width;
			$height = self::max_image_height / $ratio;
		}
		else{
			$width = self::max_image_width * $ratio;
			$height = self::max_image_height;
		}
		$src = imagecreatefromstring(file_get_contents($img));
		$dst = imagecreatetruecolor($width,$height);
		imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
		imagedestroy($src);
		$return = imagepng($dst,$imgname);
		imagedestroy($dst);
		return $return;
	}
	public function updatePhoto($type, $data){
		if (strpos($data['base64string'], 'data:image/jpeg;base64') !== false){
			$query = $this->seller->getApi('cms',$type == 'seller' ? 'seller-updatePhoto' : 'merchant-updatePhoto', array(), $data);
			return $query;
		}
		else{
			return array('status'=>'FAILURE', 'msg'=>'No image detected');
		}
	}
	public function getSellerPhoto(){
		$query = $this->seller->getAPI('cms','seller-info', array(), array('api_hash'=>API_HASH,'suite'=>$this->authuser->suite));
		if ($query['status'] == 'SUCCESS' && (isset($query['producer']['photo_path']) && $query['producer']['photo_path'] != '')){
			return '<img class="header-seller" src="'.$query['producer']['photo_path'].'" alt="seller">';
		}
		else{
			return '<i class="fa fa-user"></i>';
		}
	}

	public function getItemSla($itemlist, $orderTime){
		$item_sla = array();
		$orderDate = date($orderTime); 
		foreach ($itemlist as $itemKey => $itemValue) {
			$items_url = explode('/', $itemValue['itemurl']);
			$item = $this->seller->getAPI('cms','productdetails', array(), array('api_hash'=>API_HASH, 'product_id'=>array_pop($items_url)));
			if ($item['status'] == 'SUCCESS'){
				if (is_numeric($item['product']['merchant_sla'])){
					array_push($item_sla, strtotime($orderDate.' +'.intval($item['product']['merchant_sla']).' day'));
				}
				else if ($item['product']['merchant_sla'] == ''){
					array_push($item_sla, 'N/A');
				}
				else {
					array_push($item_sla, strtotime($orderDate.'+'.$item['product']['merchant_sla']));	
				}
			}
		}
		return $item_sla;
	}

	public function getOrderSla($orderlist){
		$orders_sla = array();
		foreach ($orderlist as $orderKey => $orderValue) {
			$item_sla = $this->getItemSla($orderValue['itmelist'], $orderValue['createTime']);
			if (count($item_sla)>1){
				array_push($orders_sla, max($item_sla));
			}
			else {
				array_push($orders_sla, array_pop($item_sla));
			}
		}
		foreach ($orders_sla as $sla_key => $sla_value) {
			if ($sla_value == 'N/A'){
				$orderlist[$sla_key]['order_sla_days'] = 'N/A';
				$orderlist[$sla_key]['order_sla_remaining'] = 'N/A';
			}
			else{
				$remaining = $sla_value - time();
				$days_remaining = round($remaining / 86400);
				$hours_remaining = floor(($remaining % 86400) / 3600);
				$orderlist[$sla_key]['order_sla_remaining'] = $days_remaining;
				$orderlist[$sla_key]['order_sla_days'] = ($sla_value - strtotime($orderlist[$sla_key]['createTime'])) / 86400; 
			}
		}
		return $orderlist;
	}
	public function getProductProducer($itemID){
		$query = $this->seller->getAPI('cms','product-producer', array(), array('api_hash'=>API_HASH,'product_id'=>$itemID));
		if ($query['status'] == 'SUCCESS' && (isset($query['product']['producer_name']) && $query['product']['producer_name'] != '')){
			return $query['product']['producer_name'];
		}
		else{
			return 'N/A';
		}
	}

	//"DUCT-TAPE" solution to search for specific orderline. REPLACE THIS WHEN JUNPING CREATED AN API FOR THIS - RENZ (12012016)
	public function search_orderlist($orderlist, $itemstatus = 'P'){
		$ret = array();
		if (isset($_SESSION['authuser'])){
			if(isset($orderlist)){
				$orders = $this->seller->getDemoAPI('orders','sellersuite='.$this->authuser->suite.'&itemstatus='.$itemstatus.'&limit=100&pageoffset=1');
				if(!empty($orders['orderlist'])){
					foreach ($orders['orderlist'] as $orderK => $orderV) {
						if ($orderlist == $orderV['txnRef']){
							$item_sla = $this->getItemSla($orderV['itmelist'], $orderV['createTime']);
							$order_sla = '';
							if (count($item_sla)>1){
								$order_sla = max($item_sla);
							}
							else {
								$order_sla = array_pop($item_sla);
							}
							if ($order_sla == 'N/A'){
								$orderV['order_sla_days'] = 'N/A';
								$orderV['order_sla_remaining'] = 'N/A';
							}
							else{
								$remaining = $order_sla - time();
								$days_remaining = round($remaining / 86400);
								$hours_remaining = floor(($remaining % 86400) / 3600);
								$orderV['order_sla_remaining'] = $days_remaining;
								$orderV['order_sla_days'] = ($order_sla - strtotime($orderV['createTime'])) / 86400; 
								$orderV['pickupTime'] = date('d F Y | g:i:s A',strtotime($orderV['createTime'].' +'.$orderV['order_sla_days'].' days'));
							}
							$orderV['createTime'] = date('d F Y | g:i:s A',strtotime($orderV['createTime']));
							$ret = $orderV;
							break;
						}
						else{
							$ret['status'] = false;
							$ret['msg'] = 'Orderlist not found.';
						}
					}
				}
			}
			else{
				$ret['status'] = false;
				$ret['msg'] = 'No orderlist specified.';				
			}
		}
		else{
			$ret['status'] = false;
			$ret['msg'] = 'No suite found; Please login.';
		}
		return $ret;
	}
}
?>