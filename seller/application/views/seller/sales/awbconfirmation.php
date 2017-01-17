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
		if($processed_orders && !empty($processed_orders['orderlist'])){
			foreach($processed_orders['orderlist'] AS $orderKey=>$v){ 
				if ($v['orderStatus'] <= 1) {
	?>
	<form id="order<?php echo ($orderKey+1); ?>" action="order/pickup" method="post">
		<input type="hidden" name="itemid" value="<?php echo $this->seller->getOrderItem($v,'itemsid') ?>">
		<input type="hidden" name="itemstatus" value="<?php echo $this->seller->getOrderItem($v,'status')?>">
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
							<h3><?php echo $itemV['itemname']; ?></h3>
							<h3><?php echo $this->translations->web_seller; ?>: <?php $itemurl = explode('/', $itemV['itemurl']); echo $this->seller_model->getProductProducer(end($itemurl)); ?></h3>
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
						<h3><span><?php echo strtoupper($this->translations->web_seller_product_code); ?>: <p> <?php echo $itemV['merchantSKU'] ? $itemV['merchantSKU'] : 'N/A'; ?> </p></span></h3>
						<h3><span><?php echo strtoupper($this->translations->web_price); ?>: <p> USD <?php echo $itemV['unitprice']; ?> </p></span></h3>
						<h3><span><?php echo strtoupper($this->translations->web_seller_quantity_ordered); ?>: <p> <?php echo $itemV['quantity'] ? $itemV['quantity'] : '0'; ?> </p></span></h3>
						<h3><span><?php echo strtoupper($this->translations->web_seller_quantity_fulfilled); ?>: <p> <?php echo $itemV['fulfilledqty']; ?> </p></span></h3>
					</td>
				</tr>
				<?php 
					}
				?>
			</table>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
			<button target="_blank" id="pickup-labelPrint" class="btn btn-primary redbtn squarebtn viewBoxLabelBtn" data-order=<?php echo $v['txnRef'] ?> data-sellersuite=<?php echo $processed_orders['sellersuite'] ?> data-boxnumber=<?php echo $v['boxnumber']?> data-merchant=<?php echo $v['itmelist'][0]['itemmerchant']; ?> style="margin-top: 60px;"><?php echo $this->translations->web_seller_view_order_label_s; ?></button>
		</div>
		<div class="button-div margin-top-10 pickup-div pull-right col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="awb_desc col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <p><?php echo $this->translations->web_seller_fulfilled_in; ?> <?php echo $v['boxnumber'] == 1 ? $v['boxnumber'].' '.$this->translations->web_seller_package_s : $v['boxnumber'].' '.$this->translations->web_seller_package_s; ?></p>
                    <?php 
                    	$coeff = 60 * 5;                    	
                    	$date = ceil(strtotime(date($v['itmelist'][0]['pickuptime'])) / $coeff) * $coeff;
                    	$pickupDate = date('D M d Y - g:iA' ,$date);

                     ?>
                    <p><?php echo $this->translations->web_seller_pickup_arranged_on; ?>: <?php echo $pickupDate ?></p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 tracking_confirmation" <?php if ($v['itmelist'][0]['airwaybill']) echo 'style="display:block"'; ?>>
                    <p class="text-center"><?php echo $this->translations->web_seller_package_s_submitted_to; ?></p>
                    <p class="text-center track_number"><?php echo $v['itmelist'][0]['airwaybill']; ?></p>
                </div>
 
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" <?php if ($v['itmelist'][0]['airwaybill']) echo 'style="display:none"'; ?>>
                    <input id="awb_input" type="text" placeholder="<?php echo $this->translations->web_seller_drivers_name_date_time_of_pickup; ?>" style="width: 100%; height: 40px; padding-left: 20px;" name="awbOrder2">
                    <a id="awb_btn" class="btn btn-primary float-right redbtn squarebtn awb_btn" data-order="order<?php echo ($orderKey+1)?>"><?php echo $this->translations->web_seller_confirm; ?></a>
                </div>
            </div>
        </div>
	</div>

	<?php 
				}
			}
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
		           <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn newredBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_seller_ok; ?></button>
		        </div>
		    </div>
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
			    <h4 class="modal-title text-center"><?php echo $this->translations->web_seller_tracking_no_confirmed; ?></h4>
		    </div>
			<div class="modal-body">
				<p class="text-center message"><?php echo $this->translations->web_seller_please_make_sure_you_have_the_proper_labels_on_each_box_before_shipping; ?></p>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4">
		            <button type="button" id="awbPopupOk" class="btn btn-primary onenowBtn newredBtn"><?php echo $this->translations->web_seller_ok; ?></button>
		        </div>
		    </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->