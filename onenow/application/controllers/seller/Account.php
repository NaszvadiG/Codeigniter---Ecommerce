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
		if (isset($_SESSION['suite'])){
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
		$this->form_validation->set_rules('regfirstname', 'First Name', 'required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('reglastname', 'Last Name', 'required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('regemail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('regpassword', 'Password', 'required');
		$this->form_validation->set_rules('reghpnum', 'Contact Number', 'required');
		$this->form_validation->set_rules('regstorename', 'Store Name', 'required|min_length[2]');
		$this->form_validation->set_rules('regaddress', 'Address', 'required');
		$this->form_validation->set_rules('regcity', 'City', 'required');
		$this->form_validation->set_rules('regpostalcode', 'Postal Code|min_length[4]|max_length[7]', 'required');

		if($this->form_validation->run() != FALSE){
			$data = array(
				'storename'			=> $this->input->post('regstorename'),
				'address'			=> $this->input->post('regaddress'),
				'city'				=> $this->input->post('regcity'),
				'postalcode'		=> $this->input->post('regpostalcode'),
				'firstName'			=> $this->input->post('regfirstname'),
				'lastName'			=> $this->input->post('reglastname'),
				'country'			=> $this->input->post('regcountry'),
				'gender'			=> $this->input->post('reggender'),
				'mobileCountryCode'	=> $this->input->post('regmobileCountryCode'),
				'hpnum'				=> $this->input->post('reghpnum'),
				'email' 			=> $this->input->post('regemail'),
				'pass' 				=> $this->input->post('regpassword'),
				'retypepass' 		=> $this->input->post('regconfirmpassword')
			);

			$ret = array('status'=>true);
			$query = $this->seller_model->createAccount($data);
			if($query){
				$data2 = array(
					'api_hash'		=> 'b6fa27c1a54b36438689166e5177a948',
					'suite'			=>  $query['suite'],
					'store_name'	=>	$data['storename'],
					'address'		=>	$data['address'],
					'city'			=>	$data['city'],
					'postal_code'	=>	$data['postalcode']
				);
				$query2 = $this->seller_model->createStore($data2);
				if($query2){
					echo json_encode(array('status'=>'SUCCESS','message'=>'Thank you for registering!','redirect'=>'seller/account.php'));
				}
				else{
					echo json_encode(array('status'=>'FAILURE','message'=>'Email already in use.'));
					return false;					
				}
			}
			else{
				echo json_encode(array('status'=>'FAILURE','message'=>'Email already in use.'));
				return false;
			}
		}
		else{

		echo json_encode(array('status'=>'FAILURE','message'=>'Registration error. Please try again later.', 'errors'=>validation_errors()));
		return false;
		}
	}
	public function update(){
		$json = json_decode(file_get_contents('php://input'), true);
		$ret = array('status'=>TRUE);
			if(!isset($_SESSION['suite'])){
				$ret = array(
					'status' => FALSE,
					'msg' => 'Seller not logged in'
				);
			};
		if($ret['status']){
			$data = array(
				'api_hash'		=> API_HASH,
				'suite'			=> $_SESSION['suite'],
				'firstName'		=> $json['regfirstname'],
				'lastName'		=> $json['reglastname'],
			);
			$update = $this->seller_model->updateAccount($data);
			if(reset($update)['status'] == 'SUCCESS'){
				$_SESSION['name'] = reset($update)['firstName'];
				$data2 = array(
					'api_hash'		=>API_HASH,
					'suite'			=> $_SESSION['suite'],
					'base64string'	=> $json['base64string']
				);
				$photoUpdate = $this->seller_model->updatePhoto('seller',$data2);
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

	public function changepass(){

		$this->form_validation->set_rules('oldPass', 'Old Password', 'required');
		$this->form_validation->set_rules('newPass', 'New Password', 'required');
		$this->form_validation->set_rules('retypePass', 'Retype New Password', 'required');

		if($this->form_validation->run() != FALSE){
			$verifyData = array(
				'email' => $_SESSION['email'],
				'pwd' => $this->input->post('oldPass')
			);
			$data = array(
				'suite'				=>	$_SESSION['suite'],
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
					'msg'	=> 'You are now logged in!');
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
		$devMode = false;
		if (!$devMode){
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
		else {
			$_SESSION['email'] = 'renz.tan@comgateway.com';
			$_SESSION['name'] = 'Dev';
			$_SESSION['suite'] = 'GCK-ABC';
			redirect('seller/', 'refresh');
		}
	}
	public function logout(){
		if (isset($_SESSION['suite'])){	
			session_unset();
			session_destroy();
			$this->seller_model->session_cookie('delete');
			redirect('/seller', 'refresh');
		}
	}
	public function create_store(){
		$json = json_decode(file_get_contents('php://input'), true);
		$ret = array('status'=>TRUE);
			if(!isset($_SESSION['suite'])){
				$ret = array(
					'status' => FALSE,
					'msg' => 'Seller not logged in'
				);
			};
		if($ret['status']){
			$data = array(
				'api_hash'			=> API_HASH,
				'suite'				=> $_SESSION['suite'],
				'store_name'		=> $this->input->post('regstorename')
			);
			$query = $this->seller_model->createStore($data);
			if($query['status'] == 'SUCCESS'){
				$_SESSION['name'] = reset($update)['firstName'];
				$data2 = array(
					'api_hash'		=>API_HASH,
					'suite'			=> 'BTH-DT',
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
}
?>