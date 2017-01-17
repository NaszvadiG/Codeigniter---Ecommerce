<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/25/16 9:46 PM
 * Description:
 */
class AuthUser
{
    public $firstname;
    public $lastname;
    public $suite;
    public $gender;
    public $lang;
    public $mobile;
    public $email;
    public $status;
    public $token;

    public function __construct()
    {
        if ($user = get_instance()->session->userdata('authuser'))
        {
            foreach($user as $key => $value)
            {
                $this->{$key} = $value;
            }
        }
    }

    public function make($params)
    {
        $mapping = array(
            'firstName' => 'firstname',
            'lastName' => 'lastname',
            'gender' => 'gender',
            'languagePrefer' => 'lang',
            'mobile' => 'mobile',
            'suite' => 'suite',
            'cgCode' => 'email',
            'sellerstatus' => 'status',
            'jsessionid' => 'token'
        );

        foreach(array_intersect_key($params, $mapping) as $key => $value)
        {
            $this->{$mapping[$key]} = $value;
        }

        $this->save();
    }

    public function save()
    {
        $ci =& get_instance();
        $ci->session->set_userdata('authuser', get_object_vars($this));
    }

    public function clear()
    {
        $ci =& get_instance();
        $ci->session->unset_userdata('authuser');
    }

    public function getLocale($name = '')
    {
        if($locale = get_instance()->session->userdata('locale'))
        {
            if (! empty($name))
            {
                return isset($locale->{$name}) ? $locale->{$name} : null;
            }

            return $locale;
        }

        return null;
    }
}
