<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 11/16/16 2:49 PM
 * Description:
 */



?>
<title>ONENOW - Curator's Pick</title>
<?php $this->view('common/header'); ?>

<div class="content-main">

    <div class="container content-category">
        <h2>Curator's Pick</h2>
        <div class="row">
            <div class="col-lg-6 category-image"><img src="<?php echo $this->category->getImage(); ?>" alt="<?php echo $this->category->getName(); ?>" class="img-responsive"></div>
            <div class="col-lg-6">
                <h3><?php echo $this->category->getName(); ?></h3>
                <?php echo $this->category->getDescription(); ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-product-boxes"></div>
            </div>
        </div>
    </div>

    <div id="curated" class="product-ads">
        <h2>Curator's Picks</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn prev" aria-action="prev.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-left.png'); ?>" /> </a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-right.png'); ?>" /></i></a>
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


<div class="JSProduct" id="js-product-box" aria-prompt="#product-preview">
    <div class="col-lg-3 col-md-3 col-sm-4">
        <?php $this->view('product/box', array('params' => false)); ?>
    </div>
</div>
<?php $this->view('common/footer'); ?>
<style type="text/css">
    .category-image {
        padding-top: 20px;
        text-align: center;
    }
    .category-image img {
        display: inline-block;
        vertical-align: top;
    }
    .content-category,
    #curated {
        margin-bottom: 30px;
    }
</style>

<script type="text/javascript">
    $(function(){
        var data = JSON.parse('<?php echo json_encode($this->category->products); ?>');

        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '<?php print($this->category->getTags()); ?>');

        for (var i in data)
        {
            product.make('.content-product-boxes', data[i]);
        }

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
    });
</script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/product.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/owl.carousel/assets/owl.carousel.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/owl.carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/plugins/cookie/jquery.cookie.js'); ?>"></script>