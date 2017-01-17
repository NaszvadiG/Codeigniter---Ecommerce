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
		if($orders_processed){
			foreach($orders_processed['orderlist'] AS $orderKey=>$v){ 
	?>

	<form id="order<?php echo ($orderKey+1); ?>" action="order/cancelItems" method="post">
		<input type="hidden" name="itemid" value="<?php echo $this->seller->getOrderItem($v,'itemsid') ?>">
		<input type="hidden" name="itemstatus" value="<?php echo $this->seller->getOrderItem($v,'status') ?>">
	</form>
	<?php 
			}
		}
	 ?>
		<div class="product_table">
			<table style="width:100%" class="cartTable">
				<tr class="CartProduct cartTableHeader">
					<th class="hidden-xs">ORDER DATE</th>
		            <th class="hidden-xxs">IMAGE</th>
		            <th class="hidden-xs">PRODUCT CODE</th>
		            <th class="hidden-xs">PROCESSED DATE</th>
		            <th class="show-xs">INFO</th>
				</tr>
				<?php
					if($orders_processed){
						foreach($orders_processed['orderlist'] AS $orderKey=>$v){ 
				?>
				<tr class="CartProduct one_image">
		            <td class="hidden-xs"><h3><?php echo date('d M Y',strtotime($v['createTime'])); ?></h3></td>
		            <td><div class="item">
		                    <div class="product">
		                        <div class="image">
		                            <a href="<?php echo base_url('seller/sales/salesconfirmation'); ?>"><img src="<?php echo $v['itmelist'][0]['imageurl'] ?>" alt="img" class="img-responsive"></a>
		                        </div>
		                    </div>
		                </div>
		            </td>
		            <td class="hidden-xs"><h3><?php echo $v['txnRef'] ?></h3></td>
		            <td class="hidden-xs"><h3><?php echo $v['orderStatus'] === 'C' ? date('d M Y',strtotime($v['itmelist'][0]['canceltime'])) : date('d M Y',strtotime($v['itmelist'][0]['fulfillmenttime'])); ?></h3></td>
		            <td class="show-xs">
		                <h3><span>ORDER DATE: <p> <?php echo date('d M Y',strtotime($v['createTime'])); ?> </p></span></h3>
		                <h3><span>PRODUCT CODE: <p> <?php echo $v['txnRef'] ?> </p></span></h3>
		                <h3><span>PROCESSED DATE: <p> <?php echo $v['orderStatus'] === 'C' ? date('d M Y',strtotime($v['itmelist'][0]['canceltime'])) : date('d M Y',strtotime($v['itmelist'][0]['fulfillmenttime'])); ?> </p></span></h3>
		            </td>
		            <td>
		            	<?php if ($v['orderStatus'] == '2') { ?>
		                <a class="btn btn-primary float-right grey-btn squarebtn cancel_sale" data-order="order<?php echo ($orderKey+1)?>" data-txnRef="<?php echo $v['txnRef'] ?>" id="cancel_sale">Cancel</a>
		                <?php } ?>
		            </td>
			    </tr>
			    <?php 
				    	}
				    } 
			    ?>
			</table>
		</div>
		<div class="row button-div margin-top-10">
	        <div class="col-sm-6 col-md-6 col-xs-6">
	            
	        </div>
	        <div class="col-sm-6 col-md-6 col-xs-6">
		        <a class="btn btn-primary float-right redbtn squarebtn" id="arrange_pickup">Arrange For Pickup</a>
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