<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<div class="container main-container headerOffset">

	<!-- Main component call to action -->
	<div class="row">
		<?php $this->view('common/seller/breadcrumbs'); ?>
	</div>
	<!-- /.row  -->
	<div class="row">
		<?php $this->view('common/seller/order_search'); ?>
	</div>
	<div class="row order-filters">
		<div class="col-xs-4 filter-button-container">
			<div class="row">
				<button class="order-filter" type="button" data-filter_type="all"><?php echo $this->translations->web_seller_all_orders; if (!empty($orders['newOrders'])) echo '<span class="order_count" data-type="new">'.$orders['newOrders'].' NEW</span>';?></button>
			</div>
		</div>
		<div class="col-xs-4 filter-button-container">
			<div class="row">
				<button class="order-filter active" type="button" data-filter_type="standard"><?php echo $this->translations->web_seller_standard_orders; if (!empty($orders['newOrders'])) echo '<span class="order_count" data-type="new">'.$orders['newOrders'].' NEW</span>'; ?></button>
			</div>
		</div>
		<div class="col-xs-4 filter-button-container">
			<div class="row">
				<button class="order-filter" type="button" data-filter_type="customized"><?php echo $this->translations->web_seller_customized_orders; ?></button>
			</div>
		</div>
	</div>
	<?php 
		if($orders && !empty($orders['orderlist'])){
	 ?>
	<div class="row order-table">
		<table style="width:100%" class="cartTable product_table">
			<thead>
				<tr class="CartProduct cartTableHeader">
					<th class="hidden-xxs"><?php echo strtoupper($this->translations->web_seller_image); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_product_code); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_price); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_quantity_ordered); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_quantity_fulfilled); ?></th>
					<th class="hidden-xs" style="width: 15%;"><?php echo strtoupper($this->translations->web_seller_if_not_fulfilled); ?></th>
					<th class="show-xs"><?php echo strtoupper($this->translations->web_seller_info); ?></th>
				</tr>
			</thead>
			<?php
					foreach($orders['orderlist'] AS $orderKey=>$orderV){ 
			?>
			<tbody class="product-info-section" <?php echo 'data-order_id='.$orderKey.' '; if ($orderKey != 0){ echo "style=\"border-top: solid 2px black;\""; }?>>
				<!-- ORDER INFO -->
				<tr>
					<td colspan="3" class="awb_info">
						<!-- ORDER FORM -->
						<form action="itemStatus/update" method="post" id="order<?php echo $orderKey+1; ?>">
							<input type="hidden" name="sellersuite" value="<?php echo $orders['sellersuite']; ?>">
							<input type="hidden" name="orderID" value="<?php echo $orderV['txnRef']?>">
							<input type="hidden" name="itemmerchant" value="<?php echo $orderV['itmelist'][0]['itemmerchant']; ?>">
							<input type="hidden" name="itemid" value="<?php echo $this->seller->getOrderItem($orderV,'itemsid') ?>">
							<input type="hidden" name="itemstatus" value="<?php echo $this->seller->getOrderItem($orderV,'status') ?>">
							<input type="hidden" name="fulfilledqty" value="<?php echo $this->seller->getOrderItem($orderV,'fulfilledqty') ?>">
							<input type="hidden" name="cancelReason" value="<?php echo $this->seller->getOrderItem($orderV,'cancelreason') ?>">
							<input type="hidden" name="boxnumber" value="<?php echo $orderV['boxnumber'] ?>">
						</form>
						<!-- END ORDER FORM -->
						<div class="col-xs-12">
							<div style="display: inline-block;">
								<p><?php echo $this->translations->web_seller_order_no.': '.$orderV['txnRef']; ?></p>
								<p><?php echo $this->translations->web_seller_order_date.':  '.date('d M Y | g:i:s A',strtotime($orderV['createTime'])) ?></p>
							</div>
						</div>
					</td>
					<td colspan="3" class="awb_info right">
						<div class="col-xs-12">
							<p><?php echo $this->translations->web_seller_service_agreement.': '.($orderV['order_sla_days'] == 'N/A' ? 'N/A' : $orderV['order_sla_days'].' '.strtolower($this->translations->web_seller_days)); ?></p>
							<p><?php echo $this->translations->web_seller_pick_up_by_date; ?>: <?php echo date('d M Y | g:i:s A',strtotime($orderV['createTime'].' +'.$orderV['order_sla_days'].' days')); ?></p>
						</div>
					</td>
				</tr>
				<!-- ORDER ITEMS -->
				<?php 
					foreach ($orderV['itmelist'] AS $itemKey => $v) {
				?>
				<tr class="CartProduct one_image" data-item=<?php echo $v['itemsid']?>>
					<!-- FORM ITEMS -->
					
					<td style="display:flex" class="image_td">
						<div class="product">
							<div class="image">
								<img src="<?php echo $v['imageurl']; ?>" alt="img" class="img-responsive">
							</div>
						</div>
						<div class="product-info show-xs" >
							<div class="row">
								<h3 class="title"><?php echo $v['itemname']; ?></h3>
								<h3>SKU: <?php echo $v['merchantSKU'] ? $v['merchantSKU'] : 'N/A'; ?></h3>
								<h3><?php echo $this->translations->web_color; ?>: <?php echo $v['color'] != "null" ? $v['color'] : 'N/A'; ?></h3>
								<h3><?php echo $this->translations->web_size; ?>: <?php echo $v['size'] != "null" ? $v['size'] : 'N/A'; ?></h3>
							</div>
						</div>
					</td>
					<td class="hidden-xs">
						<div class="product-info " >
							<div class="row">
								<h3 class="title"><?php echo $v['itemname']; ?></h3>
								<h3><?php echo $this->translations->web_seller; ?>: <?php $itemurl = explode('/', $v['itemurl']); echo $this->seller_model->getProductProducer(end($itemurl)); ?></h3>
								<h3>SKU: <?php echo $v['merchantSKU'] ? $v['merchantSKU'] : 'N/A'; ?></h3>
								<h3><?php echo $this->translations->web_color; ?>: <?php echo $v['color'] != "null" ? $v['color'] : 'N/A'; ?>, <?php echo $this->translations->web_size; ?>: <?php echo $v['size'] != "null" ? $v['size'] : 'N/A'; ?></h3>
							</div>
						</div>
					</td>
					<td class="hidden-xs"><h3>USD <?php echo $v['unitprice']; ?></h3></td>
					<td class="hidden-xs"><h3><?php echo $v['quantity'] ? $v['quantity'] : '0'; ?></h3></td>
					<!-- FulfilledQty -->
					<td class="hidden-xs fulfilledqty">
						<select id="<?php echo ($orderKey +1).'_'.($itemKey +1)?>" data-item_id="<?php echo ($itemKey)?>" data-order="<?php echo ($orderKey +1)?>" class="form-control fulfilledqty_input" name="fulfilledqty<?php echo $itemKey+1; ?>">
							<option value="0"> - </option>
							<?php for ($i=1; $i <= $v['quantity']; $i++) { 
							?>
							<option value="<?php echo $i; ?>" <?php echo $i == $v['fulfilledqty'] ? 'selected' : '' ?>> <?php echo $i; ?> </option>
							<?php 
							}
							?>
						</select>
					</td>
					<!-- Select Reason -->
					<td class="hidden-xs">
						<div class="margin-top20 select-reason">
							<div class="panel-group">
								<div class="panel panel-default " id="reason_selection" style="border: none;">
									<div class="panel-heading">
										<h4 class="panel-title" >
											<button id="reasonBtn<?php echo ($orderKey +1).'_'.($itemKey +1)?>" data-toggle="collapse" data-collapse="#collapse<?php echo ($orderKey +1).'_'.($itemKey +1) ?>" data-order="#order<?php echo ($orderKey +1) ?>" data-item="<?php echo ($itemKey +1) ?>" class="<?php echo $v['fulfilledqty'] ? 'disabled' : '' ?>"><?php echo $v['cancelreason'] && $v['cancelreason'] !== ' ' ? $v['cancelreason'] : $this->translations->web_seller_select_reason; ?></button>
										</h4>
										<div id="collapse<?php echo ($orderKey +1).'_'.($itemKey +1) ?>" class="panel-collapse collapse cPanel">
											<div class="panel-body"><h3 data-value="Out Of Stock" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>"><?php echo $this->translations->web_seller_out_of_stock; ?></h3><h3 data-value="Price Increase" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>"><?php echo $this->translations->web_seller_price_increase; ?></h3><h3 data-value="Expired Order" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>"><?php echo $this->translations->web_seller_expired_order; ?></h3><h3 data-value="Change Of Mind" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>"><?php echo $this->translations->web_seller_change_of_mind; ?></h3><h3 data-value="Other Reason" data-targetOrder="<?php echo ($orderKey +1) ?>" data-targetItem="<?php echo $itemKey +1 ?>"><?php echo strtoupper($this->translations->web_seller_other_reasons); ?></h3></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</td>
					<!-- XSMODE -->
					<td class="show-xs">
						<div class="col-xs-12">
							<div class="row">
								<h3 class="col-xs-8 text-left"><?php echo strtoupper($this->translations->web_price); ?>:</h3>
								<p class="col-xs-4 text-right"> USD <?php echo $v['unitprice']; ?> </p>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="row">
								<h3 class="col-xs-8 text-left"><?php echo strtoupper($this->translations->web_seller_quantity_ordered); ?>:</h3>
								<p class="col-xs-4 text-right"><?php echo $v['quantity'] ? $v['quantity'] : '0'; ?></p>
							</div>
						</div>
						<h3>
							<span><?php echo strtoupper($this->translations->web_seller_quantity_fulfilled); ?>: 
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
												<a data-toggle="collapse" href="#collapseSmol<?php echo $orderKey.'_'.$itemKey ?>" ><?php echo$this->translations->web_seller_select_reason; ?></a>
											</h4>
										</div>
										<div id="collapseSmol<?php echo $orderKey.'_'.$itemKey ?>" class="panel-collapse collapse cPanel">
											<div class="panel-body">
												<h3 value="reason1"><?php echo $this->translations->web_seller_out_of_stock; ?></h3>
												<h3 value="reason2"><?php echo $this->translations->web_seller_price_increase; ?></h3>
												<h3 value="reason3"><?php echo $this->translations->web_seller_expired_order; ?></h3>
												<h3 value="reason4"><?php echo $this->translations->web_seller_change_of_mind; ?></h3>
												<h3 value="reason5"><?php echo $this->translations->web_seller_other_reasons; ?></h3></div>
										</div>
									</div>
								</div>
							</div>
						</h3>
					</td>
				</tr>
				<tr class="pickup_address" data-item=<?php echo $v['itemsid']?>>
					<td colspan="6">
						<div class="col-xs-12 col-sm-6 col-md-3">
							<?php if (isset($_SESSION['authuser']) && $this->authuser->suite == 'BTH-P'): ?>
							<div class="pickup_address_dropdown seller-dropdown dropdown">
								<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Select Pick Up Address <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php foreach ($pickup_address as $addrK => $addrV):?>
									<li>
										<a href="javascript:void(0)" data-id="<?php echo $addrK; ?>">
											<ul class="pickup_address_details">
												<li><?php echo $addrV['contact']; ?></li>
												<li class="address_line_1"><?php echo $addrV['address']; ?></li>
												<li><?php echo $addrV['address_line_2'].' '.$addrV['province'].', '.$addrV['city'].', '.$addrV['postal_code']; ?></li>
											</ul>	
										</a>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php endif; ?>
						</div>
					</td>
				</tr>
				<?php 
					}
				?>
				<!-- END ORDER ITEMS -->
				<!-- ORDER FOOTER -->
				<tr class="orderTableFooter">
					<td colspan="6">
						<div class="col-xs-12 col-sm-6">
							<div class="row">
								
							</div>
							
						</div>
						<div class="button-div pickup-div pull-right col-sm-6 col-xs-12">
							<div class="row">
								<div class="col-xs-12">
									<div style="margin-top: 10px;">
										<input type="number" name="boxnumber" id="fulfillBoxes<?php echo $orderKey+1; ?>" class="form-control fulfillBox" placeholder="Number of Packages fo Fulfill" min="1" data-order_id="<?php echo $orderKey +1; ?>" value="<?php echo ($orderV['boxnumber'] == 0 || '') ? '' : $orderV['boxnumber'] ?>">
									</div>
								</div>
							</div>
							<div class="row">							
								<div class="col-xs-6">
									<div style="margin-top: 10px;">
										<button id="ordersave_btn<?php echo $orderKey +1?>" class="btn btn-primary float-right redbtn squarebtn order_save" data-order="order<?php echo $orderKey +1; ?>"><i class="fa fa-save"></i> <?php echo $this->translations->web_seller_save_order; ?></button>
									</div>
								</div>
								<div class="col-xs-6">
									<div style="margin-top: 20px;">
										<a id="orderconfirm_fulfillBoxes_btn<?php echo $orderKey +1?>" class="btn btn-primary float-right redbtn squarebtn order_submit" data-order="order<?php echo $orderKey +1; ?>">
										<?php 
											$hasCancelled = false;
											$arr = array();
											foreach ($orderV['itmelist'] as $itemKey => $v) {
												$reason = $v['cancelreason'] == ' ' ? '' : $v['cancelreason'];
												array_push($arr, $reason);
												if ($reason == ''){
													$hasCancelled = true;
													break;
												}
											}
											echo $hasCancelled ? $this->translations->web_seller_confirm_order : 'Cancel Order';

										?></a>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<!-- END ORDER FOOTER -->
			</tbody>
			<?php
					}
			?>
		</table>
		<div class="w100 categoryFooter">
	        <div class="pagination pull-right no-margin-top">
	            <ul class="pagination no-margin-top paginator">
	                
	            </ul>
	        </div>
	    </div>
	</div>
	<div class="row order-customized">
		<div class="no-items">
			<img src="<?php echo base_url('seller/assets/images/noItems_toDisplay.jpg'); ?>" alt="<?php echo ($this->translations->web_seller_coming_soon); ?>">
		</div>
	</div>
	<?php 
		}else{
	 ?>
	<div class="no-items">
		<img src="<?php echo base_url('seller/assets/images/noItems_toDisplay.jpg'); ?>" alt="<?php echo ($this->translations->web_seller_you_currently_dont_have_any_pending_orders); ?>">
	</div>
	 <?php 
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
			<div class="modal-body">
				
		    </div>
			<div class="modal-footer">
				<div id="cancelOrderBtn" class="col-xs-12 col-sm-4 cancelOrderBtnGrp" style="display: none;">
		            <button type="button"  class="btn btn-primary onenowBtn newredBtn" data-order_id="1" data-boxnumber="" style="width: 100%;"><?php echo $this->translations->web_yes; ?></button>
		        </div>
		        <div id="cancelDismissBtn" class="col-xs-12 col-sm-4 col-sm-offset-4 cancelOrderBtnGrp"  style="display: none;">
		            <button type="button" class="btn btn-primary onenowBtn" style="width: 100%;" data-dismiss="modal"><?php echo $this->translations->web_no; ?></button>
		        </div>
				<div class="col-xs-12 col-sm-4 popPrintBtnGrp">
		            <button type="button" id="printLabelsBtn" class="btn btn-primary onenowBtn" data-order_id="" data-boxnumber="" style="width: 100%;"><?php echo $this->translations->web_print; ?></button>
		        </div>
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popPrintBtnGrp">
		           <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn newredBtn" onClick='window.location.href="/seller/orders/confirmed_orders"' style="width: 100%;"><?php echo $this->translations->web_seller_ok; ?></button>
		        </div>
		    </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="alertNotif" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="alertNotifModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Order Saved</h4>
            </div>
            <div class="modal-body">
                <p class="text-center message">Order updates has been successfully saved</p>
                <div id="boxLabels">
                    <div id="boxLabels-contents"></div>
                </div>
            </div>
            <div class="modal-footer">
				<div id="cancelOrderBtn" class="col-xs-12 col-sm-4 cancelOrderBtnGrp" style="display: none;">
		            <button type="button"  class="btn btn-primary onenowBtn newredBtn" data-order_id="1" data-boxnumber="" style="width: 100%;">Yes</button>
		        </div>
		        <div id="cancelDismissBtn" class="col-xs-12 col-sm-4 col-sm-offset-4 cancelOrderBtnGrp"  style="display: none;">
		            <button type="button" class="btn btn-primary onenowBtn" style="width: 100%;" data-dismiss="modal">No</button>
		        </div>
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popAlertBtnGrp">
		            <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn newredBtn" data-dismiss="modal" style="width: 100%;">OK</button>
		        </div>
		    </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php 
$this->view("common/seller/subscribe");
$this->view("common/seller/footer");
?>