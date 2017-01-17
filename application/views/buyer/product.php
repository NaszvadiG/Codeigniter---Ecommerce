<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 7:09 PM
 * Description: Home page
 */
?>
<title>ONENOW - Product - Details</title>
<?php $this->view('common/header'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/product.css'); ?>" />

<div class="mirek-product-detail-container" >
    <div class="row">
        <!-- left column -->
        <div class="col-lg-6 col-md-6 col-sm-6 mirek-product-preview" style="text-align: center;">
            <!-- product Image and Zoom -->
            <div class="sp-wrap col-lg-12 no-padding">
                <a href="<?php echo base_url('assets/images/test-image/detail.jpg'); ?>"><img
                        src="<?php echo base_url('assets/images/test-image/detail.jpg'); ?>"  alt="img"></a>
                <a href="<?php echo base_url('assets/images/test-image/detail.jpg'); ?>"><img
                        src="<?php echo base_url('assets/images/test-image/detail.jpg'); ?>" alt="img"></a>
                <a href="<?php echo base_url('assets/images/test-image/detail.jpg'); ?>"><img
                        src="<?php echo base_url('assets/images/test-image/detail.jpg'); ?>" alt="img"></a></div>
        </div>
        <!--/ left column end -->

        <!-- right column -->
        <div class="col-lg-6 col-md-6 col-sm-5 mirek-product-detail">
            <h1 class="mirek-product-title"> A5 Yellow Handmade Diary</h1>
                <div class="mirek-rating">
                    <p><span><i class="fa fa-star"></i></span> <span><i class="fa fa-star"></i></span> <span><i
                            class="fa fa-star"></i></span> <span><i class="fa fa-star"></i></span> <span><i
                            class="fa fa-star-o "></i></span> <span class="ratingInfo">   </span></p>
                </div>
                <div class="mirek-product-price">
                    <p>US$ 12.21 </p>
                </div>

                <div class="mirek-productFilter" >
                    <p >Quantity:</p>
                    <select class="form-control" >
                        <option value="mango" selected>1</option>
                        <option value="bananas">2</option>
                        <option value="watermelon">3</option>
                        <option value="grapes">4</option>
                        <option value="oranges">5</option>
                        <option value="pineapple">6</option>
                        <option value="peaches">7</option>
                        <option value="cherries">8</option>
                    </select>
                </div>
                <!-- productFilter -->
                <div class="mirek-product-action row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <button class="addToCartBtn">Add To Cart</button>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6" style="padding: 8px;"><a >ADD TO WISHLIST</a></div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6" style="padding: 8px;"><a >FAVOURITE SHOP</a> <i class="fa  fa-heart-o"></i></div>
                </div>
                <div class="clear"></div>
                <div class="mirek-product-tab">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                        <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
                        <li><a href="#bulkdiscount" data-toggle="tab">Bulk discount</a></li>
                        <li><a href="#askSeller" data-toggle="tab">Ask the Seller</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="details">
                            -Thai design paper product made from cotton and silk with beautifully delicate hand-sewing
                        </div>
                        <div class="tab-pane" id="shipping">
                             -dummy data
                        </div>
                        <div class="tab-pane" id="bulkdiscount">
                            -dummy data
                        </div>
                        <div class="tab-pane" id="askSeller">
                            -dummy data
                        </div>
                    </div>
                    <!-- /.tab content -->

                </div>
                <!--/.product-tab-->

                <div class="mirek-product-share">
                    <p style="margin-right: 10px"> SHARE </p>
                    <div class="mirek-socialIcon"><a href="#"> <i class="fa fa-facebook"></i></a> <a href="#"> <i
                            class="fa fa-twitter"></i></a> <a href="#"> <i class="fa fa-google-plus"></i></a> <a
                            href="#">
                        <i class="fa fa-pinterest"></i></a></div>
                </div>
                <!--/.product-share-->

        </div>
        <!--/ right column end -->
    </div>
    <!--/.row-->

    <div class="row mirek-recommended">
        <div class="mirek-my-col-5 col-xs-4 mirek-seller-img" style="text-align: center;">
            <img src="<?php echo base_url('assets/images/test-image/product_author1.png'); ?>" class="authorimg">
            <p>KANG-CHONG</p>
            <a style="text-decoration: underline;">SHOP THIS SELLER</a>
        </div>
        <div class="mirek-my-col-5 col-xs-5 mirek-seller-description">
            <p>Abouth the seller</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p>Donec at odio mattis, vehicula ex a, auctor mauris. Vestibulum efficitur mauris orci, nec pharetra lacus</p>
        </div>
        <!--/.recommended-->
        <div class="mirek-my-col-5 col-xs-4">
            <img src="<?php echo base_url('assets/images/test-image/product_author2.png'); ?>">
        </div>
        <div class="mirek-my-col-5 col-xs-4">
            <img src="<?php echo base_url('assets/images/test-image/product_author2.png'); ?>">
        </div>
        <div class="mirek-my-col-5 col-xs-4">
            <img src="<?php echo base_url('assets/images/test-image/product_author2.png'); ?>">
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div class="content-promoter container-fluid">
    <h2>Most Popular</h2>
    <div class="row product-slider slider-popular" >
        <?php for($i=0; $i<8; $i++): ?>
        <div><?php $this->view('product/box', array('params' => $params->popular[$i])); ?></div>
        <?php endfor; ?>
    </div>
</div>


<div id="content-curator" class="container-fluid">
    <h2>Curator's Picks</h2>
    <div class="row product-slider slider-curator">
        <?php for($i=0; $i<8; $i++): ?>
            <div ><?php $this->view('product/box', array('params' => $params->curator[$i])); ?></div>
        <?php endfor; ?>
    </div>
</div>

<div id="mirek-content-bhistory" >
    <h2 style="text-align: center">BROWSING HISTORY</h2>
    <div class="mirek-bhistory-slider">
        <img src="<?php echo base_url('assets/images/test-image/product-5.png'); ?>">
        <img src="<?php echo base_url('assets/images/test-image/product-5.png'); ?>">
        <img src="<?php echo base_url('assets/images/test-image/product-5.png'); ?>">
        <img src="<?php echo base_url('assets/images/test-image/product-5.png'); ?>">
        <img src="<?php echo base_url('assets/images/test-image/product-5.png'); ?>">
    </div>
</div>

<?php $this->view('common/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>