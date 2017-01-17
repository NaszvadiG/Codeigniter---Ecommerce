<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Splashscreen -->
<?php if (isset($show_splash) && $show_splash == TRUE){ ?>
<div id="splash">
    <div class="splashLogo">
        <img src="<?php echo base_url('onenow/assets/images/on_splash_a.png'); ?>" class="splashCircle">
        <img src="<?php echo base_url('onenow/assets/images/on_splash_b.png'); ?>">
        <h1 class="text-center" style="font-weight: 700; margin-top: 10px; color: #000;">SELLER PORTAL</h1>
    </div>
</div>
<?php } ?>

<div class="header navbar navbar-tshop navbar-fixed-top megamenu"  role="navigation" >
    <div class="container" style="border-top: solid 2px #F24B4B;">
        <div class="topbar">
            <p><?php echo $this->translations->web_we_ship_worldwide; ?></p>
        </div>
        <div class="topmenu"> 
                
            <!--<div class="float-right" style="height: 50px; padding-left: 20px; padding-right: 20px; position: relative; border-left: solid; border-left-width: 2px; border-left-color:#e9e9e9;"><img src="<?php echo base_url('onenow/assets/images/seller/icon_cart.png'); ?>" style="margin-top: 10px;"> <span class="cartCount">2</span></div>-->
            <?php if (isset($_SESSION['suite']) && isset($_SESSION['email']) && isset($_SESSION['name'])){ ?>
                <div class="float-right join-user"><?php echo $this->seller_model->getSellerPhoto(); ?><p>Hello, <?php echo $_SESSION['name'] ?></p>
                    <ul id="nav-user-dropdown" class="dropdown-menu">
                        <li class="userinfo">
                            
                            <p><?php echo isset($_SESSION['seller_addr']) ? $_SESSION['suite'].' '.$_SESSION['seller_addr'] : $_SESSION['suite']; ?></p>                        </li>
                        <li><a href="<?php echo base_url('seller/account'); ?>" class="text-center"><?php echo $this->translations->web_seller_my_account; ?></a></li>
                        <li><a href="<?php echo base_url('seller/account/logout'); ?>" class="text-center">Logout</a></li>
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
            <div class="float-right beseller "><p><a href="<?php echo base_url(); ?>" target="_blank">Buy on ONENOW</a></p></div>   
        </div>
        <div class="mainmenu" >
            <a class="logo " href="<?php echo base_url('seller'); ?>"> <img src="<?php echo base_url('onenow/assets/images/logo.png'); ?>" alt="TSHOP"> </a>
            <div class="seller-menu">
                <ul class="nav navbar-nav">
                    <li ><a href="<?php echo base_url('seller/items'); ?>"><?php echo $this->translations->web_seller_listings; ?></a></li>
                    <li ><a href="<?php echo base_url('seller/items/add'); ?>"><?php echo $this->translations->web_seller_add_items; ?></a></li>
                    <li id="salesLink" class="dropdown" style="position:relative; margin-bottom: 0; ">
                        <a class="dropdown-toggle" data-toggle="dropdown">Orders</a>
                        <!-- <div id="popup"> -->
                            <ul id="nav-sales-dropdown" class="dropdown-menu">
                                <li><a href="<?php echo base_url('seller/sales/pending_orders'); ?>">Pending Orders</a></li>
                                <li><a href="<?php echo base_url('seller/sales/confirmed_orders'); ?>">Confirmed Orders</a></li>
                                <li><a href="<?php echo base_url('seller/sales/awb_confirmation'); ?>">Tracking Confirmation</a></li>
                                <li><a href="<?php echo base_url('seller/sales/order_history'); ?>">Order History</a></li>
                            </ul>
                        <!-- </div> -->
                    </li>
                    <!-- <li><a href="<?php echo base_url('seller/analytics'); ?>" >Analytics</a></li> -->
                    <li><a href="<?php echo base_url('seller/guide'); ?>" ><?php echo $this->translations->web_seller_seller_guide; ?></a></li>
                    <li><a href="<?php echo base_url('seller/account'); ?>" ><?php echo $this->translations->web_seller_my_account; ?></a></li>
                    <li><a href="<?php echo base_url('seller/support'); ?>" ><?php echo $this->translations->web_seller_support; ?></a></li>
                </ul>
            </div>
            
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapsem"><span
                        class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span
                        class="icon-bar"> </span> <span class="icon-bar"> </span></button>
            <!--<div class="search-mobile float-right">
                <i class="fa fa-search clicktarget"></i>
                <div class="arrow_box">
                    <input type="text" placeholder="What are you looking for?" >
                    <button class="redbtn" >Search</button>
                </div>
            </div>-->
            <div class="navbar-collapsem navbar-collapsemm collapse mobile-menu arrow_box" >
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>" >Buy on ONENOW</a></li>
                    <li><a data-toggle="modal" href="#ModalLogin"><?php echo $this->translations->web_join_signin; ?></a></li>
                    <li class="menu-mobile">
                        <a href="<?php echo base_url('seller/items'); ?>"><?php echo $this->translations->web_seller_listings; ?><i class="fa fa-caret-right"></i></a> 
                    </li>
                    <li class="menu-mobile"><a href="<?php echo base_url('seller/items/add'); ?>"><?php echo $this->translations->web_seller_add_items; ?><i class="fa fa-caret-right"></i></a></li>
                    <li class="menu-mobile"><a class="has-sub" data-toggle="collapse" data-target=".navbar-collapsemm">Sales<i class="fa fa-caret-right"></i></a></li>
                    <li class="menu-mobile"><a href="<?php echo base_url('seller/analytics'); ?>">Analytics<i class="fa fa-caret-right"></i></a></li>
                    <li class="menu-mobile"><a href="<?php echo base_url('seller/guide'); ?>">Seller Guide<i class="fa fa-caret-right"></i></a></li>
                    <li class="menu-mobile"><a href="<?php echo base_url('seller/account'); ?>">My Account<i class="fa fa-caret-right"></i></a></li>
                    <li class="menu-mobile"><a href="<?php echo base_url('seller/support'); ?>">Support<i class="fa fa-caret-right"></i></a></li>
                </ul>
            </div>
            <div class="navbar-collapsemm navbar-collapsemm-sub collapse mobile-menu arrow_box sub-menu-satict" >
                <ul class="nav navbar-nav">
                    <li class="menu-mobile back"><a data-toggle="collapse" data-target=".navbar-collapsemm">Orders<i class="fa fa-caret-left"></i></a> </li>
                    <li  class="menu-mobile"><a href="<?php echo base_url('seller/sales/pending_orders'); ?>">Pending Orders</a></li>
                    <li  class="menu-mobile"><a href="<?php echo base_url('seller/sales/confirmed_orders'); ?>">Confirmed Orders</a></li>
                    <li  class="menu-mobile"><a href="<?php echo base_url('seller/sales/awb_confirmation'); ?>">Tracking Confirmation</a></li>
                    <li  class="menu-mobile"><a href="<?php echo base_url('seller/sales/order_history'); ?>">Order History</a></li>
                </ul>
            </div>
        </div>
        <div class="topline" >
        </div>
    </div>
</div>