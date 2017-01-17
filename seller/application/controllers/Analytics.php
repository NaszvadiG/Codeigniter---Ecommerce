<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Analytics extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('seller');
	}
	public function index(){
		$this->seller->initView('seller/analytics.php');
	}
}
?>