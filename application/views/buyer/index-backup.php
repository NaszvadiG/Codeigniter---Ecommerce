<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 7:09 PM
 * Description: Home page
 */
?>
<title>ONENOW - Home</title>
<?php $this->view('common/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/product.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/owl.carousel/assets/owl.carousel.css'); ?>" />

<div id="content-banners" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#content-banners" data-slide-to="0" class="active"></li>
      <li data-target="#content-banners" data-slide-to="1"></li>
      <li data-target="#content-banners" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php echo base_url('assets/images/home-page/banners/banner-1.png'); ?>" alt="onenow">
            <div class="carousel-caption">
                <h2>Sustainable Crafts</h2>
                <a href="<?php echo base_url('about/coming-soon'); ?>" class="btn btn-danger">Let's Explore</a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url('assets/images/home-page/banners/banner-2.png'); ?>" alt="onenow">

            <div class="carousel-caption">
                <h2>Meet the Master <br/>Craftsmen & Descendants</h2>
                <a href="<?php echo base_url('about/master-artisans'); ?>" class="btn btn-danger">Let's Explore</a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url('assets/images/home-page/banners/banner-3.png'); ?>" alt="onenow">
            <div class="carousel-caption">
                <h2 style="color:#454545;text-shadow: 1px 1px 3px #727272">Lux by SACICT</h2>
                <a href="<?php echo base_url('about/coming-soon'); ?>" class="btn btn-danger">Let's Explore</a>
            </div>
        </div>

    </div>

    <!-- Controls -->
    <!--a class="left carousel-control" href="#content-banners" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#content-banners" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>-->
   <!-- <div class="content-banners-caption">
        <h2>Thai Home Collection From <br/>Master Artisans</h2>
        <a href="http://buyer.staging.onenow.com/master-craftsmen" class="btn btn-danger">Let's Explore</a>
    </div>-->
</div>


<div class="container-fluid">
    <div id="popularity" class="content-promoter">
        <h2>Most Popular</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="prev.owl.carousel"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><i class="fa fa-chevron-right"></i></a>
    </div>
</div>

<div id="content-deal" class="container">
    <h2>Today's Deal</h2>
    <div class="row">
        <div class="col-sm-6"><img src="<?php echo base_url('assets/images/please-wait.gif'); ?>" class="img-responsive" /></div>
        <div class="deal-info col-sm-6">
            <h3></h3>
            <span class="deal-seller"></span>
            <div>
                <span class="deal-price-sale"></span>
                <span>USD <del></del></span>
            </div>
            <div>
                <span class="deal-price-save"></span>
            </div>
            <div class="deal-count-down">
                Time left to buy <span></span>
            </div>
            <a href="#" class="btn btn-danger">Get This Deal</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div id="limited" class="content-promoter">
        <h2>Limited Edition</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="prev.owl.carousel"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><i class="fa fa-chevron-right"></i></a>
    </div>
</div>

<div class="container-fluid">
    <div id="curated" class="content-promoter">
        <h2>Curator's Picks</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="prev.owl.carousel"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><i class="fa fa-chevron-right"></i></a>
    </div>
</div>

<div class="container-fluid">
    <div id="content-explore">
        <h2>Explore Marketplace</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/3/112030000078_001.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('home-and-living'); ?>">Home annd Living</a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/0/131500910040_001.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('clothing-and-accessories'); ?>">Clothing and Accessories</a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/1/108030570001_006.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('health-and-beauty'); ?>">Health and Beauty</a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/1/135140190102_001.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('food'); ?>">Food</a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/0/101010080005_001.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('home-and-living'); ?>">Home annd Living</a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/3/134040720001_001.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('clothing-and-accessories'); ?>">Clothing and Accessories</a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/5/116500900026_001.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('health-and-beauty'); ?>">Health and Beauty</a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="http://tcms.staging.onenow.com/media/djcatalog2/images/item/9/165030590008_001.jpg" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url('food'); ?>">Food</a>
            </div>
        </div>
    </div>
</div>

<div class="JSProduct" id="js-product-box" aria-prompt="#product-preview">
    <div>
        <?php $this->view('product/box', array('params' => false)); ?>
    </div>
</div>
<?php $this->view('common/subscribebar'); ?>
<?php $this->view('common/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/owl.carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/plugins/countdown/jquery.countdown.min.js'); ?>"></script>
<script type="text/javascript">
    $(function() {
        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '<?php print($this->category->getTags()); ?>');
        product.controller(function(data) {
            $('#shopping-cart .badge').text(data.cart);
            $("#product-alert p").text(data.message);
            prompt_bar('alert', true);
        });

        product.request('product/get/popularity', {limit: 12,page: 1}, function(data) {
            product.features('#popularity', data);
            $('#popularity .owl-carousel').owlCarousel({
                responsiveClass: true,
                responsive: {
                    0: {items:1},
                    768: {items:2},
                    1024: {items:3},
                    1300: {items:4}
                },
                pagination: false
            });
            $('#popularity .owl-item > div').removeAttr('class');
        });

        product.request('product/get/limited', {limit: 12,page: 1}, function(data) {
            product.features('#limited', data);
            for(var i in data.list)
            {
                $('<img src="'+ data.list[i].seller_photo +'" alt="'+ data.list[i].seller +'" />').insertAfter('#limited .product-info a[href="#view"]:eq('+i+')');
            }

            $('#limited .owl-carousel').owlCarousel({
                responsiveClass: true,
                responsive: {
                    0: {items:1},
                    768: {items:2},
                    1024: {items:3},
                    1300: {items:4}
                },
                pagination: false
            });
            $('#limited .owl-item > div').removeAttr('class');
        });

        product.request('product/get/curated', {limit: 8,page: 1}, function(data) {
            product.features('#curated', data);
            $('#curated .owl-carousel').owlCarousel({
                responsiveClass: true,
                responsive: {
                    0: {items:1},
                    768: {items:2}
                },
                pagination: false
            });
            $('#curated .owl-item > div').removeAttr('class');
            $('#curated .owl-item .product-price').text('Click on item to buy');
        });

        $('.owl-btn').click(function(e){
            e.preventDefault();
            $('#'+ $(this).parent().prop('id') + ' .owl-carousel').trigger($(this).attr('aria-action'));
        });

        product.request('product/get/deal', {limit: 1, page: 1}, function(data) {
            var item = data.list[0];
            var price = parseFloat(item.price_usd);

            $('#content-deal img').attr('src', item.image);
            $('#content-deal a').attr('href', '<?php echo base_url('product/view'); ?>/'+item.id);
            $('.deal-info h3').text(item.name);
            $('.deal-seller').text('BY '+ item.seller);
            $('.deal-price-sale').text('USD '+ (price - (price * (parseFloat(item.deal_discount)/100))).toFixed(2));
            $('.deal-price-sale + span del').text(item.price_usd);
            $('.deal-price-save').text('SAVE '+ item.deal_discount +'%');

            $('.deal-count-down span').countdown(item.deal_expiry).on('update.countdown', function(event) {
                var format = '%H:%M:%S';
                if(event.offset.totalDays > 0) {
                    format = '%-d day%!d ' + format;
                }
                if(event.offset.weeks > 0) {
                    format = '%-w week%!w ' + format;
                }
                $(this).html(event.strftime(format));
            }).on('finish.countdown', function(event) {
                $(this).html('This offer has expired!').parent().addClass('disabled');
            });
        });

        /*product.request('product/get/explored', {limit: 8,page: 1}, function(data) {
            $('#content-explore .row').html('');
            for(var i in data.list)
            {
                var content = '<img src="'+ data.list[i].image +'" onerror="this.src=\'<?php //echo base_url('assets/images/image-not-found.png'); ?>\'" />';
                content += '<a href="<?php //echo base_url('product/view'); ?>/'+ data.list[i].id+'">'+ data.list[i].name +'</a>';
                $('#content-explore .row').append('<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">'+content+'</div>');
            }
        });*/
    });
</script>