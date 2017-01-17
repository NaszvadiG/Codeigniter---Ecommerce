<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/14/16 9:30 AM
 * Description:
 */
class Catalog extends Buyer_Controller
{
    public function index($id=null)
    {
        $this->category->request('list', is_null($id) ? array() : array('id' => $id));
        $this->load->helper('sidebar');
        $this->load->model('product');
        $this->render('buyer/catalog', array('params' => (object)array('id' => $id)));
    }

    public function curators_pick($category)
    {
        $this->load->model('product');
        $this->category->request('get_curator', array('category' => $category));
        $this->render('buyer/curators-pick');
    }

    public function search($action = false)
    {
        $this->load->model('product');
        if ($action)
        {
            $this->product->request("get_{$action}", array('query' => $this->input->post('q')));
            $this->renderJSON($this->product->getAttributes());
        }
        $this->render('buyer/search', array('query' => preg_replace('/\s+/',' ',$this->input->get('q'))));
    }

    public function cart($action)
    {
        if ($action !== 'view')
        {
            $message = '';
            switch ($action)
            {
                case 'add':
                    $this->load->model('product');
                    $this->product->request('get', array('id' => $this->input->post('product')));
                    $product = $this->product->get();
                    $product->quantity = $this->input->post('quantity');
                    $product->color = $this->input->post('color');
                    $product->size = $this->input->post('size');
                    $product->image = $product->images[0];
                    $message = sprintf("Product %s is successfully added to your cart.", $this->cart->add($product));
                    break;

                case 'remove': $message = sprintf("Product %s is successfully removed to your cart.", $this->cart->remove($this->input->post('value')));
                    break;

                case 'update':
                case 'checkout':
                    if (preg_match_all('/(\d+)\:(\d+)/', $this->input->post('value'), $result))
                    {
                        for($i=0; $i < sizeof($result[0]); $i++)
                        {
                            $item = $this->cart->get((int)$result[1][$i]);
                            $item->quantity = (int)$result[2][$i];
                        }
                        $this->cart->save();
                    }
                    break;

                default: $this->cart->clear(); redirect('home', 'refresh');
                    break;
            }

            $params = array('message' => $message, 'cart' => $this->cart->count());
            if ($action === 'checkout')
            {
                $params = array_merge($params, $this->cart->checkout());
            }

            $this->renderJSON($params);
        }

        $this->render('buyer/cart');
    }

}
