<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/25/16 9:46 PM
 * Description:
 */
class Visited
{
    /**
     * @var CI_Session
     */
    protected $session;

    /**
     * @var array
     */
    protected $products = array();

    /**
     * class Shopping cart constructor
     */
    public function __construct()
    {
        $this->session =& get_instance()->session;

        if ($products = json_decode($this->session->userdata('visited_products')))
        {
            $this->products = $products;
        }
    }

    public function add($id, $image)
    {
        for($i=0; $i < sizeof($this->products); $i++)
        {
            if ($this->products[$i]->id == $id)
            {
                unset($this->products[$i]);
                break;
            }
        }
        array_unshift($this->products,(object)array('id'=>$id,'image'=>$image));
        $this->products = array_slice($this->products, 0, 10);
        $this->session->set_userdata('visited_products', json_encode($this->products));
    }

    public function get()
    {
        return $this->products;
    }
}
