<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Modal Login start -->
<div class="modal signUpContent fade" id="ModalLogin" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
				<h3 class="modal-title-site text-center"><?php echo $this->translations->web_seller_sign_in; ?></h3>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="alert-msg">Incorrect email/password. Please try again.</span>
				</div>
				<?php echo form_open('seller/account/login', array('id'=>'loginForm')); ?>
				<div class="form-group login-email">
					<div>
						<?php echo form_label($this->translations->web_seller_email_address); ?> 
						<?php echo form_input(array(
							'id' => 'email', 
							'name' => 'email',
							'title' => $this->translations->web_seller_please_enter_a_valid_email_address,
							'placeholder' => $this->translations->web_seller_email_address,
							'required' => '',
							'minlength' => 3,
							'class' => 'form-control',
							'type' => 'email'
						)); ?>
					</div>
				</div>
				<div class="form-group login-password">
					<div>
						<?php echo form_label($this->translations->web_seller_password); ?> 
						<?php echo form_password(array(
								'id' => 'regpassword', 
								'name' => 'password',
								'title' => $this->translations->web_seller_please_enter_your_password_between_and_characters,
								'placeholder' => $this->translations->web_seller_password,
								'required' => '',
								'minlength' => 5,
								'class' => 'form-control',
								'type' => 'password'
							)); ?>
					</div>
				</div>
				<?php echo form_hidden('current_page',"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>
				<div class="form-group">
					<div>
						<div class="checkbox login-remember">
							<label>
								<input name="rememberme" value="forever" type="checkbox">
								<?php echo form_label($this->translations->web_seller_remember_me); ?></label>
						</div>
					</div>
				</div>
				<div>
					<div>
						<?php echo form_button(array(
								'id' => 'submit', 
								'class' => 'btn btn-primary btn-block btn-lg',
								'type' => 'submit'
							),'<i class="fa fa-sign-in"></i>'.$this->translations->web_seller_sign_in); ?>
					</div>
				</div>
				<!--userForm-->
				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
				<p class="text-center"> <?php echo form_label($this->translations->web_seller_not_here_before); ?> <a data-toggle="modal" data-dismiss="modal" href="#ModalSignup"> <?php echo form_label($this->translations->web_seller_signup); ?></a> <br>
					<a data-toggle="modal" data-dismiss="modal" href="#ModalForget"> <?php echo form_label($this->translations->web_seller_lost_your_password); ?></a></p>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.Modal Login -->

<!-- Modal Forget Password start -->
<div class="modal signUpContent fade" id="ModalForget" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
				<h3 class="modal-title-site text-center"><?php echo $this->translations->web_seller_forgot_password; ?></h3>
			</div>
			<div class="modal-body">
				<?php echo form_open('seller/account/forgetPassword', array('id'=>'forgetPassword')); ?>
				<div class="form-group fp-email">
					<div>
						<?php echo form_label($this->translations->web_seller_email_address); ?> 
						<?php echo form_input(array(
							'id' => 'email', 
							'name' => 'email',
							'title' => $this->translations->web_seller_please_enter_a_valid_email_address,
							'placeholder' => $this->translations->web_seller_email_address,
							'required' => '',
							'class' => 'form-control',
							'type' => 'email'
						)); ?>
					</div>
				</div>
				<div>
					<div>
						<?php echo form_button(array(
								'id' => 'resetPWBtn', 
								'class' => 'btn btn-primary btn-block btn-lg',
								'type' => 'button'
							),$this->translations->web_seller_ok); ?>
					</div>
				</div>
				<!--userForm-->
				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
				<p class="text-center"><a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
						<?php echo form_label($this->translations->web_seller_cancel); ?></a></p>
			</div>
		</div>
		<!-- /.modal-content -->

	</div>
	<!-- /.modal-dialog -->

</div>
<!-- /.Modal Forget Password -->

<!-- Modal Signup start -->
<div class="modal signUpContent fade" id="ModalSignup" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
				<h3 class="modal-title-site text-center"> <?php echo $this->translations->web_seller_signup; ?></h3>
			</div>
			<div class="modal-body">
				<!--<div class="control-group"><a class="fb_button btn  btn-block btn-lg " href="#"> SIGN UP WITH
						FACEBOOK</a></div>
				<h5 style="padding:10px 0 10px 0;" class="text-center"> OR</h5>-->
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<h4>ALREADY REGISTERED AS A BUYER?</h4>
						<?php echo form_open('', array('id'=>'buyerLogin')); ?>
						<div class="form-group required reg-email">
							<div>
								<?php echo form_label($this->translations->web_seller_email_address, '' ,array('class'=>'control-label')); ?> 
								<?php echo form_input(array(
										'id' => 'regemail', 
										'name' => 'email',
										'title' => $this->translations->web_seller_please_enter_a_valid_email_address,
										'placeholder' => $this->translations->web_seller_email_address,
										'required' => '',
										'minlength' => 3,
										'class' => 'form-control',
										'type' => 'email'
									)); ?>
							</div>
						</div>
						<div class="form-group required reg-password">
							<div>
								<?php echo form_label($this->translations->web_seller_password, '' ,array('class'=>'control-label')); ?> 
								<?php echo form_password(array(
										'id' => 'regpassword', 
										'name' => 'password',
										'title' => $this->translations->web_seller_please_enter_your_password_between_and_characters,
										'placeholder' => $this->translations->web_seller_password,
										'required' => '',
										'minlength' => 5,
										'class' => 'form-control',
										'type' => 'password'
									)); ?>
							</div>
						</div>
						<div>
							<div>
								<?php echo form_button(array(
										'id' => 'submit', 
										'class' => 'btn btn-primary btn-block btn-lg',
										'type' => 'submit'
									),'<i class="fa fa-sign-in"></i>'.$this->translations->web_seller_sign_in); ?>
								<a href="javascript:void(0)"><label>Lost your password?</label></a>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
					<div class="col-xs-12 col-sm-6">
					<?php echo form_open('', 'id="signup-seller"', array('regmobileCountryCode' => '65', 'current_page' => 'seller/account')); ?>
						<h4>NEW?</h4>
						<div class="form-group required reg-name">
							<div>
								<?php echo form_label($this->translations->web_seller_first_name, '' ,array('class'=>'control-label')); ?> 
								<?php echo form_input(array(
										'id' => 'regfirstname', 
										'name' => 'regfirstname',
										'title' => $this->translations->web_seller_please_enter_your_first_name_at_least_characters,
										'placeholder' => $this->translations->web_seller_first_name,
										'required' => '',
										'minlength' => 2,
										'class' => 'form-control'
									)); ?>
							</div>
						</div>
						<div class="form-group required reg-name">
							<div>
								<?php echo form_label($this->translations->web_seller_last_name, '' ,array('class'=>'control-label')); ?> 
								<?php echo form_input(array(
										'id' => 'reglastname', 
										'name' => 'reglastname',
										'title' => $this->translations->web_seller_please_enter_your_last_name_at_least_characters,
										'placeholder' => $this->translations->web_seller_last_name,
										'required' => '',
										'minlength' => 2,
										'class' => 'form-control'
									)); ?>
							</div>
						</div>
						<div class="form-group required reg-email">
							<div>
								<?php echo form_label($this->translations->web_seller_email_address, '' ,array('class'=>'control-label')); ?> 
								<?php echo form_input(array(
										'id' => 'regemail', 
										'name' => 'regemail',
										'title' => $this->translations->web_seller_please_enter_a_valid_email_address,
										'placeholder' => $this->translations->web_seller_email_address,
										'required' => '',
										'minlength' => 3,
										'class' => 'form-control',
										'type' => 'email'
									)); ?>
							</div>
						</div>
						<div class="form-group required reg-password">
							<div>
								<?php echo form_label($this->translations->web_seller_password, '' ,array('class'=>'control-label')); ?> 
								<?php echo form_password(array(
										'id' => 'regpassword', 
										'name' => 'regpassword',
										'title' => $this->translations->web_seller_please_enter_your_password_between_and_characters,
										'placeholder' => $this->translations->web_seller_password,
										'required' => '',
										'minlength' => 5,
										'class' => 'form-control',
										'type' => 'password'
									)); ?>
							</div>
						</div>
						<div class="form-group required reg-password">
							<div>
								<?php echo form_label($this->translations->web_seller_confirm_password, '' ,array('class'=>'control-label')); ?> 
								<?php echo form_password(array(
										'id' => 'regconfirmpassword', 
										'name' => 'regconfirmpassword',
										'title' => $this->translations->web_seller_passwords_does_not_match,
										'placeholder' => $this->translations->web_seller_confirm_password,
										'required' => '',
										'minlength' => 5,
										'class' => 'form-control',
										'type' => 'password'
									)); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group reg-gender">
									<div>
										<?php echo form_label($this->translations->web_seller_gender); ?> 
										<?php echo form_dropdown(array(
												'id' => 'reggender', 
												'name' => 'reggender',
												'title' => $this->translations->web_seller_please_select_gender,
												'placeholder' => $this->translations->web_seller_select_gender,
												'required' => '',
												'class' => 'form-control',
												'options' => array('M'=>$this->translations->web_seller_male,'F'=>$this->translations->web_seller_female),
											)); ?>
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group regcountry">
									<div>
										<?php echo form_label($this->translations->web_seller_country); ?> 
										<?php echo form_dropdown(array(
												'id' => 'regcountry', 
												'name' => 'regcountry',
												'title' => $this->translations->web_seller_please_select_your_country,
												'placeholder' => $this->translations->web_seller_select_country,
												'required' => '',
												'class' => 'form-control',
												'options' => array('TH'=>'Thailand','SG'=>'Singapore'),
											)); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group required reg-mobile-number">
							<div>
								<?php echo form_label($this->translations->web_seller_contact_no, '' ,array('class'=>'control-label')); ?> 
							</div>
							<div class="input-group">
								<div class="input-group-addon" id="countryCodeLbl">+66</div>
								<?php echo form_input(array(
										'id' => 'reghpnum', 
										'name' => 'reghpnum',
										'title' => $this->translations->web_seller_please_add_a_valid_contact_number,
										'placeholder' => $this->translations->web_seller_contact_no,
										'required' => '',
										'minlength' => 6,
										'maxlength' => 11,
										'class' => 'form-control',
										'type' => 'text',
										'data-error' => 'true'
									)); ?>
							</div>
						</div>
						<div>
							<?php echo form_button(array(
									'id' => 'regnext', 
									'class' => 'btn btn-primary btn-block btn-lg',
									'type' => 'button',
								),'NEXT'); ?>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				<!--userForm-->	
			</div>
			<div class="modal-footer">
				<p class="text-center"> <?php echo form_label($this->translations->web_seller_already_member); ?>  <a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
						<?php echo form_label($this->translations->web_seller_sign_in); ?></a></p>
			</div>
		</div>
		<!-- /.modal-content -->

	</div>
	<!-- /.modal-dialog -->

</div>
<div class="modal signUpContent fade" id="ModalSignup2" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
				<h3 class="modal-title-site text-center"> <?php echo $this->translations->web_seller_signup; ?></h3>
			</div>
			<div class="modal-body">
				<?php echo form_open('', 'id="signup-store"', array('regmobileCountryCode' => '65', 'current_page' => 'seller/account')); ?>
					<div class="row">
						<div class="col-xs-12">
							
							<div class="form-group reg-storephoto">
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-sm-offset-4">
										<?php echo form_label('Upload your Photo', '' ,array('class'=>'control-label')); ?> 
										<div class="seller thumbnail-upload">
											<input id="regstorephoto" type="file" name="seller-img" class="item-img" title="Please Upload a Photo of your Store" accept="image/*" required data-error="true" data-onModal="true" />
											<a class="add-img">
												<img id="seller-img-output" src="" alt="img" class="img-responsive image-thumb">
												<button type="button" class="item_img_remove"><img src="<?php echo base_url($this->seller->img_dir.'seller/cross.png'); ?>" alt=""></button>
												<h3 class="text-center"><?php echo form_label($this->translations->web_seller_add_photo); ?></h3>
											</a>
											<div class="promotion"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<h4>YOUR STORE DETAILS</h4>
							<div class="form-group required reg-store">
								<div>
									<?php echo form_label($this->translations->web_seller_store_name, '' ,array('class'=>'control-label')); ?> 
									<?php echo form_input(array(
											'id' => 'regstorename', 
											'name' => 'regstorename',
											'title' => 'Please enter your Store Name (at least 2 characters)',
											'placeholder' => $this->translations->web_seller_store_name,
											'required' => '',
											'minlength' => 2,
											'class' => 'form-control'
										)); ?>
								</div>
							</div>
							<div class="form-group required reg-address">
								<div>
									<?php echo form_label($this->translations->web_seller_address.' Line 1', '' ,array('class'=>'control-label')); ?> 
									<?php echo form_input(array(
											'id' => 'regaddress', 
											'name' => 'regaddress',
											'title' => $this->translations->web_seller_please_enter_your_store_address,
											'placeholder' => $this->translations->web_seller_address,
											'required' => '',
											'class' => 'form-control'
										)); ?>
								</div>
							</div>
							<div class="form-group reg-address2">
								<div>
									<?php echo form_label($this->translations->web_seller_address.' Line 2', '' ,array('class'=>'control-label')); ?> 
									<?php echo form_input(array(
											'id' => 'regaddress2', 
											'name' => 'regaddress2',
											'title' => $this->translations->web_seller_please_enter_your_store_address,
											'placeholder' => $this->translations->web_seller_address,
											'class' => 'form-control'
										)); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group required reg-store">
								<div>
									<?php echo form_label($this->translations->web_seller_city, '' ,array('class'=>'control-label')); ?> 
									<?php echo form_input(array(
											'id' => 'regcity', 
											'name' => 'regcity',
											'title' => $this->translations->web_seller_please_enter_city_name,
											'placeholder' => $this->translations->web_seller_city,
											'required' => '',
											'minlength' => 2,
											'class' => 'form-control',
											'type' => 'text',
											'data-error' => 'true'
										)); ?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group required reg-store">
								<div>
									<?php echo form_label($this->translations->web_seller_postal_code, '' ,array('class'=>'control-label')); ?> 
									<?php echo form_input(array(
											'id' => 'regpostalcode', 
											'name' => 'regpostalcode',
											'title' => $this->translations->web_seller_please_enter_your_postal_code,
											'placeholder' => $this->translations->web_seller_postal_code,
											'pattern'	=>	'[0-9]{5}',
											'required' => 'required',
											'minlength' => 4,
											'maxlength' => 7,
											'class' => 'form-control',
											'type' => 'text',
											'data-error' => 'true'
										)); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group required reg-province">
								<div>
									<?php echo form_label('Province', '' ,array('class'=>'control-label')); ?> 
									<?php echo form_input(array(
											'id' => 'province', 
											'name' => 'regprovince',
											'title' => 'Please Enter your Store\'s Province',
											'placeholder' => 'Enter your Province name',
											'required' => '',
											'class' => 'form-control'
										)); ?>
								</div>
							</div>
						</div>
					</div>
					<div>
						<div>
						<?php echo form_button(array(
									'id' => 'regskip', 
									'class' => 'btn btn-primary btn-block btn-lg',
									'type' => 'button',
									'data-dismiss' => 'modal',
									'style'	=>	'display:none;'
								),'SKIP'); ?>
							<?php echo form_button(array(
									'id' => 'regprev', 
									'class' => 'btn btn-primary btn-block btn-lg',
									'type' => 'button',
									'data-toggle' => 'modal',
									'data-target' => '#ModalSignup',
									'data-dismiss' => 'modal',
								),'PREV'); ?>
						</div>
					</div>
					<div>
						<div>
							<?php echo form_button(array(
									'id' => 'regsubmit', 
									'class' => 'btn btn-primary btn-block btn-lg',
									'type' => 'submit',
								),'<i class="fa fa-user"></i> '.$this->translations->web_seller_signup); ?>
						</div>
					</div>
					<!--userForm-->
				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
				<p class="text-center"> <?php echo form_label($this->translations->web_seller_already_member); ?>  <a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
						<?php echo form_label($this->translations->web_seller_sign_in); ?></a></p>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<!-- Account Create Alert Modal  -->
<div class="modal fade" id="successPop" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title text-center"><?php echo form_label($this->translations->web_seller_account_created); ?></h4>
		    </div>
			<div class="modal-body">
				<p class="text-center message"><?php echo form_label($this->translations->web_seller_your_account_is_ready_to_use); ?></p>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 popPrintBtnContainer">
		            <button type="button" class="btn btn-primary onenowBtn newredBtn" style="width: 100%;" onClick="window.location.href='/seller/account'"><?php echo form_label($this->translations->web_seller_go_to_your_account); ?></button>
		        </div>
		    </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Account Create Alert Modal  -->
<div class="modal fade" id="alertPop" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title text-center"><?php echo form_label($this->translations->web_seller_registration_failed); ?></h4>
		    </div>
			<div class="modal-body">
				<p class="text-center message"></p>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4  col-sm-offset-4 popPrintBtnContainer">
		            <button type="button" class="btn btn-primary onenowBtn newredBtn" style="width: 100%;" data-dismiss="modal"><?php echo form_label($this->translations->web_seller_ok); ?></button>
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
