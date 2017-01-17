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
		if($orders){
			foreach($orders['orderlist'] AS $orderKey=>$v){ 
	?>
	<div <?php if ($orderKey != 0){ echo "style=\"margin-top: 200px; border-top: solid 2px black;\""; }?>>
		<form action="itemStatus/update" method="post" id="order<?php echo $orderKey+1; ?>">
			<input type="hidden" name="itemTotal" value="<?php echo count($v['itmelist']); ?>">
			<input type="hidden" name="sellersuite" value="<?php echo $orders['sellersuite']; ?>">
			<input type="hidden" name="orderID" value="<?php echo $v['txnRef']?>">
			<div class="product_table">
				<table style="width:100%" class="cartTable">
					<thead>
						<tr class="CartProduct cartTableHeader" <?php if ($orderKey != 0){ echo "style=\"opacity: 0; border-bottom: none;\""; }?>>
							<th class="hidden-xxs">IMAGE</th>
							<th class="hidden-xs">PRODUCT CODE</th>
							<th class="hidden-xs">PRICE</th>
							<th class="hidden-xs">QUANTITY ORDERED</th>
							<th class="hidden-xs">QUANTITY FULFILLED</th>
							<th class="hidden-xs">IF NOT FULFILLED</th>
							<th class="show-xs">INFO</th>
						</tr>
					</thead>
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
						foreach ($v['itmelist'] AS $itemKey => $v) {
					?>
					<tr class="CartProduct one_image">
						<!-- FORM ITEMS -->
						<input type="hidden" name="itemid<?php echo $itemKey+1; ?>" value="<?php echo $v['itemsid']?>">
						<input type="hidden" name="itemstatus<?php echo $itemKey+1; ?>" value="2">
						<!-- <input type="hidden" name="fulfilledqty<?php echo $itemKey+1; ?>" value="<?php echo $v['fulfilledqty']; ?>"> -->
						<input type="hidden" name="cancelReason<?php echo $itemKey+1; ?>" value="<?php echo $v['cancelreason'] != '' ? $v['cancelreason'] : ''; ?>">
						<td colspan="2" style="display:flex">
							<div class="item">
								<div class="product">
									<div class="image">
										<a href="<?php echo base_url('seller/sales/salesconfirmation'); ?>"><img src="<?php echo $v['imageurl'] ? $v['imageurl'] : base_url('assets/images/image-not-found/380x285.png'); ?>" alt="img" class="img-responsive"></a>
									</div>
								</div>
							</div>
							<div class="product-info" >
								<h3><?php echo $v['itemname']; ?></h3>
								<h3>SKU: <?php echo $v['merchantSKU'] ? $v['merchantSKU'] : 'N/A'; ?></h3>
								<h3>Color: <?php echo $v['color'] ? $v['color'] : 'N/A'; ?></h3>
								<h3>Size: <?php echo $v['size'] ? $v['size'] : 'N/A'; ?></h3>
							</div>
						</td>
						<td class="hidden-xs ">
							
						</td>
						<td class="hidden-xs"><h3>USD <?php echo $v['unitprice']; ?></h3></td>
						<td class="hidden-xs"><h3><?php echo $v['quantity'] ? $v['quantity'] : '0'; ?></h3></td>
						<td class="hidden-xs">
							<select class="form-control fulfilledqty_input" name="fulfilledqty<?php echo $itemKey+1; ?>">
								<option value="0"> - </option>
								<?php for ($i=1; $i <= $v['quantity']; $i++) { 
								?>
								<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
								<?php 
								}
								?>
							</select>
						</td>
						<td class="hidden-xs">
							<div class="margin-top20 select-reason">
								<div class="panel-group">
									<div class="panel panel-default " id="reason_selection">
										<div class="panel-heading">
											<h4 class="panel-title" >
												<a id="<?php echo ($orderKey +1).'_'.($itemKey +1)?>" data-toggle="collapse" href="#collapse<?php echo ($orderKey +1).'_'.($itemKey +1) ?>" >Select Reason</a>
											</h4>
										</div>
										<div id="collapse<?php echo ($orderKey +1).'_'.($itemKey +1) ?>" class="panel-collapse collapse cPanel">
											<div class="panel-body"><h3 data-value="reason1" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>">Reason1</h3><h3 data-value="reason2" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>">Reason2</h3><h3 data-value="reason3" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>">Reason3</h3><h3 data-value="reason4" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>">Reason4</h3><h3 data-value="reason5" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>">Reason5</h3></div>
										</div>
									</div>
								</div>
							</div>
						</td>
						<td class="show-xs">
							<h3><span>PRODUCT CODE: <p> <?php echo $v['merchantSKU'] ? $v['merchantSKU'] : 'N/A'; ?> </p></span></h3>
							<h3><span>PRICE: <p> USD <?php echo $v['unitprice']; ?> </p></span></h3>
							<h3><span>QUANTITY ORDERED: <p> <?php echo $v['quantity'] ? $v['quantity'] : '0'; ?> </p></span></h3>
							<h3>
								<span>QUANTITY FULFILLED: 
									<select class="form-control">
										<option> - </option>
										<?php for ($i=1; $i <= $v['quantity']; $i++) { 
										?>
										<option> <?php echo $i; ?> </option>
										<?php 
										}
										?>
									</select>
								</span>
							</h3>
							<h3>
								<div class="margin-top20 select-reason">
									<div class="panel-group">
										<div class="panel panel-default " id="reason_selection">
											<div class="panel-heading">
												<h4 class="panel-title" >
													<a data-toggle="collapse" href="#collapseSmol<?php echo $orderKey.'_'.$itemKey ?>" >Select Reason</a>
												</h4>
											</div>
											<div id="collapseSmol<?php echo $orderKey.'_'.$itemKey ?>" class="panel-collapse collapse cPanel">
												<div class="panel-body"><h3 value="reason1">Reason1</h3><h3 value="reason2">Reason2</h3><h3 value="reason3">Reason3</h3><h3 value="reason4">Reason4</h3><h3 value="reason5">Reason5</h3></div>
											</div>
										</div>
									</div>
								</div>
							</h3>
						</td>
					</tr>
					<?php 
						}
					?>
				</table>
			</div>
			<div class="button-div margin-top-10 pickup-div col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<div style="margin-top: 10px;">
					<input type="number" name="boxnumber" id="fulfillBoxes<?php echo $orderKey+1; ?>" class="form-control fulfillBox" placeholder="Number of Boxes to fulfill" min="1">
				</div>
				<div style="margin-top: 20px;">
					<a id="orderconfirm_fulfillBoxes_btn" class="btn btn-primary float-right redbtn squarebtn order_submit" data-order="order<?php echo $orderKey +1; ?>">Confirm Order</a>
				</div>
			</div>
		</form>
	</div>
	<?php }
		}
		else{

		}
    ?>
</div>
<!-- /main container -->

<div class="gap"></div>

<!-- Product Details Modal  -->
<div class="modal fade" id="boxLabelPopup" tabindex="-1" role="dialog"
	 aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title text-center">Order confirmed</h4>
		    </div>
			<div class="modal-body">
				<p class="text-center message">Please print these labels and stick them on each box.</p>
				<div id="boxLabels">
					<div id="boxLabels-contents"></div>
				</div>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4">
		            <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn newredBtn" onClick='window.location.href="ordersprocessed"' style="width: 100%;">OK</button>
		        </div>
		    </div>
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