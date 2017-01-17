<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/28/16 5:24 PM
 * Description:
 */
?>
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $this->product->getName(); ?>" />
<meta property="og:url" content="<?php echo base_url('product/view/'.$this->product->getId()); ?>" />
<meta property="og:description" content="<?php echo trim(strip_tags($this->product->getDescription())); ?>" />
<?php if ($image = $this->product->getPhotos()): ?>
<meta property="og:image" content="<?php echo $image->photo; ?>" />
<meta name="twitter:image" content="<?php echo $image->photo; ?>" />
<?php endif; ?>
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@OneNow1" />
<meta name="twitter:title" content="<?php echo $this->product->getName(); ?>" />
<meta name="twitter:description" content="<?php echo trim(strip_tags($this->product->getDescription())); ?>" />

<title>ONENOW - <?php echo $this->product->getName(); ?></title>

<style type="text/css">
    #content-seller {
        border-top: 2px solid #ddd;
        padding: 30px 0 0;
    }
    #content-seller #seller-image,
    #content-seller #seller-about {
        padding: 0;
    }
    #content-seller #seller-image {
        margin-left: -15px;
    }
    #content-seller #seller-image img {
        margin: 0 auto;
    }
    #content-seller #seller-image a,
    #content-seller #seller-image span {
        display: block;
        text-align: center;
    }
    #content-seller #seller-image a:hover,
    #content-seller #seller-image a {
        color: #454545;
        text-decoration: underline;
    }
    #content-seller .row {
        margin: 0 !important;
    }
    #seller-about div {
        height: 114px;
        overflow: hidden;
    }
    #seller-about a {
        display: block;
        text-align: right;
        padding-top: 10px;
        color: #F24B4B;
    }
    #seller-products img {
        display: block;
        margin: 0 auto;
    }
    #content-browsing {
        margin-bottom: 30px;
    }
    #content-browsing h2 {
        font-size: 30px;
        font-weight: 600;
        margin-bottom: 30px;
        text-align: center;
    }
    #content-browsing div {
        text-align: center;
    }
    #content-browsing a {
        text-decoration: none;
        display: inline-block;
        vertical-align: top;
    }
    #content-browsing img {
        border: 1px solid #aaa;
        height: 125px;
        width: 125px;
        margin: 3px;
    }
    @media (max-width: 768px) {
        #content-browsing img {
            height: initial;
            width: calc((100% - 30px) / 5);
        }
    }
    @media (max-width: 480px) {
        #content-browsing img {
            height: initial;
            width: calc((100% - 18px) / 3);
        }
    }
</style>
<?php $this->view('common/header'); ?>

<?php $this->view('product/view'); ?>

<div id="content-seller" class="container">
    <div class="row">
        <div class="col-sm-5">
            <div class="container-fluid">
                <div class="row">
                    <div id="seller-image" class="col-sm-6">
                        <img src="<?php echo $this->product->getSeller_photo(); ?>" onerror="this.src='<?php echo base_url('assets/images/image-not-found.png'); ?>'" alt="<?php echo $this->product->getSeller_name(); ?>'" class="img-responsive" />
                        <span><?php echo $this->product->getSeller_name(); ?></span>
                        <!--<a href="#">SHOP THIS SELLER</a>-->
                    </div>
                    <div id="seller-about" class="col-sm-6">
                        <p>About the seller</p>
                        <div>
                            <?php echo $this->product->getSeller_info(); ?>
                        </div>
                        <a href="#more" onclick="$(this).prev().css('height', 'auto');$(this).remove();">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="container-fluid">
                <div class="row" id="seller-products"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->view('product/marketing'); ?>

<div class="content-main">
    <div id="content-browsing" class="container-fluid">
        <h2>Browsing History</h2>
        <div>
            <?php foreach($this->visited->get() as $item): if ($item->id == $this->product->getId()) continue; ?>
            <a href="<?php echo base_url("product/view/{$item->id}"); ?>">
                <img src="<?php echo $item->image; ?>" alt="<?php echo $item->id; ?>" onerror="this.src='<?php echo base_url('assets/images/image-not-found.png'); ?>'" />
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="JSProduct" id="js-product-box" aria-prompt="#product-preview">
    <div class="col-lg-3 col-md-3 col-sm-4">
        <?php $this->view('product/box', array('params' => false)); ?>
    </div>
</div>

<div id="product-alert" class="prompt prompt-alert" role="alert">
    <div class="prompt-content">
        <a href="javascript:prompt_box('#product-alert', false);" class="prompt-close">&times;</a>
        <div class="content-message">
            <p></p>
            <div class="content-buttons">
                <a href="<?php echo base_url('shopping-cart'); ?>" class="btn btn-danger">View Cart</a>
                <a id="continue-shopping" href="javascript:prompt_box('#product-alert', false);" class="btn btn-default">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>

<?php $this->view('product/form-quote'); ?>
<?php $this->view('common/footer'); ?>
<?php
    $options = "";
    if (! $this->product->getColors())
        $options .= ',.product-colors';
    if (! $this->product->getSizes())
        $options .= ',.product-sizes';
    if ($options !== "")
        echo sprintf('<script type="text/javascript">$(function(){ $("%s").parent().remove(); });</script>', substr($options, 1));
?>
<script type="text/javascript">
    $(function(){
        $('.product-colors .product-option').each(function(){
            $(this).next().css('background-color', this.value);
        });
        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '');
        product.controller(function(data) {
            if ($('#shopping-cart .badge').size() > 0)
                $('#shopping-cart .badge').text(data.cart);
            else
                $('#shopping-cart').append('<spam class="badge">'+ data.cart +'</span>');

            $("#product-alert p").text(data.message);
            prompt_box('#product-alert', true);
        }).swapper();

        product.request('product/list', {limit:3,page:1,price:'all',sellers:'<?php echo $this->product->getSeller_id(); ?>',categories:'<?php echo $this->product->getCategory(); ?>'}, function(data) {
            for(var i in data.list)
            {
                var item = data.list[i];
                $('#seller-products').append('<div class="col-xs-4"><a href="<?php echo base_url('product/view'); ?>/'+ item.id +'"><img class="img-responsive" src="'+ item.image +'" alt="'+ item.name +'" style="max-height:210px;"><\/a><\/div>');
            }

            if (data.list.length < 3)
            {
                for (var i=data.list.length; i < 3; i++)
                {
                    $('#seller-products').append('<div class="col-xs-4"><div style="display:block;height:178px;width:100%">&nbsp;<\/div><\/div>');
                }
            }
        });

        $('.content-product .product-image-thumbnails a:first()').addClass('active');
    });
</script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/owl.carousel/assets/owl.carousel.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/owl.carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/plugins/countdown/jquery.countdown.min.js'); ?>"></script>