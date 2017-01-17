<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header");
$this->load->library('seller'); ?>
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
		if($processed_orders && !empty($processed_orders['orderlist'])){
			foreach($processed_orders['orderlist'] AS $orderKey=>$v){ 
	?>
	<form id="order<?php echo ($orderKey+1); ?>" action="order/pickup" method="post">
		<input type="hidden" name="itemid" value="<?php echo $this->seller->getOrderItem($v,'itemsid') ?>">
		<input type="hidden" name="itemstatus" value="<?php echo $this->seller->getOrderItem($v,'status') ?>">
	</form>
	<div class="product-info-section" <?php if ($orderKey != 0){ echo "style=\"margin-top: 200px; border-top: solid 2px black;\""; }?>>
		<div class="product_table">
			<table style="width:100%" class="cartTable">
				<tr class="CartProduct cartTableHeader" <?php if ($orderKey != 0){ echo "style=\"opacity: 0; border-bottom: none;\""; }?>>
					<th class="hidden-xxs"><?php echo strtoupper($this->translations->web_seller_image); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_product_code); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_price); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_quantity_ordered); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_quantity_fulfilled); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_if_not_fulfilled); ?></th>
					<th class="show-xs"><?php echo strtoupper($this->translations->web_seller_info); ?></th>
				</tr>
				<tr> 
					<td colspan="3" class="awb_info">
						<div class="col-xs-12">
							<div style="display: inline-block;">
								<p><?php echo $this->translations->web_seller_order_no.': '.$v['txnRef']; ?></p>
								<p><?php echo $this->translations->web_seller_order_date.':  '.date('d M Y | g:i:s A',strtotime($v['createTime'])) ?></p>
							</div>
						</div>
					</td>
					<td colspan="3" class="awb_info right">
						<div class="col-xs-12">
							<p><?php echo $this->translations->web_seller_service_agreement.': '.($v['order_sla_days'] == 'N/A' ? 'N/A' : $v['order_sla_days'].' '.strtolower($this->translations->web_seller_days)); ?></p>
							<p><?php echo $this->translations->web_seller_pick_up_by_date; ?>: <?php echo date('d M Y | g:i:s A',strtotime($v['createTime'].' +'.$v['order_sla_days'].' days')); ?></p>
						</div>
					</td>
				</tr>
				<?php 
					foreach ($v['itmelist'] AS $itemKey => $itemV) {
				?>
				<tr class="CartProduct one_image">
					<td colspan="2" style="display:flex">
						<div class="item col-xs-4">
							<div class="product">
								<div class="image">
									<img src="<?php echo $itemV['imageurl']; ?>" alt="img" class="img-responsive">
								</div>
							</div>
						</div>
						<div class="product-info col-xs-8" >
							<h3 class="title"><?php echo $itemV['itemname']; ?></h3>
							<h3>Seller: <?php $itemurl = explode('/', $itemV['itemurl']); echo $this->seller_model->getProductProducer(end($itemurl)); ?></h3>
							<h3>SKU: <?php echo $itemV['merchantSKU'] ? $itemV['merchantSKU'] : 'N/A'; ?></h3>
							<h3><?php echo $this->translations->web_color; ?>: <?php echo $itemV['color'] != "null" ? $itemV['color'] : 'N/A'; ?>, <?php echo $this->translations->web_size; ?>: <?php echo $itemV['size'] != "null" ? $itemV['size'] : 'N/A'; ?></h3>
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
		<div class="button-div margin-top-10 pickup-div pull-right col-xs-12">
			<div class="row">
				<div id="datetime"></div>
				<div class="col-xs-12 text-right">
					<p><?php echo $this->translations->web_seller_fulfilled_in; ?> <?php echo $v['boxnumber'] == 1 ? $v['boxnumber'].' '.$this->translations->web_seller_package_s : $v['boxnumber'].' '.$this->translations->web_seller_package_s; ?></p>
				</div>
				
				<div class="col-md-2 col-sm-6 col-xs-6 pull-right" style="display: inline-table">
					<div class="row">
						<button id="pickup_btn" class="btn btn-primary float-right redbtn squarebtn pickup_btn" style="margin-top: 20px; padding: 0px 10px" data-order="order<?php echo ($orderKey+1)?>"><?php echo $this->translations->web_seller_arrange_pickup; ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
		}
		else{
	?>
	<div class="no-items">
		<img src="<?php echo base_url('seller/assets/images/noItems_toDisplay.jpg'); ?>" alt="No items to display">
	</div>
	<?php
		}
    ?>

    <div class="row" style="margin-top: 120px;">
		<div class="w100 categoryFooter">
		    <div class="pagination pull-right no-margin-top">
		        <ul class="pagination no-margin-top paginator">
		            
		        </ul>
		    </div>
		</div>
	</div>
</div>
<!-- /main container -->

<div class="gap"></div>


<?php 
$this->view("common/seller/subscribe");
$this->view("common/seller/footer");
?>


<!-- Product Details Modal  -->
<div class="modal fade" id="popupModal" tabindex="-1" role="dialog"
	 aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog" style="transform: translate(-50%, 10%);">
		<div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title text-center">Thank you</h4>
		    </div>
			<div class="modal-body">
				<p class="text-center">An email notification was sent to the warehouse requesting for pick up. Please prepare the package(s) between 9am and 2pm on your selected schedule of collection.</p>
				<p class="text-center">Upon collection, please enter the details on Order/Tracking Confirmation.</p>
				<p class="text-center">We look forward to your continued business. Thank you!</p>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4">
		            <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn newredBtn" data-dismiss="modal">Confirm</button>
		        </div>
		    </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->