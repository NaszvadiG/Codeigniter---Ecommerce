<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends MY_Controller{
	private function jsonResponse($response){
		header('Content-type: application/json');
		return json_encode($response);
	}
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('seller');
		$this->load->model('seller_model');
	}
	public function index(){
		if (isset($_SESSION['authuser'])){
			$account = $this->seller_model->getAccount();
			$css = '<link type="text/css" rel="stylesheet" href="'.base_url($this->seller->css_dir.'cropper.min.css').'" />';
			$js = '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'cropper.min.js').'" ></script>';
			$js .= '<script type="application/javascript" src="'.base_url($this->seller->js_dir.'image-upload.js').'" ></script>';
			$js .= '<script>$(imageupload.onReady());</script>';
			$this->seller->initView('seller/my_account.php', $account, $css, $js);
		}
		else{
			$this->seller->initView('seller/account.php', array());
		}
	}
	public function create(){
		$json = json_decode(file_get_contents('php://input'), true);
		$ret = array('status'=>TRUE);
		$this->form_validation->set_rules('firstName', 'First Name', 'required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('lastName', 'Last Name', 'required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		$this->form_validation->set_rules('hpnum', 'Contact Number', 'required');
		$this->form_validation->set_rules('store_name', 'Store Name', 'required|min_length[2]');
		$this->form_validation->set_rules('address', 'Address 1 Line 1', 'required');
		$this->form_validation->set_rules('province', 'Province', 'required');
		$this->form_validation->set_rules('base64string', 'Store Photo', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('postal_code', 'Postal Code|min_length[4]|max_length[7]', 'required');
		
		$data = array(						
			'firstName'			=> $json['regfirstname'],
			'lastName'			=> $json['reglastname'],
			'country'			=> $json['regcountry'],
			'gender'			=> $json['reggender'],
			'mobileCountryCode'	=> $json['regmobileCountryCode'],
			'hpnum'				=> $json['reghpnum'],
			'email' 			=> $json['regemail'],
			'pass' 				=> $json['regpassword'],
			'retypepass' 		=> $json['regconfirmpassword']
		);

		$data2 = array(
				'api_hash'			=> 	API_HASH,
				'store_name'		=>	$json['regstorename'],
				'country_code'		=>	$data['mobileCountryCode'],
				'contact_number'	=>	$data['hpnum'],
				'address'			=>	$json['regaddress'],
				'address_line_2'	=>	$json['regaddress2'],
				'city'				=>	$json['regcity'],
				'province'			=>	$json['regprovince'],
				'postal_code'		=>	$json['regpostalcode'],
				'address_2'			=>	'',
				'address_line_2_2'	=>	'',
				'city_2'			=>	'',
				'province_2'		=>	'',
				'postal_code_2'		=>	'',
				'store_info'		=>	''
			);

		$data3 = array(
				'api_hash'			=>	API_HASH,
				'base64string'		=>	$json['regstorephoto']
			);

		$this->form_validation->set_data(array_merge($data,$data2,$data3));
		if($this->form_validation->run() != FALSE){
			$query = $this->seller_model->createAccount($data);
			if($query){
				$data2['suite'] = $query['suite'];
				$data3['suite']	= $query['suite'];
				$query2 = $this->seller_model->createStore($data2);
				if($query2){
					$photoUpdate = $this->seller_model->updatePhoto('seller',$data3);
					if($photoUpdate['status'] == 'SUCCESS'){
						$ret['msg'] = 'Thank you for registering!';
						$ret['redirect'] = 'seller/account.php';
					}
					else{
						$ret['msg'] = 'Your account has been created. But there\'s seems an error occurred while uploading your Store Photo.\nPlease Try uploading another photo later.';
						$ret['redirect'] = 'seller/account.php';
					}
				}
				else{
					$ret['status'] = FALSE;
					$ret['msg'] = 'Email already in use.';
				}
			}
			else{
				$ret['status'] = FALSE;
					$ret['msg'] = 'Email already in use.';
			}
		}
		else{
			$ret['status'] = FALSE;
			$ret['msg'] = 'Registration error. Please try again later.';
			$ret['errors'] = validation_errors();
		}
		echo json_encode($ret);
	}
	public function update(){
		$json = json_decode(file_get_contents('php://input'), true);
		$ret = array('status'=>TRUE);
		if(!isset($_SESSION['authuser'])){
			$ret = array(
				'status' => FALSE,
				'msg' => 'Seller not logged in'
			);
		};
		if($ret['status']){
			$data = array(
				'api_hash'		=> API_HASH,
				'suite'			=> $this->authuser->suite,
				'firstName'		=> $json['regfirstname'],
				'lastName'		=> $json['reglastname'],
			);
			$update = $this->seller_model->updateAccount($data);
			if(reset($update)['status'] == 'SUCCESS'){
				$this->authuser->name = reset($update)['firstName'];
				$this->authuser->save();
				$data2 = array(
					'api_hash'		=>API_HASH,
					'suite'			=> $this->authuser->suite,
					'base64string'	=> $json['base64string']
				);
				$photoUpdate = $this->seller_model->updatePhoto('seller',$data2);
				$ret = array(
					'status' => 'SUCCESS',
					'msg'	=>	'Your profile changes has been saved'
				);
				if($photoUpdate['status'] != 'SUCCESS'){
					$ret = array(
						'status' => 'FAILURE',
						'msg'	=>	'Your profile photo has not been saved.'
					);	
				}
			}
			else{
				$ret = array(
					'status' => 'FAILURE',
					'msg'	=>	'Profile update failed. Please try again'
				);
			}
		}
		else{
			$ret = array(
				'status' => 'FAILURE',
				'msg'	=>	'Profile update failed. Please try again'
			);
		}
		echo json_encode($ret);
	}

	public function changepass(){

		$this->form_validation->set_rules('oldPass', 'Old Password', 'required');
		$this->form_validation->set_rules('newPass', 'New Password', 'required');
		$this->form_validation->set_rules('retypePass', 'Retype New Password', 'required');

		if($this->form_validation->run() != FALSE){
			$verifyData = array(
				'email' => $this->authuser->email,
				'pwd' => $this->input->post('oldPass')
			);
			$data = array(
				'suite'				=>	$this->authuser->suite,
				'newPass'			=>	$this->input->post('newPass')
			);
			if($this->seller_model->login($verifyData)){
				$update = $this->seller_model->updateAccount($data);
				if(reset($update)['status'] == 'SUCCESS'){
					echo json_encode(array('status'=>'SUCCESS','message'=>'Your password has been changed. :)'));
					return true;
					// $this->seller->initView('seller/my_account.php', reset($update));
				}
				else{
					echo json_encode(array('status'=>'FAILURE','message'=>'Update failed. Please try again.'));
					return false;
					// $this->seller->initView('seller/my_account.php',array('regmssg'=>'Update failed'));
				}
			}
			else{
				echo json_encode(array('status'=>'FAILURE','message'=>'Incorrect Old Password. Please try again.'));
				return false;
				// $this->seller->initView('seller/account.php',array('loginmssg'=>'Incorrect Old Password'));
			}
		}
		else{
			if($this->input->post('newPass') == $this->input->post('retypePass')){
				echo json_encode(array('status'=>'FAILURE','message'=>'Confirm password does not match new password'));
			}
			else{
				echo json_encode(array('status'=>'FAILURE','message'=>'Something is wrong while changing your password. Please try again.'));
			}
			return false;
			// return json_encode(array('status'=>'FAILURE','message'=>'Confirm password does not match new password'));
		}
	}
	public function forgetPassword(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$ret = array('status'=>TRUE);
		if($this->form_validation->run() != FALSE){
			$data = array(
				'cgCode' => $this->input->post('email')
			);
			$query = $this->seller->getAPI('checkout', 'seller-forgetPassword', $data,array());

			if($query['selleruser']['status'] == 'SUCCESS'){
				$ret = array(
					'status' => TRUE,
					'msg' => 'Password reset request sent.'
				);
			}
			else{
				$ret = array(
					'status' => FALSE,
					'msg' => 'Email does not exist'
				);
			}
		}
		else {
			$ret = array(
				'status' => FALSE,
				'msg' => 'Please type an email address'
			);
		}
		header("Content-type: application/json");
		echo json_encode($ret);
	}

	public function login(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() != FALSE){
			$data = array(
				'email' => $this->input->post('email'),
				'pwd' => $this->input->post('password'),
				'rememberme' => $this->input->post('rememberme') ? true : false
			);
			$ret = array('status'=>'SUCCESS');
			$loginData = $this->seller_model->login($data);

			if($loginData['status'] == 'SUCCESS'){
				$ret = array(
					'status'=> 'SUCCESS',
					'msg'	=> 'You are now logged in!',
					'seller_status'	=>	$loginData['sellerstatus']);
			}
			else{
				$ret = array(
					'status'=> 'FAIL',
					'msg'	=> 'Invalid email and/or password');
			}
		}
		else {
			$ret = array(
					'status'=> 'FAIL',
					'msg'	=> 'Email/password field is empty. Please Try again');
		}
		header('Content-type: application/json');
		echo json_encode($ret);
	}

	public function verifyLogin(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() != FALSE){
			$data = array(
				'email' => $this->input->post('email'),
				'pwd' => $this->input->post('password'),
				'rememberme' => $this->input->post('rememberme') ? true : false
			);
			$loginData = $this->seller_model->login($data);

			if($loginData['status'] == 'SUCCESS'){
				if (strpos($_SERVER['REDIRECT_URL'], 'verifyLogin') !== false){
					redirect('seller/', 'refresh');
				}
				else{
					redirect('seller/', 'refresh');
				}
			}
			else{
				$this->seller->initView('seller/account.php',array('loginmssg'=>'Invalid email and/or password'));
			}
		}
		else {

			redirect('seller/account', 'refresh');
		}
	}
	public function logout(){
		if (isset($_SESSION['authuser'])){	
			$this->session->unset_userdata('authuser');
			$this->session->unset_userdata('seller_addr');
			session_destroy();
			$this->seller_model->session_cookie('delete');
			redirect('/seller', 'refresh');
		}
	}
	public function create_store(){
		$json = json_decode(file_get_contents('php://input'), true);
		$ret = array('status'=>TRUE);
			if(!isset($_SESSION['authuser'])){
				$ret = array(
					'status' => FALSE,
					'msg' => 'Seller not logged in'
				);
			};
		if($ret['status']){
			$data = array(
				'api_hash'			=> API_HASH,
				'suite'				=> $this->authuser->suite,
				'store_name'		=> $this->input->post('regstorename')
			);
			$query = $this->seller_model->createStore($data);
			if($query['status'] == 'SUCCESS'){
				$this->authuser->firstName = reset($update)['firstName'];
				$this->authuser->save();
				$data2 = array(
					'api_hash'		=>API_HASH,
					'suite'			=> $this->authuser->suite,
					'base64string'	=> $json['base64string']
				);
				$photoUpdate = $this->seller_model->updatePhoto('merchant',$data2);
				if($photoUpdate['status'] != 'SUCCESS'){
					$ret = array(
						'status' => 'FAILURE',
						'msg'	=>	'Your profile photo has not been saved.'
					);	
				}
				$ret = array(
					'status' => 'SUCCESS',
					'msg'	=>	'Your profile changes has been saved'
				);
			}
			else{
				$ret = array(
					'status' => 'FAILURE',
					'msg'	=>	'Profile update failed. Please try again'
				);
			}
		}
		else{
			$ret = array(
				'status' => 'FAILURE',
				'msg'	=>	'Profile update failed. Please try again'
			);
		}
		echo json_encode($ret);
	}

	// public function validate_seller(){
	// 	if(isset($_POST['suite'])){
	// 		$query = $this->seller->getAPI('checkout','getuserprofile', array(), array('suite'=>$_POST['suite']));
	// 		$query = reset($query);
	// 		if ($query['status'] == 'SUCCESS'){
				
	// 			$_SESSION['temp_suite'] = $query['suite'];
	// 			$_SESSION['temp_key'] = sha1(rand(1000000,9999999));
				
	// 			exit($_SESSION['temp_key']);

	// 		}
	// 	}
	// 	exit('0');
	// }

	// public function redirect_seller($key){
	// 	if (isset($_SESSION['temp_key'])){
	// 		if($key == $_SESSION['temp_key']){
	// 			$this->seller_model->session_cookie('delete');
	// 			$_SESSION['suite'] = $_SESSION['temp_suite'];
	// 			unset($_SESSION['temp_key'], $_SESSION['temp_suite']);
	// 			return redirect('/seller', 'refresh');
	// 		}
	// 	}
	// 	return redirect('/home', 'refresh');
	// }

	// public function jkejhviengpekvgnek($suite){
	// 	if(isset($suite)){
	// 		$query = $this->seller->getAPI('checkout','getuserprofile', array(), array('suite'=>$suite));
	// 		$query = reset($query);
	// 		if ($query['status'] == 'SUCCESS'){
				
	// 			$_SESSION['suite'] = $query['suite'];				
	// 			return redirect('/seller', 'refresh');
	// 		}
	// 	}
	// 	return redirect('/home', 'refresh');
	// }
}
?>

