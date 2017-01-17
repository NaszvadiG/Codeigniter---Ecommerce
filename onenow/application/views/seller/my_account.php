<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<div class="main-container headerOffset">
	<div class="container">
		<div class="row">
			<div class="breadcrumbDiv col-lg-12">
				<ul class="breadcrumb">
					<?php draw_seller_breadcrumb($this->uri->segment_array()); ?>
				</ul>
			</div>
		</div>
		<div class="row" style="padding:20px 0px">
			<div class="container">
				<div class="col-lg-9 col-md-9 col-sm-7">
					<!-- <h1 class="section-title-inner"><span><i class="fa fa-unlock-alt"></i> My account </span></h1> -->
					<div class="row userInfo">
						<div class="col-xs-12 col-sm-6">

								<h2 class="block-title-2"><?php echo form_label($this->translations->web_seller_basic_information); ?></h2>
							
								<?php if (($this->authuser->suite != 'BTH-N') && ($this->authuser->suite != 'BTH-P')): ?>
								<div>
									<?php echo form_label($this->translations->web_seller_store_name); ?>
									<p><?php echo $this->seller_model->getMerchants()[0]['name']; ?></p>
								</div>
								<?php endif; ?>
								<div class="col-xs-12">	
									<div class="row">	
										<div class="col-xs-5 seller-thumb">
											<div class="row">
												<?php echo form_label('Seller Photo'); ?> 
												<div class="seller thumbnail-upload">
													<input id="seller" type="file" name="seller-img" class="item-img" accept="image/*" style="<?php echo $photo_path ? 'display:none' : ''?>" />
													<a class="add-img">
														<img id="seller-img-output" src="<?php echo $photo_path ? $photo_path : '' ?>" alt="img" class="img-responsive image-thumb <?php echo $photo_path ? 'active' : ''?>">
														<button type="button" class="item_img_remove"><img src="<?php echo base_url($this->seller->img_dir.'seller/cross.png'); ?>" alt=""></button>
														<h3 class="text-center"  style="<?php echo $photo_path ? 'display:none' : ''?>"><?php echo form_label($this->translations->web_seller_add_photo); ?></h3>
													</a>
													<div class="promotion"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php echo form_open('seller/account/update','id="changeprofileinfoform"'); ?>
								<div class="form-group">
									<?php echo form_label($this->translations->web_seller_first_name); ?> 
									<?php echo form_input(array(
											'id' => 'regfirstname', 
											'name' => 'regfirstname',
											'title' => $this->translations->web_seller_please_enter_your_first_name_at_least_characters,
											'placeholder' => 'First name',
											'required' => '',
											'minlength' => 3,
											'class' => 'form-control',
											'value' => $firstName
										)); ?>
								</div>
								<div class="form-group">
									<?php echo form_label($this->translations->web_seller_last_name); ?> 
									<?php echo form_input(array(
											'id' => 'reglastname', 
											'name' => 'reglastname',
											'title' => $this->translations->web_seller_please_enter_your_last_name_at_least_characters,
											'placeholder' => 'Last name',
											'required' => '',
											'minlength' => 3,
											'class' => 'form-control',
											'value' => $lastName
										)); ?>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-md-9">
										<div class="row">
											<?php echo form_label($this->translations->web_seller_email_address); ?> 
											<div class="text-dynamic">
												<p><?php echo $email ?></p>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-3">
										<div class="row">
											<?php echo form_label($this->translations->web_seller_suite); ?> 
											<p><?php echo $suite ?></p>								
										</div>
									</div>
								</div>
								<div class="form-group">
									<?php echo form_label($this->translations->web_seller_gender); ?> 
									<p><?php echo $gender == 'M' ? $this->translations->web_seller_male : $this->translations->web_seller_female ?></p>
								</div>
								
								<div class="error">
									<?php echo form_error('regname'); ?>
									<?php echo form_error('regemail'); ?>
									<?php echo form_error('regpassword'); ?>
									<?php echo (isset($regmssg) ? $regmssg : ''); ?>
								</div>
			                        
								<?php echo form_button(array(
										'id' => 'updateProfile', 
										'class' => 'btn btn-primary squarebtn',
										'type' => 'submit'
									),'<i class="fa fa-pencil"></i>' . $this->translations->web_seller_update); ?>
			                        
								<?php echo form_close(); ?>

						</div>
						<div class="col-xs-12 col-sm-6">

								<h2 class="block-title-2"><span><?php echo form_label($this->translations->web_seller_change_password); ?> </span></h2>

								<?php echo form_open('seller/account/changepass', 'id="changepwdform"'); ?>
								<div class="form-group">
									<?php echo form_label($this->translations->web_seller_old_password); ?> 
									<?php echo form_input(array(
											'id' => 'oldPass', 
											'name' => 'oldPass',
											'title' => 'Please enter old password',
											'placeholder' => $this->translations->web_seller_enter_old_password,
											'required' => '',
											'minlength' => 5,
											'class' => 'form-control',
											'type' => 'password'
										)); ?>
								</div>
								<div class="form-group">
									<?php echo form_label($this->translations->web_seller_new_password); ?> 
									<?php echo form_password(array(
											'id' => 'newPass', 
											'name' => 'newPass',
											'title' => 'Please enter new password',
											'placeholder' => $this->translations->web_seller_enter_new_password,
											'required' => '',
											'minlength' => 5,
											'class' => 'form-control',
											'type' => 'password'
										)); ?>
								</div>
								<div class="form-group">
									<?php echo form_label($this->translations->web_seller_retype_new_password); ?> 
									<?php echo form_password(array(
											'id' => 'retypePass', 
											'name' => 'retypePass',
											'title' => 'Please retype the new password',
											'placeholder' => $this->translations->web_seller_retype_new_password,
											'required' => '',
											'minlength' => 5,
											'class' => 'form-control',
											'type' => 'password'
										)); ?>
								</div>
								<div class="error">
									<?php echo form_error('oldPass'); ?>
									<?php echo form_error('newPass'); ?>
									<?php echo form_error('retypePass'); ?>
									<?php echo (isset($loginmssg) ? $loginmssg : ''); ?>
								</div>
								<?php echo form_button(array(
										'id' => 'submit', 
										'class' => 'btn btn-primary changepwd squarebtn',
										'type' => 'submit'
									),'<i class="fa fa-pencil"></i>'.$this->translations->web_seller_change_password); ?>
								<?php echo form_close(); ?>

						</div>
					</div>
					<!--/row end-->
				</div>
				<div class="col-lg-3 col-md-3 col-sm-5"></div>
			</div>
		</div>
	</div>
	<!--/row-->
	<?php if (($this->authuser->suite == 'BTH-N') || ($this->authuser->suite == 'BTH-P') || ($this->authuser->suite == 'BTH-DT')): ?>
	<div class="row">
		<div class="container margin-top20">
			<h2>Merchants</h2>
			<div class="col-lg-9 col-md-9 col-sm-7">
				<div class="row userInfo">
					<div class="col-xs-12 col-sm-6">
						<h2 class="block-title-2">Registered Merchants</h2>
						<div class="table-responsive" style="height: 250px; overflow-y: scroll">
							<table class="table">
								<tbody>
									<?php foreach($this->seller_model->getMerchants() AS $k=>$v): ?>
									<tr>
										<td><p><?php echo $v['name']; ?></p></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<!-- <p><?php echo $this->seller_model->getMerchants()[0]['name']; ?></p> -->
						</div>
						
						
					</div>
					<div class="col-xs-12 col-sm-6">
						<h2 class="block-title-2"><span>Add Store</span></h2>
						<!-- <div class="col-xs-12">	
							<div class="row">	
								<div class="col-xs-5">
									<div class="row">
										<?php echo form_label('Store Photo'); ?> 
										<div class="merchant thumbnail-upload">
											<input type="file" id="merchant" name="merchant-img" class="item-img" accept="image/*" style="<?php echo $store_photo_path ? 'display:none' : ''?>" />
											<a class="add-img">
												<img id="merchant-img-output" src="<?php echo $store_photo_path ? $store_photo_path : '' ?>" alt="img" class="img-responsive image-thumb <?php echo $store_photo_path ? 'active' : ''?>">
												<button type="button" class="item_img_remove"><img src="<?php echo base_url($this->seller->img_dir.'seller/cross.png'); ?>" alt=""></button>
												<h3 class="text-center"  style="<?php echo $store_photo_path ? 'display:none' : ''?>">ADD IMAGE</h3>
											</a>
											<div class="promotion"></div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<?php echo form_open('seller/account/create_store', 'id="createStoreForm"'); ?>
						<div class="form-group">
							<?php echo form_label($this->translations->web_seller_store_name); ?> 
							<?php echo form_input(array(
									'id' => 'regstorename', 
									'name' => 'regstorename',
									'title' => 'Please enter a store name',
									'placeholder' => $this->translations->web_seller_store_name,
									'required' => '',
									'minlength' => 2,
									'class' => 'form-control',
									'type' => 'text'
								)); ?>
						</div>
						
						<div class="error">
							<?php echo form_error('regstorename'); ?>
							<?php echo (isset($loginmssg) ? $loginmssg : ''); ?>
						</div>
						<?php echo form_button(array(
								'id' => 'submit', 
								'class' => 'btn btn-primary createStoreBtn squarebtn',
								'type' => 'submit'
							),'<i class="fa fa-plus"></i> Add Store'); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
				<!--/row end-->

			</div>
		</div>
	</div>
	<?php endif; ?>
	<!--/row-->
	<div style="clear:both"></div>
</div>
<!-- /wrapper -->

<div class="gap"></div>
<?php 
$this->view("common/seller/subscribe");
$this->view("common/seller/footer"); ?>

<!-- Crop Image Modal  -->
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog"
	 aria-labelledby="itemImageCropModalAjaxLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center"><?php echo form_label($this->translations->web_seller_crop_image); ?> Crop Image</h4>
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
					<button type="button" id="cropImageBtn" class="btn btn-primary onenowBtn newredBtn cropImg" style="width: 100%;"><?php echo form_label($this->translations->web_seller_crop); ?></button>
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