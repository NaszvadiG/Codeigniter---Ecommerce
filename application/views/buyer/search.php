<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 7:09 PM
 * Description: Home page
 */
?>
<title>ONENOW - Search Result</title>
<?php $this->view('common/header'); ?>

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
        font-size: 15px;
    }
    .content-list-summary nav,
    .content-list-summary {
        text-align: center;
    }
    #product-alert .error.active + div,
    #product-alert .error {
        display: none;
    }
    #product-alert .error.active {
        display: block;
    }
    .content-filter {
        margin-top: -15px;
        position: absolute;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        z-index: 1;
        background: rgba(200,200,200, 0.72);
        overflow: hidden;
    }
    .content-filter .filters > label > span {
        color: rgba(200,200,200, 0);
    }
    .content-filter .filters > input:checked + label > span {
        color: #fff;
    }
    .content-filter .sidebar label,
    .content-filter .sidebar a {
        border-top: none;
    }
    a[href="#content-filter"] {
        color: #454545;
        text-decoration: none;
        font-size: 18px;
        display: block;
        height: 50px;
        line-height: 50px;
        width: 165px;
        border: 1px solid #ccc;
        margin: 0 0 20px;
        text-align: center;
    }
    a.active[href="#content-filter"],
    a[href="#content-filter"]:hover {
        background: #F24B4B;
        color: #fff;
    }
    #menu nav {
        z-index: 5 !important;
    }
    #curated {
        margin-bottom: 70px;
    }
</style>


<div class="content-body">
    <div class="content-main">
        <div class="container-fluid">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-home"></i></a></li>
                    <li><a href="<?php echo base_url('catalog'); ?>">Catalog</a></li>
                    <li class="active">Search Result</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-product-boxes"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="content-list-summary">
                    <nav class="paginator"></nav>
                    <span id="total"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->view('product/marketing'); ?>

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

<div class="JSProduct" id="js-product-box" aria-target=".content-product-boxes" aria-prompt="#product-preview">
    <div class="col-lg-3 col-md-3 col-sm-4">
        <?php $this->view('product/box', array('params' => false)); ?>
    </div>
</div>

<?php $this->view('common/footer'); ?>

<script type="text/javascript">
    $(function() {
        $('#menu a[href="'+ window.location.href +'"]').append('<hr />').addClass('active');
        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '');

        var mapping = $.cookie('_catalog_mapping');
        if (mapping)
        {
            mapping = JSON.parse(mapping);
            if(mapping.origin == window.location.href) product.params = mapping.params;
        }

        product.set('search', '<?php echo $query; ?>');
        product.controller(function(data) {
            $('#shopping-cart .badge').text(data.cart);
            $("#product-alert p").text(data.message);
            prompt_box('#product-alert', true);
        }).list();

        product.do_please_wait = true;
    });
</script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/owl.carousel/assets/owl.carousel.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/owl.carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/plugins/cookie/jquery.cookie.js'); ?>"></script>
