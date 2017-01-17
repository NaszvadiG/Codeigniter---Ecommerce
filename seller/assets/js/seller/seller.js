//demo JS
var base_url = '/seller/';
$(function(){
	$.each($('.CartProduct .image img'), function(i,v){
		$(v).imageCheck();
	});

	$('.order-filter').on('click', function(){
		if (!$(this).hasClass('active')){
			$('.order-filter').removeClass('active');
			$(this).addClass('active');
		}
		switch($(this).data('filter_type')){
			case 'all':
			$('.order-customized').hide();
			$('.order-table').show();
			break;
			case 'standard':
			$('.order-customized').hide();
			$('.order-table').show();
			break;
			case 'customized':
			$('.order-customized').show();
			$('.order-table').hide();
			break;
			default:
			break;
		}
	});

	if($('#confirm_sale').length){
		$('#confirm_sale').click(function(){
			alert('Product ID '+$(this).data('id')+' added to confirmed orders');
		});
	}

	if($('#cancelOrderBtn button').length){
		$('#cancelOrderBtn button').click(function(){
			var orderid = $(this).data('txnref'),
			orderForm = '#'+$(this).data('order_id'),
			itemstatusArr = $(orderForm+' input[name=itemstatus]').val().split('|');
			itemstatusArr.forEach(function(ind,val){
				itemstatusArr[ind] = 'C';
			});
			$(orderForm+' input[name=itemstatus]').val(itemstatusArr.join('|'));
			var query = decodeURI('itemid='+$(orderForm+' input[name=itemid]').val()+'&itemstatus='+$(orderForm+' input[name=itemstatus]').val()+'&cancelReason='+$(orderForm+' input[name=cancelReason]').val());
			console.log(query.replace(/\s/g, '%2520'));
			$.post(base_url+'orders/itemsStatus/update', query.replace(/\s/g, '%2520'))
			.success(function(event){
				window.location.href = "pending_orders";
				console.log(event);
			})
			.fail(function(e){
				console.log(e);
			});
		});
	}

	if($('.awb_btn').length){
		$('.awb_btn').click(function(){
			var date = new Date();
			var datetime = {
				month: date.getMonth() + 1,
				day: date.getDate(),
				year: date.getFullYear(),
				hour: date.getHours() % 12 == 0 ? 12 : date.getHours() % 12,
				minute: date.getMinutes(),
				meridiem: this.hour < 12 ? 'AM' : 'PM',
				output: function(){
					return this.month.toString()+this.day.toString()+this.year.toString()+" "+this.hour+":"+this.minute+" "+this.meridiem;
				}
			}
			var awb_input = $($(this).parent('div').children()[0]).val() +" - "+ datetime.output();
			var itemStatStr = $('#'+$(this).data('order')+' input[name=itemstatus]').val();
			var awb = "&airwaybill=";
			var tempArr = itemStatStr.split('|');
			for (var i = 0; i < (tempArr.length); i++){
				if (tempArr[i] == '3'){
					tempArr[i] = $($(this).parent('div').children()[0]).val();
				}
				else{
					tempArr[i] = '';
				}				
			}
			awb += tempArr.join('|');
			$('#'+$(this).data('order')+' input[name=itemstatus]').val(itemStatStr.replace(new RegExp('3', 'g'), '4'));
			var query =decodeURI($('#'+$(this).data('order')).serialize());
			query += awb;
			console.log(query.replace(/\s/g, '%2520'))

			if (!$(this).parent('div').find('input').val()){
				$('#popupModal h4.modal-title').text('No Name');
				$('#popupModal p.message').text("Please enter the Driver's Name and Date/Time of pickup");
				$('#popupModal').data('invalid', true);
				$('#popupModal').modal('show');
			}
			else {
				$('#popupModal h4.modal-title').text('Package(s) Sent');
				$('#popupModal p.message').text('Please ensure to have the proper labels on each box before shipping. We appreciate your business');
				$('#popupModal').data('invalid', false);
				var div = $(this).parent('div');
				var trackingConf = div.parent('div').children()[1];
				
				$(trackingConf).find('.track_number').text(($($(this).parent('div').children()[0]).val()))

				$.post(base_url+'orders/itemsStatus/awb', query.replace(/\s/g, '%2520'))
				.success(function(e){
					$('#popupModal').modal('show');
					$(trackingConf).show();
					div.hide();
					console.log(e);
				})
				.fail(function(e){
					console.log(e);
				});
				
			}

		});
	}

	if($('#awbPopupOk').length){
		$('#awbPopupOk').click(function(){
			$('#popupModal').modal('hide');
		});
	}

	if($('.pickup_btn').length){
		$('.pickup_btn:not(:disabled)').click(function(){
			// var pickupDate = new Date($('#'+$(this).data('order')+' input[name=pickuptime]').val());
			
			var itemStatStr = $('#'+$(this).data('order')+' input[name=itemstatus]').val();
			$('#'+$(this).data('order')+' input[name=itemstatus]').val(itemStatStr.replace(new RegExp('2', 'g'), '3'));
			var query =decodeURI($('#'+$(this).data('order')).serialize());
			var button = $(this);
			$(this).prop('disabled', true);
			$(this).html('Arranging Pick Up...');
			$.post(base_url+'orders/itemsStatus/awb', query)
			.success(function(e){
				$('#popupModal').modal('show');
				button.html('Pick Up Arranged');
				console.log(e);
			})
			.fail(function(e){
				console.log(e);
			});
		});
	}

	if($('.arrange_pickup').length){
		$('.arrange_pickup').click(function(){
			var itemStatStr = $("form"+$(this).data('order')+" input[name=itemstatus]").val();
			window.location.href=base_url+"orders/arrange_pickup";
			// $("form"+$(this).data('order')+" input[name=itemstatus]").val(itemStatStr.replace(new RegExp('2', 'g'), '3'));
			// var query = decodeURI($("form"+$(this).data('order')).serialize());
			// console.log(query);
			// $.post(base_url+'itemsStatus/pickup', query)
			// .success(function(e){
			// 	window.location.href="arrange_pickup";
			// 	// alert($('#fulfillBoxes').val() + ' boxes fulfilled.');
			// 	console.log(e);
			// })
			// .fail(function(e){
			// 	console.log(e);
			// });
		})
	}

	
	
	// Pending Orders - Confirm Order Button
	if($('.order_submit').length){
		$('.order_submit').click(function(){
			var $button = $(this);
			// Get the box number from the input box, send it to the form.
			$('#boxLabelPopup #boxLabels-contents').empty();
			var boxInput = $(this).parents('.button-div').find('input[name=boxnumber]').val();
			$("form#"+$(this).data('order')+" input[name=boxnumber]").val(boxInput);
			
			// Store order values
			var postData = {
				'itemid': $("form#"+$(this).data('order')+" input[name=itemid]").val().split('|'),
				'itemstatus': $("form#"+$(this).data('order')+" input[name=itemstatus]").val().split('|'),
				'fulfilledqty': $("form#"+$(this).data('order')+" input[name=fulfilledqty]").val().split('|'),
				'cancelReason': $("form#"+$(this).data('order')+" input[name=cancelReason]").val().split('|'),
				'boxnumber': boxInput == "" ? 0 : boxInput,
				'sellersuite': $("form#"+$(this).data('order')+" input[name=sellersuite]").val(),
				'orderID': $("form#"+$(this).data('order')+" input[name=orderID]").val(),
				'merchant': $("form#"+$(this).data('order')+" input[name=itemmerchant]").val()
			},
			query = '',
			isChecked = false;
			function appendQuery(name){
				var array = [];
				switch(name){
					case 'itemid':
						array = postData.itemid;
						break;
					case 'itemstatus':
						array = postData.itemstatus;
						break;
					case 'fulfilledqty':
						array = postData.fulfilledqty;
						break;
					case 'cancelReason':
						array = postData.cancelReason;
						break;
					default:
						break;
				}

				$.each((array), function(id,value){
					
					if ((id == 0) && (id == array.length -1)){
						query += name+"="+value+"&";
					}
					else if (id == 0){
						query += name+"="+value;
					}
					else if (id == array.length -1){
						query += "|"+value+"&";
					}
					else if (id < 0 && id > array.length -1){
						query += "|"+value;
					}
					else {
						query += "|"+value;
					}
				});
			};

			function validator(index, value){
				if(value != 0){
					return true;
				}
				else{
					//No fulfilled qty
					if (postData.cancelReason[index] == ""){
						$('#alertNotif .modal-title').text('Order Error');
						$('#alertNotif .message').text('One of the items do not have a fulfilled quantity.\nPlease check your items and try again.');
						$('#alertNotif .popPrintBtnContainer').hide();
						$('#alertNotif .popDismissBtnContainer button').attr('onClick', '');
						$('#alertNotif .popDismissBtnContainer button').attr('data-dismiss', 'modal');
						$('#alertNotif').modal('show');
						return false;
					}
					else {
						return true;
					}
				}
			}
			// Check if cancel reason of that item has value
			$.each(postData.cancelReason, function(cr_i, cr_v){
				if (cr_v){
					// Has reason, Status is cancelled
					postData.itemstatus[cr_i] = 'C';
				}
				else{
					// No Reason, If has reason = Pending else Confirmed
					postData.itemstatus[cr_i] = postData.boxnumber == 0 ? 'P' : '2';	
				}
			});
			// Validation logic
			
			function validate(){
				var valid = false;
				$.each(postData.fulfilledqty, function(fl_i, fl_v){
					// Check for QTY Fullfilled

					if(fl_v == 0 && !postData.cancelReason[fl_i]){

						$('#alertNotif .modal-title').text('Order Error');
						$('#alertNotif .message').text('Please select a reason for cancellation or input a number on unfulfilled items.');
						$('#alertNotif .cancelOrderBtnGrp').show();
						$('#alertNotif #cancelOrderBtn').hide();
						$('#alertNotif .popPrintBtnGrp').hide();
						$('#alertNotif #pickupConfirmBtn').hide();
						$('#alertNotif #cancelDismissBtn button').html('OK');
						$('#alertNotif').modal('show');
						valid = false;
						return false;
					}
					else if (fl_v == 0 && postData.cancelReason[fl_i]){

						valid = true;
					}
					else if (fl_v != 0){

						valid = true;
					}
				});
				return valid;
			}

			if(validate()){
				var allPend = postData.itemstatus.every(elem => elem == 'P'),
				allCancel = postData.itemstatus.every(elem => elem == 'C');
				console.log(allPend)
				if (postData.boxnumber == 0){
					if (allCancel){
						appendQuery('itemid');
						appendQuery('itemstatus');
						appendQuery('fulfilledqty');
						appendQuery('cancelReason');
						query += 'boxnumber='+postData.boxnumber;
						console.log($('#boxLabelPopup #cancelOrderBtn button').data('order_id'));
						$button.html('Cancelling Order...');
						$button.prop('disabled', true);
						$('#alertNotif #cancelOrderBtn button').attr('data-order_id', $(this).data('order'));
						$('#alertNotif .modal-title').text('Cancel order');
						$('#alertNotif .message').text('Are you sure to cancel all items of this order?');
						$('#alertNotif .cancelOrderBtnGrp').show();
						$('#alertNotif .popAlertBtnGrp').hide();
						$('#alertNotif #cancelDismissBtn button').html('No');
						$('#alertNotif').modal('show');
						// showBoxLabelModal(postData.sellersuite, postData.orderID, postData.boxnumber);
						// console.log(query.replace(/\s/g, '%2520'));
						// $.post(base_url+'orders/itemsStatus/update', query.replace(/\s/g, '%2520'))
						// .success(function(e){
						// 	showBoxLabelModal(postData.sellersuite, postData.orderID, postData.boxnumber, '2');
						// 	console.log(e);
						// })
						// .fail(function(e){
						// 	console.log(e);
						// });
						return true;
					}
				}
				else if (postData.boxnumber > 0){
					if (!allCancel){
						appendQuery('itemid');
						appendQuery('itemstatus');
						appendQuery('fulfilledqty');
						appendQuery('cancelReason');
						query += 'boxnumber='+postData.boxnumber;
						showBoxLabelModal(postData.sellersuite, postData.orderID, postData.boxnumber);
						console.log(query.replace(/\s/g, '%2520'));
						$button.html('Confirming Order...');
						$button.prop('disabled', true);
						$.post(base_url+'orders/itemsStatus/update', query.replace(/\s/g, '%2520'))
						.success(function(e){
							showBoxLabelModal(postData.sellersuite, postData.orderID, postData.boxnumber,'2');
							console.log(e);
						})
						.fail(function(e){
							console.log(e);
						});
						return true;
					}
				}
				$('#alertNotif .modal-title').text('Order Error');
				$('#alertNotif .message').text('Please enter the number of boxes to fulfill and try again.');
				$('#alertNotif .cancelOrderBtnGrp').show();
				$('#alertNotif .popPrintBtnGrp').hide();
				$('#alertNotif .popAlertBtnGrp').hide();
				$('#alertNotif #cancelOrderBtn').hide();
				$('#alertNotif #cancelDismissBtn button').html('OK');
				$('#alertNotif').modal('show');
			}
		
			console.log($(this).data('cancelOrder'));

// var itemStatStr = $('#'+$(this).data('order')+' input[name=itemstatus]').val();
// itemStatStr = itemStatStr.replace(new RegExp('2', 'g'), 'P');
		})
	}

	// Pending Orders - Save Order Button
	if($('.order_save').length){
		$('.order_save').click(function(){
			$('#alertNotif .modal-title').text('Order Saved');
			$('#alertNotif .message').text('Order updates has been successfully saved');
			$('#alertNotif').modal('show');
		})
	}
	// END OF PENDING ORDERS

	// Fulfilledqty on change function
	// On value change, it will update the item fulfilled qty
	$('.product_table .CartProduct .fulfilledqty_input').on('change', function (evt) {
		var item = {
			'itemid':'',
			'itemStatus':'P',
			'fulfilledqty':'',
			'cancelReason':''
		}
		
		//Update the quantity fulfilled on the form
		var arr = $('#order'+$(this).data('order')+' input[name=fulfilledqty]').val().split('|');
		arr[$(this).data('item_id')] = $(this).val();
		$('#order'+$(this).data('order')+' input[name=fulfilledqty]').val(arr.join('|'));

		var query = '';
		var itemInputs = $(this).closest('.CartProduct.one_image');
		item.itemid = $(this).closest('.CartProduct.one_image').data('item');

		$('#collapse'+$(this).attr('id')).collapse('hide');
		if ($(this).val() != 0){
			$('#reasonBtn'+$(this).attr('id')).addClass('disabled');
			$('#reasonBtn'+$(this).attr('id')).html('Select Reason');
			
			var cancelArr = $('#order'+$(this).data('order')+' input[name=cancelReason]').val().split('|'),
			itemstatusArr = $('#order'+$(this).data('order')+' input[name=itemstatus]').val().split('|');
			cancelArr[$(this).data('item_id')] = $(this).data('value');
			itemstatusArr[$(this).data('item_id')] = 'P';
			$('#order'+$(this).data('order')+' input[name=cancelReason]').val(cancelArr.join('|'));
			$('#order'+$(this).data('order')+' input[name=itemstatus]').val(itemstatusArr.join('|'));

			item.fulfilledqty = $(this).val();
			query = 'itemid='+item.itemid+'&itemstatus='+item.itemStatus+'&fulfilledqty='+item.fulfilledqty+'&cancelReason=%2520';
			order_cancellable($(this).parents('tbody').data('order_id'),false);
		}
		else {
			$('#reasonBtn'+$(this).attr('id')).removeClass('disabled');
			query = 'itemid='+item.itemid+'&itemstatus='+item.itemStatus+'&fulfilledqty=0&cancelReason=%2520';
		}
		var elem = $(this);
		$(elem).prop('disabled', true);
		
		$.post(base_url+'orders/itemsStatus/update', query)
		.success(function(e){
			$(elem).prop('disabled', false);
			console.log(e);
		})
		.fail(function(e){
			$(elem).prop('disabled', false);
			console.log(e);
		});
	});

	// Box Number Input
	$('.product_table .orderTableFooter .fulfillBox').on('change', function (evt) {
		$(this).val($(this).val() == 0 ? '' : $(this).val());
	});

	if($('.viewBoxLabelBtn').length){
		$('.viewBoxLabelBtn').click(function(){
			var $button = $(this);
			$button.prop('disabled', true);
			var urlPath = window.location.pathname.split('/');
			var itemstat = urlPath[urlPath.length - 2] == 'awb_confirmation' ? '3' : '4';
			showBoxLabelModal($(this).data('sellersuite'), $(this).data('order'), $(this).data('boxnumber'),itemstat);
		});
	}

	if($('#printLabelsBtn').length){
		$('#printLabelsBtn').click(function(){
			var url = window.location.origin+"/seller/orders/order_print_packing_labels";
			var urlPath = window.location.pathname.split('/'),
			itemstat = '2';
			switch (urlPath[urlPath.length - 2]){
				case 'pending_orders':
				itemstat = '2';
				break;
				case 'awb_confirmation':
				itemstat = '3';
				break;
				case 'order_history':
				itemstat = '4';
				break;
				default:
				itemstat = '2';
				break;
			}
			window.open(url+"?order_id="+$(this).data('order_id')+"&boxnumber="+$(this).data('boxnumber')+"&itemstatus="+itemstat, '_blank');
		});
	}


	if($('.confirmActionBtn').length){
		$('.confirmActionBtn').click(function(){
			var button = $(this);
			var query = 'itemid='+$(this).data('item')+'&cancelReason=Item%2520cancelled&itemstatus=C';
			var selected=$(this.closest('.CartProduct.one_image'));
			console.log(query)
			var targetBtn = $($("#cancelWarnPop .confirmActionBtn").data('target'));
			if ($(targetBtn).not(':disabled')){
				button.addClass('loading');
				button.prop('disabled', true);
				$.post(base_url+'orders/itemsStatus/update', query)
				.success(function(e){
					$(selected).removeClass('loading');
					targetBtn.prop('disabled', true);
					$($("#cancelWarnPop .confirmActionBtn").data('target')).prop('disabled', true)
					if($(targetBtn).data('status') == 'C'){
						if ($(targetBtn.closest('tbody')).children('.CartProduct.one_image').length == 1){
							//Lazy method on removing the whole order if all items are reprocessed.
							window.location.reload();
						}
						var orderItemStatus = $('form'+$(targetBtn).data('order')+' input[name=itemstatus]').val().split('|');
						orderItemStatus[$(targetBtn).data('item_id')] = 'C';
						$('form'+$(targetBtn).data('order')+' input[name=itemstatus]').val(orderItemStatus.join('|'));
						targetBtn.html('<i class="fa fa-ban" aria-hidden="true"></i>Item Cancelled');
					}
					$('#cancelWarnPop').modal('hide');
					console.log(e);
				})
				.fail(function(e){
					$(selected).removeClass('loading')
					$(targetBtn).prop('disabled', false);
					console.log(e);
				});
			};
		});
	};


	// ITEM FUNCTIONALITIES
	if($('.addItem').length){
		$('.addItem').click(function(){
			// // var product = new item.product("Title", "Description");
			// var form = function(input){
			// 	return $('#itemForm input[name='+input+']');
			// }
			// form('item_name').val($('input[name=product_name]').val());
			// form('item_desc').val("<p>"+$('textarea[name=product_desc]').val().replace(/(\n)/g, '</p><p>')+"</p>");
			// // form('item_producer_id').val();
			// // form('item_cat_id').val();
			// // form('item_subcat_id').val();
			// // form('item_subsubcat_id').val();
			// // form('item_subsubsubcat_id').val();
			// form('item_price').val($('input[name=product_price]').val());
			// form('item_quantity').val($('input[name=product_qty]').val());
			// form('item_discount').val($('input[name=discount]').val());
			// form('item_bulk_discount').val($('input[name=bulk_discount]').val());
			// // form('item_minimum_order_size').val();
			// // form('item_color').val();
			// // form('item_size').val();
			// // form('item_weight').val();
			// // form('item_ship_in_a_box').val();
			// // form('item_length').val();
			// // form('item_width').val();
			// // form('item_height').val();
			// // form('item_sku').val();
			// // form('item_merchant_sku').val();

			// var product = new item.product(form('item_name').val(),form('item_desc').val(),form('item_producer_id').val(),form('item_cat_id').val(),form('item_subcat_id').val(),form('item_subsubcat_id').val(),form('item_subsubsubcat_id').val(),form('item_price').val(),form('item_quantity').val(),form('item_discount').val(),form('item_bulk_discount').val(),form('item_minimum_order_size').val(),form('item_color').val(),form('item_size').val(),form('item_weight').val(),form('item_ship_in_a_box').val(),form('item_length').val(),form('item_width').val(),form('item_height').val(),form('item_sku').val(),form('item_merchant_sku').val());
			// item.addItem(product);
		});
	};

	// if($('.clearItemForm').length){
	// 	$('.clearItemForm').click(function(){
	// 		item.clearForm();
	// 	});
	// };

	// if($('.deleteItem').length){
	// 	$('.deleteItem').click(function(){
	// 		item.deleteItem();
	// 	});
	// };

	// if($('.updateItem').length){
	// 	$('.updateItem').click(function(){
	// 		console.log($(this).data('itemdetail'));
	// 		item.updateDetail($(this).data('itemdetail'));
	// 	});
	// };

	if ($('.search-boxes input[name=date_ordered]').length){
		$('.search-boxes input[name=date_ordered]').daterangepicker({
			"singleDatePicker": true,
			"opens": "center",
			"buttonClasses": "btn btn-sm squarebtn",
			"applyClass": "redbtn",
			autoUpdateInput: false,
		});

		$('.search-boxes input[name=date_ordered]').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('MM/DD/YYYY'));
		});

		$('.search-boxes input[name=date_ordered]').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	}
	// Order Sort function
	$(document).on('change', '.sort-controls input', function(event){
		var sort_value = event.target.value == 'created_date_asc' ? 'desc' : 'asc',
		cookie,
		name = "seller_order_search_query=",
		ca = document.cookie.split(';');
	    for(var i = 0; i <ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            cookie = $.parseJSON(decodeURIComponent(c.substring(name.length,c.length)));
	        }
	        else{
	        	cookie = $.parseJSON('{"sku":"","prodname":"","dateFrom":"","dateTo":""}');
	        }
	    }
		cookie['sort_by'] = sort_value;
		cookie = encodeURIComponent(JSON.stringify(cookie));
		var d = new Date();
		d.setTime(d.getTime() + (60 * 60 * 24 * 30));
		var expires = "expires="+ d.toUTCString();
		document.cookie = name + cookie + ";" + expires + ";path=/";
		var hrefArr = window.location.href.split('/');
		hrefArr.splice(-2,2);
		hrefArr.push('search_order', '1');
		window.location.href = hrefArr.join('/');
	});
	// Order search SKU Validation
	if ($('#form_ordersearch').length){
		$.validator.addMethod("loginRegex", function(value, element) {
	        return this.optional(element) || /^[a-zA-Z0-9_\-]*$/i.test(value);
	    }, "Text must contain only letters, numbers, or dashes.");
		$('#form_ordersearch').validate({
			rules: {
				'sku': {
					loginRegex: true
				}
			},
			messages: {
				'sku': {
					loginRegex: "SKU format is not valid"
				}
			}
		});
	}

	$(document).on('submit', '#form_ordersearch', function(event){
		if (!$('#form_ordersearch').valid()){
			event.preventDefault();
		}
		else{
			$('#form_ordersearch button[type=submit]').prop('disabled', true)
			.html('<i class="fa fa-search"></i> Searching...');
		}
	});

	$(document).on('click', '.pickup_address_dropdown a', function(event){
		$(this).parents('ul').prev('button').html($(this).find('.address_line_1').text()+' <span class="caret"></span>')
	});

});


//end demo JS

// this script required for subscribe modal
/*$(window).load(function () {
		// full load
		$('#modalAds').modal('show');
		$('#modalAds').removeClass('hide');
	});*/
$('.accordion-option').click(function(){
	var reason = $(this).data('value');
	$('#accordion-parent').html(reason).click();
});
$(".menu-country li").click(function(e) {
		if(e.target.id == "menu-us"){
			$('#menu-us').addClass("sub-selected");
			$('#menu-thai').removeClass("sub-selected");
			$('.menu-sub-us').css('cssText', 'display: inline-block !important');
			$('.menu-sub-thai').css('cssText', 'display: none !important');
		}
		else if (e.target.id == "menu-thai"){
			$('#menu-us').removeClass("sub-selected");
			$('#menu-thai').addClass("sub-selected");
			$('.menu-sub-thai').css('cssText', 'display: inline-block !important');
			$('.menu-sub-us').css('cssText', 'display: none !important');
		}
	});


// New function for the reason accordion input - CGW-Renz - 10/12/2016 16:50



$('.select-reason').on('click','h3',function(){

	$('#collapse'+$(this).data('targetorder')+'_'+$(this).data('targetitem')).collapse("hide");
	$('#reasonBtn'+$(this).data('targetorder')+'_'+$(this).data('targetitem')).html(decodeURIComponent($(this).data('value')).replace(/\+/g, ' '));
	var cancelArr = $('#order'+$(this).data('targetorder')+' input[name=cancelReason]').val().split('|'),
	itemstatusArr = $('#order'+$(this).data('targetorder')+' input[name=itemstatus]').val().split('|');
	
	cancelArr[$(this).data('targetitem') - 1] = $(this).data('value');
	itemstatusArr[$(this).data('targetitem') - 1] = 'C';
	$('#order'+$(this).data('targetorder')+' input[name=cancelReason]').val(cancelArr.join('|'));
	$('#order'+$(this).data('targetorder')+' input[name=itemstatus]').val(itemstatusArr.join('|'));
	order_cancellable($(this).parents('tbody').data('order_id'),(cancelArr.every(elem => elem != '')));

	var itemid = $(this).closest('.CartProduct.one_image').data('item');
	query = 'itemid='+itemid+'&itemstatus=P&fulfilledqty=0&cancelReason='+$(this).data('value')+'&boxnumber=0';
	var $elem = $('#reasonBtn'+$(this).data('targetorder')+'_'+$(this).data('targetitem'));
	$elem.addClass('disabled');
	console.log(query);
	
	$.post(base_url+'orders/itemsStatus/update', query.replace(/\s/g, '%2520'))
	.success(function(e){
		$elem.removeClass('disabled');
		console.log(e);
	})
	.fail(function(e){
		$elem.removeClass('disabled');
		console.log(e);
	});
});

// function formInput_update(order_id, input){
// 	var arr = $('#order'+order_id+' input[name='++']').val().split('|');
// }

$('.select-reason button').click(function(e){
	if (!$(this).hasClass('disabled')){
		$($(this).data('collapse')).collapse("toggle");
	}
});



// if all items in an order has a cancel reason, disable box number input and change confirm order to cancel order
function order_cancellable(ordernum, bool){
	var tbody = 'tbody[data-order_id='+ordernum+']';
	$(tbody + ' input[name=boxnumber]').prop('disabled', bool);
	if ($(tbody + ' input[name=cancelReason]').val().split('|').every(elem => (elem != '') || (elem != ' ')  )) $(tbody + ' input[name=boxnumber]').val('');
	$(tbody + ' #orderconfirm_fulfillBoxes_btn'+(ordernum+1)).html(bool ? 'Cancel Order' : 'Confirm Order');
	$(tbody + ' #orderconfirm_fulfillBoxes_btn'+(ordernum+1)).data('cancelOrder', bool);
};

// $('input[name=checkSIB]').on('ifChecked', function(e){
// 	$('#collapseSIB').addClass('in');
// });

// $('input[name=checkSIB]').on('ifUnchecked', function(e){
// 	$('#collapseSIB').removeClass('in');
// 	$('#collapseSIB input').val('');
// });

// function appendColor(color){
// 	var selector = 'a[href=#collapseColor]',
// 	textArr = $(selector).text().replace(/Colors: /g,'').split(', '),
// 	capColor = color.charAt(0).toUpperCase() + color.slice(1);
// 	if(textArr[0]=='') textArr.splice(0,1);
// 	var textArrPos = $.inArray(capColor,textArr);
// 		console.log(textArr);
// 		console.log(textArrPos);
// 	if (textArrPos != -1){
// 		textArr.splice(textArrPos, 1);
// 	}
// 	else{
// 		textArr.push(capColor);
// 	}
// 	// console.log(textArr);
// 	$(selector).text('Colors: '+textArr.join(', '));
// 	// if(text.indexOf(color) != -1){
// 	// 	text.replace('/, '+color+'/g', '');
// 	// }
// 	// else{
// 	// 	text += ', '+color;
// 	// }
// 	// $(selector).text(text);
// }

// $('.color-list-item input').on('ifChecked', function(e){
// 	appendColor($(this).val());
// });
// $('.color-list-item input').on('ifUnchecked', function(e){
// 	appendColor($(this).val());
// });

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

function showBoxLabelModal(suite, order_id, boxnumber, itemstatus){
	console.log(order_id);
	console.log(boxnumber);
	console.log(itemstatus);
	$('#boxLabelPopup #boxLabels-contents').empty();
	if(boxnumber > 0){
		$('#boxLabelPopup .modal-title').text('Order Label(s)');
		$('#boxLabelPopup .message').text('Please print these labels and stick them on each box.');
		$('#boxLabelPopup .cancelOrderBtnGrp').hide();
		$('#boxLabelPopup .popPrintBtnGrp').show();
		
		$.post(base_url+'orders/packinglist_preview', "order_id="+order_id+"&boxnumber="+boxnumber+"&itemstatus="+itemstatus)
			.success(function(event){
				console.log(event);
				var packslip = '#boxLabelPopup .packingslip',
				orderlist = event['orderlist_details'],
				itemlist = orderlist['itmelist'];
				$('#boxLabelPopup .modal-body #print_container').remove();
				for(var i = 0; i < orderlist['boxnumber']; i++){
					var ordertxt = orderlist['txnRef']+'-'+suite+'-'+((i+1) < 10 ? '0' : '') + (i+1),
					packing_list_page = '<div id="print_container"> <div class="contents"> <div id="header"> <p class="footnote text-center">This serves as your packing slip. Please print</p> </div> <div class="packingslip"> <div class="header"> <div class="col-xs-9"> <div class="row"> <img src="/assets/images/logo.png" id="logo" class="image-responsive" alt="OneNow"> </div> <div class="packinginfo"> <!-- <div class="row"> <p>Address &amp; Contact:</p> <p>KHUN POR | +66 81 853 7920</p> </div> --> <div class="row"> <p>Order Date &amp; Time:</p> <p id="createTime">'+orderlist['createTime']+'</p> </div> <div class="row"> <p>Pick Up by Date:</p> <p id="pickupTime">'+orderlist['pickupTime']+'</p> </div> <div class="row"> <h4 id="orderID">'+ordertxt+'</h4> </div> </div> </div> <div class="col-xs-3"> <div class="barcode-container"> <div class="barcode barcodeImg" data-id="'+(i+1)+'" id="barcode"></div> </div> <h4 class="text-center scanorder">Scan Order label No. here</h4> </div> </div> <div class="orderlist"> <table class="table table-responsive"> <thead> <td class="col-xs-3">Merchant</td> <td class="col-xs-6">Description</td> <td class="col-xs-3">Remarks</td> </thead> <tbody id="items"> </tbody> <tfoot> <td colspan=3> <p class="important_notes">Important Note(s):</p> <p>*Please print in 3 copies for Seller Copy, Warehouse Copy and Driver&lsquo;s Copy</p> </td> </tfoot> </table> </div> <div class="footer"> <div class="col-xs-12"> <div class="row"> <p>Date Received: _________________________________________</p> <p>Seller Signature: _________________________________________</p><p>Warehouse Conforme Signature: _________________________________________</p></div></div></div></div></div></div>';
					$('#boxLabelPopup .modal-body').append(packing_list_page);
					new QRCode($('.barcodeImg')[i],{
						text: ordertxt,
						width: '250',
						height: '250'
					});
				}

				$(packslip+' #items tr').remove();
				itemlist.forEach(function(i,v){
					var row = '<tr><td>'+i['itemmerchant']+'</td><td><p>'+i['fulfilledqty']+'qty; '+i['itemname']+'</p><p>Size: '+(i['size'] != "null" ? i['size'] : 'N/A')+'</p><p>Color: '+(i['size'] != "null" ? i['size'] : 'N/A')+'</p></td><td></td></tr>';
					$(packslip+' #items').append(row);
				});
				$('#boxLabelPopup').modal('show');
				console.log(event);
			})
			.fail(function(e){
				console.log(e);
			});

		$('#boxLabelPopup #printLabelsBtn').data('order_id', order_id);
		$('#boxLabelPopup #printLabelsBtn').data('boxnumber', boxnumber);
		$('#boxLabelPopup .popDismissBtnContainer button').attr('onClick', 'window.location.href="/seller/orders/confirmed_orders"');
		$('#boxLabelPopup .popDismissBtnContainer button').attr('data-dismiss', '');
		
	}

	else {
		$('#alertNotif .modal-title').text('Cancel order');
		$('#alertNotif .message').text('Are you sure to cancel all items of this order?');
		$('#alertNotif .cancelOrderBtnGrp').show();
		$('#alertNotif .popAlertBtnGrp').hide();
		$('#alertNotif #cancelDismissBtn button').html('No');
		$('#alertNotif').modal('show');
	}

	$('#boxLabelPopup').on('hidden.bs.modal', function(e){
		if ($('.viewBoxLabelBtn').length){
			$('.viewBoxLabelBtn').prop('disabled', false);
		}
	})
}


function getImageDataUri(url, callback) {
	var image = new Image();

	image.onload = function () {
		var canvas = document.createElement('canvas');
		canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
		canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

		canvas.getContext('2d').drawImage(this, 0, 0);

		// Get raw image data
		callback(canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, ''));

		// ... or get as Data URI
		callback(canvas.toDataURL('image/png'));
	};

	image.src = url;
}

