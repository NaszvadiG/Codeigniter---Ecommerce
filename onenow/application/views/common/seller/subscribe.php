<div class="subscribe">
	<div class="responsive-container">
		<?php echo form_open('subscribe'); ?>
		<div class="inputdiv col-md-8 col-sm-8 col-xs-8" >
			<div class="col-xs-12 col-sm-10 pull-right">
				<div class="row">
					<?php 
					echo form_input(array(
					'type'			=>	'email',
					'name'			=>	'subscribe-email',
					'class'			=>	'email-bottom',
					'style'			=>	'padding: 0 20px',
					'title'			=>	'Please enter a valid email address',
					'placeholder'	=>	$this->translations->web_enter_email,
					'required'		=>	'')); ?>
				</div>
			</div>
		</div>
		<div class="buttondiv col-md-4 col-sm-4 col-xs-4" >
			<?php echo form_button(array(
			'type'		=>	'submit',
			'id'		=>	'subscribe-btn',
			'class'		=>	'onenowBtn newredBtn',
			'content'	=>	$this->translations->web_sub)) ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="subscribePop" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
		<div class="modal-content">
	    	<div class="modal-body">
				<div class="col-xs-12 col-sm-8 pull-right text-center">
					<div class="row">
						<h1>Thank You for Subscribing</h1>
						<p>Take $10 OFF your first purchase and we'll upgrade your shipment to express for FREE!</p>
						<h3>Use code:</h3>
						<h2>WELCOME10</h2>
						<button data-dismiss="modal" class="btn subscribe-dismiss">OK</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->