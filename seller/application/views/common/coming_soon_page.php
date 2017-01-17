<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<div class="container main-container headerOffset">

	
	<div class="col-xs-12">
		<div class="row text-center">
			<img src="<?php echo base_url('assets/images/coming-soon.jpg'); ?>" alt="Coming Soon"><br/>
			<?php echo strtoupper($this->translations->web_seller_coming_soon); ?>
		</div>

	</div>

</div>
<!-- /wrapper -->

<div class="gap"></div>

<?php 
$this->view("common/seller/subscribe");
$this->view("common/seller/footer");
?>