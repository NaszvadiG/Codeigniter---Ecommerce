
<div class="footer">
	<div class="container">
		<div class="col-sm-6 col-xs-12 links">
			<div class="row">
				<div class="footerColumn col-xs-6">
					<a href="coming-soon"><h3> <?php echo $this->translations->web_open_a_shop; ?></h3></a>
					<ul class="list-unstyled footer-nav">
						<li><a href="<?php echo base_url('/seller/coming-soon'); ?>"><?php echo $this->translations->web_why_join; ?>
						</a></li>
						<li><a href="<?php echo 'javascript:void(0);'; ?>" onclick="<?php echo '$(\'#ModalSignup\').modal(\'show\'); return false;'; ?>"><?php echo $this->translations->web_apply_to_sell; ?>
						</a></li>
						<li><a href="<?php echo base_url('seller/assets/pdf/Seller_Handbook.pdf');?>" target="_blank"><?php echo $this->translations->web_seller_handbook; ?>
						</a></li>
						<li><a href="<?php echo base_url('/seller/home/faqs');?>"><?php echo $this->translations->web_faq; ?> </a></li>

					</ul>
				</div>
				<div class="footerColumn col-xs-6">
					<a href="coming-soon"><h3><?php echo $this->translations->web_shipping; ?></h3></a>
					<ul class="list-unstyled footer-nav">
						<li><a href="<?php echo base_url('how-we-ship'); ?>"><?php echo $this->translations->web_how_we_ship; ?>
							</a></li>
						<li><a href="<?php echo base_url('membership'); ?>"><?php echo $this->translations->web_express_upgrade; ?>
						</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xs-12 links">
			<div class="row">
				<div class="footerColumn col-xs-6">
					<a href="<?php echo base_url('about-us'); ?>"><h3><?php echo $this->translations->web_about_us; ?></h3></a>

					<ul class="list-unstyled footer-nav">
						<li><a href="<?php echo base_url('/story')?>"><?php echo $this->translations->web_our_story; ?>
						</a></li>

						<li><a href="<?php echo base_url('about-us'); ?>"><?php echo $this->translations->web_about_us; ?>
							</a></li>
						<li><a href="<?php echo base_url('newsroom'); ?>"><?php echo $this->translations->web_newsroom; ?>
						</a></li>
						<li><a href="<?php echo base_url('contact'); ?>"><?php echo $this->translations->web_contact_us; ?></a></li>
						<li><a href="<?php echo base_url('privacy-policy'); ?>"><?php echo $this->translations->web_privacy_policy; ?></a></li>
						<li><a href="<?php echo base_url('terms-of-use'); ?>"><?php echo $this->translations->web_terms_of_use; ?></a></li>
					</ul>
				</div>


				<div class="footerColumn col-xs-6">
					<a href="<?php echo base_url('/seller/coming-soon'); ?>"><h3> <?php echo $this->translations->web_help; ?> </h3></a>

					<ul class="list-unstyled footer-nav">
						<li><a href="https://secure.onenow.com/checkout/global-checkout-account.do?referrer=http://www.onenow.com/buyer/logout" target="_blank"><?php echo $this->translations->web_your_account; ?>
						</a></li> 
						<li><a href="https://secure.onenow.com/checkout/global-checkout-order.do?referrer=http://www.onenow.com/buyer/logout"><?php echo $this->translations->web_your_orders; ?>
						</a></li>
						<li><a href="<?php echo base_url('return-and-replacement'); ?>"><?php echo $this->translations->web_return_replacement; ?> </a></li>
						<li><a href="<?php echo base_url('general-enquiries'); ?>"><?php echo $this->translations->web_general_enquiries; ?></a></li>
						<li><a href="<?php echo base_url('suggest-product'); ?>"><?php echo $this->translations->web_suggest_a_product; ?></a></li>
					</ul>
				</div>
				<!-- <div class="col-sm-3 col-xs-12">
					<div class="row">
						<div class="social">
								<a class="btn onenowBtn" href="https://instagram.com/one.now/" target="_blank"><i class="fa fa-lg fa-instagram" aria-hidden="true"></i></a>
						</div>
						<div class="social">
							<a class="btn onenowBtn" href="http://www.pinterest.com/one.now" target="_blank"><i class="fa fa-lg fa-pinterest" aria-hidden="true"></i></a>
						</div>
						<div class="social">
							<a class="btn onenowBtn" href="htttp://www.twitter.com/" target="_blank"><i class="fa fa-lg fa-twitter" aria-hidden="true"></i></a>
						</div>
						<div class="social">
							<a class="btn onenowBtn" href="htttp://www.facebook.com/one.now" target="_blank"><i class="fa fa-lg fa-facebook" aria-hidden="true"></i></a>
						</div>
					</div>
				</div> -->
			</div>
		</div>
		<!--/.row-->
	</div>
	<!--/.container-->

	<!-- <div class="certifications">
		<img src="<?php echo base_url('seller/assets/images/seller/bbb_logo.png'); ?>">
		<img src="<?php echo base_url('seller/assets/images/seller/pci_logo.png'); ?>">
	</div> -->
</div>
<!--/.footer-->

<div class="footer-bottom">
	<div class="container">
		<span> &copy; ONENOW 2016. <?php echo $this->translations->web_all_right_reserved; ?> </span>

		<img src="<?php echo base_url('seller/assets/images/seller/dhl_logo.png'); ?>" alt="img">
	</div>
</div>
<div id="scrollTopContainer">
	<button class="scrollTopBtn"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
</div>
<?php $this->view("common/seller/signin"); ?>