<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/11/16 12:54 PM
 * Description:
 */
class Product extends Buyer_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('product');
    }

    public function index()
    {
        $params = (array)$this->input->post();
        $params['sellers'] = implode(",", array_filter(explode(',', $params['sellers'])));
        foreach($params as $key => $value)
        {
            if (empty($value)) unset($params[$key]);
        }

        $this->product->request('list', $params);

        $this->renderJSON($this->product->getAttributes());
    }

    public function get($subject)
    {
        $this->product->request("get_featured/{$subject}", (array)$this->input->post());
        $result = $this->product->getAttributes();

        if (in_array($subject, array('deal')))
        {
            foreach($result['list'] as $key => $item)
            {
                $result['list'][$key]->image = preg_replace("/item\/\d+\//", 'item/imgmktg/', $item->image);
            }
        }

        $this->renderJSON($result);
    }

    public function view($product = null)
    {
        $this->product->request('get', array('id' => ($this->input->method() === 'post') ? $this->input->post('id') : $product));

        if ($this->product->isError())
            $this->renderError($this->product->error(), 406);

        if ($this->input->method() === 'post')
        {
            $product = $this->product->get();
            $product->price_usd = number_format($product->price_usd, 2);
            $product->price_usd_discount = number_format($product->price_usd_discount, 2);
            $product->images = $this->product->getPhotos();
            $this->renderJSON($product);
        }
        $this->load->library('visited');
        $this->visited->add($this->product->getId(), $this->product->getImages()[0]);
        $this->render('product/index');
    }

    public function quote()
    {
        $this->product->request('get', array('id' => $this->input->post('id')));

        if ($this->product->isError())
            $this->renderError($this->product->error(), 406);

        $this->load->library('email');
        $this->config->load('mailer');
        $this->email->initialize($this->config->item('mailer'));

        $this->email->from('buythai@onenow.com');
        // $this->email->to('customerservice@onenow.com');
        $this->email->to('ian.moreno@comgateway.com, balery.pimentel@comgateway.com, jiezel.palad@comgateway.com, cedie.garcia@comgateway.com, teena.delmundo@comgateway.com, david.corpuz@comgateway.com');

        $this->email->subject('Quotation Request for '. $this->product->getSeller_sku());
        $this->email->message($this->load->view('mail/quotation', false, true));

        if (! $this->email->send())
            $this->renderError('failed', 500);

        $this->renderJSON(array('message' => 'success'));
    }


}
