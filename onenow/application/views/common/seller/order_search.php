<?php 
// PLACE THAI TRANSLATIONS HERE
// Replace string with translation

$txt_sorting = 'Sorting';

$txt_button_search = $this->translations->web_search;

// Sort labels: 2 labels (Latest, Oldest)
$sort_labels = array('Latest', 'Oldest');

// Order boxes: 4 Text boxes by order (Order, Item Name, Date Ordered, SKU)
$order_boxes = array($this->translations->web_seller_item_name,'Date Ordered','SKU');

$search_query = array();
if (!is_null(get_cookie('seller_order_search_query'))){
	$session_query = (array) json_decode(get_cookie('seller_order_search_query'));
	array_push($search_query, rawurldecode($session_query['prodname']));
	// var_dump($session_query);
	if ($session_query['dateFrom'] != ''){
		$timeTo = strtotime(rawurldecode($session_query['dateTo']).' -1 day');
		$timeFrom = strtotime(rawurldecode($session_query['dateFrom']));
		// array_push($search_query, date('m/d/Y', $timeFrom).' - '.date('m/d/Y', $timeTo));
		array_push($search_query, date('m/d/Y', $timeFrom));
	}
	else{
		array_push($search_query, '');		
	}
	array_push($search_query, $session_query['sku']);
}
else{
	$search_query = array('','','');
}
 ?>

<div class="col-xs-12 order-search">
	<div class="row">	
		<div class="col-xs-12 col-sm-2 search-sort">
			<div class="row">
				<?php echo form_label($txt_sorting, 'search-sort'); ?>
				<div class="sort-controls">
					<?php 
					echo form_radio('created_date_sort','created_date_asc',(isset($session_query['sort_by']) && $session_query['sort_by'] == 'desc') ? TRUE : FALSE,array('id'	=>	'created_date_asc')).form_label($sort_labels[0],'created_date_asc').' |'.form_radio('created_date_sort','created_date_desc',(isset($session_query['sort_by']) && $session_query['sort_by'] == 'asc') ? TRUE : FALSE,array('id'	=>	'created_date_desc')).form_label($sort_labels[1],'created_date_desc');
					 ?>
				</div>
			</div>
		</div>
		<?php echo form_open('/seller/orders/search_order', array('id'=>'form_ordersearch','class'=>'form-inline')); ?>
		<div class="col-xs-12 col-sm-10 search-boxes">
			<div class="row">
				<div class="col-xs-12 col-sm-9">
					<div class="row">
						<?php foreach(['item_name','date_ordered','sku'] AS $ind=>$val): ?>
							<div class="col-xs-12 col-sm-4">
								<?php
									echo form_input(array(
										'name'	=>	$val,
										'value'	=>	!empty($search_query) ? $search_query[$ind] : '',
										'placeholder'	=>	ucfirst($order_boxes[$ind]),
										'type'	=>	'text',
										'class'	=>	'text-center'
										));
								?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="row">
						<button type="submit" class="btn btn-primary squarebtn pull-right" name="search_submit"><i class="fa fa-search"></i> <?php 	echo $txt_button_search; ?></button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>