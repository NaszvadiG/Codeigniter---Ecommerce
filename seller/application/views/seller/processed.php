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

	<div class="product_table">
		<table style="width:100%" class="cartTable">
			<tr class="CartProduct cartTableHeader">
				<!-- <th></th> -->
				<th class="hidden-xs">ORDER DATE</th>
				<th class="hidden-xxs">IMAGE</th>
				<th class="hidden-xs">PRODUCT CODE</th>
				<th class="hidden-xs">PROCESSED DATE</th>
				<th class="show-xs">INFO</th>
			</tr>
			<?php
			if($processed['status'] == 'SUCCESS'){
				foreach($processed['products_list'] AS $k => $v){
					$list = array();
					$processdt = '28 SEP 2016 15:51';
					$list['orderid'] = $v['id'];
					$list['productcode'] = $v['id'];
					$list['orderdate'] = strtoupper(date('j M Y',strtotime('28 SEP 2016')));
					$list['imgurl'] = base_url('seller/sales/confirmation/'.$v['id']);
					$list['imgsrc'] = $v['image_full_path'];
					$list['processdt'] = strtoupper(date('j M Y',strtotime($processdt))).'<br>'.date('G:i',strtotime($processdt));
					?>
					<tr class="CartProduct one_image">
						<!-- <td><input type="checkbox" class="pickup-chk" value="<?php echo $list['orderid']; ?>"></td> -->
						<td class="hidden-xs"><h3><?php echo $list['orderdate']; ?></h3></td>
						<td><div class="item">
								<div class="product">
									<div class="image">
										<a href ="<?php echo $list['imgurl']; ?>"><img src="<?php echo $list['imgsrc']; ?>" alt="img" class="img-responsive"></a>
										<div class="promotion"><span class="new-product"> NEW</span> </div>
									</div>
								</div>
							</div>
						</td>
						<td class="hidden-xs"><h3><?php echo $list['productcode']; ?></h3></td>
						<td class="hidden-xs"><h3><?php echo $list['processdt']; ?></h3></td>
						<td class="show-xs">
							<h3><span>ORDER DATE: <p> <?php echo $list['orderdate']; ?></p></span></h3>
							<h3><span>PRODUCT CODE: <p> <?php echo $list['productcode']; ?></p></span></h3>
							<h3><span>PROCESSED DATE: <p> <?php echo $list['processdt']; ?></p></span></h3>
						</td>
						<td>
							<a class="btn btn-primary float-right grey-btn squarebtn" id="cancel_sale" data-id="<?php echo $list['orderid']; ?>" >Cancel</a>
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
                
			<a class="btn btn-primary float-right redbtn squarebtn" data-redirect="<?php echo base_url('seller/sales'); ?>" id="arrange_pickup">Pick Up Arranged</a>
		</div>
	</div>
</div>
<!-- /main container -->

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