<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/29/16 2:26 PM
 * Description: Product order view.
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/product.css'); ?>" />
<style type="text/css">
    .product-descriptions .tab-content .tab-pane {
        padding: 15px;
        min-height: 72px;
    }
    .product-descriptions .nav-tabs li.active a {
        color: #F24B4B;
    }
    .product-descriptions .nav-tabs a {
        border-radius: 0;
        color: #454545;
    }
    .product-descriptions .nav-tabs a:hover {
        background-color: #EBEDEF;
    }
    .product-social label,
    .product-social nav {
        display: inline-block;
        vertical-align: top;
    }
    .product-social label {
        margin-right: 10px;
    }
    .product-social a {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-decoration: none;
        text-align: center;
        background: #454545;
        color: #fff;
        margin: 0 3px;
        -webkit-transition: background-color 300ms ease;
        -moz-transition: background-color 300ms ease;
        -o-transition: background-color 300ms ease;
        transition: background-color 300ms ease;
    }
    .product-social a:hover {
        background-color: #F24B4B;
    }
    .product-offered-price .deal-count-down {
        font-size: 16px;
        margin-bottom: 5px;
    }
    .product-offered-price .deal-count-down > span {
        margin-left: 15px;
        color: #F24B4B;
    }
    a[href="#qty-decrement"],
    a[href="#qty-increment"] {
        font-size: 14px;
        display: inline-block;
        vertical-align: top;
    }
</style>
<div class="content-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php $images = $this->product->getPhotos();
                $image = (sizeof($images) < 1 ? (object)array(
                        'photo' => base_url('assets/images/please-wait.gif'),
                        'zoomable' => 'false'
                ) : $images[0]);
                ?>
                <div class="product-image" aria-zoomable="<?php echo $image->zoomable; ?>">
                    <img src="<?php echo $image->photo; ?>" alt="<?php echo $this->product->getName(); ?>" onerror="this.src='<?php echo base_url('assets/images/image-not-found.png'); ?>';" />
                </div>
                <div class="product-image-thumbnails">
                    <?php if ($images): foreach ($images as $image): ?>
                        <a href="<?php echo $image->photo; ?>" aria-zoomable="<?php echo $image->zoomable; ?>"><img src="<?php echo $image->thumbnail; ?>" alt="<?php echo $this->product->getName(); ?>" onerror="this.src='<?php echo base_url('assets/images/image-not-found.png'); ?>';" /></a>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h2 class="product-name" aria-product="<?php echo $this->product->getId(); ?>"><?php echo $this->product->getName(); ?></h2>
                <!--<div class="product-ratings">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </div>-->
                <div class="product-offered-price">
                <?php if ($this->product->getPrice() < 1): ?>
                    <span class="price-list">Made to Order</span>
                <?php else: ?>
                    <span class="price-list">USD <?php echo number_format($this->product->getPrice_usd(), 2); ?></span>
                    <?php if ($this->product->getBulk_discount()): ?>
                        <span class="price-bulk">Bulk Purchase (<?php echo $this->product->getBulk_min_order(); ?>) USD <?php echo number_format($this->product->getBulk_discount_price(),2); ?></span>
                    <?php endif; ?>
                    <?php if($this->product->getDiscount() && $this->product->getDeal_expiry() > date('Y-m-d')): ?>
                        <span class="price-sale"><sup>Sale</sup> $<?php echo number_format($this->product->getPrice_usd_discount(),2); ?></span>
                        <span class="price-discount"><?php echo $this->product->getDiscount(); ?>% OFF</span>
                        <div class="deal-count-down">
                            Time left to buy <span></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
                <div class="product-options">
                    <label>Color</label>
                    <div class="product-colors">
                    <?php if ($colors = $this->product->getColors()): foreach ($colors as $color): ?>
                        <input type="radio" class="product-option" name="product-color" id="color-<?php echo $color; ?>" value="<?php echo $color; ?>" />
                            <label for="color-<?php echo $color; ?>"><span class="glyphicon glyphicon-ok"></span></label>
                    <?php endforeach; endif; ?>
                    </div>
                </div>
                <div class="product-options">
                    <label>Size</label>
                    <div class="product-sizes">
                        <?php if ($sizes = $this->product->getSizes()): foreach ($sizes as $size): ?>
                            <input type="radio" class="product-option" name="product-size" id="size-<?php echo $size; ?>" value="<?php echo $size; ?>" />
                                <label for="size-<?php echo $size; ?>"><?php echo $size; ?></label>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
                <div class="product-options">
                    <label for="product-quantity">Quantity</label>
                    <a href="#qty-decrement" class="btn btn-default"><i class="fa fa-minus"></i></a>
                    <input type="text" maxlength="3" class="form-control" name="product-quantity" id="product-quantity" value="1" />
                    <a href="#qty-increment" class="btn btn-default"><i class="fa fa-plus"></i></a>
                </div>
                <div class="product-options product-action-buttons">
                    <?php if ($this->product->getPrice() < 1): ?>
                    <button aria-action="mail" class="btn btn-danger">GET QUOTE</button>
                    <?php else: ?>
                    <button aria-action="add" class="btn btn-danger">ADD TO CART</button>
                    <?php endif; ?>
                    <!--<button aria-action="wish" class="btn btn-link">ADD TO WISHLIST</button>
                    <button aria-action="favorite" class="btn btn-link pull-right">FAVORITE SHOP <i class="fa fa-heart-o"></i></button>-->
                </div>

                <div class="product-options product-descriptions">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-details">Details</a></li>
                        <li><a data-toggle="tab" href="#tab-shipping">Shipping</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab-details" class="tab-pane fade in active">
                            <p><?php echo $this->product->getDescription(); ?></p>
                        </div>
                        <div id="tab-shipping" class="tab-pane fade">
                            <p>Express Delivery: <?php echo $this->product->getSeller_sla() + 7; ?> business days <br/>
                            Standard Delivery: <?php echo $this->product->getSeller_sla() + 9; ?> business days </p>
                        </div>
                    </div>
                </div>
                <div class="product-options product-social">
                    <label>SHARE</label>
                    <nav>
                        <a role="facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('product/view/'.$this->product->getId()); ?>','popup','width=600,height=600'); return false;"><i class="fa fa-facebook"></i></a>
                        <a role="twitter" onclick="window.open('http://twitter.com/share?url=<?php echo base_url('product/view/'.$this->product->getId()); ?>','popup','width=600,height=300'); return false;"><i class="fa fa-twitter"></i></a>
                        <a role="googleplus" onclick="window.open('https://plus.google.com/share?url=<?php echo base_url('product/view/'.$this->product->getId()); ?>','popup','width=600,height=600'); return false;"><i class="fa fa-google-plus"></i></a>
                        <a role="pinterest" onclick="window.open('https://pinterest.com/pin/create/button/?url=<?php echo base_url('product/view/'.$this->product->getId()); ?>&media=<?php echo $image->photo; ?>','popup','width=600,height=600'); return false;"><i class="fa fa-pinterest"></i></a>
                    </nav>
                </div>
                <?php /*<p>
                    <span class="glyphicon glyphicon-ok-circle"></span> IN STOCK <span class="glyphicon glyphicon-lock"></span> SECURE ONLINE ORDERING
                </p>*/ ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#product-quantity').on('keyup mouseleave', function(){
            var qty = $(this).val().replace(/[^0-9]/g, '');
            qty = parseInt(qty.length < 1 ? 1 : qty);
            $(this).val((qty < 1 ? 1 : qty));
        });
        $('a[href="#qty-decrement"], a[href="#qty-increment"]').click(function(e){
            e.preventDefault();
            var $qty = $('#product-quantity');
            var qty = parseInt($qty.val());
            if ($(this).attr('href') == '#qty-increment') ++qty;
            else --qty;
            if (qty < 1 || qty > 999)
                return false;
            $qty.val(qty);
        });
        $('.product-descriptions a').click(function (e) {
            $(this).tab('show');
        });
        if($('.deal-count-down span').length)
        {
            $('.deal-count-down span').countdown('<?php echo $this->product->getDeal_expiry(); ?>').on('update.countdown', function(event) {
                var format = '%H:%M:%S';
                if(event.offset.totalDays > 0) {
                    format = '%-d day%!d ' + format;
                }
                if(event.offset.weeks > 0) {
                    format = '%-w week%!w ' + format;
                }
                $(this).html(event.strftime(format));
            }).on('finish.countdown', function(e) {
                    var $productOfferedPrice = $('.content-product .product-offered-price');
                    if($productOfferedPrice.find('.price-sale').length > 0)
                        $productOfferedPrice.find('.price-sale').remove();
                    if($productOfferedPrice.find('.price-discount').length > 0)
                        $productOfferedPrice.find('.price-discount').remove();
                    if ($productOfferedPrice.find('.deal-count-down').length > 0)
                        $productOfferedPrice.find('.deal-count-down').remove();
            });
        }

<?php if($this->product->getPrice() < 1): ?>
        $('.product-offered-price .price-list').text('Made to Order');
        $('.product-action-buttons button:first()').attr('aria-action', 'mail').text('Get Quote');
<?php endif; ?>

        $('#tab-details a[href^="mailto"]').unbind('click');
        $('#tab-details a[href^="mailto"]').each(function(){
            $(this).attr('href', $(this).attr('href')+'?subject=Inquiring Product: '+ $('h2.product-name').text());
        });
    });
</script>

<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/plugins/countdown/jquery.countdown.min.js'); ?>"></script>