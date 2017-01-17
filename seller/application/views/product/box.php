<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/9/16 9:58 AM
 * Description: Category product box listing.
 */
$params = (object)(isset($params) && is_array($params) ? $params : array(
    'product' => '{PRODUCT_NAME}',
    'seller' => '{SELLER_NAME}',
    'price' => 0,
    'image' => base_url('assets/images/please-wait.gif')
));
?>
<div class="product-box">
    <div class="product-image">
        <a href="#quick-view">QUICK VIEW</a>
        <a href="#view"><img src="<?php echo $params->image; ?>" onerror="this.src='<?php echo base_url('assets/images/image-not-found.png'); ?>';" alt="picture-not-found" class="img-responsive" /></a>
    </div>
    <div class="product-info">
        <a href="#view"><?php echo $params->product; ?></a>
        <label>BY <?php echo $params->seller; ?></label>
    </div>

    <?php if (isset($params->price)): ?>
    <div class="product-price">USD <?php echo number_format($params->price, 2); ?></div>
    <?php endif; ?>
    <a href="#wish"><i class="fa fa-heart"></i></a>
</div>
<?php unset($params); ?>