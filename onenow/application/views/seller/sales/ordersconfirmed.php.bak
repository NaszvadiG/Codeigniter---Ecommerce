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

	<form action="pickup" method="post" id="orders">
		<input type="hidden" name="itemid" value="<?php echo $this->seller->getItems($orders_processed['orderlist'],'itemsid') ?>">
		<input type="hidden" name="itemstatus" value="<?php echo $this->seller->getItems($orders_processed['orderlist'],'status') ?>">
	</form>
	
	<?php
		if($orders_processed && !empty($orders_processed['orderlist'])){
			foreach($orders_processed['orderlist'] AS $orderKey=>$v){ 
	?>
	<form id="order<?php echo ($orderKey+1); ?>" action="order/pickup" method="post">
		<input type="hidden" name="itemid" value="<?php echo $this->seller->getOrderItem($v,'itemsid') ?>">
		<input type="hidden" name="itemstatus" value="<?php echo $this->seller->getOrderItem($v,'status') ?>">
	</form>
	<div class="product-info-section" <?php if ($orderKey != 0){ echo "style=\"margin-top: 10px; border-top: solid 2px black;\""; }?>>
		<div class="product_table">
			<table style="width:100%" class="cartTable">
				<tr class="CartProduct cartTableHeader" <?php if ($orderKey != 0){ echo "style=\"opacity: 0; border-bottom: none;\""; }?>>
					<th class="hidden-xxs"><?php echo strtoupper($this->translations->web_seller_image); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_product_code); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_price); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_quantity_ordered); ?></th>
					<th class="hidden-xs"><?php echo strtoupper($this->translations->web_seller_quantity_fulfilled); ?></th>
					<th class="hidden-xs" style="width:18%;"><?php echo strtoupper($this->translations->web_seller_item_action); ?></th>
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
							<h3><?php echo $this->translations->web_seller; ?>: <?php $itemurl = explode('/', $itemV['itemurl']); echo $this->seller_model->getProductProducer(end($itemurl)); ?></h3>
							<h3>SKU: <?php echo $itemV['merchantSKU'] ? $itemV['merchantSKU'] : 'N/A'; ?></h3>
							<h3><?php echo $this->translations->web_color; ?>: <?php echo $itemV['color'] != "null" ? $itemV['color'] : 'N/A'; ?>, <?php echo $this->translations->web_size; ?>: <?php echo $itemV['size'] != "null" ? $itemV['size'] : 'N/A'; ?></h3>
						</div>
					</td>
					<td class="hidden-xs">
					</td>
					<td class="hidden-xs"><h3>USD <?php echo $itemV['unitprice']; ?></h3></td>
					<td class="hidden-xs"><h3><?php echo $itemV['quantity'] ? $itemV['quantity'] : '0'; ?></h3></td>
					<td class="hidden-xs"><h3><?php echo $itemV['fulfilledqty']; ?></h3></td>
					<td class="hidden-xs">
					<?php
							$item_id = $itemV['itemsid']; 
							echo $itemV['status'] != 'C' ? '<button class="btn btn-primary onenowBtn confirmActionBtn" data-order=#order'.($orderKey +1).' data-item='.$item_id.' data-item_id='.($itemKey).' data-status="C" style="margin-top: -15px;" data-toggle="modal" data-target="#cancelWarnPop" onClick=\'$("#cancelWarnPop .confirmActionBtn").data("item", '.$item_id.').data("target", $(this));\'><i class="fa fa-ban" aria-hidden="true"></i>'.$this->translations->web_seller_cancel_item.'</button>' : '<button class="btn btn-primary onenowBtn confirmActionBtn" data-order=#order'.($orderKey +1).' data-item='.$item_id.' data-item_id='.($itemKey).' data-status="P" style="margin-top: -15px;" disabled><i class="fa fa-ban" aria-hidden="true"></i>'.$this->translations->web_seller_item_cancelled.'</button>';
					
					 ?>
					</td>
					<td class="show-xs">
						<h3><span><?php echo strtoupper($this->translations->web_seller_product_code); ?>: <p> <?php echo $itemV['merchantSKU'] ? $itemV['merchantSKU'] : 'N/A'; ?> </p></span></h3>
						<h3><span><?php echo strtoupper($this->translations->web_price); ?>: <p> USD <?php echo $itemV['unitprice']; ?> </p></span></h3>
						<h3><span><?php echo strtoupper($this->translations->web_seller_quantity_ordered); ?>: <p> <?php echo $itemV['quantity'] ? $itemV['quantity'] : '0'; ?> </p></span></h3>
+						<h3><span><?php echo strtoupper($this->translations->web_seller_quantity_fulfilled); ?>: <p> <?php echo $itemV['fulfilledqty']; ?> </p></span></h3>
					</td>
				</tr>
				<?php 
					}
				?>
			</table>
		</div>
		<div class="button-div margin-top-10 pickup-div col-xs-12">
            <div class="row">
				<div class="col-sm-6 col-md-2 col-xs-6 col-xs-offset-6 pull-right">
					<div class="row">
						<a class="btn btn-primary float-right redbtn squarebtn arrange_pickup" id="arrange_pickup" style="margin: 10px 0px;" data-order="#order<?php echo ($orderKey+1); ?>" <?php echo in_array('2',explode('|',$this->seller->getOrderItem($v,'status'))) == true ? '>'.$this->translations->web_seller_for_pickup : ' disabled>'.$this->translations->web_seller_order_cancelled; ?></a>
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
	<div class="row button-div margin-top-10" style="border-top: 2px solid black;">
	</div>
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
<div class="modal fade" id="cancelWarnPop" tabindex="-1" role="dialog"
	 aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center"><?php echo $this->translations->web_seller_cancel_item; ?></h4>
			</div>
			<div class="modal-body">
				<p class="text-center message"><?php echo $this->translations->web_seller_are_you_sure_you_want_to_cancel_this_item; ?></p>
			</div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 popPrintBtnContainer">
					<button type="button" class="btn btn-primary onenowBtn confirmActionBtn" data-item="" style="width: 100%;"><?php echo $this->translations->web_yes; ?></button>
				</div>
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
					<button type="button" class="btn btn-primary onenowBtn newredBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_no; ?></button>
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