<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 7:09 PM
 * Description: Home page
 */
?>
<title>ONENOW - Shopping Cart</title>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/cart.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/cart.js'); ?>"></script>
<?php $this->view('common/header'); ?>
<style type="text/css">
    .product-weight {
        font-size: 12px;
    }
</style>

<div class="content-body">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-home"></i></a></li>
                <li class="active">Shopping Cart</li>
            </ol>
            <h4><?php echo $this->cart->count() < 1 ? 'No' : $this->cart->count(); ?> item<?php echo $this->cart->count() > 1 ? 's' : ''; ?> in your Shopping Cart</h4>
        </div>
        <div class="cart row">
        <?php if ($this->cart->count() > 0): ?>
            <div class="cart-content col-lg-9">
                <table>
                    <tr>
                        <th>Product</th>
                        <th width="140">Quantity</th>
                        <th width="110">Price</th>
                        <th width="60"><span class="sr-only">Delete</span></th>
                    </tr>
                    <?php foreach($this->cart->getAll() as $n => $item): ?>
                    <tr id="cart-<?php echo $n; ?>">
                        <td>
                            <div class="product-image">
                                <img src="<?php echo $item->image; ?>" alt="<?php echo $item->name; ?>">
                            </div>
                            <div class="product-detail">
                                <div class="product-name" aria-product="<?php echo $item->product; ?>" aria-category="<?php echo $item->category; ?>"><?php echo $item->name; ?></div>
                                <div class="product-options">
                                <?php if ($item->color !== 'none'): ?>
                                    <span class="product-color"><?php echo $item->color; ?></span>
                                <?php endif; ?>
                                <?php if ($item->size !== 'none'): ?>
                                    <span class="product-size"><?php echo $item->size; ?></span>
                                <?php endif; ?>
                                </div>
                                <?php $price = $this->cart->getPrice($item); ?>
                                <div class="product-price emphasis"><?php if ($this->cart->isDiscounted($item)) echo '<del style="color:#454545;">$'. number_format($item->price_usd, 2) .'</del> '; ?>$<?php echo $price; ?></div>
                                <div class="product-weight">Actual weight: <?php echo $item->weight; ?></div>
                                <div class="product-weight">Volume weight: <?php echo $this->cart->getVolumeWeight($item); ?></div>
                            </div>
                        </td>
                        <td>
                            <a href="#decrement" aria-target="<?php echo $n; ?>" class="btn btn-default"><i class="fa fa-minus"></i></a>
                            <input type="text" maxlength="3" class="product-quantity form-control" name="product-quantity" aria-target="<?php echo $n; ?>" value="<?php echo $item->quantity; ?>" />
                            <a href="#increment" aria-target="<?php echo $n; ?>" class="btn btn-default"><i class="fa fa-plus"></i></a>
                        </td>
                        <?php $total_price = (float)str_replace(',','',$price) * $item->quantity; ?>
                        <td class="product-price-total">
                            $<?php echo number_format($total_price, 2); ?>
                        </td>
                        <td>
                            <a href="#remove" title="Remove" aria-target="<?php echo $n; ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <div class="cart-controller">
                    <a href="#update" class="btn btn-danger">Update</a>
                    <a href="#checkout" class="btn btn-default">Checkout</a>
                </div>
            </div>
            <div class="cart-summary col-lg-3">
                <form method="POST" action=""></form>
                <table>
                    <tr>
                        <th><a href="#shop" class="btn btn-danger col-lg-12">Continue Shopping</a></th>
                    </tr>
                    <tr>
                        <td><div class="cart-summary-content">
                            <?php $total = $this->cart->getTotalPrice(); ?>
                            <div>Total Price <span class="cart-price">$<?php echo number_format($total, 2); ?></span></div>
                            <div>TOTAL <span class="cart-grand-total">$<?php echo number_format($total, 2); ?></span></div>
                        </div></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->view('common/footer'); ?>