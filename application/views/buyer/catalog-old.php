<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 7:09 PM
 * Description: Home page
 */
?>
<title>ONENOW - Catalog</title>
<?php $this->view('common/header'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/owl-carousel/owl.theme.css'); ?>" />
<style type="text/css">
    .content-product-boxes > div {
        padding: 0;
    }
    .paginator {
        display: block;
    }
    .paginator a {
        color: #000;
        display: inline-block;
        min-width: 32px;
        padding: 5px;
        background: #eee;
        margin-right: 2px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
    }
    .paginator a.active,
    .paginator a:hover {
        color: #fff;
        background: #F24B4B;
    }
    #loading .prompt-content {
        top: 100px;
        font-size: 18px;
        line-height: 50px;
        color: #454545;
        padding: 15px 30px;
    }
    #loading .prompt-content span {
        display: inline-block;
        vertical-align: top;
        background: url('<?php echo base_url('assets/images/please-wait.gif'); ?>') no-repeat -80px -72px;
        height: 50px;
        width: 44px;
    }
    .content-list-summary {
        margin-bottom: 20px;
    }
    .content-list-summary #total {
        font-size: 12px;
    }
    #curated .product-image,
    #curated img {
        height: 320px;
        width: auto;
    }
    #curated a[href="#quick-view"],
    #curated a[href="#wish"] {
        display: none;
    }

    #curated .product-info a {
        font-size: 20px;
    }

    #curated .product-info label {
        font-size: 15px;
        text-transform: uppercase;
    }
    #curated .owl-item .product-price {
        font-size: 13px;
    }

    #product-alert .error.active + div,
    #product-alert .error {
        display: none;
    }
    #product-alert .error.active {
        display: block;
    }
</style>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/plugins/cookie/jquery.cookie.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript">
    $(function() {
        $('#menu a[href="'+ window.location.href +'"]').append('<hr />').addClass('active');
        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '<?php print($this->category->getTags()); ?>');

        var mapping = $.cookie('_catalog_mapping');
        if (mapping)
        {
            mapping = JSON.parse(mapping);
            if(mapping.origin == window.location.href)
                product.params = mapping.params;

            $.cookie('_catalog_mapping', '');
        }

        product.controller(function(data) {
            $('#shopping-cart .badge').text(data.cart);
            $("#product-alert p").text(data.message);
            prompt_box('#product-alert', true);
        }).list();

        $('.filters  > label').click(function(e){
            var filter = $(this).prev();
            var name = filter.attr('name').substring('filters'.length);
            if (filter.val() !== 'oth')
            {
                var vals = "";
                if (name !== 'price')
                {
                    $(this).parent().find(':checked').each(function(){
                        if ($(this).attr('id') != filter.attr("id"))
                            vals += ","+ $(this).val();
                    });
                }

                if (! filter.is(':checked'))
                    vals += ","+filter.val();

                product.set('page', 1);
                product.set(name, vals.substring(1));
                product.list();
            }
        });

        $('.filter-price-range input').on('focus', function() {
            $('#'+ $(this).attr('aria-for')).prop('checked', true);
        });

        $('.filter-price-range button').click(function(){
            var min = parseFloat($('.filter-price-range input[name="filter-price-min"]').val());
            var max = parseFloat($('.filter-price-range input[name="filter-price-max"]').val());

            if (min < 1)
            {
                $('#product-alert .content-message p').text('Invalid entry of price range! price FROM should be not less than 1.');
                $('#product-alert .error').addClass('active');
                return prompt_box('#product-alert', true);
            }

            if (min > max)
            {
                $('#product-alert .content-message p').text('Invalid entry of price range! price TO should be higher than price FROM');
                $('#product-alert .error').addClass('active');
                return prompt_box('#product-alert', true);
            }

            if (max > 0)
            {
                product.set('price', 'oth');
                product.set('price_min', min);
                product.set('price_max', max);
                product.set('page', 1);
                product.list();
            }
        });

        $('.sidebar .filters').each(function(){
            if ($(this).height() > 172)
            {
                $(this).css({
                    "height": "172px",
                    "overflow-y": "scroll",
                    "margin-right": "8px"
                });
            }
        });

        product.do_please_wait = true;

        product.request('product/get/popularity', {limit: 12,page: 1}, function(data) {
            product.features('#popularity', data);
            $('#popularity .owl-carousel').owlCarousel({
                items: 4,
                itemsTabletSmall: [480, 1],
                itemsTablet: [768, 2],
                itemsDesktopSmall: [1024, 3],
                pagination: false
            });
            $('#popularity .owl-item > div').removeAttr('class');
        });

        product.request('product/get/curated', {limit: 8,page: 1}, function(data) {
            product.features('#curated', data);
            $('#curated .owl-carousel').owlCarousel({
                items: 2,
                itemsTabletSmall: [480, 1],
                itemsTablet: [768, 2],
                itemsDesktopSmall: [1024, 3],
                pagination: false
            });
            $('#curated .owl-item > div').removeAttr('class');

            $('#curated .owl-item .product-price').text('Click on item to buy');
        });

        $('.owl-btn').click(function(e){
            e.preventDefault();
            $('#'+ $(this).parent().prop('id') + ' .owl-carousel').trigger($(this).attr('aria-action'));
        });
    });
</script>
<div class="content-body">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-home"></i></a></li>
                <?php foreach($this->category->getParent() as $breadcrumb): ?>
                <li><a href="<?php echo base_url('catalog/'.$breadcrumb->id); ?>"><?php echo $breadcrumb->name; ?></a></li>
                <?php endforeach; ?>
                <li class="active"><?php echo $this->category->getName() !== false ? $this->category->getName() : 'Shop'; ?></li>
            </ol>
        </div>

        <div class="row">
            <!-- The Sidebar -->
            <div class="col-lg-3"><?php $this->view('common/sidebar'); ?></div>
            <!-- The Product blocking -->
            <div class="col-lg-9">
                <div class="content-product-boxes col-lg-12"></div>
                <div class="content-list-summary">
                    <span id="total" class="pull-right"></span>
                    <nav class="paginator"></nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="product-preview" class="prompt prompt-form" role="form">
    <div class="prompt-content">
        <a href="javascript:prompt_box('#product-preview',false);" class="prompt-close">&times;</a>
        <?php $this->view('product/view'); ?>
    </div>
</div>

<div id="product-alert" class="prompt prompt-alert" role="alert">
    <div class="prompt-content">
        <a href="javascript:prompt_box('#product-alert',false);" class="prompt-close">&times;</a>
        <div class="content-message">
            <p></p>
            <div class="error content-buttons">
                <a href="javascript:$(this).parent().removeClass('active'); prompt_box('#product-alert',false);" class="btn btn-danger">Close</a>
            </div>
            <div class="content-buttons">
                <a href="<?php echo base_url('shopping-cart'); ?>" class="btn btn-danger">View Cart</a>
                <a href="javascript:prompt_box('#product-alert',false);prompt_box('#product-preview',false);" class="btn btn-default">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>

<div id="loading" class="prompt prompt-loading" role="loading">
    <div class="prompt-content">
        <span class="please-wait"></span> Please wait
    </div>
</div>

<div class="container-fluid">
    <div id="popularity" class="content-promoter">
        <h2>Most Popular</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="owl.prev"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="owl-btn next" aria-action="owl.next"><i class="fa fa-chevron-right"></i></a>
    </div>
</div>

<div class="container-fluid">
    <div id="curated" class="content-promoter">
        <h2>Curator's Picks</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="owl.prev"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="owl-btn next" aria-action="owl.next"><i class="fa fa-chevron-right"></i></a>
    </div>
</div>

<div class="JSProduct" id="js-product-box" aria-target=".content-product-boxes" aria-prompt="#product-preview">
    <div class="col-lg-3 col-md-3 col-sm-4">
        <?php $this->view('product/box', array('params' => false)); ?>
    </div>
</div>

<?php $this->view('common/subscribebar'); ?>
<?php $this->view('common/footer'); ?>