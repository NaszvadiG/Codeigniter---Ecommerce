<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Modal Login start -->
<div class="modal signUpContent fade" id="ModalLogin" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
				<h3 class="modal-title-site text-center">Sign in</h3>
			</div>
			<div class="modal-body">
				<?php echo form_open('seller/account/verifyLogin'); ?>
				<div class="form-group login-email">
					<div>
						<?php echo form_label('Email address'); ?> 
						<?php echo form_input(array(
							'id' => 'email', 
							'name' => 'email',
							'title' => 'Please enter valid email',
							'placeholder' => 'Enter email',
							'required' => '',
							'minlength' => 3,
							'class' => 'form-control',
							'type' => 'email'
						)); ?>
					</div>
				</div>
				<div class="form-group login-password">
					<div>
						<?php echo form_label('Password'); ?> 
						<?php echo form_password(array(
								'id' => 'regpassword', 
								'name' => 'password',
								'title' => 'Please enter your password, between 5 and 12 characters',
								'placeholder' => 'Password',
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
								<input name="rememberme" value="forever" checked="checked" type="checkbox">
								Remember Me</label>
						</div>
					</div>
				</div>
				<div>
					<div>
						<?php echo form_button(array(
								'id' => 'submit', 
								'class' => 'btn btn-primary btn-block btn-lg',
								'type' => 'submit'
							),'<i class="fa fa-sign-in"></i> Sign In'); ?>
					</div>
				</div>
				<!--userForm-->
				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
				<p class="text-center"> Not here before? <a data-toggle="modal" data-dismiss="modal" href="#ModalSignup"> Sign Up.</a> <br>
					<a href="forgot-password.html"> Lost your password?</a></p>
			</div>
		</div>
		<!-- /.modal-content -->

	</div>
	<!-- /.modal-dialog -->

</div>
<!-- /.Modal Login -->

<!-- Modal Signup start -->
<?php echo form_open('seller/account/create', 'id="signup"', array('regmobileCountryCode' => '65', 'current_page' => 'seller/account')); ?>
<div class="modal signUpContent fade" id="ModalSignup" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
				<h3 class="modal-title-site text-center"> SIGN UP</h3>
			</div>
			<div class="modal-body">
				<!--<div class="control-group"><a class="fb_button btn  btn-block btn-lg " href="#"> SIGN UP WITH
						FACEBOOK</a></div>
				<h5 style="padding:10px 0 10px 0;" class="text-center"> OR</h5>-->
				<div class="form-group required reg-store">
					<div>
						<?php echo form_label('Store Name', '' ,array('class'=>'control-label')); ?> 
						<?php echo form_input(array(
								'id' => 'regstorename', 
								'name' => 'regstorename',
								'title' => 'Please enter your Store Name (at least 2 characters)',
								'placeholder' => 'Store Name',
								'required' => '',
								'minlength' => 2,
								'class' => 'form-control'
							)); ?>
					</div>
				</div>
				<div class="form-group required reg-name">
					<div>
						<?php echo form_label('First Name', '' ,array('class'=>'control-label')); ?> 
						<?php echo form_input(array(
								'id' => 'regfirstname', 
								'name' => 'regfirstname',
								'title' => 'Please enter your first name (at least 2 characters)',
								'placeholder' => 'First Name',
								'required' => '',
								'minlength' => 2,
								'class' => 'form-control'
							)); ?>
					</div>
				</div>
				<div class="form-group required reg-name">
					<div>
						<?php echo form_label('Last Name', '' ,array('class'=>'control-label')); ?> 
						<?php echo form_input(array(
								'id' => 'reglastname', 
								'name' => 'reglastname',
								'title' => 'Please enter your last name (at least 2 characters)',
								'placeholder' => 'Last Name',
								'required' => '',
								'minlength' => 3,
								'class' => 'form-control'
							)); ?>
					</div>
				</div>

				<div class="form-group required reg-email">
					<div>
						<?php echo form_label('Email address', '' ,array('class'=>'control-label')); ?> 
						<?php echo form_input(array(
								'id' => 'regemail', 
								'name' => 'regemail',
								'title' => 'Please enter valid email',
								'placeholder' => 'Enter email address',
								'required' => '',
								'minlength' => 3,
								'class' => 'form-control',
								'type' => 'email'
							)); ?>
					</div>
				</div>
				<div class="form-group required reg-password">
					<div>
						<?php echo form_label('Password', '' ,array('class'=>'control-label')); ?> 
						<?php echo form_password(array(
								'id' => 'regpassword', 
								'name' => 'regpassword',
								'title' => 'Please enter your password, between 5 and 12 characters',
								'placeholder' => 'Password',
								'required' => '',
								'minlength' => 5,
								'class' => 'form-control',
								'type' => 'password'
							)); ?>
					</div>
				</div>
				<div class="form-group required reg-password">
					<div>
						<?php echo form_label('Confirm Password', '' ,array('class'=>'control-label')); ?> 
						<?php echo form_password(array(
								'id' => 'regconfirmpassword', 
								'name' => 'regconfirmpassword',
								'title' => 'Passwords does not match',
								'placeholder' => 'Confirm Password',
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
								'id' => 'regnext', 
								'class' => 'btn btn-primary btn-block btn-lg',
								'type' => 'button',
							),'NEXT'); ?>
					</div>
				</div>
				<!--userForm-->
				
			</div>
			<div class="modal-footer">
				<p class="text-center"> Already member? <a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
						Sign in</a></p>
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
				<h3 class="modal-title-site text-center"> SIGN UP</h3>
			</div>
			<div class="modal-body">
				<div class="form-group reg-gender">
					<div>
						<?php echo form_label('Choose Your Gender'); ?> 
						<?php echo form_dropdown(array(
								'id' => 'reggender', 
								'name' => 'reggender',
								'title' => 'Please select your gender',
								'placeholder' => 'Select Your Gender',
								'required' => '',
								'class' => 'form-control',
								'options' => array('M'=>'Male','F'=>'Female'),
							)); ?>
					</div>
				</div>
				<div class="form-group reg-country">
					<div>
						<?php echo form_label('Choose Your Country'); ?> 
						<?php echo form_dropdown(array(
								'id' => 'regcountry', 
								'name' => 'regcountry',
								'title' => 'Please select your country',
								'placeholder' => 'Select Country',
								'required' => '',
								'class' => 'form-control',
								'options' => array('PH'=>'Philippines','SG'=>'Singapore'),
							)); ?>
					</div>
				</div>
				<div class="form-group required reg-mobile-number">
					<div>
						<?php echo form_label('Enter Mobile Number', '' ,array('class'=>'control-label')); ?> 
					</div>
					<div class="input-group">
						<div class="input-group-addon" id="countryCodeLbl">+63</div>
						<?php echo form_input(array(
								'id' => 'reghpnum', 
								'name' => 'reghpnum',
								'title' => 'Please enter your phone number',
								'placeholder' => 'Phone number',
								'required' => '',
								'minlength' => 10,
								'maxlength' => 11,
								'class' => 'form-control',
								'type' => 'text',
								'data-error' => 'true'
							)); ?>
					</div>
				</div>
				<div>
					<div>
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
				<?php echo form_hidden('current_page',"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>
				<div>
					<div>
						<?php echo form_button(array(
								'id' => 'regsubmit', 
								'class' => 'btn btn-primary btn-block btn-lg',
								'type' => 'submit',
							),'<i class="fa fa-user"></i> Sign up'); ?>
					</div>
				</div>
				<!--userForm-->
				
			</div>
			<div class="modal-footer">
				<p class="text-center"> Already member? <a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
						Sign in</a></p>
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
			    <h4 class="modal-title text-center">Account created</h4>
		    </div>
			<div class="modal-body">
				<p class="text-center message">Your account is ready to use.</p>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 popPrintBtnContainer">
		            <button type="button" class="btn btn-primary onenowBtn newredBtn" style="width: 100%;" onClick="window.location.href='/seller/account'">Go To Account</button>
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
			    <h4 class="modal-title text-center">Registration Failed</h4>
		    </div>
			<div class="modal-body">
				<p class="text-center message"></p>
		    </div>
			<div class="modal-footer">
				<div class="col-xs-12 col-sm-4  col-sm-offset-4 popPrintBtnContainer">
		            <button type="button" class="btn btn-primary onenowBtn newredBtn" style="width: 100%;" data-dismiss="modal">OK</button>
		        </div>
		    </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php echo form_close(); ?>