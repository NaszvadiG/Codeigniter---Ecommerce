<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/18/16 9:00 PM
 * Description:
 */
?>
<style type="text/css">
    #footer {
        width: 100%;
        border-top: solid 1px #ddd;
    }
    @media (max-width: 425px) {
        .content-foot > .content-main {
            padding: 0 10px;
        }
        .content-foot > .content-main img {
            width: 85px;
            margin-top: 13px;
        }
    }
</style>

<?php $this->view('common/subscribebar'); ?>
<div id="footer" class="responsive-container">
    <div class="hotlinks content-main row">
        <nav class="col-sm-3 col-md-3 col-xs-6">
            <a href="<?php echo base_url('coming-soon'); ?>">Open A Shop, Be A Seller</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Why Join?</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Apply To Sell On ONENOW</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Seller Handbook</a>
            <a href="<?php echo base_url('faq'); ?>">FAQ</a>
        </nav>
        <nav class="col-sm-3 col-md-3 col-xs-6">
            <a href="<?php echo base_url('coming-soon'); ?>">Shipping</a>
            <a href="<?php echo base_url('how-we-ship'); ?>">How We Ship</a>
            <a href="<?php echo base_url('express-upgrade'); ?>">Express Upgrade</a>
        </nav>
        <nav class="col-sm-3 col-md-3 col-xs-6">
            <a href="<?php echo base_url('coming-soon'); ?>">About Us</a>
            <a href="<?php echo base_url('story'); ?>">Our Story</a>
            <a href="<?php echo base_url('emailpreference'); ?>">Email Preference</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Newsroom</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Contacts</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Policy Privacy</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Term of Use</a>
        </nav>
        <nav class="col-sm-3 col-md-3 col-xs-6">
            <a href="<?php echo base_url('coming-soon'); ?>">Help</a>
            <a href="http://tpayment.staging.onenow.com/checkout/global-checkout-account.do?referrer=<?php echo base_url('buyer/logout'); ?>">Your Account</a>
            <a href="http://tpayment.staging.onenow.com/checkout/global-checkout-order.do?referrer=<?php echo base_url('buyer/logout'); ?>">Your Orders</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Return & Replacement </a>
            <a href="<?php echo base_url('coming-soon'); ?>">General Enquiries</a>
        </nav>
    </div>

    <div class="content-foot">
        <div class="content-main">
            <span>&copy; ONENOW 2016. All Rights Reserved.</span>
            <img src="<?php echo base_url('assets/images/dhl_logo.png'); ?>" />
        </div>
    </div>
</div>
