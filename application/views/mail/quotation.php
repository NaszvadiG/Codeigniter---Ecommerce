<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 11/10/16 4:42 PM
 * Description:
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->product->getName(); ?></title>
    <style type="text/css">
        body{font-family:helvetica,arial,sans-serif;font-size:13px;line-height:20px;color:#222}
        a,span{color:#0563C1}
        strong{color:#000}
        p.c-msg{text-indent:30px}
    </style>
</head>
<body>
    <p>Dear Customer Service,</p>
    <p class="c-msg">The following product has been requested for quotation. Please contact the seller to obtain the price and time needed to produce the order.</p>
    <div>Product URL: <a href="<?php echo base_url('product/view/'. $this->product->getId()); ?>" target="_blank"><?php echo base_url('product/view/'. $this->product->getId()); ?></a></div>
    <div>Product Name: <span><?php echo $this->product->getName(); ?></span></div>
    <div>Product SKU: <span><?php echo $this->product->getSeller_sku(); ?></span></div>
    <div>Quantity: <span><?php echo $this->input->post('quantity'); ?></span></div>
    <div>Seller: <span><?php echo $this->product->getSeller_name(); ?></span></div>
    <p>Customer's Email address: <a href="mailto:<?php echo $this->input->post('email'); ?>"><?php echo $this->input->post('email'); ?></a></p>
    <p>Warm Regards,<br/> <strong>OneNow.com/BuyThai</strong></p>
</body>
</html>
