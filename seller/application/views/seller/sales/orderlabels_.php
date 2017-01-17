<?php defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
	
	<!-- Main component call to action -->
	<div class="container">
		<div id="print">
			<div class="col-xs-10">	
				<div class="row">
					<p>Please print the label(s) or write the code on each box</p>
				</div>
			</div>
			<div class="col-xs-2">	
				<div class="row">
					<button class="pull-right" onClick="window.print()">Print</button>
					<button class="pull-right" onClick="window.close()">Close</button>
				</div>
			</div>
			<div id="boxLabels">
				<div id="boxLabels-contents">
				<?php if ($order){
						for ($i = 0; $i < $order['boxnumber']; $i++) {
				?>	
					<div class="boxLabel">
						<div class="row"> 
							<div class="col-xs-8">
								<h2>MERCHANT NAME</h2> 
							</div> 
							<div class="col-xs-4">
								<img src="http://buyer.staging.onenow.com/assets/images/logo.png" alt="Label Logo" class="pull-right"> 
							</div> 
						</div> 
						<div class="row"> 
							<div class="col-sm-12">
								<h1><?php echo $order['order_id'].'-'.$order['sellersuite'].'-'.($i +1) ?></h1> 
								<!-- <h1>BTH-123214-BTH-SP-1</h1>  -->
							</div>
						</div>
					</div>
				<?php }
				} ?>
				</div>
			</div>
		</div>
	</div>
	<script>	
		// window.print();

	</script>
	<!-- /.row  -->
