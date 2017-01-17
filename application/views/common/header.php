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
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/pushy/pushy.css'); ?>" />
<div class="content-head">
    <div class="toolbar content-main">
        <nav>
            <a href="<?php echo base_url('seller'); ?>" id="ba-seller">Become a Seller</a>
            <?php if (! $this->authuser->firstname): ?>
            <a href="javascript:prompt_box('#sign-in',true);">Join/Sign in</a>
            <?php else: ?>
            <nav id="my-account">
                <a href="http://tpayment.staging.onenow.com/checkout/global-checkout-account.do">My Account</a>
                <a href="http://tpayment.staging.onenow.com/checkout/global-checkout-order.do">My Orders</a>
                <a href="<?php echo base_url('buyer/logout'); ?>">Logout</a>
            </nav>
            <a href="javascript:$('#my-account').toggleClass('active');void(0);">Hello <?php echo ucfirst($this->authuser->firstname); ?> <i class="fa fa-chevron-circle-down"></i> </a>
            <?php endif; ?>
            <a href="<?php echo base_url('shopping-cart'); ?>" id="shopping-cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <?php if ($this->cart->count() > 0): ?>
                <span class="badge"><?php echo $this->cart->count(); ?></span>
                <?php endif; ?>
            </a>
            <a class="menu-btn"><i class="fa fa-bars"></i></a>
        </nav>
        <!--<nav>
            <a href="http://onenow.com" target="_blank" id="shop-us">Shop in <span>United States</span><span>U.S.</span></a>
            <a href="<?php /*echo base_url('home'); */?>" id="shop-thai">Shop in <span>Thailand</span><span>Thai</span></a>
        </nav>-->
    </div>
    <nav class="menubar">
        <div class="content-main">
            <?php $this->view('common/searchbar'); ?>
            <a href="<?php echo base_url('home'); ?>" class="logo"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="ONENOW"></a>
            <nav id="menu">
                <span>
                    <a href="<?php echo base_url('about/sacict'); ?>">SACICT</a>
                    <nav>
                        <a href="<?php echo base_url('about/sacict'); ?>">About SACICT</a>
                        <a href="<?php echo base_url('about/master-artisans'); ?>">Master Artisans</a>
                        <a href="<?php echo base_url('about/master-craftsmen'); ?>">Master Craftsmen</a>
                        <a href="<?php echo base_url('about/craftsmen-decendants'); ?>">Craftsman Descendants</a>
                        <a href="<?php echo base_url('lux'); ?>">Lux by SACICT</a>
                        <a href="<?php echo base_url('made-to-order'); ?>">Made to Order</a>
                        <a href="<?php echo base_url('all-sacict'); ?>">All SACICT</a>
                    </nav>
                </span>
                <span>
                    <a href="<?php echo base_url('coming-soon'); ?>">Leading Brands</a>
                    <nav>
                        <a href="<?php echo base_url('catalog?seller=333'); ?>">S'uvimol</a>
                    </nav>
                </span>
                <span>
                    <a href="<?php echo base_url('coming-soon'); ?>">Curator's Pick</a>
                    <!--<a href="<?php /*echo base_url('coming-soon'); */?>">Speciality</a>
                    <nav>
                        <a href="<?php /*echo base_url('coming-soon'); */?>">F & B Outfitting</a>
                        <a href="<?php /*echo base_url('coming-soon'); */?>">Curator's Pick</a>
                    </nav>-->
                </span>
                <span>
                    <a href="<?php echo base_url('home-and-living'); ?>">Home & Living</a>
                    <nav>
                        <a href="<?php echo base_url('furniture'); ?>">Furniture</a>
                        <a href="<?php echo base_url('dining'); ?>">Dining</a>
                        <a href="<?php echo base_url('decorative-arts'); ?>">Decorative Arts</a>
                        <a href="<?php echo base_url('lacquerware'); ?>">Lacquerware</a>
                        <a href="<?php echo base_url('lighting'); ?>">Lighting</a>
                        <a href="<?php echo base_url('cushions'); ?>">Cushions</a>
                        <a href="<?php echo base_url('glassware'); ?>">Glassware</a>
                        <a href="<?php echo base_url('benjarong'); ?>">Benjarong</a>
                    </nav>
                </span>
                <span>
                    <a href="<?php echo base_url('clothing-and-accessories'); ?>">Clothing & Accessories</a>
                    <nav>
                        <a href="<?php echo base_url('apparel'); ?>">Apparel</a>
                        <a href="<?php echo base_url('shoes'); ?>">Shoes</a>
                        <a href="<?php echo base_url('jewelry'); ?>">Jewelry</a>
                        <a href="<?php echo base_url('bags'); ?>">Bags</a>
                        <a href="<?php echo base_url('hats-and-scarves'); ?>">Hats &amp; scarves</a>
                        <a href="<?php echo base_url('accessories'); ?>">Accessories</a>
                    </nav>
                </span>
                <span>
                    <a href="<?php echo base_url('health-and-beauty'); ?>">Health & Beauty</a>
                    <nav>
                        <a href="<?php echo base_url('skin-care'); ?>">Skin Care</a>
                        <a href="<?php echo base_url('bath-and-body'); ?>">Bath &amp; Body</a>
                        <a href="<?php echo base_url('hair-care'); ?>">Hair Care</a>
                        <a href="<?php echo base_url('make-up'); ?>">Make up</a>
                        <a href="<?php echo base_url('spa-treatment'); ?>">Spa Treatment</a>
                        <a href="<?php echo base_url('balms'); ?>">Balms</a>
                    </nav>
                </span>
                <span>
                    <a href="<?php echo base_url('food'); ?>">Food</a>
                    <nav>
                        <a href="<?php echo base_url('snack'); ?>">Snack</a>
                        <a href="<?php echo base_url('coffee'); ?>">Coffee</a>
                        <a href="<?php echo base_url('organic-food'); ?>">Organic Food</a>
                        <a href="<?php echo base_url('cookies'); ?>">Cookies</a>
                        <a href="<?php echo base_url('jam-jelly-peanut'); ?>">Jam, Jelly, Peanut</a>
                        <a href="<?php echo base_url('butter'); ?>">Butter</a>
                        <a href="<?php echo base_url('cocoa'); ?>">Cocoa</a>
                        <a href="<?php echo base_url('seasonings'); ?>">Seasonings</a>
                    </nav>
                </span>
            </nav>
        </div>
    </nav>
</div>
<nav class="pushy pushy-right" id="responsive-menu">
    <ul>
        <li class="pushy-submenu">
            <a href="#">SACICT</a>
            <ul>
                <li class="pushy-link"><a href="<?php echo base_url('about/sacict'); ?>">About SACICT</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('about/master-artisans'); ?>">Master Artisans</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('about/master-craftsmen'); ?>">Master Craftsmen</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('about/craftsmen-decendants'); ?>">Craftsman Descendants</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('lux'); ?>">Lux by SACICT</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('catalog?seller=97'); ?>">Sustainable Crafts</a></li>
            </ul>
        </li>
        <li class="pushy-link"><a href="<?php echo base_url('coming-soon'); ?>">Leading Brands</a></li>
        <li class="pushy-link"><a href="<?php echo base_url('coming-soon'); ?>">Speciality</a></li>
        <li class="pushy-submenu">
            <a href="#">Home & Living</a>
            <ul>
                <li class="pushy-link"><a href="<?php echo base_url('furniture'); ?>">Furniture</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('dining'); ?>">Dining</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('decorative-arts'); ?>">Decorative Arts</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('lacquerware'); ?>">Lacquerware</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('lighting'); ?>">Lighting</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('cushions'); ?>">Cushions</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('glassware'); ?>">Glassware</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('benjarong'); ?>">Benjarong</a></li>
            </ul>
        </li>
        <li class="pushy-submenu">
            <a href="#">Clothing & Accessories</a>
            <ul>
                <li class="pushy-link"><a href="<?php echo base_url('apparel'); ?>">Apparel</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('shoes'); ?>">Shoes</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('jewelry'); ?>">Jewelry</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('bags'); ?>">Bags</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('hats-and-scarves'); ?>">Hats &amp; scarves</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('accessories'); ?>">Accessories</a></li>
            </ul>
        </li>
        <li class="pushy-submenu">
            <a href="#">Health & Beauty</a>
            <ul>
                <li class="pushy-link"><a href="<?php echo base_url('skin-care'); ?>">Skin Care</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('bath-and-body'); ?>">Bath &amp; Body</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('hair-care'); ?>">Hair Care</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('make-up'); ?>">Make up</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('spa-treatment'); ?>">Spa Treatment</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('balms'); ?>">Balms</a></li>
            </ul>
        </li>
        <li class="pushy-submenu">
            <a href="#">Food</a>
            <ul>
                <li class="pushy-link"><a href="<?php echo base_url('snack'); ?>">Snack</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('coffee'); ?>">Coffee</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('organic-food'); ?>">Organic Food</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('cookies'); ?>">Cookies</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('jam-jelly-peanut'); ?>">Jam, Jelly, Peanut</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('butter'); ?>">Butter</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('cocoa'); ?>">Cocoa</a></li>
                <li class="pushy-link"><a href="<?php echo base_url('seasonings'); ?>">Seasonings</a></li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Site Overlay -->
<div class="site-overlay"></div>

<style type="text/css">
    #sign-in .content-auth {
        width: 360px;
    }
    #sign-up .content-auth {
        width: 620px;
    }
    .content-auth h3 {
        margin-bottom: 15px;
        margin-top: 10px;
    }
    .content-auth .content-buttons {
        background: #ebedef none repeat scroll 0 0;
        border-top: 1px solid #ddd;
        padding: 15px;
        text-align: right;
        margin-top: 5px;
    }
    .content-auth input,
    .content-auth select,
    .content-auth .btn {
        border-radius: 0 !important;
    }
    .content-auth .form-group label {
        font-size: 15px;
        font-weight: normal;
    }
    .content-auth .form-group input,
    .content-auth .form-group select {
        font-size: 14px;
        outline: medium none;
        padding: 1px 5px;
        box-shadow: none;
    }
    .content-auth .form-group input:focus,
    .content-auth .form-group select:focus {
        border: 1px solid #f24b4b;
    }
    .content-auth .content-buttons p {
        float: left;
        text-align: left;
        font-size: 14px;
        margin: -4px 0 0;
    }
    #sign-up .content-auth .content-buttons p {
        margin-top: 2px;
    }
    .content-auth .content-buttons a {
        color: #F24B4B;
    }
    .content-auth .col-lg-4,
    .content-auth .col-md-4,
    .content-auth .col-sm-4 {
        padding-right: 0;
    }
    #menu nav a sup {
        font-size: 9px;
        font-weight: 900;
        top: -8px;
        color: #F24B4B;
        transition: color 300ms ease-in-out 0s;
    }
    #menu nav a:hover sup {
        color: #fff;
    }
    #my-account {
        top: 42px;
        position: absolute;
        display: none;
        width: 130px;
        background: rgba(230,230,230,0.7);
        box-shadow: 0 2px 3px -2px #222;
        z-index: 5;
    }
    #my-account.active {
        display: inline-block;
    }
    #my-account a {
        display: block;
        width: 100%;
        height: 30px;
        line-height: 30px;
        border: 0;
    }
    #my-account + a > i {
        font-size: 16px;
        margin-left: 5px;
    }
    #forgot-password .content-auth {
        width: 360px;
    }
    #forgot-password p {
        font-size: 14px;
    }
    #ba-seller {
        display: inline-block;
    }
</style>
<?php $this->view('forms/forgot-password'); ?>
<?php $this->view('forms/sign-in'); ?>
<?php $this->view('forms/sign-up'); ?>

<script type="text/javascript" src="<?php echo base_url('assets/vendor/pushy/pushy.js'); ?>"></script>