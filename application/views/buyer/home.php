<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 11/4/16 11:17 AM
 * Description:
 */
?>
<title>ONENOW - Home</title>
<?php $this->view('common/header'); ?>

<div class="content-main">
    <div id="banners" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#banners" data-slide-to="0" class="active"></li>
            <li data-target="#banners" data-slide-to="1"></li>
            <li data-target="#banners" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="<?php echo base_url('assets/images/home-page/banners/banner-1.png'); ?>" alt="Sustainable Crafts">
                <div class="carousel-caption">
                    <h2>Made To Order</h2>
                    <a href="<?php echo base_url('made-to-order'); ?>" class="btn btn-danger">Let's Explore</a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo base_url('assets/images/home-page/banners/banner-2.png'); ?>" alt="Meet the Master Craftsmen & Descendants">
                <div class="carousel-caption">
                    <h2>Meet the Master <br/>Craftsmen & Descendants</h2>
                    <a href="<?php echo base_url('about/master-artisans'); ?>" class="btn btn-danger">Let's Explore</a>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo base_url('assets/images/home-page/banners/banner-3.png'); ?>" alt="Lux by SACICT">
                <div class="carousel-caption">
                    <h2 style="color:#454545;text-shadow: 1px 1px 3px #727272">Lux by SACICT</h2>
                    <a href="<?php echo base_url('home-and-living'); ?>" class="btn btn-danger">Let's Explore</a>
                </div>
            </div>
        </div>
    </div>

    <div id="popular" class="product-ads">
        <h2>Most Popular</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="prev.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-left.png'); ?>" /> </a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-right.png'); ?>" /></i></a>
    </div>

    <div id="deals" class="container">
        <h2>Today's Deal</h2>
        <div class="row">
            <div class="col-md-6"><img src="<?php echo base_url('assets/images/please-wait.gif'); ?>" class="img-responsive" /></div>
            <div class="deal-info col-md-6">
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
                <br/>
                <a href="#" class="btn btn-danger">Get This Deal</a>
            </div>
        </div>
    </div>

    <div id="limited" class="product-ads">
        <h2>Artisans One Of Originals</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="prev.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-left.png'); ?>" /> </a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-right.png'); ?>" /></i></a>
    </div>

    <div id="curated" class="product-ads">
        <h2>Curator's Picks</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn prev" aria-action="prev.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-left.png'); ?>" /> </a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-right.png'); ?>" /></i></a>
    </div>

    <div id="explored">
        <h2>Explore Marketplace</h2>
        <div class="row">
            <?php $market = array('SACICT', 'Thai Brands', 'Home and Living', 'Clothing & Accessories', 'Health and Beauty', 'Food', 'Curator\'s Pick', 'Benjarong');
            $arrLink = array('about/sacict', 'coming-soon', 'home-and-living', 'clothing-and-accessories', 'health-and-beauty', 'food', 'coming-soon', 'benjarong');
            foreach($market as $i => $name):
                $n = $i + 1;
                $link = $arrLink[$i];
            ?>
            <div class="col-xs-3">
                <img src="<?php echo base_url("assets/images/home-page/explore/market-{$n}.jpg"); ?>" onerror="this.src='http://localhost/assets/images/image-not-found.png'">
                <a href="<?php echo base_url($link); ?>"><?php echo $name; ?></a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<div class="JSProduct" id="js-product-box" aria-prompt="#product-preview">
    <div>
        <?php $this->view('product/box', array('params' => false)); ?>
    </div>
</div>

<?php $this->view('common/footer'); ?>

<script type="text/javascript">
    $(function() {
        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '<?php print($this->category->getTags()); ?>');
        product.controller(function(data) {
            $('#shopping-cart .badge').text(data.cart);
            $("#product-alert p").text(data.message);
            prompt_bar('alert', true);
        });

        product.request('product/get/limited', {limit: 12,page: 1}, function(data) {
            product.features('#limited', data);
            for(var i in data.list)
            {
                var url = '<?php echo base_url('about'); ?>/';

                switch (data.list[i].seller)
                {
                    case 'Thongsuk Chantawong':
                    case 'Chumnong Glubthong': url += 'master-artisans';
                        break;
                    case 'Jukkit Suksawat': url += 'master-craftsmen';
                        break;
                    case 'Angkan Uppanun': url += 'craftsmen-decendants';
                        break;
                    default:  url += 'master-artisans';
                }

                $('<a href="'+ url +'" target="_blank"><img src="'+ data.list[i].seller_photo +'" alt="'+ data.list[i].seller +'" /></a>').insertAfter('#limited .product-info a[href="#view"]:eq('+i+')');
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
            if (data.list.length > 4)
            {
                $('#limited .owl-btn').show();
            }
        });

        product.request('product/get/popularity', {limit: 12,page: 1}, function(data) {
            product.features('#popular', data);
            $('#popular .owl-carousel').owlCarousel({
                responsiveClass: true,
                responsive: {
                    0: {items:1},
                    768: {items:2},
                    1024: {items:3},
                    1300: {items:4}
                },
                pagination: false
            });
            $('#popular .owl-item > div').removeAttr('class');
            if (data.list.length > 4)
            {
                $('#popular .owl-btn').show();
            }
        });

        product.request('product/get/curated', {}, function(data) {
            if (data.rows < 1)
            {
                $('#curated').hide();
                return;
            }

            $('#curated > .row').html('');
            for(var i in data.list)
            {
                product.make('#curated > .row', data.list[i]);
            }

            $('#curated > .row > div').prop('class', 'col-lg-3 col-md-6 col-sm-6');
            $('#curated a[href="#quick-view"]').unbind('click').remove();

            $('#curated .owl-carousel').owlCarousel({
                responsiveClass: true,
                responsive: {
                    0: {items:1},
                    1200: {items:2}
                },
                pagination: false
            });

            $('#curated .owl-item > div').removeAttr('class');
            if (data.list.length > 2)
            {
                $('#curated .owl-btn').show();
            }

            $('#curated .product-info label').remove();
            $('#curated .owl-item .product-price').text('Click on item to buy');
            $('#curated a[href="#view"]').unbind('click').each(function(){
                $(this).attr('href', '<?php echo base_url('curators-pick'); ?>/'+ $(this).attr('aria-alias'));
            });
        });

        $('.owl-btn').click(function(e){
            e.preventDefault();
            $('#'+ $(this).parent().prop('id') + ' .owl-carousel').trigger($(this).attr('aria-action'));
        });

        product.request('product/get/deal', {limit: 1, page: 1}, function(data) {
            if (data.list.length < 1)
            {
                return $('#deals').remove();
            }

            var item = data.list[0];
            var price = parseFloat(item.price_usd);

            $('#deals img').attr('src', item.image);
            $('#deals img').click(function(){
                window.location.href = '<?php echo base_url('product/view'); ?>/'+item.id;
            }).css('cursor', 'pointer');
            $('#deals a').attr('href', '<?php echo base_url('product/view'); ?>/'+item.id);
            $('.deal-info h3').text(item.name);
            $('.deal-seller').text('by '+ item.seller);
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
    });
</script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/product.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/owl.carousel/assets/owl.carousel.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/home.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/owl.carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/plugins/countdown/jquery.countdown.min.js'); ?>"></script>