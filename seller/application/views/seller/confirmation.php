<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); 

$color = (strpos($product['color'],',') !== FALSE) ? explode(',',$product['color']) : $product['color'];
$color = is_array($color) ? $color[rand(0,count($color) - 1)] : $color;
$size = (strpos($product['size'],',') !== FALSE) ? explode(',',$product['size']) : $product['size'];
$size = is_array($size) ? $size[rand(0,count($size) - 1)] : $size;

$prod['id'] = $product['id'];
$prod['name'] = $product['name'];
$prod['desc'] = $product['description'];
$prod['price'] = $product['price'];
$prod['img'] = $product['image_full_path'];
$prod['qty'] = rand(1,$product['quantity']);
$prod['color'] = ucwords($color);
$prod['size'] = ucwords($size);
$receive['line1'] = 'Consolidation Center';
$receive['line2'] = 'c/o Order: 123456789';
$receive['line3'] = 'Address Line 1';
$receive['line4'] = 'Address Line 2';
$receive['line5'] = 'City';

$cancelreason = array(
	'Card Issue',
	'Change of Mind',
	'Out of Stock - Partial No',
	'Price Increase',
	'Others',
);
?>
<div class="container main-container headerOffset">

	<!-- Main component call to action -->

	<div class="row">
		<div class="breadcrumbDiv col-lg-12">
			<ul class="breadcrumb">
				<?php draw_seller_breadcrumb($this->uri->segment_array()); ?>
			</ul>
		</div>
	</div>
	<!-- /.row  -->

	<h1>Sale Confirmation</h1>
	<div class="sale-description">
		<div class="row">
			<div class="col-sm-3 col-lg-3 col-md-3 col-xs-6">
				<div class="product">
					<div class="image">
						<a>
							<img src="<?php echo $prod['img']; ?>" alt="img" class="img-responsive">
						</a>
						<div class="promotion"></div>
					</div>
				</div>
			</div>
			<div class="col-sm-9 col-lg-9 col-md-9 col-xs-6">
				<h1><?php echo $prod['name']; ?></h1>
				<h3 style="padding:0">Product Description</h3>
				<h3><?php echo $prod['desc']; ?></h3>
			</div>
		</div>
		<div class="row margin-top20 total-description">
			<div class="col-sm-6 col-md-6 col-xs-6">
				<div class="row">
					<div class="col-sm-6 col-md-6 col-xs-6">
						<h2>Price:</h2>
					</div>
					<div class="col-sm-6 col-md-6 col-xs-6">
						<h2 style="color: #990000">$<?php echo $prod['price']; ?></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-xs-6">
						<h2>Quantity Bought:</h2>
					</div>
					<div class="col-sm-6 col-md-6 col-xs-6">
						<h2 style="color: #990000"><?php echo $prod['qty']; ?></h2>
					</div>
				</div>
				<div class="static-pan margin-top20">
					<h1>Ship To:</h1>
					<div>
						<h2><?php echo $receive['line1']; ?></h2>
						<h2><?php echo $receive['line2']; ?></h2>
						<h2><?php echo $receive['line3']; ?></h2>
						<h2><?php echo $receive['line4']; ?></h2>
						<h2><?php echo $receive['line5']; ?></h2>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-6">
				<div class="row">
					<div class="col-sm-6col-md-6 col-xs-6">
						<h2>Color:</h2>
					</div>
					<div class="col-sm-6 col-md-6 col-xs-6">
						<h2 style="color: #990000"><?php echo $prod['color']; ?></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-xs-6">
						<h2>Size:</h2>
					</div>
					<div class="col-sm-6 col-md-6 col-xs-6">
						<h2 style="color: #990000"><?php echo $prod['size']; ?></h2>
					</div>
				</div>
				<div class="margin-top20 select-reason">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title" >
									<a data-toggle="collapse" href="#collapse1" id="accordion-parent">Select Reason</a>
								</h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse cPanel">
								<div class="panel-body">
									<h3 class="accordion-option" data-value="Select Reason">Remove Reason</h3>
									<?php
									foreach($cancelreason AS $reason){
										echo '<h3 class="accordion-option" data-value="'.$reason.'">'.$reason.'</h3>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row button-div margin-top-10">
            <div class="col-sm-6 col-md-6 col-xs-6">
                <a class="btn btn-primary float-right redbtn squarebtn" id="confirm_sale" href="<?php echo base_url('seller/sales/processed'); ?>" data-id="<?php echo $prod['id']; ?>">Confirm</a>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-6">
                <a class="btn btn-primary float-right grey-btn squarebtn" id="cancel_sale" data-redirect="<?php echo base_url('seller/sales'); ?>" data-id="<?php echo $prod['id']; ?>">Cancel</a>
            </div>
        </div>
	</div>
</div>
<div class="gap"></div>

<!-- Product Details Modal  -->
<div class="modal fade" id="productSetailsModalAjax" tabindex="-1" role="dialog" aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="subscribe">
    <div class="row">
        <div class="inputdiv col-md-8 col-sm-8 col-xs-8" >
            <input style="padding: 0 20px;" type="text" class="email-bottom" placeholder="Enter email to receive a welcome gift" />
        </div>
        <div class="buttondiv col-md-4 col-sm-4 col-xs-4" >
            <button id="subscribe-btn">Subscribe</button>
        </div>
    </div>
</div>
<?php $this->view("common/seller/footer"); ?>