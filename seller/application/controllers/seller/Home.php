<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('seller');
		// var_dump($this->translations); die();
	}
	public function index(){
		$this->seller->initView('seller/index.php', array('show_splash'=>TRUE));
	}
	public function locale(){
		if($this->input->post('locale_th') == 'true'){
			$_SESSION['locale_th'] = true;
		}
		else{
			unset($_SESSION['locale_th']);
		}
	}
	public function faqs(){
		$this->seller->initView('seller/faqs.php', array('show_splash'=>FALSE));
	}
	public function coming_soon(){
		$this->seller->initView('common/coming_soon_page.php', array('show_splash'=>FALSE));
	}
}
?>