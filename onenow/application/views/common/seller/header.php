<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Splashscreen -->
<?php if (isset($show_splash) && $show_splash == TRUE){ ?>
<div id="splash">
    <div class="splashLogo">
        <div class="col-xs-12">
            <img src="<?php echo base_url('seller/assets/images/on_splash_a.png'); ?>" class="splashCircle">
            <img src="<?php echo base_url('seller/assets/images/on_splash_b.png'); ?>">
        </div>
        <h1 class="text-center" style="font-weight: 700; margin-top: 10px; color: #000;">SELLER PORTAL</h1>
    </div>
</div>
<?php } ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('seller/assets/vendor/pushy/pushy.css'); ?>" />
<style>

.menu-btn {
    display: none;
    float: right;
    font-size: 30px;
    margin-right: 10px;
    margin-top: 25px;
}

@media (max-width: 980px) {
    .menu-btn {
        display: block;
        margin-top: 0;
        margin-bottom: 10px;
    }
}
</style>
<div class="header navbar navbar-tshop navbar-fixed-top megamenu"  role="navigation" >
    <div style="border-top: solid 2px #F24B4B;">
        <div class="topbar">
            <p><?php echo $this->translations->web_seller_top_banner; ?></p>
        </div>
        <div class="topmenu"> 
            <div class="responsive-container">
                <!--<div class="float-right" style="height: 50px; padding-left: 20px; padding-right: 20px; position: relative; border-left: solid; border-left-width: 2px; border-left-color:#e9e9e9;"><img src="<?php echo base_url('seller/assets/images/seller/icon_cart.png'); ?>" style="margin-top: 10px;"> <span class="cartCount">2</span></div>-->
                <?php if (isset($_SESSION['authuser'])){ ?>
                    <div class="float-right join-user"><?php echo $this->seller_model->getSellerPhoto(); ?><p>Hello, <?php echo $this->authuser->firstname ?></p>
                        <ul id="nav-user-dropdown" class="dropdown-menu">
                            <li class="userinfo">

                                <p><?php echo isset($_SESSION['seller_addr']) ? $this->authuser->suite.' '.$_SESSION['seller_addr'] : $this->authuser->suite; ?></p>                        </li>
                            <li><a href="<?php echo base_url('seller/account'); ?>" class="text-center"><?php echo $this->translations->web_seller_my_account; ?></a></li>
                            <li><a href="<?php echo base_url('seller/account/logout'); ?>" class="text-center"><?php echo $this->translations->web_seller_logout; ?></a></li>
                        </ul>
                    </div>

                <?php
                    }
                    else{
                ?>
                    <div class="float-right join "><p><a data-toggle="modal" href="#ModalLogin"><?php echo $this->translations->web_join_signin; ?></a></p></div>
                <?php
                    }
                ?>
                <!-- CGW-IT-RENZ 11092016 - Added link for localization change -->
                <div class="float-right toggle-lang"><a href="javascript:lang_th(<?php echo isset($_SESSION['locale_th']) ? 'false' : 'true' ?>);void(0);"><?php echo isset($_SESSION['locale_th']) ?  '<p>EN | <b>ไทย</b></p>' : '<p><b>EN</b> | ไทย</p>' ?></a></div>
                <div class="float-right beseller "><p><a href="<?php echo base_url(); ?>" target="_blank"><?php echo $this->translations->web_seller_buy_on_onenow; ?></a></p></div>
            </div>
        </div>
        <div class="mainmenu" >
            <div class="responsive-container">
                <a class="logo " href="<?php echo base_url('seller'); ?>"> <img src="<?php echo base_url('assets/images/logo.png'); ?>"> </a>
                <div class="seller-menu">
                    <ul class="nav navbar-nav">
                        <li ><a href="<?php echo isset($_SESSION['authuser']) ? base_url('seller/items'): 'javascript:void(0);'; ?>" onclick="<?php echo isset($_SESSION['authuser']) ? ($this->authuser->status == '' ? 'showCreateStoreModal(); return false;' : '') : '$(\'#ModalLogin\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_seller_listings; ?></a></li>
                        <li ><a href="<?php echo isset($_SESSION['authuser']) ? base_url('seller/items/add'): 'javascript:void(0);'; ?>" onclick="<?php echo isset($_SESSION['authuser']) ? ($this->authuser->status == '' ? 'showCreateStoreModal(); return false;' : '') : '$(\'#ModalLogin\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_seller_add_items; ?></a></li>
                        <li id="salesLink" class="dropdown" style="position:relative; margin-bottom: 0; ">
                            <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->translations->web_seller_orders; ?></a>
                            <!-- <div id="popup"> -->
                                <ul id="nav-sales-dropdown" class="dropdown-menu">
                                     <li><a href="<?php echo isset($_SESSION['authuser']) ? base_url('seller/orders/pending_orders'): 'javascript:void(0);'; ?>" onclick="<?php echo isset($_SESSION['authuser']) ? ($this->authuser->status == '' ? 'showCreateStoreModal(); return false;' : '') : '$(\'#ModalLogin\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_seller_pending_orders; ?></a></li>
                                    <li><a href="<?php echo isset($_SESSION['authuser']) ? base_url('seller/orders/confirmed_orders'): 'javascript:void(0);'; ?>" onclick="<?php echo isset($_SESSION['authuser']) ? ($this->authuser->status == '' ? 'showCreateStoreModal(); return false;' : '') : '$(\'#ModalLogin\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_seller_confirmed_orders; ?></a></li>
                                    <li><a href="<?php echo isset($_SESSION['authuser']) ? base_url('seller/orders/awb_confirmation'): 'javascript:void(0);'; ?>" onclick="<?php echo isset($_SESSION['authuser']) ? ($this->authuser->status == '' ? 'showCreateStoreModal(); return false;' : '') : '$(\'#ModalLogin\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_seller_tracking_confirmation; ?></a></li>
                                    <li><a href="<?php echo isset($_SESSION['authuser']) ? base_url('seller/orders/order_history'): 'javascript:void(0);'; ?>" onclick="<?php echo isset($_SESSION['authuser']) ? ($this->authuser->status == '' ? 'showCreateStoreModal(); return false;' : '') : '$(\'#ModalLogin\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_seller_order_history; ?></a></li>
                                </ul>
                            <!-- </div> -->
                        </li>
                        <!-- <li><a href="<?php echo base_url('seller/analytics'); ?>" >Analytics</a></li> -->
                         
                        <li><a href="<?php echo base_url('seller/assets/pdf/Seller_Handbook.pdf');?>" target="_blank"><?php echo $this->translations->web_seller_seller_guide; ?></a></li>
                        <li><a href="<?php echo isset($_SESSION['authuser']) ? base_url('seller/account'): 'javascript:void(0);'; ?>" onclick="<?php echo isset($_SESSION['authuser']) ? ($this->authuser->status == '' ? 'showCreateStoreModal(); return false;' : '') : '$(\'#ModalLogin\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_seller_my_account; ?></a></li>
                        <li><a href="<?php echo base_url('seller/coming-soon'); ?>" ><?php echo $this->translations->web_seller_support; ?></a></li>
                    </ul>
                </div>
            </div>
            <a class="menu-btn"><i class="fa fa-bars"></i></a>
        </div>
    </div>
</div>
<nav class="pushy pushy-right" id="responsive-menu">
    <ul>
        <?php if (isset($_SESSION['authuser'])): ?>
            <div class="mobile-userInfo">
                <?php echo $this->seller_model->getSellerPhoto(); ?>
                <p class="user-name">Hello, <?php echo $this->authuser->firstname ?></p>
                <p class="user-info"><?php echo isset($_SESSION['seller_addr']) ? $this->authuser->suite.' '.$_SESSION['seller_addr'] : $this->authuser->suite; ?></p>
            </div>
        <?php
            else:
        ?>
             <li class="pushy-link"><a data-toggle="modal" href="#ModalLogin"><?php echo $this->translations->web_join_signin; ?></a></li>
        <?php
            endif;
        ?>
        <hr>
        <li class="pushy-link"><a href="<?php echo base_url('seller/items'); ?>"><?php echo $this->translations->web_seller_listings; ?></a></li>
        <li class="pushy-link"><a href="<?php echo base_url('seller/items/add'); ?>"><?php echo $this->translations->web_seller_add_items; ?></a></li>
        <li class="pushy-submenu">
            <a ><?php echo $this->translations->web_seller_orders; ?></a>
            <ul>
                <li><a href="<?php echo base_url('seller/orders/pending_orders'); ?>"><?php echo $this->translations->web_seller_pending_orders; ?></a></li>
                <li><a href="<?php echo base_url('seller/orders/confirmed_orders'); ?>"><?php echo $this->translations->web_seller_confirmed_orders; ?></a></li>
                <li><a href="<?php echo base_url('seller/orders/awb_confirmation'); ?>"><?php echo $this->translations->web_seller_tracking_confirmation; ?></a></li>
                <li><a href="<?php echo base_url('seller/orders/order_history'); ?>"><?php echo $this->translations->web_seller_order_history; ?></a></li>
            </ul>
        </li>
        <li class="pushy-link"><a href="<?php echo base_url('seller/assets/pdf/Seller_Handbook.pdf');?>" target="_blank"><?php echo $this->translations->web_seller_seller_guide; ?></a></li>
        <li class="pushy-link"><a href="<?php echo base_url('seller/account'); ?>" ><?php echo $this->translations->web_seller_my_account; ?></a></li>
        <li class="pushy-link"><a href="<?php echo base_url('seller/coming-soon'); ?>" ><?php echo $this->translations->web_seller_support; ?></a></li>
        <?php if (isset($_SESSION['authuser'])): ?>
        <li class="pushy-link"><a href="<?php echo base_url('seller/account/logout'); ?>"><?php echo $this->translations->web_seller_logout; ?></a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Site Overlay -->
<div class="site-overlay"></div>