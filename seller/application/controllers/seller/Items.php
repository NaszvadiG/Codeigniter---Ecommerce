<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Items extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('seller');
		$this->load->model('seller_model');
	}
	public function index($page = 0){
		if (isset($_SESSION['suite'])){
			redirect('seller/items/listing/1', 'refresh');
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function listing($page = 0){
		if($page == 0){
			redirect('seller/items/listing/1', 'refresh');
		}
		else{
			if (isset($_SESSION['suite'])){
				if ($page){
					$products = $this->seller->getAPI('cms','productlist', array(), array('api_hash'=>API_HASH, 'suite' => $_SESSION['suite'], 'limit' => 10, 'page' => $page, 'sort' => 'created desc'));
					$js = '<script>paginator('.$products["pages"].','.$page.')</script>';
					$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'items-add.js').'" ></script>';
					$js .= '<script type="text/javascript">
					$(document).ready(function(){
						itemsadd.initItemActions();
					})
					</script>';
					$products['page'] = $page;
					$products['pages'] = $products['pages'] +1;
					$this->seller->initView('seller/items.php',array('products'=>$products),NULL,$js);
				}
				else{
					echo json_encode(array('status' => 'FAILURE'));
				}
			}
			else{
				redirect('seller/account', 'refresh');
			}
		}
	}

	public function preview($productid = NULL){
		$products = $this->seller->getAPI('sellerproductlist');
		$product = array();
		foreach($products['products_list'] AS $k => $v){
			if($v['id'] == $productid){
				$product = $v;
				break;
			}
		}
		$js = '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'items-preview.js').'" ></script>';
		$this->seller->initView('seller/preview.php',array('product'=>$product),NULL,$js);
	}

	public function edit($productid = NULL){
		if($_SESSION['suite']){

			$css = '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'dropzone.css').'" />';
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'bootstrap-tagsinput.css').'" />';
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'croppie.css').'" />';
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'cropper.min.css').'" />';
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'bootstrap3-wysihtml5.min.css').'" />';
			// $js = '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'dropzone.js').'" ></script>';
			$js = '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'croppie.min.js').'" ></script>';
			$js = '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'cropper.min.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'items-add.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'items-preview.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'bootstrap-tagsinput.min.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'bootstrap3-wysihtml5.all.min.js').'" ></script>';
			$js .= '<script>$(itemsadd.onReady());</script>';

			$query = $this->seller->getAPI('cms','categorylist',array(),array('api_hash'=>API_HASH));
			$var = array('category'=>$query['menu']);
			$var['formMode'] = 'edit';
			$product = $this->seller->getAPI('cms','productdetails', array(), array('api_hash'=>API_HASH, 'product_id' => $productid));
			
			if ($product['status'] != 'ERROR'){
				$var['product'] = $product['product'];
				$var['product']['name'] = (string)$var['product']['name'];
				$var['product']['description'] = str_replace('<p>', ' ', str_replace('</p>',' ',(string)$var['product']['description']));
				$prod_cat_id = $product['product']['product_category_id'];
				$tempCatArr = array();
				foreach ($this->seller_model->getCategoryNames($query['menu']) as $catK => $catV) {
					if ($catK == $prod_cat_id){
						$tempCatArr[$catK] = $catV['name'];
						break;
					}
					else {
						foreach ($catV as $sub1K => $sub1V) {
							if ($sub1K == $prod_cat_id){
								$tempCatArr[$catK] = $catV['name'];
								$tempCatArr[$sub1K] = $sub1V['name'];
								break;
							}
							else if (is_numeric($sub1K) && (count($sub1V) > 1)){
								foreach ($sub1V as $sub2K => $sub2V) {
									if ($sub2K == $prod_cat_id){
										$tempCatArr[$catK] = $catV['name'];
										$tempCatArr[$sub1K] = $sub1V['name'];
										$tempCatArr[$sub2K] = $sub2V['name'];
										break;
									}
									else if (is_numeric($sub2K) && (count($sub2V) > 1)){
										foreach ($sub2V as $sub3K => $sub3V) {
											if ($sub2K == $prod_cat_id){
												$tempCatArr[$catK] = $catV['name'];
												$tempCatArr[$sub1K] = $sub1V['name'];
												$tempCatArr[$sub2K] = $sub2V['name'];
												$tempCatArr[$sub3K] = $sub3V['name'];
												break;
											}
										}
									}
								}
							}
						}
					}		
				}
				// var_dump(implode('>',array_values($tempCatArr))); die();
				for($i=0;$i < count($tempCatArr); $i++){
					// var_dump(array_slice($tempCatArr, 0, ($i+1)),($i+1));
					$js .= "<script>
								
							</script>";
				}
				$var['product']['prod_cat'] = $tempCatArr;
			}

			$images = array();

			$this->seller->initView('seller/add.php',$var,$css,$js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}

	public function add(){
		if(isset($_SESSION['suite'])){
			$query = $this->seller->getAPI('cms','categorylist',array(),array('api_hash'=>API_HASH));
			$var = array('category'=>$query['menu']);
			$var['formMode'] = 'add';
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'cropper.min.css').'" />';
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'croppie.css').'" />';
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'bootstrap-tagsinput.css').'" />';
			$css .= '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'bootstrap3-wysihtml5.min.css').'" />';
			$js = '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'cropper.min.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'croppie.min.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'exif.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'items-add.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'bootstrap-tagsinput.min.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'bootstrap3-wysihtml5.all.min.js').'" ></script>';
			$js .= '<script type="text/javascript">
						$(document).ready(function(){
							$(\'.dropdown-submenu a.test\').on("click", function(e){
							    e.stopPropagation();
							    e.preventDefault();
							});
						});
					</script>';
			$js .= '<script>$(itemsadd.onReady());</script>';
			$this->seller->initView('seller/add.php',$var,$css,$js);
		}
		else{
			redirect('seller/account', 'refresh');
		}
	}
	public function formAddItem(){
		$json = json_decode(file_get_contents('php://input'), true);
		$ret = array('status'=>TRUE);
			if(!isset($_SESSION['suite'])){
				$ret = array(
					'status' => FALSE,
					'msg' => 'Seller not logged in'
				);
			};
		// echo json_encode($ret); die();
		// $this->form_validation->set_rules('name', 'Product Name', 'required|min_length[2]|max_length[64]');
		// $this->form_validation->set_rules('cat_id', 'Category', 'required');
		// $this->form_validation->set_rules('sku', 'Product SKU', 'required');
		// $this->form_validation->set_rules('merchant_sku', 'Merchant SKU', 'required');
		
		if($ret['status']){
			// if($this->form_validation->run() != FALSE){
				$data = array(
						'api_hash' 			=> API_HASH,
						'suite' 			=> $_SESSION['suite'],
						'product_id'		=> isset($json['product_id']) ? $json['product_id'] : '',
						'product_name'		=> $json['name'],
						'product_desc'		=> $json['desc'],
						'producer_id'		=> $json['producer_id'],
						'cat_id'			=> $json['cat_id'],
						'subcat_id'			=> $json['subcat_id'],
						'subsubcat_id'		=> $json['subsubcat_id'],
						'subsubsubcat_id'	=> $json['subsubsubcat_id'],
						'product_price'		=> $json['price'],
						'product_quantity'	=> $json['quantity'],
						'product_discount'	=> $json['discount'],
						'bulk_discount'		=> $json['bulk_discount'],
						'minimum_order_size'=> $json['min_order_size'],
						'product_color'		=> $json['color'],
						'product_size'		=> $json['size'],
						'product_weight'	=> $json['weight'],
						'ship_in_a_box'		=> $json['ship_in_box'],
						'product_length'	=> $json['length'],
						'product_width'		=> $json['width'],
						'product_height'	=> $json['height'],
						'product_sku'		=> $json['sku'],
						'merchant_sku'		=> $json['merchant_sku']
						);
				$images = explode('|', $json['images']);
				if (isset($json['type']) && $json['type'] != '' &&($json['type'] == 'add' || $json['type']== 'update'))
				{
					$query = $this->seller->getAPI('cms', $json['type'] == 'add' ? 'product-add':'product-update',array(),$data);
					if($query['status'] == 'SUCCESS'){
						$product_id = $query['product_id'];
						//FOR NOW, ONLY TYPE 'ADD' WILL ACCEPT IMAGES. CHANGE THIS SOON
						if ($json['type'] == 'add' || $json['type'] == 'update'){
							foreach ($images as $imgK => $imgV) {
								if ($imgV != ''){
									$query2 = $this->seller->getAPI('cms','product-image',array(),array('api_hash'=>'b6fa27c1a54b36438689166e5177a948', 'product_id' => $product_id, 'base64string' => $imgV, 'order_id' => ($imgK+1)));
									// var_dump($product_id);
									if($query2['status'] !== 'SUCCESS'){
										$ret = array(
										'status' => FALSE,
										'msg' => 'Product added but images failed to upload'
										);
										break;
									};
								};
							}
						}
						$ret = array(
						'status' => TRUE,
						'msg' => $query
						);
					}
					else{
						$ret = array(
						'status' => FALSE,
						'msg' => $query
						);
					}
				}
				else{
					$ret = array(
						'status' => FALSE,
						'msg'	=>	'Invalid type'
					);
				}
			// }
			// else{
			// 	$ret = array(
			// 		'status' => FALSE,
			// 		'msg' => validation_errors()
			// 	);

			// }
		}
		echo json_encode($ret);
	}
	public function actionItem(){
		$json = json_decode(file_get_contents('php://input'), true);
		
		$ret = array('status'=>TRUE);
		if(!isset($_SESSION['suite'])){
			$ret = array(
				'status' 	=> FALSE,
				'msg' 		=> 'Seller not logged in'
			);
		};
		if($ret['status']){
			$data = array(
				'api_hash'		=>	API_HASH,
				'suite'			=>	$json['suite'],
				'seller_id'		=>	'',
				'product_id'	=>	$json['product_id']
				);
			$query = $this->seller->getAPI('cms',$json['type'] == 'unpublish' ? 'product-unpublish' : 'product-delete',array(),$data);
			if($query['status'] == 'SUCCESS'){
				$ret = array(
					'status' => TRUE,
					'msg' => 'Product '. $json['type'] == 'unpublish' ? 'Unpublished' : 'Deleted'
					);
			}
			else{
				$ret = array(
					'status' => FALSE,
					'msg' => 'Invalid Input'
					);
			}
		}
		echo json_encode($ret);
	}

	public function deleteImage(){
		$ret = array('status' => true);
		if (isset($_SESSION['suite'])){
			if (isset($_POST['product_id']) && $_POST['product_id'] != '' && isset($_POST['image_id']) && $_POST['image_id'] != ''){
				$query = $this->seller->getAPI('cms', 'product-image-delete', array(),array('api_hash'=>API_HASH,'suite'=>$_SESSION['suite'], 'product_id'=>$_POST['product_id'],'image_id'=>$_POST['image_id']));
				header('Content-type:application/json');
				echo json_encode($query);
			}
			else{
				$ret['status'] = false;				
				$ret['msg'] = 'Server error, Please try again.';
			}
		}
		else{
			$ret['status'] = false;
			$ret['msg'] = 'Seller not logged in.';
		}
	}

	public function getCategoryItems(){
		$query = $this->seller->getAPI('cms','categorylist',array(),array('api_hash'=>API_HASH));
		$cat = json_encode($this->seller_model->getCategoryNames2($query['menu']));
		$var = array('category'=>$cat);
		header('Content-type:apllication/json');
		echo $cat;
	}

	public function testImg(){
		$json = json_decode(file_get_contents('php://input'), true); 
		if (isset($json['data'])){
			if (strpos($json['data'], 'data:image/jpeg;base64') !== false){
				$query2 = $this->seller->getAPI('cms','product-image',array(),array('api_hash'=>'b6fa27c1a54b36438689166e5177a948', 'product_id' => 2537, 'base64string' => $json['data']));
				echo $query2;
				$data = str_replace('data:image/jpeg;base64,', '', $json['data']);
				// echo base64_decode($data);
				// echo '<img src="data:image/jpeg;base64,'.$data.'"/>';
			}
			else{
				echo json_encode(array('status'=>'Failure','msg'=>'Not an Image'));
			}
		}
		else{
			echo json_encode(array('status'=>'Failure','msg'=>'Base64 string not found on POST'));
		}
	}
	// public function testImg(){
	// 	$json = json_decode(file_get_contents('php://input'), true); 
	// 		echo json_encode(array('status'=>'Success','msg'=>'Image exists'));
	// 	if (isset($json['data'])){
	// 		if (strpos($json['data'], 'data:image/jpeg;base64') !== false){
	// 			$data = str_replace('data:image/jpeg;base64,', '', $json['data']);
	// 			// echo base64_decode($data);
	// 			echo '<img src="data:image/jpeg;base64,'.$data.'"/>';
	// 		}
	// 		else{
	// 			echo json_encode(array('status'=>'Failure','msg'=>'Not an Image'));
	// 		}
	// 	}
	// 	else{
	// 		echo json_encode(array('status'=>'Failure','msg'=>'Base64 string not found on POST'));
	// 	}
	// }
}
?>