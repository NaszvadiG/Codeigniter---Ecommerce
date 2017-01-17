<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="navbar navbar-tshop navbar-fixed-top megamenu"  role="navigation">
	<div class="container">
		<div class="navbar-header" id="testnav">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapsem">
				<span class="sr-only"> Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand " href="<?php echo base_url('seller'); ?>"> <img src="<?php echo base_url('onenow/assets/images/logo.png'); ?>" alt="TSHOP"></a>
			<div class="signandcart">
				<div class="link-top">
					<a id="sell_on" href="<?php echo base_url(); ?>">BUY ON ONENOW</a>
					<a id="sign_in" href="<?php echo base_url('seller/account'); ?>">SIGN IN</a>
				</div>
			</div>
		</div>
		<div class="navbar-collapsem collapse " >
			<ul class="nav navbar-nav">
				<li class="menu-mobile-thai"><a href="<?php echo base_url('seller/items'); ?>">LISTINGS</a></li>
				<li class="menu-mobile-thai"><a href="<?php echo base_url('seller/items/add'); ?>">ADD ITEMS</a></li>
				<li class="menu-mobile-thai"><a href="<?php echo base_url('seller/sales'); ?>" >SALES</a></li>
				<li class="menu-mobile-thai"><a href="<?php echo base_url('seller/analytics'); ?>">ANALYTICS</a></li>
				<li class="menu-mobile-thai"><a href="<?php echo base_url('seller/guide'); ?>">SELLER GUIDE</a></li>
				<li class="menu-mobile-thai"><a href="<?php echo base_url('seller/account'); ?>" >MY ACCOUNT</a></li>
				<li class="menu-mobile-thai"><a href="<?php echo base_url('seller/support'); ?>" >SUPPORT</a></li>
			</ul>
		</div>
		<div class="topline" ></div>
		<div class="top-menu">
			<div class="top-menu-div">
				<div class="seller-menu">
					<ul class="nav navbar-nav">
						<li ><a href="<?php echo base_url('seller/items'); ?>">LISTINGS</a></li>
						<li ><a href="<?php echo base_url('seller/items/add'); ?>">ADD ITEMS</a></li>
						<li><a href="<?php echo base_url('seller/sales'); ?>" >SALES</a></li>
						<li><a href="<?php echo base_url('seller/analytics'); ?>" >ANALYTICS</a></li>
						<li><a href="<?php echo base_url('seller/guide'); ?>" >SELLER GUIDE</a></li>
						<li><a href="<?php echo base_url('seller/account'); ?>" >MY ACCOUNT</a></li>
						<li><a href="<?php echo base_url('seller/support'); ?>" >SUPPORT</a></li>
					</ul>
				</div>
			</div>
			<div class="seller-menu-alt">
				<ul class="nav navbar-nav">
					<li ><a href="<?php echo base_url(); ?>">SHOP</a></li>
					<li ><a href="<?php echo base_url('seller/account'); ?>">SIGN IN</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>