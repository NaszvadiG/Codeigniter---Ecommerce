<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/25/16 4:03 PM
 * Description: Home controller
 */
class Buyer extends Buyer_Controller
{
    public function index()
    {
        $this->render('buyer/home');
    }

    public function account()
    {
        $this->render('buyer/account');
    }

    public function about($page)
    {
        $this->render("buyer/{$page}");
    }

    public function locale()
    {
        if (! $this->session->has_userdata('locale'))
        {
            $this->session->set_userdata('locale', json_encode($this->input->post()));
        }
    }

    public function auth()
    {
        $this->authuser->save($this->input->post());
        redirect('home', 'refresh');
    }

    public function logout()
    {
        $this->authuser->clear();
        redirect('home', 'refresh');
    }

    public function faq()
    {
        $this->render('buyer/faq');
    }

    public function how_we_ship()
    {
        $this->render('buyer/how-we-ship');
    }

    public function emailpreference()
    {
        $this->render('buyer/emailpreference');
    }

    public function story()
    {
        $this->render('buyer/story');
    }

    public function soon()
    {
        $this->render('buyer/coming-soon');
    }
}