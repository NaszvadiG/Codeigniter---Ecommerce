<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/14/16 10:56 AM
 * Description: Shopping cart library
 */
class ShoppingCart
{
    /**
     * @var CI_Session
     */
    protected $session;

    /**
     * @var array
     */
    protected $holidays;

    /**
     * @var array
     */
    protected $cart = array();

    /**
     * class Shopping cart constructor
     */
    public function __construct()
    {
        $this->session =& get_instance()->session;
        $this->holidays = get_instance()->config->item('thai_holidays');

        if ($cart = json_decode($this->session->userdata('cart')))
        {
            foreach($cart as $key => $item)
            {
                $this->cart[(int)$key] = (object)$item;
            }
        }
    }

    /**
     * @param array $params
     * @return ShoppingCartProperty
     */
    public function add($params)
    {
        if ($this->count() > 0) {
            foreach ($this->cart as $key => $item)
            {
                if ($item->id == $params->id && $item->color == $params->color && $item->size == $params->size)
                {
                    $this->cart[$key] = $params;
                    $params = false; // prevent from creating new.
                    break;
                }
            }
        }

        if ($params)
        {
            $this->cart[] = $params;
        }

        $this->save();
        return $this->get(@array_pop(array_keys($this->cart)))->name;
    }

    /**
     * @param int $id
     * @return ShoppingCartProperty
     */
    public function &get($id)
    {
        return $this->cart[$id];
    }

    public function getAll()
    {
        return $this->cart;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function remove($id)
    {
        $item = clone $this->cart[$id];
        unset($this->cart[$id]);
        $this->save();
        return $item->name;
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        $this->session->unset_userdata('cart');
    }

    /**
     * Saving cart to session
     */
    public function save()
    {
        $this->session->set_userdata('cart', json_encode($this->cart));
    }

    /**
     * Count total item in cart.
     * @return int
     */
    public function count()
    {
        return sizeof($this->cart);
    }

    public function getTotalPrice()
    {
        if ($this->count() < 1)
        {
            return '0.00';
        }

        $total = 0;
        foreach($this->cart as $item)
        {
            $total = $total + ($item->quantity * str_replace(',','', $this->getPrice($item)));
        }

        return $total;
    }

    public function getPrice($item)
    {
        $price = $item->price_usd;
        if ((float)$item->discount > 0 && strtotime($item->deal_expiry) > strtotime('now'))
        {
            $price = $item->price_usd_discount;
        }
        if ((float)$item->bulk_discount > 0 && (int)$item->bulk_min_order <= (int)$item->quantity)
        {
            $price = $item->bulk_discount_price;
        }

        return number_format((float)$price, 2);
    }

    public function isDiscounted($item)
    {
        return (number_format($item->price_usd, 2) !== $this->getPrice($item));
    }

    public function getChargedInsurance()
    {
        return 0; //($this->getTotalPrice() * 0.01);
    }

    public function getVolumeWeight($item)
    {
        $value = (floatval($item->length) * floatVal($item->width) * floatVal($item->height) / 5000);

        return ($value <= 0) ? 'N/A' : $value;

    }

    public function checkout()
    {
        $locale = json_decode($this->session->userdata('locale'));
        $cnf = (object)get_instance()->config->item('gck', 'cnf');
        //$cnf->params['logincallbackurl'] = base_url('home');
        $cnf->params['merchant_url'] = base_url('home');
        $cnf->params['merchantShoppingCart'] = base_url('shopping-cart');
        $cnf->params['cartlockurl'] = base_url('shopping-cart/clear');
        $cnf->params['itemNumber'] = $this->count();
        $cnf->params['shippingcountry'] = $locale->countrycode;
        $cnf->params['fuelsurcharge_insurance'] = $this->getChargedInsurance();
        $result = array('url' => $cnf->url);
        foreach($cnf->params as $name => $value)
        {
            $result['params'][] = array('name' => $name, 'value' => $value);
        }
        if ($this->count() > 0)
        {
            $sla = 0;
            $i = 1;
            foreach($this->getAll() as $item)
            {
                if ((int)$item->seller_sla > $sla) $sla = (int)$item->seller_sla;
                $result['params'][] = array('name' => "url{$i}", 'value' => base_url("product/view/{$item->id}"));
                $result['params'][] = array('name' => "prodname{$i}", 'value' => $item->name);
                $result['params'][] = array('name' => "prodnumb{$i}", 'value' => $item->quantity);
                $result['params'][] = array('name' => "unitprice{$i}", 'value' => number_format($item->price_usd, 2));
                $result['params'][] = array('name' => "imageurl{$i}", 'value' => $item->image);
                $result['params'][] = array('name' => "color{$i}", 'value' => $item->color);
                $result['params'][] = array('name' => "size{$i}", 'value' => $item->size);
                $result['params'][] = array('name' => "merchantSKU{$i}", 'value' => $item->seller_sku);
                $result['params'][] = array('name' => "sku{$i}", 'value' => $item->seller_item_sku);
                $result['params'][] = array('name' => "category{$i}", 'value' => $item->tax_category);
                $result['params'][] = array('name' => "actualweight{$i}", 'value' => $item->weight);
                $result['params'][] = array('name' => "sellersuite{$i}", 'value' => $item->seller);
                $result['params'][] = array('name' => "hscode{$i}", 'value' => '');
                $result['params'][] = array('name' => "otherinfo{$i}", 'value' => '');
                $result['params'][] = array('name' => "itemdiscount{$i}", 'value' => (floatVal(number_format($item->price_usd, 2)) - floatVal($this->getPrice($item))));
                $i++;
            }

            $result['params'][] = array('name' => 'expectedexpressdeliverydate', 'value' => $this->getWorkingDays($sla, 7));
            $result['params'][] = array('name' => 'expecteddeliverydate', 'value' => $this->getWorkingDays($sla, 9));
        }
        return $result;
    }

    public function getWorkingDays($sla, $additional_days=0)
    {
        $holidays = array_filter($this->holidays, function($date) {
            return (int)date('N', strtotime($date)) < 6;
        });

        $working_days = (int)($sla+$additional_days);
        $i = 0;
        while ($i < $working_days) {
            ++$i;
            $timestamp = strtotime("+{$i} ".'day'.($i>1?'s':''));
            if((int)date('N', $timestamp) < 6 && !in_array(date('Y-m-d', $timestamp), $holidays))
            {
                continue;
            }
            $working_days++;
        }

        return date('Y-m-d', strtotime("+{$working_days} days"));
    }
}