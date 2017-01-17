<div id="print_container">
	<div class="contents">
		<div id="header">
			<p class="footnote text-center">This serves as your packing slip. Please print</p>
		</div>
		<div class="packingslip">
			<div class="header">
				<div class="col-xs-9">
					<div class="row">
						<img src="/seller/assets/images/logo.png" id="logo" class="image-responsive" alt="OneNow">
					</div>	
					<div class="packinginfo">
						<!-- <div class="row">
							<p>Address &amp; Contact:</p>
							<p>KHUN POR | +66 81 853 7920</p>
						</div> -->
						<div class="row">
							<p>Order Date &amp; Time:</p>
							<p id="createTime"></p>
						</div>
						<div class="row">
							<p>Pick Up by Date:</p>
							<p id="pickupTime"></p>
						</div>
						<div class="row">
							<h4 id="orderID"></h4>
						</div>
					</div>
				</div>
				<div class="col-xs-3">
					<!-- <div class="barcode-container">
						<div class="barcode barcodeImg" data-id="<?php echo $i+1 ?>" id="barcode"></div>
					</div>
					<h4 class="text-center scanorder">Scan Order label No. here</h4> -->
				</div>
			</div>
			<div class="orderlist">
				<table class="table table-responsive">
					<thead>
						<td class="col-xs-3">Merchant</td>
						<td class="col-xs-6">Description</td>
						<td class="col-xs-3">Remarks</td>
					</thead>
					<tbody id="items">
						

					</tbody>
					<tfoot>
						<td colspan=3>
							<p class="important_notes">Important Note(s):</p>
							<p>*Please print in 3 copies for Seller Copy, Warehouse Copy and Driver's Copy</p>
						</td>
					</tfoot>
				</table>
			</div>
			<div class="footer">
				<div class="col-xs-12">
					<div class="row">
						<p>Date Received: _________________________________________</p>
						<p>Seller Signature: _________________________________________</p>
						<p>Warehouse Conforme Signature: _________________________________________</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>