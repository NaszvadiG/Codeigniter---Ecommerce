<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>

<div id="content-banners" class="carousel slide responsive-container" data-ride="carousel">
    <!-- Indicators -->
    <!-- <ol class="carousel-indicators">
      <li data-target="#content-banners" data-slide-to="0" class="active"></li>
      <li data-target="#content-banners" data-slide-to="1"></li>
      <li data-target="#content-banners" data-slide-to="2"></li>
      <li data-target="#content-banners" data-slide-to="3"></li>
    </ol> -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php echo base_url('seller/assets/images/home-page/banners/seller-banner/banner.png'); ?>" alt="onenow">
            <div class="carousel-caption">
                <h1><?php echo strtoupper($this->translations->web_seller_start_selling_to_billion_online_consumers); ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="testmonial responsive-container">
    <h1><?php echo $this->translations->web_seller_how_you_do_it_with_onenow; ?></h1>
    <div class="row">
        <div class="testmonial-item col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <img src="<?php echo base_url('seller/assets/images/home-page/banners/seller-banner/sub-banner1.jpg'); ?>">
            <div class="testmonial-text white">
                <h1>1</h1>
                <h3><?php echo $this->translations->web_seller_snap_a_picture_of_your_product_write_a_description_and_provide_some_details; ?></h3>
            </div>
        </div>
        <div class="testmonial-item col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <img src="<?php echo base_url('seller/assets/images/home-page/banners/seller-banner/sub-banner2.png'); ?>">
            <div class="testmonial-text white">
                <h1>2</h1>
                <h3><?php echo $this->translations->web_seller_onenow_list_your_item_in_english_and_publish_it_without_markups; ?></h3>
            </div>
        </div>
        <div class="testmonial-item col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <img src="<?php echo base_url('seller/assets/images/home-page/banners/seller-banner/sub-banner3.png'); ?>">
            <div class="testmonial-text white">
                <h1>3</h1>
                <h3><?php echo $this->translations->web_seller_buyers_buy_your_item_from_onenow_at_a_lower_price_and_you_will_sell_more; ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="signup-banner responsive-container">
   <a href="javascript:$('#ModalSignup').modal('show');void(0);" class="onenowBtn btn btn-danger newredBtn"><?php echo strtoupper($this->translations->web_seller_sign_up_now); ?></a>
   <h1><?php echo $this->translations->web_seller_join_our_selling_platform_today; ?></h1>
   <h1><?php echo $this->translations->web_seller_be_a_onenow_seller_today_for_free; ?></h1>
   <p><?php echo $this->translations->web_seller_receive_a_starter_pack_worth_thb_when_you_signup_today; ?></p>
</div>



<?php 
$this->view("common/seller/subscribe");
$this->view("common/seller/footer");
?>

<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
