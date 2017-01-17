<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
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
            <img src="<?php echo base_url('../assets/images/home-page/banners/banner-1.png'); ?>" alt="onenow">
            <div class="carousel-caption">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="row">
                            <h2><?php echo $this->translations->web_seller_join_the_platform; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="javascript:$('#ModalSignup').modal('show');void(0);" class="btn btn-danger"><?php echo $this->translations->web_seller_signup; ?></a>
                </div>
                <div class="row margin-top20">
                    <div class="col-xs-12 col-sm-9">
                        <div class="row">
                            <h2><?php echo $this->translations->web_seller_enjoy_wc; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url('../assets/images/home-page/banners/banner-2.png'); ?>" alt="onenow">

            <div class="carousel-caption">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="row">
                            <h2><?php echo $this->translations->web_seller_join_the_platform; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="javascript:$('#ModalSignup').modal('show');void(0);" class="btn btn-danger"><?php echo $this->translations->web_seller_signup; ?></a>
                </div>
                <div class="row margin-top20">
                    <div class="col-xs-12 col-sm-9">
                        <div class="row">
                            <h2 ><?php echo $this->translations->web_seller_enjoy_wc; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url('../assets/images/home-page/banners/banner-3.png'); ?>" alt="onenow">
            <div class="carousel-caption">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="row">
                            <h2><?php echo $this->translations->web_seller_join_the_platform; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="javascript:$('#ModalSignup').modal('show');void(0);" class="btn btn-danger"><?php echo $this->translations->web_seller_signup; ?></a>
                </div>
                <div class="row margin-top20">
                    <div class="col-xs-12 col-sm-9">
                        <div class="row">
                            <h2><?php echo $this->translations->web_seller_enjoy_wc; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                <a href="<?php echo base_url($link); ?>" target="_blank"><?php echo $name; ?></a>
            </div>
            <?php endforeach ?>
        </div>
    </div>



<div class="subscribe">
    <div class="row">
        <div class="inputdiv col-md-8 col-sm-8 col-xs-8" >
            <input style="padding: 0 20px;" type="text" class="email-bottom" placeholder="<?php echo $this->translations->web_enter_email; ?>" />
        </div>
        <div class="buttondiv col-md-4 col-sm-4 col-xs-4" >
            <button id="subscribe-btn" class="onenowBtn newredBtn"><?php echo $this->translations->web_sub; ?></button>
        </div>
    </div>
</div>
<?php $this->view("common/seller/footer"); ?>

<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>"></script>
<script type="text/javascript">
    $(function() {
        var product = new Product();
        // product.construct('.JSProduct', '<?php echo base_url(); ?>', 'print($this->category->getTags()); ');

        product.request('product/get/explored', {limit: 8,page: 1}, function(data) {
            $('#content-explore .row').html('');
            for(var i in data.list)
            {
                var content = '<img src="'+ data.list[i].image +'" />';
                    content += '<a href="<?php echo base_url('product/view'); ?>/'+ data.list[i].id+'">'+ data.list[i].name +'</a>';
                $('#content-explore .row').append('<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">'+content+'</div>');
            }
        });
    });
</script>