<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/25/16 9:46 PM
 * Description:
 */
class AuthUser
{
    /**
     * @var CI_Session
     */
    protected $session;

    /**
     * @var array
     */
    public $firstname;
    public $lastname;
    public $suite;
    public $gender;
    public $lang;
    public $mobile;
    public $email;
    public $token;

    protected $mapping = array(
        'firstName' => 'firstname',
        'lastName' => 'lastname',
        'gender' => 'gender',
        'languagePrefer' => 'lang',
        'mobile' => 'mobile',
        'suite' => 'suite',
        'cgCode' => 'email',
        'jsessionid' => 'token'
    );

    /**
     * class Shopping cart constructor
     */
    public function __construct()
    {
        $this->session =& get_instance()->session;

        if ($user = json_decode($this->session->userdata('authuser')))
        {
            $this->firstname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->suite = $user->suite;
            $this->gender = $user->gender;
            $this->lang = $user->lang;
            $this->mobile = $user->mobile;
            $this->email = $user->email;
            $this->token = $user->token;
        }
    }

    public function save($params)
    {
        foreach($this->mapping as $map => $key)
        {
            $this->{$key} = $params[$map];
        }

        $this->session->set_userdata('authuser', json_encode(array_diff_key(get_object_vars($this), array('mapping' => false))));
    }

    public function clear()
    {
        $this->session->unset_userdata('authuser');
    }
}
