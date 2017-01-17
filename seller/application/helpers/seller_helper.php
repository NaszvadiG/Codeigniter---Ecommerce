<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
function draw_seller_breadcrumb($uri){
	$ci =& get_instance();
	$ci->config->load('translations');
	$name = array(
		'seller'	=>	$ci->config->item('translations')->web_home,
		'items'		=>	$ci->config->item('translations')->web_seller_listings,
		'add'		=>	$ci->config->item('translations')->web_seller_add_items,
		'edit'		=>	$ci->config->item('translations')->web_seller_edit_items,
		'guide'		=>	$ci->config->item('translations')->web_seller_seller_guide,
		'account'	=>	$ci->config->item('translations')->web_seller_my_account,
		// Added new names for the sales page - CGWPH-IT-Renz - 10162016 - 1315
		'pending_orders'	=>	$ci->config->item('translations')->web_seller_pending_orders,
		'confirmed_orders'	=>	$ci->config->item('translations')->web_seller_confirmed_orders,
		'processed_orders'	=>	'Processed Orders',
		'pickup_orders'		=>	'Pickup Orders',
		'arrange_pickup'	=>	$ci->config->item('translations')->web_seller_arrange_pickup,
		'awb_confirmation'	=>	$ci->config->item('translations')->web_seller_tracking_confirmation,
		'order_history'		=>	$ci->config->item('translations')->web_seller_order_history,
		'listing'			=>	$ci->config->item('translations')->web_seller_listings,
		'orders'			=>	$ci->config->item('translations')->web_seller_orders,
		'search_order'		=>	'Search Orders'
	);
	$bc = array();
	foreach($uri AS $v){
		if(!is_numeric($v)){
			$bc[$v] = (array_key_exists($v,$name)) ? $name[$v] : $v;
		}
	}
	$breadcrumb = '';
	$url = '';
	$i = 0;
	foreach($bc AS $link=>$name){
		$url .= $link.'/';
		$breadcrumb .= '<li class="'.(($i < (count($bc)-1)) ? '' : 'active').'">'.(($i < (count($bc)-1)) ? '<a href="'.base_url($url).'">' : '').ucwords($name).(($i < (count($bc)-1)) ? '</a>' : '').'</li>';
		$i++;
	}
	echo $breadcrumb;
}

function sellerPageTitle($title){
	$name = array(
		'seller'	=>	'Home',
		'items'		=>	'Listings',
		'add'		=>	'Add Items',
		'guide'		=>	'Seller Guide',
		'account'	=>	'My Account',
		// Added new names for the sales page - CGWPH-IT-Renz - 10162016 - 1315
		'pending_orders'	=>	'Pending Orders',
		'confirmed_orders'	=>	'Confirmed Orders',
		'processed_orders'	=>	'Processed Orders',
		'pickup_orders'		=>	'Pickup Orders',
		'arrange_pickup'	=>	'Arrange Pickup',
		'awb_confirmation'	=>	'Tracking Confirmation'	
	);
	$bc = array();
	foreach($uri AS $v){
		if(!is_numeric($v)){
			$bc[$v] = (array_key_exists($v,$name)) ? $name[$v] : $v;
		}
	}
	$title = end($bc);

	echo 'As';
}

function checkIfSame($arr, $target){
	for($i = 0; $i < count($arr); $i++){
		if ($arr[$i] !== $arr[0]){
			return 0;
		}
	}
	if ($arr[0] == $target){
		return 1;
	}
	else{
		return 2;
	}
}

function fileExists($url = ''){
	$ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}

function sort_canceled($a, $b){
	if (strtotime($a['itmelist'][0]['canceltime'])==strtotime($b['itmelist'][0]['canceltime'])) return 0;
    return (strtotime($a['itmelist'][0]['canceltime'])<strtotime($b['itmelist'][0]['canceltime']))?1:-1;
}

function sort_updated($a, $b){
	$itemtime = array();
	$itembtime = array();
	foreach ($a['itmelist'] as $itemK => $itemV) {
		array_push($itemtime, max(array(strtotime($itemV['canceltime']),strtotime($itemV['fulfillmenttime']),strtotime($itemV['createdtime']),strtotime($itemV['pickuptime']))));
	}
	$atime = max($itemtime);
	foreach ($b['itmelist'] as $itembK => $itembV) {
		array_push($itembtime, max(array(strtotime($itembV['canceltime']),strtotime($itembV['fulfillmenttime']),strtotime($itembV['createdtime']),strtotime($itembV['pickuptime']))));
	}
	$atime = max($itemtime);
	$btime = max($itembtime);
	if ($atime==$btime) return 0;
    return $atime<$btime ? 1 : -1;
}

function sort_orderlist($orderlist = array(), $status = 'P'){
	$arr = $orderlist;
	switch($status){
		case 2:
			usort($arr, function($a, $b){
				return sort_updated($a, $b);
			});
			// usort($arr, function($a, $b){
			// 	if($a['itmelist'][0]['status'] == 'C'){
			// 		return sort_canceled($a, $b);
			// 	}
			// 	else{
			// 		if (strtotime($a['itmelist'][0]['fulfillmenttime'])==strtotime($b['itmelist'][0]['fulfillmenttime'])) return 0;
			// 	    return (strtotime($a['itmelist'][0]['fulfillmenttime'])<strtotime($b['itmelist'][0]['fulfillmenttime']))?1:-1;
			// 	}
			// });
		break;
		case 3:
			usort($arr, function($a, $b){
				return sort_updated($a, $b);
				// if (strtotime($a['itmelist'][0]['pickuptime'])==strtotime($b['itmelist'][0]['pickuptime'])) return 0;
			 //    return (strtotime($a['itmelist'][0]['pickuptime'])<strtotime($b['itmelist'][0]['pickuptime']))?1:-1;
			});
		break;
		case 4:
			usort($arr, function($a, $b){
				if (strtotime($a['itmelist'][0]['pickuptime'])==strtotime($b['itmelist'][0]['pickuptime'])) return 0;
			    return (strtotime($a['itmelist'][0]['pickuptime'])<strtotime($b['itmelist'][0]['pickuptime']))?1:-1;
			});
		break;
		default:
		usort($arr, function($a, $b){
			return sort_updated($a, $b);
		});
		// usort($arr, function($a, $b){
		// 	if (strtotime($a['createTime'])==strtotime($b['createTime'])) return 0;
		//     return (strtotime($a['createTime'])<strtotime($b['createTime']))?1:-1;
		// });
		break;
	}
	return $arr;
}

function get_translations(){
	// $this->load->library('seller');
	$translation = (object)$this->seller->getAPI('cms','translations', array(), array('api_hash'=>API_HASH, 'locale'=>isset($_SESSION['locale_th'])? 'TH' : 'EN'));
    $this->translations = (object)[];
    $tempArr = array();
    if ($translation->status == 'SUCCESS'){
        foreach ($translation->translations_list as $key => $value) {
            $tempArr[$value['variable_name']] = $value['val'];
        }
        $this->translations = (object)$tempArr;
    }
    else{
        header("HTTP/1.1 500 Internal Server Error."); // inform the browser that the request is error.
        echo json_encode(array('status'=>'ERROR', 'message' => 'Server cannot retrive locale'));
        }
}

?>