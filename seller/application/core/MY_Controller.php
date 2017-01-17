<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/31/16 11:22 AM
 * Description:
 */

class MY_Controller extends CI_Controller
{
    const LAYOUT = 'default';

    /**
     * @param string $view
     * @param null|array $params
     */

    public function __construct(){
        parent::__construct();
        $this->load->library('seller');
        $this->load->model('seller_model');
        if($this->seller_model->session_cookie('get') != ''){
            $session = json_decode($this->seller_model->session_cookie('get'));
            $this->authuser->suite = $session->suite;
            $this->authuser->save();            
        }
        if (isset($_SESSION['authuser'])){
            $account = $this->seller_model->getAccount();
            if (isset($account['status']) && $account['status'] == 'SUCCESS'){
                $this->authuser->firstname = $account['firstName'];
                $this->authuser->email = $account['email'];
                $this->authuser->save();
            }
        }
        $translation = (object)$this->seller->getAPI('cms','translations', array(), array('api_hash'=>API_HASH, 'locale'=>isset($_SESSION['locale_th'])? 'TH' : 'EN'));
        $this->translations = (object)[];
        $tempArr = array();
        if ($translation->status == 'SUCCESS'){
            // $this->config->load('translations');
            foreach ($translation->translations_list as $key => $value) {
                $tempArr[$value['variable_name']] = $value['val'];
            }
            $this->config->set_item('translations',(object)$tempArr);
            $this->translations = (object)$tempArr;
        }
        else{
            header("HTTP/1.1 500 Internal Server Error."); // inform the browser that the request is error.
            echo json_encode(array('status'=>'ERROR', 'message' => 'Server cannot retrive locale'));
        }
    }

    public function render($view, $params = NULL)
    {
        $this->layout->render(static::LAYOUT, $view, $params);
    }

    /**
     * @param array $params
     */
    public function renderJSON($params = array())
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }
}

class Buyer_Controller extends MY_Controller
{
    const LAYOUT = 'buyer';
}