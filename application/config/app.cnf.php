<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/10/16 1:19 PM
 * Description:
 */
$config['cnf']['layout'] = array(
    'path' => 'layout',
    'debug' => false
);

$config['cnf']['cms'] = array(
    //'url' => 'http://tcms.staging.onenow.com/buythai/apis/service/',
    'url' => 'http://localhost/service/',
    'params' => array(
        'api_hash' => 'b6fa27c1a54b36438689166e5177a948'
    ),
    'debug' => false
);

$config['cnf']['gck'] = array(
    'url' => 'http://tpayment.staging.onenow.com/checkout/global-check-out.do',
    'params' => array(
        'merchant' => 'Buythai',            // Frontend store name
        'merchant_url' => '',               // Frontend site url
        'merchantShoppingCart' => '',       // Frontend shopping-cart fallback
        'cartlockurl' => '',                // Frontend to clear the shopping cart content
        //'logincallbackurl' => '',         // Frontend logged in fallback when the customer registered to GCK
        'jsonstr' => '',                    // Other parameters from GCK
        'itemNumber' => 0,                  // Cart total item
        'domestichandling' => 0,            // Unused from previous ONENOW U.S.
        'shippingcountry' => '',            // Country Code (i.e. PH)
        'flatshipping' => 0,                // Required but no use for this moment
        'fuelsurcharge_insurance' => 0      // 1% of total purchase
    )
);