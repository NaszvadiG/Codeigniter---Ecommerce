<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 7:09 PM
 * Description: Home page
 */
?>
<title>ONENOW - Category</title>
<?php $this->view('common/header'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/product.css'); ?>" />

<div class="mirek-refine-icon">
    <p>REFINE RESULTS</p>
    <i class="fa  fa-filter"></i>
    <div class="mirek-filter">
        <ul class="mirek-filter-option">
            <li>
                <p>REFINE BY</p>
            </li>
            <li>
            <p>CATEGORY</p>
                <ul>
                    <li><i class="fa  fa-caret-right"></i><p>SACICT</p><li>
                    <li><i class="fa  fa-caret-right"></i><p>Leading Brands<li>
                    <li><i class="fa  fa-caret-right"></i><p>Home @ Living</li>
                </ul>
            </li>
            <li>
                <p>SELLER</p>
                <ul>
                    <li><i class="fa  fa-caret-right"></i><p>SACICT</p><li>

                 </ul>
            </li>
            <li>
                <p>PRICE</p>
                <ul>
                    <li><i class="fa  fa-caret-right"></i><p>Up to $75.00</p><li>
                    <li><i class="fa  fa-caret-right"></i><p>Up to $150.00</p><li>
                    <li><i class="fa  fa-caret-right"></i><p>Up to $200.00</p></li>
                </ul>
            </li>
            <li>
                <button>DONE</button>
            </li>


        </ul>
    </div>
</div>
<div class="mirek-content-product-list container-fluid">
    <div class="row mirek-items">
        <?php for($j=0; $j<3; $j++): ?>
            <?php for($i=0; $i<4; $i++): ?>
                <div><?php $this->view('product/box', array('params' => $params->popular[$i])); ?></div>
            <?php endfor; ?>
        <?php endfor; ?>
    </div>
    <div class="mirek-nav-buttons">
        <div>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>4</button>
            <button>5</button>
            <button>6</button>
            <button>7</button>
            <button class="next">NEXT</button>
        </div>
        <div>
            <p> 1-12 of 79 Products </p>
        </div>
    </div>
</div>
<div class="content-promoter container-fluid">
    <h2>Most Popular</h2>
    <div class="row product-slider slider-popular" >
        <?php for($i=0; $i<8; $i++): ?>
        <div><?php $this->view('product/box', array('params' => $params->popular[$i])); ?></div>
        <?php endfor; ?>
    </div>
</div>

<div id="content-curator" class="container-fluid">
    <h2>Curator's Picks</h2>
    <div class="row product-slider slider-curator">
        <?php for($i=0; $i<8; $i++): ?>
            <div ><?php $this->view('product/box', array('params' => $params->curator[$i])); ?></div>
        <?php endfor; ?>
    </div>
</div>

<?php $this->view('common/subscribebar'); ?>
<?php $this->view('common/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>