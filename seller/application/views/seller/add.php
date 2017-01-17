<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header");?>

<!-- HIDDEN FORM -->
<?php 
	if (!empty($product)){
		for ($i = 0; $i < count($product['prod_cat']); $i++){
			$tempCatIdArr = array_reverse(array_keys($product['prod_cat']));
			if ($i == 0){
				$product['item_cat'] = $tempCatIdArr[$i];
			}
			else{
				$product['item_'.str_repeat('sub',$i).'cat'] = $tempCatIdArr[$i];
			}
		}
	}
 ?>
<form action="" id="itemForm">
	<?php if (($formMode == 'edit') && !empty($product)){
		echo form_hidden('item_product_id', !empty($product) ? $product['id'] : '');
	} ?>
	<input type="hidden" name="item_name" value="<?php echo !empty($product) ? $product['name'] : ''; ?>" >
	<input type="hidden" name="item_desc" value="<?php echo !empty($product) ? $product['description'] : ''; ?>" >
	<input type="hidden" name="item_producer_id" value="<?php echo !empty($product) ? $product['producer_id'] : ''; ?>" >
	<input type="hidden" name="item_cat_id" value="<?php echo !empty($product['item_cat']) ? $product['item_cat'] : ''; ?>" >
	<input type="hidden" name="item_subcat_id" value="<?php echo !empty($product['item_subcat']) ? $product['item_subcat'] : ''; ?>" >
	<input type="hidden" name="item_subsubcat_id" value="<?php echo !empty($product['item_subsubcat']) ? $product['item_subsubcat'] : ''; ?>" >
	<input type="hidden" name="item_subsubsubcat_id" value="<?php echo !empty($product['item_subsubsubcat']) ? $product['item_subsubsubcat'] : ''; ?>" >
	<input type="hidden" name="item_price" value="<?php echo !empty($product) ? $product['original_currency_price'] : '0'; ?>" >
	<input type="hidden" name="item_quantity" value="<?php echo !empty($product) ? $product['quantity'] : '0'; ?>" >
	<input type="hidden" name="item_discount" value="<?php echo !empty($product) ? $product['product_discount'] : '0'; ?>" >
	<input type="hidden" name="item_bulk_discount" value="<?php echo !empty($product) ? $product['bulk_discount'] : '0'; ?>" >
	<input type="hidden" name="item_minimum_order_size" value="<?php echo !empty($product) ? $product['bulk_discount'] : '0';?>" >
	<input type="hidden" name="item_color" value="<?php echo !empty($product) ? $product['color'] : ''; ?>" >
	<input type="hidden" name="item_size" value="<?php echo !empty($product) ? $product['size'] : ''; ?>" >
	<input type="hidden" name="item_weight" value="<?php echo !empty($product) ? $product['weight'] : '0'; ?>" >
	<input type="hidden" name="item_ship_in_a_box" value="<?php echo !empty($product) ? $product['ship_in_a_box'] ? 'true' : '' : ''; ?>" >
	<input type="hidden" name="item_length" value="<?php echo !empty($product) ? $product['length'] : '0'; ?>" >
	<input type="hidden" name="item_width" value="<?php echo !empty($product) ? $product['width'] : '0'; ?>" >
	<input type="hidden" name="item_height" value="<?php echo !empty($product) ? $product['height'] : '0'; ?>" >
	<input type="hidden" name="item_sku" value="<?php echo !empty($product) ? $product['sku'] : ''; ?>" >
	<input type="hidden" name="item_merchant_sku" value="<?php echo !empty($product) ? $product['merchant_sku'] : ''; ?>" >
	<input type="hidden" name="item_merchant_sla" value="<?php echo !empty($product) ? $product['merchant_sla'] : ''; ?>" >
</form>
<!-- END HIDDEN FORM -->

<div class="main-container headerOffset formAddItem">
	<?php echo form_open('', array('id'=>'secretForm')); ?>
	<!-- Main component call to action -->
	<div class="container">
		<div class="row">
			<div class="breadcrumbDiv col-lg-12">
				<ul class="breadcrumb">
					<?php draw_seller_breadcrumb($this->uri->segment_array()); ?>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.row  -->

	
	<?php
		if (($formMode == 'edit') && empty($product)){
	?>
	<div class="container">
		<div class="no-items">
			<h1><?php echo form_label($this->translations->web_seller_product_not_found); ?></h1>
		</div>
	</div>
	<?php }
	else {
	?>

	<div class="panel-group" id="list-photo">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-caption">
					<a data-toggle="collapse" data-parent="#list-photo" href="#collapse1">PHOTO<i class="fa fa-check complete"></i><i class="fa fa-chevron-right direction"></i><i class="fa fa-chevron-down direction"></i></a>
				</h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse">
				<div class="sale-description form-group">
                	<div class="container">
                		<section>
                			<?php if(!empty($product) && !empty($product['images'])){
                				$images = $product['images'];
                			} ?>
                			<h2><?php echo form_label($this->translations->web_seller_photos); ?></h2>
                			<h3><?php echo form_label($this->translations->web_seller_drag_and_drop_at_least_one_photo_use_all_five_photos_to_show_different_angles); ?></h3>
                			<div class="row">
                				<div class="item_images col-xs-12 <?php if ((!isset($images)) || (count($images) < 5)){echo 'col-sm-10'; } ?>">
                					<div class="row">
                						<?php for($imageInd=0;$imageInd<5;$imageInd++){?>
                						<div class="my-col-5 col-xs-6 margin-top20">
                							<div class="product thumbnail-upload">
                								<input type="file" name="item-img<?php echo ($imageInd+1);?>" data-id="<?php echo ($imageInd+1);?>"; class="item-img" accept="image/*" style="<?php echo isset($images[$imageInd]) ? 'display: none' : ''?>"/>
                								<a class="add-img">
                									<img id="item-img-output<?php echo ($imageInd+1);?>" src="<?php echo isset($images[$imageInd]) ? $images[$imageInd]['fullpath'] : '';?>" alt="img" class="img-responsive image-thumb <?php echo isset($images[$imageInd]) ? 'active' : ''?>" data-imageid="<?php echo isset($images[$imageInd]) ? $images[$imageInd]['imageid'] : '';?>">
                									<button type="button" class="item_img_remove"><img src="<?php echo base_url($this->seller->img_dir.'seller/cross.png'); ?>" alt=""></button>
                									<h3 class="text-center" style="<?php echo isset($images[$imageInd]) ? 'display:none' : ''?>"><?php echo form_label($this->translations->web_seller_add_photo); ?></h3>
                								</a>
                								<div class="promotion"></div>
                							</div>
                						</div>
                						<?php } ?>
                					</div>
								</div>
								<?php if ((!isset($images)) || (count($images) < 5)): ?>
                                    <div class="col-xs-12 col-sm-2 formTips photos">
                                        <p><?php echo $this->translations->web_seller_use_high_quality_jpg_png_that_are_at_least_px_wide_we_recommend_px; ?></p>
                                        <p><?php echo $this->translations->web_seller_the_best_photos_use_natural_or_diffused_lighting_and_dont_use_a_flash; ?></p>
                                    </div>
							</div>
							<?php if ($formMode == 'edit'): ?>
                            <!-- <div class="row margin-top-10" style="padding-right: 30px">
                            	<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem" data-itemdetail="1">Update</button>
                            </div> -->
                            <?php endif; ?>
                            <?php endif; ?>
						</section>
					</div>
				</div>
			</div>
		</div>
  	</div>

	<!-- <div class="hori-stick"></div> -->
	
	<div class="panel-group" id="list-detail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-caption">
					<a data-toggle="collapse" data-parent="#list-detail" href="#collapse2">LISTING DETAILS<i class="fa fa-check complete"></i><i class="fa fa-chevron-right direction"></i><i class="fa fa-chevron-down direction"></i></a>
				</h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
				<div class="form-group required">
					<div class="container">
						<!-- <h2>Name and describe the item</h2> -->
						<section>
							<h2><?php echo form_label($this->translations->web_seller_listing_details); ?></h2>
							<div class="row">
								<div class="col-xs-12 col-sm-8">
									<?php echo form_label($this->translations->web_seller_item_name, '' ,array('class'=>'control-label')); ?>
									<?php echo form_input(array(
										'id' => 'product_name',
										'name' => 'product_name',
										'title' => $this->translations->web_seller_please_enter_the_product_name,
										'placeholder' => $this->translations->web_seller_product_name,
										'required' => '',
										'minlength' => 2,
										'class' => 'form-control val-list-detail',
										'value' => !empty($product) ? $product['name'] : ''
									)); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4 ">
									<?php echo form_label($this->translations->web_category, '' ,array('class'=>'control-label')); ?>
									<div id="cat-dropdown" class="dropdown">
										<button class="col-xs-12 dropdown-toggle" type="button" data-toggle="dropdown" data-cat_id="<?php echo !empty($product['item_cat']) ? $product['item_cat'] : ''; ?>" data-subcat_id="<?php echo !empty($product['item_subcat']) ? $product['item_subcat'] : ''; ?>" data-subsubcat_id="<?php echo !empty($product['item_subsubcat']) ? $product['item_subsubcat'] : ''; ?>" data-subsubsubcat_id="<?php echo !empty($product['item_subsubsubcat']) ? $product['item_subsubsubcat'] : ''; ?>"><?php echo (empty($product)) ? $this->translations->web_seller_select_cat : implode('>',array_values($product['prod_cat'])); ?><span class="caret"></span></button>
										<?php echo $this->seller_model->renderCategoryList($category); ?>


									</div>
									<!-- <div class="panel-group no-margin-bottom category-holder" data-num="1">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title" >
													<a data-toggle="collapse" href="#collapse1" id="select-cat-1" data-id="">Select Category</a>
												</h4>
											</div>
											<div id="collapse1" class="panel-collapse collapse cPanel">
												<div class="panel-body padding-left80">
													<?php
													foreach(json_decode($category,1) AS $k=>$v){
													echo '<h3 class="category" data-id="'.$k.'" data-num="1">'.$v['name'].'</h3>';
													}
													?>
												</div>
											</div>
										</div>
									</div> -->
								</div>
								<div class="col-xs-12 col-sm-4">
									<?php echo form_label($this->translations->web_seller_merchant, '' ,array('class'=>'control-label')); ?>
									<?php
										$options = array();
										foreach($this->seller_model->getMerchants() as $i => $v):
											$options[$v['id']] = $v['name'];
										endforeach;
										echo form_dropdown('producer_id', $options, !empty($product) ? $product['producer_id'] : '0', 'class="form-control" name="producer_id" placeholder="Select Merchant" ');
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4">
									<?php echo form_label($this->translations->web_seller_price_thb, '' ,array('class'=>'control-label')); ?>
									<?php echo form_input(array(
										'type'	=>	'number',
										'min'	=>	0,
										'step'	=>	0.50,
										'id' => 'product_price',
										'name' => 'product_price',
										'title' => $this->translations->web_seller_input_product_price,
										'placeholder' => $this->translations->web_seller_price_thb,
										'required' => '',
										'class' => 'form-control val-list-detail',
										'value' => !empty($product) ? $product['original_currency_price'] : ''
									)); ?>
								</div>
								<div class="col-xs-12 col-sm-2">
									<?php echo form_label($this->translations->web_seller_qty_stock, '' ,array('class'=>'control-label')); ?>
									<?php echo form_input(array(
										'type'	=>	'number',
										'min'	=>	0,
										'id' => 'product_qty',
										'name' => 'product_qty',
										'title' => $this->translations->web_seller_input_quantity_in_stock,
										'placeholder' => $this->translations->web_seller_quantity_in_stock,
										'required' => '',
										'class' => 'form-control val-list-detail',
										'value' => !empty($product) ? $product['quantity'] : ''
									)); ?>
								</div>
							</div>
							<div class="row hidden-xs">
								<div class="col-sm-4">
									<?php echo form_label($this->translations->web_seller_seller_sku, '' ,array('class'=>'control-label')); ?>
								</div>
								<div class="col-sm-2">
									<?php echo form_label($this->translations->web_seller_bulk_discount_if_applicable, '' ,array('class'=>'control-label')); ?>
								</div>
								<div class="col-sm-2">
									<?php echo form_label($this->translations->web_seller_min_bulk_qty, '' ,array('class'=>'control-label')); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4">
									<?php echo form_label($this->translations->web_seller_seller_sku, '' ,array('class'=>'control-label show-xs')); ?>
									 <?php
										echo form_input(array(
										'id'=>'merchant_sku',
										'name'=>'merchant_sku',
										'class'=>'form-control val-list-detail',
										'placeholder'=>$this->translations->web_seller_seller_sku,
										'title' => $this->translations->web_seller_input_seller_sku,
										'required'=> '',
										'value'=>!empty($product) ? $product['merchant_sku'] : ''
									)); ?>
								</div>
								<div class="col-xs-12 col-sm-2">
									<?php echo form_label($this->translations->web_seller_bulk_discount_if_applicable, '' ,array('class'=>'control-label show-xs')); ?>
									<?php echo form_input(array(
										'type'			=>	'number',
										'min'			=>	0,
										'max'			=>	100,
										'id' 			=> 'bulk_discount',
										'name' 			=> 'bulk_discount',
										'placeholder' 	=> $this->translations->web_seller_discount,
										'class' 		=> 'form-control val-list-detail',
										'value' 		=> !empty($product) ? $product['bulk_discount'] : ''
									)); ?>
								</div>
								<div class="col-xs-12 col-sm-2">
									<?php echo form_label($this->translations->web_seller_min_bulk_qty, '' ,array('class'=>'control-label show-xs')); ?>
									<?php echo form_input(array(
										'type'			=>	'number',
										'min'			=>	0,
										'id' 			=> 'bulk_qty',
										'name' 			=> 'bulk_qty',
										'placeholder' 	=> $this->translations->web_seller_bulk_quantity,
										'class' 		=> 'form-control val-list-detail',
										'value' 		=> !empty($product) ? $product['minimum_order_size'] : ''
									)); ?>
								</div>
							</div>

							<?php
							if($formMode == 'edit'){
							?>
							<!-- <div class="row btn-responsive-update">
								<div class="col-xs-12">
									<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem" data-itemdetail="2">Update</button>
								</div>
							</div> -->
							<?php
								}
							?>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-group" id="list-description">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-caption">
					<a data-toggle="collapse" data-parent="#list-description" href="#collapse5">DESCRIPTION<i class="fa fa-check complete"></i><i class="fa fa-chevron-right direction"></i><i class="fa fa-chevron-down direction"></i></a>
				</h4>
			</div>
			<div id="collapse5" class="panel-collapse collapse">
				<div class="form-group required">
                	<div class="container">
                		<section>
           					<div class="row">
           						<div class="col-sm-8 col-xs-12">
           							<?php echo form_label('Description', '' ,array('class'=>'control-label')); ?>
           							<?php echo form_textarea(array(
           								'id' => 'product_desc',
           								'name' => 'product_desc',
           								'title' => 'Please enter the product description',
           								'placeholder' => 'Add Product Description',
           								'required' => '',
           								'class' => 'form-control val-list-desc',
           								'value' => !empty($product) ? $product['description'] : ''
           							)); ?>
           						</div>
           						<div class="col-xs-12 col-sm-2 pull-right formTips desc">
           							<p>Item description should be at the minimum of 150 characters.</p>
           						</div>
           					</div>
           					<?php
           					if($formMode == 'edit'){
           					?>
           					<div class="row btn-responsive-update">
           						<div class="col-xs-12">
           							<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem" data-itemdetail="2">Update</button>
           						</div>
           					</div>
           					<?php
           					}
           					?>
                		</section>
                	</div>
                </div>
			</div>
		</div>
	</div>
	<!-- <div class="hori-stick"></div> -->
	<div class="panel-group" id="list-option">
		<div class="panel panel-default">
			<div class="panel-heading completed">
				<h4 class="panel-caption">
					<a data-toggle="collapse" data-parent="#list-description" href="#collapse3">LISTING OPTIONS<i class="fa fa-check complete"></i><i class="fa fa-chevron-right direction"></i><i class="fa fa-chevron-down direction"></i></a>
				</h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse">
				<div class="form-group">
					<div class="container">
						<section class="item-option">
							<h2><?php echo $this->translations->web_seller_optional; ?></h2>
							<div class="row">
								<div class="col-xs-12 col-sm-8">
									<?php echo form_label($this->translations->web_seller_available_colors, '' ,array('class'=>'control-label')); ?>
									<div class="product-colors">
										<?php
											foreach(array('White','Black','Red','Orange','Yellow', 'Green', 'Blue', 'Indigo','Violet') AS $k => $v){

												echo form_checkbox(array('id'=>'color_'.$v,'name'=>'color_'.$v,'value'=>$v,'class'=>'product-option','checked'=>(!empty($product)) ? in_array($v, explode(',',$product['color'])) : false));
												echo form_label('<span class="glyphicon glyphicon-ok"></span>','color_'.$v, array('style'=>'background-color:'.$v));
											}
										 ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-2 pull-right formTips colors">
									<p><?php echo $this->translations->web_seller_you_can_select_as_many_colors_as_you_want_by_clicking_on_the_desired_color_s; ?></p>
									<p><?php echo $this->translations->web_seller_if_the_desired_color_is_not_listed_please_type_your_available_colors_on_the_item_description; ?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6">
									<?php echo form_label($this->translations->web_size, '' ,array('class'=>'control-label')); ?>
									<div class="product-sizes">

										<?php
											foreach(array($this->translations->web_seller_small,$this->translations->web_seller_medium,$this->translations->web_seller_large) AS $k => $v){
												echo '<div class="col-xs-4">';
												echo form_checkbox(array('id'=>'size_'.$v,'name'=>'size_'.$v,'value'=>$v,'class'=>'product-option','checked'=>(!empty($product)) ? in_array($v, explode(',',$product['size'])) : false));
												echo form_label('','size_'.$v);
												echo '<span>'.$v.'</span></div>';
											}
										 ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-2 pull-right formTips sizes">
									<p><?php echo $this->translations->web_seller_you_can_select_as_many_size_s_as_you_want; ?></p>
								</div>
							</div>
						</section>
						<?php
						if($formMode == 'edit'){
						?>
						<!-- <div class="row">
							<div class="col-xs-12 col-sm-2 pull-right">
								<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem"  data-itemdetail="4"><?php echo $this->translations->web_seller_update; ?></button>
							</div>
						</div> -->
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="hori-stick"></div> -->
	<div class="panel-group" id="list-ship">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-caption">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">SHIPPING DETAILS<i class="fa fa-check complete"></i><i class="fa fa-chevron-right direction"></i><i class="fa fa-chevron-down direction"></i></a>
				</h4>
			</div>
			<div id="collapse4" class="panel-collapse collapse">
				<div class="form-group required">
					<div class="container">
						<section class="shipping-description">
							<h2><?php echo $this->translations->web_seller_shipping_details; ?></h2>
							
							<!-- <h3>Shipping Weight (kg)</h3> -->
							<div class="row">
								<div class="col-sm-6 col-xs-12">
									<!-- <input type="number" min=0 max=2000 class="form-control" name="product_weight" placeholder="Weight" value="<?php echo !empty($product) ? $product['original_currency_price'] : '' ?>" > -->
									<?php echo form_label($this->translations->web_seller_shipping_weight_kg, '' ,array('class'=>'control-label')); ?>
									<?php echo form_input(array(
										'type'			=>	'number',
										'min'			=>	0,
										'max'			=>	2000,
										'step'			=>	0.50,
										'id' 			=> 'product_weight',
										'name' 			=> 'product_weight',
										'title'			=>	$this->translations->web_seller_input_product_weight,
										'required'		=>	'',
										'placeholder' 	=> $this->translations->web_seller_weight,
										'class' 		=> 'form-control val-list-ship',
										'value' 		=> !empty($product) ? $product['weight'] : ''
									)); ?>
								</div>
								<div class="col-sm-6 col-xs-12">
									<?php echo form_label('SLA (day)', '' ,array('class'=>'control-label')); ?>
									<?php echo form_input(array(
										'type'			=>	'number',
										'min'			=>	1,
										'max'			=>	365,
										'step'			=>	1,
										'id' 			=> 'product_sla',
										'name' 			=> 'product_sla',
										'title'			=>	'Input Product SLA',
										'required'		=>	'',
										'placeholder' 	=> 	'SLA',
										'class' 		=> 'form-control val-list-ship',
										'value' 		=> !empty($product) ? $product['merchant_sla'] : ''
									)); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="sib">
										<div class="col-xs-12">
											<div class="row">
												<?php
													$isSib = empty($product) ? false : $product['ship_in_a_box'];
													echo '<div class="col-xs-6">'.form_radio('shopinbox', '', !$isSib,'id="sib_false"').form_label('','sib_false').'<span>'.$this->translations->web_seller_ship_in_poly_bag.'</span></div>';
													echo '<div class="col-xs-6">'.form_radio('shopinbox', 'true', $isSib,'id="sib_true"').form_label('','sib_true').'<span>'.$this->translations->web_seller_ship_in_box.'</span></div>';
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="ship_product_dimensions" class="row" style="<?php echo !$isSib ? 'display: none' : 'display: block';?>">
								<div class="col-xs-12 col-sm-8">
									<?php echo form_label($this->translations->web_seller_product_dimensions_cm, '' ,array('class'=>'control-label')); ?>

									<div class="row">
									<?php
										foreach(array('length','width','height') AS $k => $v){
											$attributes = array('name' => 'product_'.$v, 'id' => 'product_dimension_'.$k, 'placeholder' => ucfirst($v).' (cm)', 'type'=>'number', 'min'=>'1', 'max'=>'999999', 'step' => 0.50,'class'=>'form-control val-list-ship', 'title' => 'Input product '.$v, 'value'=>!empty($product) ? $product[$v] : '');
											if (!$isSib){
												$attributes['disabled'] = '';
											}
											echo '<div class="col-xs-12 col-sm-4">'.form_input($attributes).'</div>';
										}
									?>
									</div>
								</div>
							</div>
						</section>
						<?php
						if($formMode == 'edit'){
						?>
						<!-- <div class="row btn-responsive-update">
							<div class="col-xs-12">
								<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem" data-itemdetail="5"><?php echo $this->translations->web_seller_update; ?></button>
							</div>
						</div> -->
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
    	}
    echo form_close('');
    ?>
	<!-- <div class="hori-stick"></div> -->
	<div class="form-action">
		<div class="col-xs-12 col-sm-6 pull-right no-padding">
			<div class="row">
				<?php   
					if($formMode == 'add'){
				?>
				<div class="col-xs-12 col-sm-6 col-sm-push-5">
					<button class="btn btn-primary col-xs-12 squarebtn addItem enabled"><i class="fa fa-plus"></i><?php echo $this->translations->web_seller_add_item; ?></button>
				</div>
				<?php
					}
					else {
				?>
					<div class="col-xs-12 col-sm-4">
						<button class="col-xs-12 btn btn-primary squarebtn actionBtn" data-name="<?php echo $product['name']; ?>" data-itemId="<?php echo $product['id']; ?>" data-suite="<?php echo $this->authuser->suite; ?>" data-type="unpublish"><i class="fa fa-eye-slash"></i>Unpublish</button>
					</div>
					<div class="col-xs-12 col-sm-4">
						<button class="col-xs-12 btn btn-primary squarebtn actionBtn" data-name="<?php echo $product['name']; ?>" data-itemId="<?php echo $product['id']; ?>" data-suite="<?php echo $this->authuser->suite; ?>" data-type="delete"><i class="fa fa-trash-o"></i>Delete</button>
					</div>
					<div class="col-xs-12 col-sm-4">
						<button class="col-xs-12 btn btn-primary squarebtn updateItem"><i class="fa fa-pencil"></i><?php echo $this->translations->web_seller_update; ?></button>
					</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>
<!-- /main container -->

<div class="gap"></div>
<?php if ($formMode == 'edit'):
?>
<!-- Delete Item Modal  -->
<div class="modal fade" id="deleteWarnPop" tabindex="-1" role="dialog"
	 aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Unpublish Item</h4>
			</div>
			<div class="modal-body">
				<p class="text-center message">Are you sure to unpublish this item?</p>
				<div id="boxLabels">
					<div id="boxLabels-contents"></div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 popPrintBtnContainer">
					<button type="button" id="deleteItem" class="btn btn-primary onenowBtn newredBtn deleteItem" style="width: 100%;" data-suite="<?php echo $this->authuser->suite; ?>" data-itemid="<?php echo $product['id']?>"><?php echo $this->translations->web_yes; ?></button>
				</div>
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
					<button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_no; ?></button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- Delete Item Modal  -->
<div class="modal fade" id="alertNotif" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
	 aria-labelledby="alertNotifModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Unpublish Item</h4>
			</div>
			<div class="modal-body">
				<p class="text-center message">Unpublishing item...</p>
				<div id="boxLabels">
					<div id="boxLabels-contents"></div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
					<button type="button" class="btn btn-primary onenowBtn newredBtn" data-dismiss="modal" style="width: 100%;">OK</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- Product Details Modal  -->
<div class="modal fade" id="itemsubmitPop" tabindex="-1" role="dialog" aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Item Edited</h4>
			</div>
			<div class="modal-body">
				<p class="text-center message">Your item will be temporarily unpublished while we review the changes made. Please check again in 24-48 hours.</p>
				<p class="text-center message">Thank you.</p>
			</div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popPrintBtnContainer">
					<button type="button" class="btn btn-primary onenowBtn" data-dismiss="modal" style="width: 100%;">OK</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
	else:

?>
<!-- Product Details Modal  -->
<div class="modal fade" id="itemsubmitPop" tabindex="-1" role="dialog" aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Item Submitted</h4>
			</div>
			<div class="modal-body">
				<p class="text-center message">Your item will be temporarily unpublished while we review the changes made. Please check again in 24-48 hours.</p>
				<p class="text-center message">We look forward to your continued business!</p>
			</div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popPrintBtnContainer">
					<button type="button" class="btn btn-primary onenowBtn dismissBtn" style="width: 100%;">OK</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
	endif;
?>
<!-- Delete Item Modal  -->
<div class="modal fade" id="actionWarnPop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Unpublish Item</h4>
            </div>
            <div class="modal-body">
                <p class="text-center message">Are you sure to unpublish this item from the store?</p>
                <div id="boxLabels">
                    <div id="boxLabels-contents"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-4 popPrintBtnContainer">
                    <button type="button" id="deleteItem" class="btn btn-primary onenowBtn newredBtn actionItem" data-itemId="" style="width: 100%;"><?php echo $this->translations->web_yes; ?></button>
                </div>
                <div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
                    <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_no; ?></button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Delete Item Modal  -->
<div class="modal fade" id="alertNotif" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="alertNotifModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Unpublish Item</h4>
            </div>
            <div class="modal-body">
                <p class="text-center message">Unpublishing item...</p>
                <div id="boxLabels">
                    <div id="boxLabels-contents"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
                    <button type="button" class="btn btn-primary onenowBtn newredBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_seller_ok; ?></button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Crop Image Modal  -->
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog"
	 aria-labelledby="itemImageCropModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center"><?php echo $this->translations->web_seller_crop_image; ?></h4>
			</div>
			<div class="modal-body">
				<p class="text-center message"></p>
				<div class="row">

						<div style="display: block; width: 300px; height: 300px; margin: 0 auto 40px auto;">
							<div id="upload-demo"></div>
						</div>
	
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-5 popPrintBtnContainer">
					<button type="button" id="cropImageBtn" class="btn btn-primary onenowBtn newredBtn cropImg" style="width: 100%;"><?php echo $this->translations->web_seller_crop; ?></button>
				</div>
				<div class="col-xs-12 col-sm-5 col-sm-offset-2 popDismissBtnContainer">
					<button type="button" id="cancelCropBtn" class="btn btn-primary onenowBtn" data-dismiss="modal" data-id="" style="width: 100%;"><?php echo $this->translations->web_seller_cancel; ?></button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Cropper Modal  -->
<div class="modal fade" id="cropperPop" tabindex="-1" role="dialog"
	 aria-labelledby="itemImageCropModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center"><?php echo $this->translations->web_seller_crop_image; ?></h4>
			</div>
			<div class="modal-body">
				<div class="row">

						<div style="display: block; width: 300px; height: 300px; margin: 0 auto 40px auto;">
							<img src="" id="upload-image">
						</div>
						<!-- <div id="cropper-container" style="display: block; width: 300px; height: 300px; margin: 0 auto 40px auto;">
							<!-- <img src="" id="upload-image">
							<canvas id="cropper-image"></canvas>
						</div> -->
	
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4 popPrintBtnContainer">
					<button type="button" id="cropImageBtn" class="btn btn-primary onenowBtn newredBtn cropImg" style="width: 100%;"><?php echo $this->translations->web_seller_crop; ?></button>
				</div>
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
					<button type="button" class="btn btn-primary onenowBtn cancelCropBtn" data-dismiss="modal" data-id="" style="width: 100%;"><?php echo $this->translations->web_seller_cancel; ?></button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php $this->view("common/seller/footer"); ?>