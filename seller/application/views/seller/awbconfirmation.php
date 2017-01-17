<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
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
	<?php
		if($processed_orders){
			foreach($processed_orders['orderlist'] AS $orderKey=>$v){ 
				if ($v['orderStatus'] == '3') {
	?>
	<form id="order<?php echo ($orderKey+1); ?>" action="order/pickup" method="post">
		<input type="hidden" name="itemid" value="<?php echo $this->seller->getOrderItem($v,'itemsid') ?>">
		<input type="hidden" name="itemstatus" value="<?php echo $this->seller->getOrderItem($v,'status') ?>">
	</form>
	<div class="product-info-section" <?php if ($orderKey != 0){ echo "style=\"margin-top: 200px; border-top: solid 2px black;\""; }?>>
		<div class="product_table">
			<table style="width:100%" class="cartTable">
				<tr class="CartProduct cartTableHeader" <?php if ($orderKey != 0){ echo "style=\"opacity: 0; border-bottom: none;\""; }?>>
					<th class="hidden-xxs">IMAGE</th>
					<th class="hidden-xs">PRODUCT CODE</th>
					<th class="hidden-xs">PRICE</th>
					<th class="hidden-xs">QUANTITY ORDERED</th>
					<th class="hidden-xs">QUANTITY FULFILLED</th>
					<th class="hidden-xs">IF NOT FULFILLED</th>
					<th class="show-xs">INFO</th>
				</tr>
				<tr> 
					<td colspan="2" class="awb_info">
						<div class="row">
							<div class="col-sm-6 col-md-6 col-xs-6">
								<div style="display: inline-block; margin-left: calc(50% - 30px)">
									<p>Order No:</p>
									<p>Order Date:</p>
									<p>SLA:</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-xs-6">
								<p><?php echo $v['txnRef']; ?></p>
						<p><?php echo date('d M Y - g:i:s A',strtotime($v['createTime'])); ?></p>
						<p>7 days (<?php echo ceil((strtotime('+7 days',strtotime($v['createTime']))-time()) / 86400); ?> days left)</p>
							</div>
						</div>
					</td>
				</tr>
				<?php 
					foreach ($v['itmelist'] AS $itemKey => $itemV) {
				?>
				<tr class="CartProduct one_image">
					<td colspan="2" style="display:flex"><div class="item">
							<div class="product">
								<div class="image">
									<a href="<?php echo base_url('seller/orders/salesconfirmation'); ?>"><img src="<?php echo $itemV['imageurl'] ? $itemV['imageurl'] : base_url('seller/assets/images/noimg.jpg'); ?>" alt="img" class="img-responsive"></a>
								</div>
							</div>
						</div>
						<div class="product-info" >
							<h3><?php echo $itemV['itemname']; ?></h3>
							<h3>SKU: <?php echo $itemV['merchantSKU'] ? $itemV['merchantSKU'] : 'N/A'; ?></h3>
							<h3>Color: <?php echo $itemV['color'] ? $itemV['color'] : 'N/A'; ?></h3>
							<h3>Size: <?php echo $itemV['size'] ? $itemV['size'] : 'N/A'; ?></h3>
						</div>
					</td>
					<td class="hidden-xs ">
					</td>
					<td class="hidden-xs"><h3>USD <?php echo $itemV['unitprice']; ?></h3></td>
					<td class="hidden-xs"><h3><?php echo $itemV['quantity'] ? $itemV['quantity'] : '0'; ?></h3></td>
					<td class="hidden-xs"><h3><?php echo $itemV['fulfilledqty']; ?></h3></td>
					<td class="hidden-xs"><h3><?php echo $itemV['cancelreason']; ?></h3></td>
					<td class="show-xs">
						<h3><span>PRODUCT CODE: <p> <?php echo $itemV['merchantSKU'] ? $itemV['merchantSKU'] : 'N/A'; ?> </p></span></h3>
						<h3><span>PRICE: <p> USD <?php echo $itemV['unitprice']; ?> </p></span></h3>
						<h3><span>QUANTITY ORDERED: <p> <?php echo $itemV['quantity'] ? $itemV['quantity'] : '0'; ?> </p></span></h3>
						<h3><span>QUANTITY FULFILLED: <p> <?php echo $itemV['fulfilledqty']; ?> </p></span></h3>
					</td>
				</tr>
				<?php 
					}
				?>
			</table>
		</div>
		<div class="button-div margin-top-10 pickup-div col-lg-8 col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="awb_desc col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <p>Fulfilled in <?php echo $v['boxnumber'] == 1 ? $v['boxnumber'].' package' : $v['boxnumber'].' packages'; ?></p>
                    <?php 
                    	$coeff = 60 * 5;                    	
                    	$date = ceil(strtotime(date($v['itmelist'][0]['pickuptime'])) / $coeff) * $coeff;
                    	$pickupDate = date('D M d Y - g:iA' ,$date);

                     ?>
                    <p>Pickup arranged on: <?php echo $pickupDate ?></p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input id="awb_input" type="text" placeholder="Enter Tracking No." style="width: 100%; height: 40px; padding-left: 20px;" name="awbOrder2">
                    <a id="awb_btn" class="btn btn-primary float-right redbtn squarebtn awb_btn" data-order="order<?php echo ($orderKey+1)?>">Confirm</a>
                </div>
            </div>
        </div>
	</div>
	<?php 
				}
			}
		} 
	?>
</div>
<!-- /main container -->

<div class="gap"></div>

<!-- Product Details Modal  -->
<div class="modal fade" id="productSetailsModalAjax" tabindex="-1" role="dialog"
     aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php 
$this->view("common/seller/subscribe");
$this->view("common/seller/footer");
?>


<!-- Product Details Modal  -->
<div class="modal fade" id="popupModal" tabindex="-1" role="dialog"
	 aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true" data-invalid="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title text-center">Tracking No. Confirmed</h4>
		    </div>
			<div class="modal-body">
				<p class="text-center message">Please make sure you have the proper labels on each box before shipping.</p>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4">
		            <button type="button" id="awbPopupOk" class="btn btn-primary onenowBtn newredBtn">OK</button>
		        </div>
		    </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->