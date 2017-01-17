<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<div class="container main-container headerOffset">

	<div class="row">
		<div class="breadcrumbDiv col-lg-12">
			<ul class="breadcrumb">
				<?php draw_seller_breadcrumb($this->uri->segment_array()); ?>
			</ul>
		</div>
	</div>

	<div class="row">

		<div class="col-lg-9 col-md-9 col-xs-12">
			<h1 class="section-title-inner"><span><i class="fa fa-lock"></i> <?php echo form_label($this->translations->web_seller_authentication); ?> </span></h1>

			<div class="row userInfo">
				<div class="col-xs-12 col-sm-6">
					<h2 class="block-title-2"> <?php echo form_label($this->translations->web_seller_create_an_account); ?></h2>
					
					<?php echo form_open('/seller/account/create', 'id="regForm"', array('regmobileCountryCode' => '65', 'current_page' => 'seller/account')); ?>
					<div class="form-group required">
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
					<div class="form-group required">

						<?php echo form_label($this->translations->web_seller_first_name, '' ,array('class'=>'control-label')); ?> 
						<?php echo form_input(array(
								'id' => 'regfirstname', 
								'name' => 'regfirstname',
								'title' => $this->translations->web_seller_please_enter_your_first_name_at_least_characters,
								'placeholder' => 'Enter first name',
								'required' => '',
								'minlength' => 3,
								'class' => 'form-control'
							)); ?>
					</div>
					<div class="form-group required">
						<?php echo form_label($this->translations->web_seller_last_name, '' ,array('class'=>'control-label')); ?> 
						<?php echo form_input(array(
								'id' => 'reglastname', 
								'name' => 'reglastname',
								'title' => $this->translations->web_seller_please_enter_your_last_name_at_least_characters,
								'placeholder' => 'Enter last name',
								'required' => '',
								'minlength' => 2,
								'class' => 'form-control'
							)); ?>
					</div>
					<div class="form-group required">
						<?php echo form_label($this->translations->web_seller_email_address, '' ,array('class'=>'control-label')); ?> 
						<?php echo form_input(array(
								'id' => 'regemail', 
								'name' => 'regemail',
								'title' => $this->translations->web_seller_please_enter_a_valid_email_address,
								'placeholder' => 'Enter email',
								'required' => '',
								'class' => 'form-control',
								'type' => 'email'
							)); ?>
					</div>
					<div class="form-group required">
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
					<div class="form-group required">
						<?php echo form_label($this->translations->web_seller_retype_new_password, '' ,array('class'=>'control-label')); ?> 
						<?php echo form_password(array(
								'id' => 'regconfirmpassword', 
								'name' => 'regconfirmpassword',
								'title' => 'Please retype your password',
								'placeholder' => $this->translations->web_seller_retype_new_password,
								'required' => '',
								'minlength' => 5,
								'class' => 'form-control',
								'type' => 'password'
							)); ?>
					</div>
					<div class="form-group">
						<?php echo form_label($this->translations->web_seller_gender); ?> 
						<?php echo form_dropdown('reggender', array(
								'M' => $this->translations->web_seller_male, 
								'F' => $this->translations->web_seller_female), '', array('class'=>'form-control')); ?>
					</div>
					<div class="form-group">
						<?php echo form_label($this->translations->web_seller_country); ?> 
						<?php echo form_dropdown('regcountry', array(
								'PH' => 'Philippines', 
								'SG' => 'Singapore'), '', array('class'=>'form-control')); ?>
					</div>
					<div class="form-group required">
						<?php echo form_label($this->translations->web_seller_contact_no, '' ,array('class'=>'control-label')); ?> 
						<div class="input-group">
							<div class="input-group-addon" id="countryCodeLbl">+63</div>
							<?php echo form_input(array(
									'id' => 'reghpnum', 
									'name' => 'reghpnum',
									'title' => $this->translations->web_seller_please_add_a_valid_contact_number,
									'placeholder' => $this->translations->web_seller_contact_no,
									'required' => '',
									'minlength' => 10,
									'maxlength' => 11,
									'class' => 'form-control',
									'type' => 'text',
									'data-error' => 'true'
								)); ?>
						</div>
					</div>
					<div class="error">
						<?php echo form_error('regname'); ?>
						<?php echo form_error('regemail'); ?>
						<?php echo form_error('regpassword'); ?>
						<?php echo (isset($regmssg) ? $regmssg : ''); ?>
					</div>
                        
					<?php echo form_button(array(
							'id' => 'regsubmit', 
							'class' => 'btn btn-primary squarebtn',
							'type' => 'submit'
						),'<i class="fa fa-user"></i> ' . $this->translations->web_seller_create_an_account); ?>
                        
					<?php echo form_close(); ?>
				</div>
				<div class="col-xs-12 col-sm-6">
					<h2 class="block-title-2"><span><?php echo form_label($this->translations->web_seller_already_member); ?> </span></h2>

					<?php echo form_open('seller/account/verifyLogin'); ?>
					<div class="form-group">
						<?php echo form_label($this->translations->web_seller_email_address); ?> 
						<?php echo form_input(array(
								'id' => 'email', 
								'name' => 'email',
								'title' => $this->translations->web_seller_please_enter_a_valid_email_address,
								'placeholder' => 'Enter email',
								'required' => '',
								'minlength' => 3,
								'class' => 'form-control',
								'type' => 'email'
							)); ?>
					</div>
					<div class="form-group">
						<?php echo form_label($this->translations->web_seller_password); ?> 
						<?php echo form_password(array(
								'id' => 'password', 
								'name' => 'password',
								'title' => $this->translations->web_seller_please_enter_your_password_between_and_characters,
								'placeholder' => $this->translations->web_seller_password,
								'required' => '',
								'minlength' => 5,
								'class' => 'form-control',
								'type' => 'password'
							)); ?>
					</div>
					<div class="checkbox">
						<label>
							<input name="rememberme" value="forever" type="checkbox">
								<?php echo form_label($this->translations->web_seller_remember_me); ?></label>
					</div>
					<div class="form-group">
						<p><a title="Recover your forgotten password" data-toggle="modal" data-dismiss="modal" href="#ModalForget" style="font-size: 0.7em;"><?php echo form_label($this->translations->web_seller_forgot_your_password); ?></a></p>
					</div>
					<div class="error"
						<?php echo form_error('email'); ?>
						<?php echo form_error('password'); ?>
						<?php echo (isset($loginmssg) ? $loginmssg : ''); ?>
					</div>
					<?php echo form_button(array(
							'id' => 'submit', 
							'class' => 'btn btn-primary squarebtn',
							'type' => 'submit'
						),'<i class="fa fa-sign-in"></i> ' . $this->translations->web_seller_sign_in); ?>
					<?php echo form_close(); ?>
				</div>
			</div>
			<!--/row end-->

		</div>

		<div class="col-lg-3 col-md-3 col-sm-5"></div>
	</div>
	<!--/row-->

	<div style="clear:both"></div>
</div>
<!-- /wrapper -->

<div class="gap"></div>

<?php $this->view("common/seller/footer"); ?>