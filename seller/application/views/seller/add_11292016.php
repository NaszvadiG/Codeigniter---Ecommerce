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
			<h1>Product not found</h1>
		</div>
	</div>
	<?php }
	else {
	?>
	<div class="sale-description form-group">
		<div class="container">
			<section>
				<?php if(!empty($product) && !empty($product['images'])){
					$images = $product['images'];
				} ?>
				<h2><?php echo form_label($this->translations->web_seller_photos); ?></h2>
				<?php if (($formMode == 'edit') && (count($images) < 5)): ?>
				<h3><?php echo form_label($this->translations->web_seller_drag_and_drop_at_least_one_photo_use_all_five_photos_to_show_different_angles); ?></h3>
				<?php endif; ?>
				<div class="row">
					<div class="item_images col-xs-12 <?php if ((!isset($images)) || (count($images) < 5)){echo 'col-sm-10'; } ?>">
						<div class="row">
							<?php for($imageInd=0;$imageInd<5;$imageInd++){?>
							<div class="my-col-5 col-xs-6 margin-top20">
								<div class="product thumbnail-upload">
									<?php 
									if (($formMode == 'edit') && (isset($images[$imageInd]))): ?>
									<a class="add-img">
										<img id="item-img-output<?php echo ($imageInd+1);?>" src="<?php echo isset($images[$imageInd]) ? $images[$imageInd]['fullpath'] : '';?>" alt="img" class="img-responsive image-thumb <?php echo isset($images[$imageInd]) ? 'active' : ''?>" data-edit="false">
									</a>
									<?php else: ?>
									<input type="file" name="item-img<?php echo ($imageInd+1);?>" data-id="<?php echo ($imageInd+1);?>"; class="item-img" accept="image/*" style="<?php echo isset($images[$imageInd]) ? 'display: none' : ''?>"/>
									<a class="add-img">
										<img id="item-img-output<?php echo ($imageInd+1);?>" src="<?php echo isset($images[$imageInd]) ? $images[$imageInd]['fullpath'] : '';?>" alt="img" class="img-responsive image-thumb <?php echo isset($images[$imageInd]) ? 'active' : ''?>">
										<button type="button" class="item_img_remove"><img src="<?php echo base_url($this->seller->img_dir.'seller/cross.png'); ?>" alt=""></button>
										<h3 class="text-center" style="<?php echo isset($images[$imageInd]) ? 'display:none' : ''?>"><?php echo form_label($this->translations->web_seller_add_photo); ?></h3>
									</a>
									<div class="promotion"></div>
									<?php endif; ?>
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
				<div class="row margin-top-10" style="padding-right: 30px">
					<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem" data-itemdetail="1">Update</button>
				</div>
					<?php endif; ?>
					<?php endif; ?>
			</section>
		</div>
	</div>

	<!-- <div class="hori-stick"></div> -->

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
							'class' => 'form-control',
							'value' => !empty($product) ? $product['name'] : ''
						)); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-4 hidden-sm hidden-xs">
						<?php echo form_label($this->translations->web_category, '' ,array('class'=>'control-label')); ?> 
						<div id="cat-dropdown" class="dropdown">

							<button class="col-xs-12 dropdown-toggle" type="button" data-toggle="dropdown" data-cat_id="<?php echo !empty($product['item_cat']) ? $product['item_cat'] : ''; ?>" data-subcat_id="<?php echo !empty($product['item_subcat']) ? $product['item_subcat'] : ''; ?>" data-subsubcat_id="<?php echo !empty($product['item_subsubcat']) ? $product['item_subsubcat'] : ''; ?>" data-subsubsubcat_id="<?php echo !empty($product['item_subsubsubcat']) ? $product['item_subsubsubcat'] : ''; ?>"><?php echo (empty($product)) ? $this->translations->web_seller_select_cat : implode('>',array_values($product['prod_cat'])); ?>
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li class="dropdown-submenu">
								<a class="category test" tabindex="-1" data-num="1" data-id="7"><?php echo form_label($this->translations->web_home_and_living); ?><i class="fa fa-caret-right"></i></a>
									<ul class="dropdown-menu">
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,11">Furniture</a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,12"><?php echo form_label($this->translations->web_dining); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,13"><?php echo form_label($this->translations->web_decorative_arts); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,14"><?php echo form_label($this->translations->web_lacquerware); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,15"><?php echo form_label($this->translations->web_lighting); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,17"><?php echo form_label($this->translations->web_cushions); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,18"><?php echo form_label($this->translations->web_glassware); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="7,48"><?php echo form_label($this->translations->web_benjarong); ?></a></li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a class="category test" tabindex="-1" data-num="1" data-id="8"><?php echo form_label($this->translations->web_clothing_and_accessories); ?><i class="fa fa-caret-right"></i></a>
									<ul class="dropdown-menu">
										<li><a class="category" tabindex="-1" data-num="2" data-id="8,19"><?php echo form_label($this->translations->web_apparel); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="8,20"><?php echo form_label($this->translations->web_shoes); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="8,21"><?php echo form_label($this->translations->web_jewelry); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="8,22"><?php echo form_label($this->translations->web_bags); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="8,23"><?php echo form_label($this->translations->web_hats_and_scarves); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="8,24"><?php echo form_label($this->translations->web_accessories); ?></a></li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a class="category test" tabindex="-1" data-num="1" data-id="9"><?php echo form_label($this->translations->web_health_and_beauty); ?><i class="fa fa-caret-right"></i></a>
									<ul class="dropdown-menu">
										<li><a class="category" tabindex="-1" data-num="2" data-id="9,34"><?php echo form_label($this->translations->web_skin_care); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="9,35"><?php echo form_label($this->translations->web_bath_and_body); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="9,36"><?php echo form_label($this->translations->web_hair_care); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="9,37"><?php echo form_label($this->translations->web_make_up); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="9,38"><?php echo form_label($this->translations->web_spa_treatment); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="9,39"><?php echo form_label($this->translations->web_balms); ?></a></li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a class="category test" tabindex="-1" data-num="1" data-id="10"><?php echo form_label($this->translations->web_food); ?><i class="fa fa-caret-right"></i></a>
									<ul class="dropdown-menu">
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,40"><?php echo form_label($this->translations->web_snacks); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,41"><?php echo form_label($this->translations->web_coffee); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,42"><?php echo form_label($this->translations->web_organic_food); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,43"><?php echo form_label($this->translations->web_cookies); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,44"><?php echo form_label($this->translations->web_jam_jelly_peanuts); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,45"><?php echo form_label($this->translations->web_butter); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,46"><?php echo form_label($this->translations->web_cocoa); ?></a></li>
										<li><a class="category" tabindex="-1" data-num="2" data-id="10,47"><?php echo form_label($this->translations->web_seasonings); ?></a></li>
									</ul>
								</li>
							</ul>
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
					<div class="col-xs-12 visible-xs visible-sm">
						<?php echo form_label($this->translations->web_category, '' ,array('class'=>'control-label')); ?>
						<div class="accordion" id="catAccordion">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#collapseCats" class="accordion-toggle" data-toggle="collapse" data-parent="#catAccordion">Select Category</a>
								</div>
								<div class="accordion-body collapse" id="collapseCats">
									<div class="accordion" id="accordion1">
										  <div class="accordion-group">
										    <div class="accordion-heading">
										      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" data-num="1" data-id="7">
										      <?php echo form_label($this->translations->web_home_and_living); ?>
										      </a>
										    </div>
										    <div id="collapseOne" class="accordion-body collapse">
										      <div class="accordion-inner">
											      <ul>
											        <li><a class="category" tabindex="-1" data-num="2" data-id="7,11">Furniture</a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="7,12"><?php echo form_label($this->translations->web_dining); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="7,13"><?php echo form_label($this->translations->web_decorative_arts); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="7,14"><?php echo form_label($this->translations->web_lacquerware); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="7,15"><?php echo form_label($this->translations->web_lighting); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="7,17"><?php echo form_label($this->translations->web_cushions); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="7,18"><?php echo form_label($this->translations->web_glassware); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="7,48"><?php echo form_label($this->translations->web_benjarong); ?></a></li>
												</ul>
										      </div>
										    </div>
										  </div>
										  <div class="accordion-group">
										    <div class="accordion-heading">
										      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo" data-num="1" data-id="8">
										      <?php echo form_label($this->translations->web_clothing_and_accessories); ?>
										      </a>
										    </div>
										    <div id="collapseTwo" class="accordion-body collapse">
										      <div class="accordion-inner">
												<ul>
													<li><a class="category" tabindex="-1" data-num="2" data-id="8,19"><?php echo form_label($this->translations->web_apparel); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="8,20"><?php echo form_label($this->translations->web_shoes); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="8,21"><?php echo form_label($this->translations->web_jewelry); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="8,22"><?php echo form_label($this->translations->web_bags); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="8,23"><?php echo form_label($this->translations->web_hats_and_scarves); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="8,24"><?php echo form_label($this->translations->web_accessories); ?></a></li>
										        </ul>  

										        <!-- Inner accordion ends here -->
										      </div>
										    </div>
										  </div>
										  <div class="accordion-group">
										    <div class="accordion-heading">
										      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree" data-num="1" data-id="9">
										      <?php echo form_label($this->translations->web_health_and_beauty); ?>
										      </a>
										    </div>
										    <div id="collapseThree" class="accordion-body collapse">
										      <div class="accordion-inner">
												<ul>
													<li><a class="category" tabindex="-1" data-num="2" data-id="9,34"><?php echo form_label($this->translations->web_skin_care); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="9,35"><?php echo form_label($this->translations->web_bath_and_body); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="9,36"><?php echo form_label($this->translations->web_hair_care); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="9,37"><?php echo form_label($this->translations->web_make_up); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="9,38"><?php echo form_label($this->translations->web_spa_treatment); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="9,39"><?php echo form_label($this->translations->web_balms); ?></a></li>
												</ul>
										      </div>
										    </div>
										  </div>
										  <div class="accordion-group">
										    <div class="accordion-heading">
										      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour" data-num="1" data-id="10">
										      <?php echo form_label($this->translations->web_food); ?>
										      </a>
										    </div>
										    <div id="collapseFour" class="accordion-body collapse">
										      <div class="accordion-inner">
												<ul>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,40"><?php echo form_label($this->translations->web_snacks); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,41"><?php echo form_label($this->translations->web_coffee); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,42"><?php echo form_label($this->translations->web_organic_food); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,43"><?php echo form_label($this->translations->web_cookies); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,44"><?php echo form_label($this->translations->web_jam_jelly_peanuts); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,45"><?php echo form_label($this->translations->web_butter); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,46"><?php echo form_label($this->translations->web_cocoa); ?></a></li>
													<li><a class="category" tabindex="-1" data-num="2" data-id="10,47"><?php echo form_label($this->translations->web_seasonings); ?></a></li>
												</ul>
										      </div>
										    </div>
										  </div>
										</div>
								</div>
							</div>
						</div>
						
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
							'class' => 'form-control',
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
							'class' => 'form-control',
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
							'class'=>'form-control',
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
							'class' 		=> 'form-control',
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
							'class' 		=> 'form-control',
							'value' 		=> !empty($product) ? $product['minimum_order_size'] : ''
						)); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 col-xs-12">
						<?php echo form_label($this->translations->web_seller_description, '' ,array('class'=>'control-label')); ?> 
						<?php echo form_textarea(array(
							'id' => 'product_desc', 
							'name' => 'product_desc',
							'title' => $this->translations->web_seller_please_enter_the_product_description,
							'placeholder' => $this->translations->web_seller_add_description,
							'required' => '',
							'class' => 'form-control',
							'value' => !empty($product) ? $product['description'] : ''
						)); ?>
					</div>
					<div class="col-xs-12 col-sm-2 pull-right formTips desc">	
						<p><?php echo $this->translations->web_seller_item_description_should_be_at_the_minimum_of_characters; ?></p>
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

	<!-- <div class="hori-stick"></div> -->

	<div class="form-group">
		<div class="container">
			<section class="item-option">
			<h2><?php echo $this->translations->web_seller_optional; ?></h2>
				<div class="row">
					<div class="col-xs-12 col-sm-8">
						<?php echo form_label('Available Colors', '' ,array('class'=>'control-label')); ?>
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
						<p>If the desired color is not listed, please type your available colors on the item description.</p>
					</div>
				</div>
				<div class="row">	
					<div class="col-xs-12 col-sm-6">
						<?php echo form_label($this->translations->web_size, '' ,array('class'=>'control-label')); ?>
						<div class="product-sizes">

							<?php 
								foreach(array('Small','Medium','Large') AS $k => $v){
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
			<div class="row">
				<div class="col-xs-12 col-sm-2 pull-right">
					<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem"  data-itemdetail="4"><?php echo $this->translations->web_seller_update; ?></button>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>

	<!-- <div class="hori-stick"></div> -->

	<div class="form-group required">
		<div class="container">
			<section class="shipping-description">
			<h2><?php echo $this->translations->web_seller_shipping_details; ?></h2>
				<?php echo form_label($this->translations->web_seller_shipping_weight_kg, '' ,array('class'=>'control-label')); ?> 
				<!-- <h3>Shipping Weight (kg)</h3> -->
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<!-- <input type="number" min=0 max=2000 class="form-control" name="product_weight" placeholder="Weight" value="<?php echo !empty($product) ? $product['original_currency_price'] : '' ?>" > -->
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
							'class' 		=> 'form-control',
							'value' 		=> !empty($product) ? $product['weight'] : ''
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
										echo '<div class="col-xs-6">'.form_radio('shopinbox', '', !$isSib,'id="sib_false"').form_label('','sib_false').'<span>Ship in Poly Bag</span></div>';
										echo '<div class="col-xs-6">'.form_radio('shopinbox', 'true', $isSib,'id="sib_true"').form_label('','sib_true').'<span>Ship in Box</span></div>';
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
								$attributes = array('name' => 'product_'.$v, 'placeholder' => ucfirst($v).' (cm)', 'type'=>'number', 'min'=>'1', 'max'=>'999999', 'step' => 0.50,'class'=>'form-control', 'title' => 'Input product '.$v, 'value'=>!empty($product) ? $product[$v] : '');
								if (!$isSib){
									$attributes['disabled'] = '';
								}
								echo '<div class="col-xs-12 col-sm-4">'.form_input($attributes).'</div>';
							}
						?>
						</div>
						<p class="vol-weight"></p>
					</div>
				</div>
			</section>
			<?php   
			if($formMode == 'edit'){
			?>
			<div class="row btn-responsive-update">
				<div class="col-xs-12">
					<button type="button" class="btn btn-primary float-right grey-btn squarebtn updateItem" data-itemdetail="5"><?php echo $this->translations->web_seller_update; ?></button>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<?php   
		}
		echo form_close('');
	?>
	<!-- <div class="hori-stick"></div> -->
	<div class="container">
		
		<div class="col-xs-12 col-sm-6 pull-right">
			<div class="row">
				<?php   
					if($formMode == 'add'){
				?>
				<div class="col-xs-12 col-sm-6">
					<!-- <button class="btn col-xs-12 clearItemForm">Clear</button> -->
				</div>
				<div class="col-xs-12 col-sm-6">
					<button class="btn btn-primary col-xs-12 squarebtn addItem"><?php echo $this->translations->web_seller_add_item; ?></button>
				</div>
				<?php
					}
					else {
				?>
				<div class="col-xs-12 col-sm-10 pull-right">
					<div class="row">
						<button class="btn btn-primary col-xs-12 col-sm-10 pull-right squarebtn actionBtn" data-name="<?php echo $product['name']; ?>" data-itemId="<?php echo $product['id']; ?>" data-suite="<?php echo $_SESSION['suite']; ?>" data-type="delete">Delete Item</button>
					</div>
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
<textarea id="cat-json"><?php echo htmlentities($category); ?></textarea>

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
					<button type="button" id="deleteItem" class="btn btn-primary onenowBtn newredBtn deleteItem" style="width: 100%;" data-suite="<?php echo $_SESSION['suite']?>" data-itemid="<?php echo $product['id']?>"><?php echo $this->translations->web_yes; ?></button>
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
				<h4 class="modal-title text-center">Crop Image</h4>
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
				<div class="col-xs-12 col-sm-4 popPrintBtnContainer">
					<button type="button" id="cropImageBtn" class="btn btn-primary onenowBtn newredBtn cropImg" style="width: 100%;">Crop</button>
				</div>
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
					<button type="button" id="cancelCropBtn" class="btn btn-primary onenowBtn" data-dismiss="modal" data-id="" style="width: 100%;">Cancel</button>
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
				<h4 class="modal-title text-center">Crop Image</h4>
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
					<button type="button" id="cropImageBtn" class="btn btn-primary onenowBtn newredBtn cropImg" style="width: 100%;">Crop</button>
				</div>
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
					<button type="button" class="btn btn-primary onenowBtn cancelCropBtn" data-dismiss="modal" data-id="" style="width: 100%;">Cancel</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php $this->view("common/seller/footer"); ?>