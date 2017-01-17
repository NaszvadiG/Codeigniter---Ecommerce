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
				<div class="row buttons">
					<button class="pull-right" onClick="window.print()">Print</button>
					<button class="pull-right" onClick="window.close()">Close</button>
				</div>
			</div>
		<div id="boxLabels">
			<table id="boxLabels-contents" cellspacing="0" cellpadding="1"  class="table">
			<tr>
			<?php 
			for ($i = 0; $i < $order['boxnumber']; $i++):
				if ($i % 2 == 0 && $i != 1){
				    echo '</tr><tr>';
				}
				echo '<td>';
			?>
			<div class="boxLabel">
				<img class="bgimg" src="<?php echo base_url('seller/assets/images/seller/orderlabel.png')?>">
				<div class="row"> 
					<div class="col-xs-8 pull-left">
						<h2><?php echo $order['merchant']; ?></h2> 
					</div> 
				</div> 
				<div class="row"> 
					<div class="col-xs-12 barcode">
						<div id="barcode<?php echo $i+1 ?>" class="col-sm-12"></div>
						<div id="mtn<?php echo $i+1 ?>" class="col-sm-12 text-center mtn" style="font-size:0.8em; padding: 10px 0px; font-weight:700; color:#000;"></div>
					</div> 
				</div>
			</div>
			<?php
			echo '</td>';
			endfor;
			echo '</tr></table>'
			?>
			</table>
		</div>
	</div>