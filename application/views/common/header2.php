<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/31/16 2:35 PM
 * Description: Header
 */
?>
<div class="prompt prompt-overlay"></div>
<article class="notice">
    <p>We ship worldwide. First shipping 20% off</p>
</article>
<div class="content-head">
    <div class="toolbar">
        <nav>
            <a href="#" id="shop-us">Shop in <span>United States</span><span>U.S.</span></a>
            <a href="#" id="shop-thai">Shop in <span>Thailand</span><span>Thai</span></a>
        </nav>
        <nav class="pull-right">
            <a href="<?php echo base_url('seller'); ?>">Become a Seller</a>
            <a href="#login">Join/Sign in</a>
            <a href="<?php echo base_url('shopping-cart'); ?>" id="shopping-cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <?php if ($this->cart->count() > 0): ?>
                <span class="badge"><?php echo $this->cart->count(); ?></span>
                <?php endif; ?>
            </a>
            <a href="#menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
        </nav>
    </div>
    <nav class="menubar">
        <a href="<?php echo base_url('home'); ?>" class="logo"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="ONENOW"></a>
        <nav id="menu">
            <a href="<?php echo base_url('sacict'); ?>">SACICT</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Thai Brands</a>
            <a href="<?php echo base_url('home-and-living'); ?>">Home and Living</a>
            <a href="<?php echo base_url('clothing-and-accessories'); ?>">Clothing and Accessories</a>
            <a href="<?php echo base_url('health-and-beauty'); ?>">Health and Beauty</a>
            <a href="<?php echo base_url('food'); ?>">Food</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Kids</a>
            <a href="<?php echo base_url('coming-soon'); ?>">Crafts for a Cause</a>
        </nav>
        <div class="searchbar pull-right">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" id="searcher" name="searcher" placeholder="Search"/>
        </div>
    </nav>
</div>